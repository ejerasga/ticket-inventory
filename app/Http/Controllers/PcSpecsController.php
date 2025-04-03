<?php

namespace App\Http\Controllers;

use App\Models\PcSpecs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
use App\Models\Location; // Add this line

class PcSpecsController extends Controller
{
    public function index()
    {
        $pcs = PcSpecs::with(['department', 'location'])->get(); // Add location relationship
        $departments = Department::all();
        $locations = Location::all(); // Get all locations

        return view('inventory.pc_specs.pcspecs', compact('pcs', 'departments', 'locations'));
    }

    public function store(Request $request)
    {
        Log::info('PcSpecsController@store', ['request' => $request->all()]);

        try {
            $validated = $request->validate([
                'name_deployed' => 'required|string|max:255',
                'department_id' => 'required|exists:departments,d_id',
                'location_id' => 'required|exists:locations,l_id', // Validate location exists
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image_filenames = [];
            $department = Department::find($request->department_id);
            $departmentFolder = strtolower($department->d_name);
            $userFolder = strtolower($request->name_deployed);
            $path = 'pc_images/' . $departmentFolder . '/' . $userFolder;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $filename = sprintf('%s(%d)-PC.%s', $request->name_deployed, $index + 1, $image->getClientOriginalExtension());

                    $directory = public_path($path);
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    $image->move($directory, $filename);
                    $image_filenames[] = $filename;
                }
            }

            Log::info('PcSpecsController@store', ['image_filenames' => $image_filenames]);

            $validated['image_filenames'] = $image_filenames;

            $pc = PcSpecs::create($validated);

            return redirect()->route('pcspecs.index')->with('success', 'PC Specification added successfully.');
        } catch (\Exception $e) {
            Log::error('PcSpecsController@store', ['error' => $e->getMessage(), 'request' => $request->all()]);
            return back()->with('error', 'Error adding PC: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(PcSpecs $pcspec)
    {
        $departments = Department::all();
        $locations = Location::all(); // Add locations data

        return view('inventory.pc_specs.editspecs', compact('pcspec', 'departments', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_deployed' => 'required|string',
            'department_id' => 'required|exists:departments,d_id',
            'location_id' => 'required|exists:locations,l_id', // Validate location exists
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pcspec = PcSpecs::findOrFail($id);

        $department = Department::find($request->department_id);
        $departmentName = strtolower($department->d_name);
        $userFolder = strtolower($request->name_deployed);
        $path = 'pc_images/' . $departmentName . '/' . $userFolder;

        // Handle image deletions
        if ($request->has('delete_images') && is_array($request->delete_images)) {
            $currentImages = $pcspec->image_filenames ?? [];
            $imagesToKeep = [];

            foreach ($currentImages as $image) {
                if (!in_array($image, $request->delete_images)) {
                    $imagesToKeep[] = $image;
                } else {
                    $oldPath = $path . '/' . $image;
                    if (file_exists(public_path($oldPath))) {
                        unlink(public_path($oldPath));
                    }
                }
            }

            $pcspec->image_filenames = $imagesToKeep;
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $directory = public_path($path);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            if (!is_array($pcspec->image_filenames)) {
                $pcspec->image_filenames = [];
            }

            foreach ($request->file('images') as $index => $image) {
                $filename = sprintf(
                    '%s(%d)-PC.%s',
                    $request->name_deployed,
                    count($pcspec->image_filenames) + $index + 1,
                    $image->getClientOriginalExtension()
                );

                $image->move($directory, $filename);
                $pcspec->image_filenames[] = $filename;
            }
        }

        // Update basic information
        $pcspec->name_deployed = $request->name_deployed;
        $pcspec->department_id = $request->department_id;
        $pcspec->location_id = $request->location_id;

        $pcspec->save();

        return redirect()->route('pcspecs.index')->with('success', 'PC Specification updated successfully');
    }

    public function destroy(PcSpecs $pcspec)
    {
        $pcspec->delete();

        return redirect()->route('pcspecs.index')->with('success', 'PC Specification deleted successfully.');
    }

    public function images(PcSpecs $pcspec)
    {
        return view('inventory.pc_specs.viewimages', compact('pcspec'));
    }
}