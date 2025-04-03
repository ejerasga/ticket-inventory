<?php

namespace App\Http\Controllers;

use App\Models\ItemDeployed;
use App\Models\Stock;
use App\Models\Department;
use App\Models\Location; // Add this line
use Illuminate\Http\Request;

class ItemDeployedController extends Controller
{
    public function index()
    {
        $items = ItemDeployed::with(['stock', 'department', 'location'])->get(); // Add location to with()
        $stocks = Stock::all();
        $departments = Department::all();
        $locations = Location::all(); // Get all locations

        return view('inventory.item_deployed.itemdeployed', compact('items', 'stocks', 'departments', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'requested_by' => 'required|string',
            'item_id' => 'required|integer',
            'department_id' => 'required|integer',
            'quantity' => 'required|integer',
            'purpose' => 'required|string',
            'date_deployed' => 'required|date',
            'location_id' => 'required|integer',
            'gatepass' => 'required|boolean',
            'returning' => 'required|boolean',
            'date_returned' => 'nullable|date',
        ]);

        // Find the stock item
        $stock = Stock::findOrFail($request->item_id);

        // Check if stock exists and has enough available items
        if ($stock->stock_available < $request->quantity) {
            return redirect()->back()
                ->with('error', 'Not enough items available in stock! Available: ' . $stock->stock_available)
                ->withInput();
        }

        // Decrease the stock available by the quantity
        $stock->decrement('stock_available', $request->quantity);

        // Create the deployed item record
        ItemDeployed::create([
            'requested_by' => $request->requested_by,
            'item_id' => $request->item_id,
            'department_id' => $request->department_id,
            'quantity' => $request->quantity, // Add quantity to the record
            'purpose' => $request->purpose,
            'date_deployed' => $request->date_deployed,
            'location_id' => $request->location_id,
            'remark' => $request->remark,
            'gatepass' => $request->gatepass,
            'returning' => $request->returning,
            'date_returned' => $request->date_returned,
        ]);

        return redirect()->route('item_deployed')
            ->with('success', 'Item(s) deployed successfully.');
    }

    public function edit($id)
    {
        $itemdeployed = ItemDeployed::findOrFail($id);
        $stocks = Stock::all();
        $departments = Department::all();
        $locations = Location::all(); // Add locations data

        return view('inventory.item_deployed.editdeployed', compact('itemdeployed', 'stocks', 'departments', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $itemdeployed = ItemDeployed::findOrFail($id);

        $request->validate([
            'requested_by' => 'required|string',
            'item_id' => 'required|integer',
            'department_id' => 'required|integer',
            'quantity' => 'required|integer',
            'purpose' => 'required|string',
            'date_deployed' => 'required|date',
            'location_id' => 'required|integer',
            'gatepass' => 'required|boolean',
            'returning' => 'required|boolean',
            'date_returned' => 'nullable|date',
        ]);

        // Get the stock item
        $stock = Stock::findOrFail($request->item_id);

        // Calculate the difference between old and new quantity
        $quantityDifference = $request->quantity - $itemdeployed->quantity;

        // If quantity is being increased
        if ($quantityDifference > 0) {
            // Check if there's enough stock available
            if ($stock->stock_available < $quantityDifference) {
                return redirect()->back()
                    ->with('error', 'Not enough items available in stock! Available: ' . $stock->stock_available)
                    ->withInput();
            }
            // Decrease the stock available
            $stock->decrement('stock_available', $quantityDifference);
        }
        // If quantity is being decreased
        elseif ($quantityDifference < 0) {
            // Increase the stock available
            $stock->increment('stock_available', abs($quantityDifference));
        }

        // Handle return date changes
        if ($request->date_returned && !$itemdeployed->date_returned && $request->returning) {
            // If item is being marked as returned now, add the quantity back to stock
            $stock->increment('stock_available', $request->quantity);
        } elseif (!$request->date_returned && $itemdeployed->date_returned && $request->returning) {
            // If return date is being removed, subtract the quantity from stock
            // Check if there's enough stock available
            if ($stock->stock_available < $request->quantity) {
                return redirect()->back()
                    ->with('error', 'Not enough items available in stock to undo return! Available: ' . $stock->stock_available)
                    ->withInput();
            }
            $stock->decrement('stock_available', $request->quantity);
        }

        // Update the deployed item record
        $itemdeployed->update($request->all());

        return redirect()->route('item_deployed')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $itemdeployed = ItemDeployed::findOrFail($id);

        // If the item wasn't returned, add it back to stock
        if (!$itemdeployed->date_returned && $itemdeployed->returning) {
            $stock = Stock::find($itemdeployed->item_id);
            if ($stock) {
                $stock->increment('stock_available', $itemdeployed->quantity);
            }
        }

        $itemdeployed->delete();
        return redirect()->route('item_deployed')
            ->with('success', 'Item deleted successfully.');
    }
}