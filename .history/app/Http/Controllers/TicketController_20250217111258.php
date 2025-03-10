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
    
        // Get the currently logged-in user
        $user = auth()->user();
    
        // Convert date_needed and time_needed into a full datetime format
        $dateNeeded = $request->input('date_needed');
        $timeNeeded = $request->input('time_needed');
        $dateTimeNeeded = $dateNeeded . ' ' . $timeNeeded . ':00'; // Format: YYYY-MM-DD HH:MM:SS
    
        // Create the ticket object
        $ticket = new Ticket();
        $ticket->s_id = $request->input('s_id');
        $ticket->located_at = $request->input('l_id');
        $ticket->d_id = $request->input('d_id');
        $ticket->f_name = $request->input('f_name');
        $ticket->l_name = $request->input('l_name');
        $ticket->date_needed = $dateNeeded;
        $ticket->time_needed = $dateTimeNeeded; // Store full datetime
        $ticket->description = $request->input('description');
    
        // Assign req_by as the logged-in user's ID
        $ticket->req_by = $user->u_id;  
    
        // Assign t_control_no with a unique ticket ID
        $ticket->t_control_no = 'TCKT-' . uniqid();
    
        // Save the ticket
        $ticket->save();
    
        return redirect()->route('ticket_list')->with('success', 'Ticket created successfully!');
    }
    
    

    public function tickets()
    {
        // Eager load the necessary relationships
        $tickets = Ticket::with(['service', 'location', 'departments'])->get();
        return view('ticket.ticket_list', compact('tickets'));
    }

}
