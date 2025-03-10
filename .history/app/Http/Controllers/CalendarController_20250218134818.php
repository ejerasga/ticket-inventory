<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index() {
        return view('users.calendar');
    }

    public function getEvents() {
        // Get assigned tickets
        $tickets = Ticket::where('status', '>=', 1) // Only assigned tickets
            ->whereNotNull('assigned_to')
            ->with(['assignedStaff', 'service']) // Eager load relationships
            ->get();

        $events = [];

        foreach ($tickets as $ticket) {
            // Create datetime string from date and time
            $startDateTime = $ticket->date_needed . ' ' . date('H:i:s', strtotime($ticket->time_needed));
            
            // Add 1 hour as default duration
            $endDateTime = date('Y-m-d H:i:s', strtotime($startDateTime . ' +1 hour'));

            $events[] = [
                'id' => $ticket->t_control_no,
                'title' => 'Ticket: ' . $ticket->service->s_name . ' - ' . $ticket->assignedStaff->f_name . ' ' . $ticket->assignedStaff->l_name,
                'start' => $startDateTime,
                'end' => $endDateTime,
                'url' => route('show_ticket_info', $ticket->id), // Add this route if you want clickable events
                'backgroundColor' => $this->getStatusColor($ticket->status),
                'borderColor' => $this->getStatusColor($ticket->status),
            ];
        }

        return response()->json($events);
    }

    private function getStatusColor($status) {
        switch ($status) {
            case 1: // In Progress
                return '#ffc107'; // Yellow
            case 2: // For Evaluation
                return '#17a2b8'; // Blue
            case 4: // Completed
                return '#28a745'; // Green
            case 9: // Rejected
                return '#dc3545'; // Red
            default:
                return '#6c757d'; // Grey
        }
    }
}