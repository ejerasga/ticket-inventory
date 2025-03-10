<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller {
    public function index() {

        $counts = $this->getIndexCounts();

        $services = Service::all();
        $locations = Location::all();
        $departments = Department::all();

        return view('ticket.create_ticket', compact('services', 'locations' , 'departments'));
    }

    public function getIndexCounts() {

        $user = Auth::user();

        $roles = [
            1 => 'Super Admin',
            2 => 'Admin',
            3 => 'USER',
        ];

        if ($user->r_id == 1 || $user->r_id == 2) {
            $countPendingRequests = TicketModel::where('initial_status', 0)->count();
            $countOngoingRequests = TicketModel::where('initial_status', '>', 0)->where('final_status', 0)->count();
        } else {
            $countPendingRequests = RequestModel::where('u_id', $user->u_id)->where('initial_status', 0)->count();
            $countOngoingRequests = RequestModel::where('u_id', $user->u_id)->where(function ($query) {
                $query->where('initial_status', '>', 0)->orWhere(function ($query) {
                    $query->where('initial_status', 1)->where('final_status', 0);
                });
            })->count();
        }
    
        // Fetch the first five pending requests for the "For Approval" card
        $pendingRequestsForApproval = RequestModel::where('initial_status', 0)
            ->orderBy('req_id', 'asc')
            ->limit(5)
            ->get();
    
        // Fetch the first five pending requests for the "In Progress" card
        $requestsInProgress = RequestModel::where('initial_status', '>', 0)
            ->where('final_status', 0)
            ->orderBy('req_id', 'asc')
            ->limit(5)
            ->get();
    
        return [
            'countPendingRequests' => $countPendingRequests,
            'countOngoingRequests' => $countOngoingRequests,
            'pendingRequestsForApproval' => $pendingRequestsForApproval,
            'requestsInProgress' => $requestsInProgress,
            'roles' => $roles,
        ];

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
        // Get the currently authenticated user
        $user = auth()->user();

        // Check the login user role
        if ($user->r_id == '3') {
            // If the user is a regular User, show only their own tickets
            $tickets = Ticket::where('req_by', $user->u_id) // Filter by req_by (the user who requested the ticket)
                            ->with(['service', 'location', 'department'])
                            ->get();
        } else {
            // If the user is an Admin or Super Admin, show all tickets
            $tickets = Ticket::with(['service', 'location', 'department'])->get();
        }

        // Return the view with the filtered tickets
        return view('ticket.ticket_list', compact('tickets'));
    }


}
