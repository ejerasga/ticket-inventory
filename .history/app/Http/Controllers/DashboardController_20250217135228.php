<?php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        // Count the tickets based on status
        $pendingTicketCount = Ticket::where('status', 0)->count();
        $inProgressTicketCount = Ticket::where('status', 1)->count();
        $completedTicketCount = Ticket::where('status', 2)->count();

        return view('dashboard', compact('pendingTicketCount', 'inProgressTicketCount', 'completedTicketCount'));
    }
}
