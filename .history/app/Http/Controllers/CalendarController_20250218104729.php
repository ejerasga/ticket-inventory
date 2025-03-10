<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class CalendarController extends Controller
{
    public function index()
    {
        return view('users.calendar');
    }

    public function getEvents()
    {
        $tickets = Ticket::where('assigned_to', '!=', null)
            ->with(['assignedStaff', 'service'])
            ->get();

        $events = [];

        foreach ($tickets as $ticket) {
            // Combine date and time
            $dateTime = date('Y-m-d H:i:s', strtotime($ticket->date_needed . ' ' . $ticket->time_needed));
            
            // Create event
            $events[] = [
                'id' => $ticket->t_id,
                'title' => 'Ticket: ' . $ticket->t_control_no . ' - ' . $ticket->assignedStaff->u_fname,
                'start' => $dateTime,
                // Set end time to 1 hour after start by default
                'end' => date('Y-m-d H:i:s', strtotime($dateTime . '+1 hour')),
                'description' => $ticket->description,
                'url' => route('ticket_info', $ticket->t_id),
                'backgroundColor' => $this->getStatusColor($ticket->status),
            ];
        }

        return response()->json($events);
    }

    private function getStatusColor($status)
    {
        return match ($status) {
            1 => '#3498db', // In Progress - Blue
            2 => '#f1c40f', // For Evaluation - Yellow
            4 => '#2ecc71', // Completed - Green
            9 => '#e74c3c', // Rejected - Red
            default => '#95a5a6', // Default - Gray
        };
    }
}