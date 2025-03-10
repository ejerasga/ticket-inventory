<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evaluation;


class TicketController extends Controller {
    public function index() {


        $services = Service::all();
        $locations = Location::all();
        $departments = Department::all();

        return view('ticket.create_ticket', compact('services', 'locations' , 'departments'));
    }



    // Store a new ticket in the database
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
    
    
    // Display the list of tickets
    public function tickets()
    {
        $user = auth()->user();

        if ($user->r_id == 3) {
            $tickets = Ticket::where('req_by', $user->u_id)
                ->with(['service', 'location', 'department', 'assignedStaff'])
                ->get();
        } else {
            $tickets = Ticket::with(['service', 'location', 'department', 'assignedStaff'])
                ->get();
        }

        $adminUsers = User::where('r_id', 2)->get();

        return view('ticket.ticket_list', compact('tickets', 'adminUsers'));
    }

    // Assign a ticket to a user
    public function assignTicket(Request $request, $id)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,u_id',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        // Verify if the assigner is a Super Admin
        if (Auth::user()->r_id != 1) {
            return redirect()->route('ticket_list')
                ->with('error', 'Only Super Admins can assign tickets.');
        }

        // Verify if the assignee is either a Super Admin or Admin
        $assignee = User::findOrFail($request->assigned_to);
        if (!in_array($assignee->r_id, [1, 2])) {
            return redirect()->route('ticket_list')
                ->with('error', 'Tickets can only be assigned to Super Admins or Admins.');
        }

        // Update the ticket
        $ticket->assigned_to = $request->assigned_to;
        $ticket->status = 1; // Set status to In Progress
        $ticket->save();

        return redirect()->route('ticket_list')
            ->with('success', 'Ticket assigned successfully and status updated to In Progress.');
    }

    // Mark a ticket as completed
    public function completeTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Verify if the user is the assigned staff
        if ($ticket->assigned_to != Auth::user()->u_id) {
            return redirect()->route('ticket_list')
                ->with('error', 'You are not authorized to complete this ticket.');
        }

        // Update ticket status to For Evaluation (2)
        $ticket->status = 2;
        $ticket->save();

        return redirect()->route('ticket_list')
            ->with('success', 'Ticket marked as completed and is now for evaluation.');
    }

    // Reject a ticket
    public function rejectTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Verify if the user is the assigned staff
        if ($ticket->assigned_to != Auth::user()->u_id) {
            return redirect()->route('ticket_list')
                ->with('error', 'You are not authorized to reject this ticket.');
        }

        $ticket->status = 9; // Rejection status (9)
        $ticket->save();

        return redirect()->route('ticket_list')
            ->with('success', 'Ticket has been rejected.');
    }

    // Evaluate a ticket
    public function evaluateTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Check if user is authorized to evaluate this ticket
        if ($ticket->req_by != Auth::user()->u_id) {
            return redirect()->route('ticket_list')
                ->with('error', 'You are not authorized to evaluate this ticket.');
        }

        // Check if ticket is in the correct status
        if ($ticket->status != 2) {
            return redirect()->route('ticket_list')
                ->with('error', 'This ticket is not ready for evaluation.');
        }

        return view('ticket.evaluate_ticket', compact('ticket'));
    }

    // Save evaluation for a ticket
    public function saveEvaluation(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Validate request
        $request->validate([
            'work_quality' => 'required|integer|between:1,5',
            'res_delivery' => 'required|integer|between:1,5',
            'personnels_quality' => 'required|integer|between:1,5',
            'overall' => 'required|integer|between:1,5',
            'comments' => 'nullable|string'
        ]);

        // Create evaluation
        $evaluation = new Evaluation();
        $evaluation->u_id = Auth::user()->u_id;
        $evaluation->work_quality = $request->work_quality;
        $evaluation->res_delivery = $request->res_delivery;
        $evaluation->personnels_quality = $request->personnels_quality;
        $evaluation->overall = $request->overall;
        $evaluation->comments = $request->comments;
        $evaluation->final_status = 1;
        $evaluation->save();

        // Update ticket status
        $ticket->status = 4; // Completed
        $ticket->final_status = 1; // Completed
        $ticket->save();

        return redirect()->route('ticket_list')
            ->with('success', 'Thank you for your evaluation!');
    }
    
    // Get all evaluations for a ticket
    public function showTicketInfo($id)
    {
        $ticket = Ticket::with(['service', 'location', 'department', 'assignedStaff'])
            ->findOrFail($id);
        
        return view('ticket.ticket_info', compact('ticket'));
    }

    





}
