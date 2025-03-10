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
            's_id' => 'required',
            'located_at' => 'required',
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

        return redirect()->route('ticket_create')->with('success', 'Ticket created successfully!');
    }


    public function users()
    {
        $users = Ticket::all();
        return view('ticket', compact('tickets'));
    }
}
