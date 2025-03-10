<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserValidation;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // Fetch all departments
        $roles = Role::all(); // Fetch all roles

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
            'u_mname' => $request->input('u_mname'),
            'u_lname' => $request->input('u_lname'),
            'u_gender' => $request->input('u_gender'),
            'u_contact' => $request->input('u_contact'),
            'r_id' => $request->input('r_id'),
            'd_id' => $request->input('d_id'),
        ]);
        

        return redirect()->route('user_create')->with('success', 'User created successfully!');
    }


    public function edit($u_id)
    {
        $rows = User::find($u_id);

        return view('users/edit_users', compact('rows'));
    }


    public function update(Request $request, $u_id)
    {
        $rows = User::find($u_id);
        // Update user data based on the form input
        $rows->u_username = $request->input('u_username');
        $rows->u_password = $request->input('u_password');
        $rows->u_fname = $request->input('u_fname');
        $rows->u_mname = $request->input('u_mname');
        $rows->u_lname = $request->input('u_lname');
        $rows->u_gender = $request->input('u_gender');
        $rows->u_contact = $request->input('u_contact');
        $rows->update();

        return redirect()->route('user_list')->with('success', 'User updated successfully.');
    }
}
