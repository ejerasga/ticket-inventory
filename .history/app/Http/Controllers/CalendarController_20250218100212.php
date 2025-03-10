<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index() {


        $services = Service::all();
        $locations = Location::all();
        $departments = Department::all();

        return view('ticket.create_ticket', compact('services', 'locations' , 'departments'));
    }
}
