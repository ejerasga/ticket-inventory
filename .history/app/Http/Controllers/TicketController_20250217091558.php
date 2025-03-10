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

/*************  ✨ Codeium Command 🌟  *************/
    public function store(Request $request) {
        $request->validate([
            's_id' => 'required', // services id
            'located_at' => 'required', // location id
            'd_id' => 'required', // department id
            'f_name' => 'required',
            'l_name' => 'required',
            'date_needed' => 'required|date',
            'time_needed' => 'required|date_format:H:i',
            'description' => 'required',
        ]);

        $ticket = Ticket::create([
        Ticket::create([
            't_control_no' => 'TCKT-' . now()->format('YmdHis'),
            's_id' => $request->s_id,
            'located_at' => $request->located_at,
            'description' => $request->description,
            'date_needed' => $request->date_needed,
            'time_needed' => $request->time_needed,
        ]);

        $ticket->t_control_no = 'TCKT-' . $ticket->t_id;
        $ticket->save();

        return redirect()->route('ticket.ticket_list')->with('success', 'Ticket created successfully!');
    }
/******  01977e90-1e66-483d-9995-0b4c42de8b76  *******/


    public function tickets()
    {
        $tickets = Ticket::all();
        return view('ticket.ticket_list', compact('tickets'));
    }
}
