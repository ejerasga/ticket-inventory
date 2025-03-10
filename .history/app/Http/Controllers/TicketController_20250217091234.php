<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Location;

class TicketController extends Controller {
    public function index() {
        $services = Service::all();
        $locations = Location::all();
        return view('ticket.create_ticket', compact('services', 'locations'));
    }

    public function store(Request $request) {
        $request->validate([
            's_id' => 'required', // service id
            'located_at' => 'required', // location id
            'd_id' => 'required', // department id
            'description' => 'required',
            'date_needed' => 'required|date',
            'time_needed' => 'required|date_format:H:i',
        ]);

        Ticket::create([
            't_control_no' => 'TCKT-' . now()->format('YmdHis'),
            's_id' => $request->s_id,
            'located_at' => $request->located_at,
            'description' => $request->description,
            'date_needed' => $request->date_needed,
            'time_needed' => $request->time_needed,
        ]);

        return redirect()->route('ticket.ticket_list')->with('success', 'Ticket created successfully!');
    }


    public function tickets()
    {
        $tickets = Ticket::all();
        return view('ticket.ticket_list', compact('tickets'));
    }
}
