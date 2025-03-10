<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Existing ticket counts
        if ($user->r_id == 3) {
            $pendingTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 0)->count();
            $inProgressTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 1)->count();
            $completedTicketCount = Ticket::where('req_by', $user->u_id)->where('status', 2)->count();
        } else {
            $pendingTicketCount = Ticket::where('status', 0)->count();
            $inProgressTicketCount = Ticket::where('status', 1)->count();
            $completedTicketCount = Ticket::where('status', 2)->count();
        }


        // Get ticket assignment breakdown for MIS department
        $ticketAssignments = User::select(
            'users.u_id',
            DB::raw('CONCAT(users.u_fname, " ", users.u_lname) as full_name'),
            DB::raw('COUNT(tickets.t_id) as ticket_count')
        )
        ->leftJoin('tickets', 'users.u_id', '=', 'tickets.assigned_to')
        ->whereIn('users.r_id', [1, 2]) // Super Admin and Admin
        ->where('users.d_id', 1) // MIS department
        ->groupBy('users.u_id', 'users.u_fname', 'users.u_lname')
        ->get();

        return view('dashboard', compact(
            'pendingTicketCount',
            'inProgressTicketCount',
            'completedTicketCount',
            'ticketAssignments'
        ));
    }
}