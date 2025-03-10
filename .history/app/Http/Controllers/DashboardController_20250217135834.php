<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if the user is a regular user (r_id == 3)
        if ($user->r_id == 3) {
            // Count only the tickets requested by the logged-in user
            $pendingTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 0)->count();
            $inProgressTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 1)->count();
            $completedTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 2)->count();
        } else {
            // If Admin or Super Admin, count all tickets
            $pendingTicketCount = Ticket::where('status', 0)->count();
            $inProgressTicketCount = Ticket::where('status', 1)->count();
            $completedTicketCount = Ticket::where('status', 2)->count();
        }

        return view('dashboard', compact('pendingTicketCount', 'inProgressTicketCount', 'completedTicketCount'));
    }
}
