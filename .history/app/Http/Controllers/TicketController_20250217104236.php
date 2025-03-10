<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Location;
use App\Models\Department;

class TicketController extends Controller {
    public function index() {
        $services = Service::all();
        $locations = Location::all();
        $departments = Department::all();
        return view('ticket.create_ticket', compact('services', 'locations' , 'departments'));
    }

    public function store(Request $request) {
        $request->validate([
            's_id' => 'required|exists:services,s_id',
            'l_id' => 'required|exists:locations,l_id', 
            'd_id' => 'required|exists:departments,d_id', 
            'f_name' => 'required',
            'l_name' => 'required',
            'date_needed' => 'required|date',
            'time_needed' => 'required|date_format:H:i',
            'description' => 'required',
        ]);
    
        $ticket = Ticket::create([
            's_id'  => $request->input('s_id'),
            'located_at' => $request->input('l_id'), 
            'd_id' => $request->input('d_id'),
            'f_name' => $request->input('f_name'),
            'l_name' => $request->input('l_name'),
            'date_needed' => $request->input('date_needed'),
            'time_needed' => $request->input('time_needed'),
            'description' => $request->input('description'),
        ]);
    
        $ticket->t_control_no = 'TCKT-' . $ticket->t_id;
        $ticket->save();
    
        return redirect()->route('ticket.ticket_list')->with('success', 'Ticket created successfully!');
    }
    


    public function tickets()
    {
        $tickets = Ticket::all();
        return view('ticket.ticket_list', compact('tickets'));
    }
}
