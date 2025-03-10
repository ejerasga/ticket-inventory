<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $departments = Role::all(); // Fetch all roles
        return view('users.create_users', compact('departments'));
    }
}
