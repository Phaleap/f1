<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Team;
use App\Models\Driver;
use App\Models\CarPurchaseRequest; // ← adjust model name if different

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products'    => Product::where('status', 'active')->count(),
            'total_orders'      => Order::count(),
            'pending_orders'    => Order::where('order_status', 'pending')->count(),
            'total_users'       => User::where('status', 'active')->count(),
            'total_cars'        => Product::where('product_type', 'car')->where('status', 'active')->count(),
            'total_merchandise' => Product::where('product_type', 'merchandise')->where('status', 'active')->count(),
            'total_teams'       => Team::count(),
            'total_drivers'     => Driver::count(),
        ];

        $recentOrders = Order::with('user')
            ->latest('order_date')
            ->take(5)
            ->get();

        $lowStock = \App\Models\Inventory::with('product')
            ->whereRaw('stock_quantity <= minimum_stock')
            ->take(5)
            ->get();

        // ── Bar chart: orders per day for last 7 days ──
        $ordersByDay = Order::selectRaw('DATE(order_date) as date, COUNT(*) as total')
            ->where('order_date', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        // ── Pie chart: car request status breakdown ──
        $carRequestStats = array_merge(
            ['pending' => 0, 'approved' => 0, 'rejected' => 0],
            CarPurchaseRequest::selectRaw('request_status, COUNT(*) as total')
                ->groupBy('request_status')
                ->pluck('total', 'request_status')
                ->toArray()
        );

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'lowStock',
            'ordersByDay',
            'carRequestStats',
        ));
    }
}