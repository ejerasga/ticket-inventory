<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('users.create_users', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'u_username' => 'required|unique:users,u_username',
            'u_password' => 'required|min:6',
            'u_fname' => 'required',
            'u_lname' => 'required',
            'u_gender' => 'required',
            'u_contact' => 'required',
            'r_id' => 'required|exists:roles,r_id',
            'd_id' => 'required|exists:departments,d_id',
        ]);

        User::create([
            'u_username' => $request->input('u_username'),
            'u_password' => Hash::make($request->input('u_password')),
            'u_fname' => $request->input('u_fname'),
            'u_mname' => $request->input('u_mname') ?? null,
            'u_lname' => $request->input('u_lname'),
            'u_gender' => $request->input('u_gender'),
            'u_contact' => $request->input('u_contact'),
            'r_id' => $request->input('r_id'),
            'd_id' => $request->input('d_id'),
        ]);

        return redirect()->route('user_create')->with('success', 'User created successfully!');
    }

    public function users()
    {
        $users = User::all();
        return view('users.user_list', compact('users'));
    }

    public function profile($u_id)
    {
        $user = User::findOrFail($u_id);
        return view('users.profile', compact('user'));
    }

    public function edit($u_id)
    {
        $user = User::findOrFail($u_id);
        $departments = Department::all();
        $roles = Role::all();
        return view('users.edit_users', compact('user', 'departments', 'roles'));
    }

    public function update(Request $request, $u_id)
    {
        $request->validate([
            'u_username' => 'required|unique:users,u_username,' . $u_id . ',u_id',
            'u_fname' => 'required',
            'u_lname' => 'required',
            'u_gender' => 'required',
            'u_contact' => 'required',
            'r_id' => 'required|exists:roles,r_id',
            'd_id' => 'required|exists:departments,d_id',
        ]);

        $user = User::findOrFail($u_id);
        $user->u_username = $request->input('u_username');
        $user->u_fname = $request->input('u_fname');
        $user->u_mname = $request->input('u_mname') ?? null;
        $user->u_lname = $request->input('u_lname');
        $user->u_gender = $request->input('u_gender');
        $user->u_contact = $request->input('u_contact');
        $user->r_id = $request->input('r_id');
        $user->d_id = $request->input('d_id');

        if ($request->filled('u_password')) {
            $user->u_password = Hash::make($request->input('u_password'));
        }

        $user->save();

        return redirect()->route('user_list')->with('success', 'User updated successfully.');
    }

    public function updateProfile(Request $request, $u_id)
    {
        $request->validate([
            'u_username' => 'required|unique:users,u_username,' . $u_id . ',u_id',
            'u_fname' => 'required',
            'u_lname' => 'required',
            'u_gender' => 'required',
            'u_contact' => 'required',
            'user_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
        ]);

        $user = User::findOrFail($u_id);
        $user->u_username = $request->input('u_username');
        $user->u_fname = $request->input('u_fname');
        $user->u_mname = $request->input('u_mname') ?? null;
        $user->u_lname = $request->input('u_lname');
        $user->u_gender = $request->input('u_gender');
        $user->u_contact = $request->input('u_contact');

        // Handle profile image upload
        if ($request->hasFile('user_icon')) {
            // Delete old image if it exists
            if ($user->user_icon) {
                Storage::disk('public')->delete($user->user_icon);
            }
            
            $file = $request->file('user_icon');
            $filename = $user->u_username . '.' . $file->getClientOriginalExtension();
            $path = 'user_icons/' . $user->u_username;
            
            // Create directory if it doesn't exist
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            
            // Store the file
            $file->storeAs('public/' . $path, $filename);
            $user->user_icon = $path . '/' . $filename;
        }

        $user->save();

        return redirect()->route('user_profile', ['u_id' => $user->u_id])->with('success', 'Profile updated successfully.');
    }

    public function destroy($u_id)
    {
        $user = User::findOrFail($u_id);
        $user->delete();
        
        return redirect()->route('user_list')->with('success', 'User deleted successfully.');
    }
}