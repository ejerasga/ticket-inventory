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
            's_id' => 'required', 
            'l_id' => 'required', 
            'd_id' => 'required|exists:departments,d_id', 
            'f_name' => 'required',
            'l_name' => 'required',
            'date_needed' => 'required|date',
            'time_needed' => 'required|date_format:H:i',
            'description' => 'required',
        ]);
    
        // Create the ticket object but don't save it yet
        $ticket = new Ticket();
        $ticket->s_id = $request->input('s_id');
        $ticket->located_at = $request->input('l_id');
        $ticket->d_id = $request->input('d_id');
        $ticket->f_name = $request->input('f_name');
        $ticket->l_name = $request->input('l_name');
        $ticket->date_needed = $request->input('date_needed');
        $ticket->time_needed = $request->input('time_needed');
        $ticket->description = $request->input('description');
    
        // Assign a temporary t_control_no before saving
        $ticket->t_control_no = 'TCKT-' . uniqid();
    
        // Save the ticket
        $ticket->save();
    
        return redirect()->route('ticket.ticket_list')->with('success', 'Ticket created successfully!');
    }
    
    
    


    public function tickets()
    {
        $tickets = Ticket::all();
        return view('ticket.ticket_list', compact('tickets'));
    }
}
