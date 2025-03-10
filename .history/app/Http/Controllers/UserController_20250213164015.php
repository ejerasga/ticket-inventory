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

    public function store($request) {
        $user = User::create([
            'u_username' => $request->input('u_username'),
            'password' => Hash::make($request->password),
            'u_fname' => $request->input('u_fname'),
        ]);
    }



}
