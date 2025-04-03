<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('inventory.stock.viewstock', compact('stocks'));
    }

    public function create()
    {
        // No need for a separate create view as it's included in the index view
        return redirect()->route('view_stock');
    }

    public function store(Request $request)
    {
        \Log::info('Store method called', $request->all());

        $request->validate([
            'item_code' => 'required|string|max:255|unique:stocks',
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_available' => 'required|integer|min:0',
            'uom' => 'required|string|max:50',
        ]);

        \Log::info('Validation passed');

        $stock = Stock::create($request->all());

        \Log::info('Stock created', $stock->toArray());

        return redirect()->route('view_stock')->with('success', 'Stock added successfully!');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('inventory.stock.editstock', compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_code' => 'required|string|max:255|unique:stocks,item_code,' . $id,
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_available' => 'required|integer|min:0',
            'uom' => 'required|string|max:50',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());

        return redirect()->route('view_stock')->with('success', 'Stock updated successfully!');
    }

    public function destroy($id)
    {
        Stock::findOrFail($id)->delete();
        return redirect()->route('view_stock')->with('success', 'Stock deleted successfully!');
    }
}