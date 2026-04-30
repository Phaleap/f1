<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with(['product', 'variant'])
            ->orderBy('stock_quantity', 'asc')
            ->paginate(20);

        return view('admin.inventory.index', compact('inventory'));
    }

    public function adjust(Request $request, Inventory $inventory)
    {
        $request->validate([
            'movement_type' => 'required|in:IN,OUT,RETURN,DAMAGE,ADJUSTMENT',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string',
        ]);

        $qty = in_array($request->movement_type, ['OUT', 'DAMAGE'])
            ? -abs($request->quantity)
            : abs($request->quantity);

        $inventory->increment('stock_quantity', $qty);
        $inventory->update(['last_updated' => now()]);

        StockMovement::create([
            'inventory_id'   => $inventory->inventory_id,
            'movement_type'  => $request->movement_type,
            'quantity'       => $request->quantity,
            'reference_type' => 'manual',
            'notes'          => $request->notes,
            'created_at'     => now(),
        ]);

        return back()->with('success', 'Stock updated.');
    }

    public function lowStock()
    {
        $inventory = Inventory::with(['product', 'variant'])
            ->whereColumn('stock_quantity', '<=', 'minimum_stock')
            ->get();

        return view('admin.inventory.low_stock', compact('inventory'));
    }
}
