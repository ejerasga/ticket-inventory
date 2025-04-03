<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function viewInventory()
    {
        // Add any data you need to pass to the view
        return view('inventory.view_inventory');
    }
}