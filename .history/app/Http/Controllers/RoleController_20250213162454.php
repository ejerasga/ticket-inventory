<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // Fetch all departments
        return view('users.create_users', compact('departments'));
    }
}
