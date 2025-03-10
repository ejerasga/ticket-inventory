<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Instantiate RequestController
        $requestController = new TickController();

        // Call the index method to get the counts
        $counts = $requestController->getIndexCounts();

        // Pass the counts to the dashboard view
        return view('dashboard', $counts);
    }
}
