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

    public function store(CreateUserValidation $request) {
        $user = User::create([
            'u_fname' => $request->u_fname,
            'u_mname' => $request->u_mname,
            'u_lname' => $request->u_lname,
            'u_gender' => $request->u_gender,
            'u_contact' => $request->u_contact,
            'd_id' => $request->d_id,
            'r_id' => $request->r_id,
            'password' => Hash::make($request->password),
        ]);
    }



}
