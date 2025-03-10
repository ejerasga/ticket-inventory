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




}
