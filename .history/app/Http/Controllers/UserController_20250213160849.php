<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserValidation;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.create_users');
    }

    public function store($request)
    {
        $hashedPassword = Hash::make($request->input('u_password'));
        $rows = new User;
        $rows->u_username = $request->input('u_username');
        $rows->u_password = $hashedPassword;
        $rows->u_fname = $request->input('u_fname');
        $rows->u_mname = $request->input('u_mname');
        $rows->u_lname = $request->input('u_lname');
        $rows->u_suffix = $request->input('u_suffix');
        $rows->u_gender = $request->input('u_gender');
        $rows->u_contact = $request->input('u_contact');
        $rows->u_sig = $request->input('u_sig');
        $rows->o_id = $request->input('o_id');
        $rows->d_id = $request->input('d_id');
        $rows->r_id = 5;
        $rows->remember_token = $request->input('remember_token');
        $rows->is_active = $request->input('is_active');

        $rows->save();

        return redirect()->route('user_list')->with('success', 'Data saved successfully');
    }
}
