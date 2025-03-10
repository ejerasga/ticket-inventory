<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Role;

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
        ]);

        $user = User::findOrFail($u_id);
        $user->u_username = $request->input('u_username');
        $user->u_fname = $request->input('u_fname');
        $user->u_mname = $request->input('u_mname') ?? null;
        $user->u_lname = $request->input('u_lname');
        $user->u_gender = $request->input('u_gender');
        $user->u_contact = $request->input('u_contact');

        if ($request->filled('u_password')) {
            $user->u_password = Hash::make($request->input('u_password'));
        }

        $user->save();

        return redirect()->route('user_edit', ['u_id' => $u_id])->with('success', 'User updated successfully.');
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
}
