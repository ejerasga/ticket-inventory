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

        $user = User::create([
            'u_username' => $request->input('u_username'),
            'password' => Hash::make($request->password),
            'u_fname' => $request->input('u_fname'),
            'u_mname' => $request->input('u_mname'),
            'u_lname' => $request->input('u_lname'),
            'u_gender' => $request->input('u_gender'),
            'u_contact' => $request->input('u_contact'),
            'r_id' => $request->input('r_id'),
            'd_id' => $request->input('d_id'),
        ]);
    }



}
