<?php

namespace App\Http\Controllers;

use App\Models\PrRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class PrRequestController extends Controller
{
    public function index()
    {
        $prRequests = PrRequest::with('department')->get();
        return view('inventory.pr_requests.prrequests', compact('prRequests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requestor_name' => 'required',
            'department_id' => 'required|exists:departments,d_id',
            'item' => 'required',
            'qty' => 'required|integer',
            'unit' => 'required',
            'purpose' => 'required',
            'date_requested' => 'required|date',
            'arrived' => 'required|boolean',
            'date_arrived' => 'nullable|date|required_if:arrived,1',
            'remarks' => 'nullable',
        ]);

        PrRequest::create($validated);

        return redirect()->route('prrequests.index')->with('success', 'PR request created successfully');
    }

    public function edit($id)
    {
        $prRequest = PrRequest::findOrFail($id);
        $departments = Department::all();
        return view('inventory.pr_requests.editPrRequests', compact('prRequest', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'requestor_name' => 'required',
            'department_id' => 'required|exists:departments,d_id',
            'item' => 'required',
            'qty' => 'required|integer',
            'unit' => 'required',
            'purpose' => 'required',
            'date_requested' => 'required|date',
            'arrived' => 'required|boolean',
            'date_arrived' => 'nullable|date|required_if:arrived,1',
            'remarks' => 'nullable',
        ]);

        $prRequest = PrRequest::findOrFail($id);
        $prRequest->update($validated);

        return redirect()->route('prrequests.index')->with('success', 'PR request updated successfully');
    }

    public function destroy($id)
    {
        PrRequest::findOrFail($id)->delete();
        return redirect()->route('prrequests.index')->with('success', 'PR request deleted successfully');
    }
}