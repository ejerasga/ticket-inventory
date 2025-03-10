<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('users.create_users', compact('departments', 'roles'));
    }
}
