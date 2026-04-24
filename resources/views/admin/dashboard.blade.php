@extends('admin.layouts.admin')
@section('page-title', 'Dashboard')

@section('content')

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon red">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a1 1 0 00-1 1v11a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
        </div>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $stats['total_products'] }}</div>
        <div class="stat-sub">{{ $stats['total_cars'] }} cars · {{ $stats['total_merchandise'] }} merch</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>
        </div>
        <div class="stat-label">Orders</div>
        <div class="stat-value">{{ $stats['total_orders'] }}</div>
        <div class="stat-sub">{{ $stats['pending_orders'] }} pending</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <div class="stat-label">Users</div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-sub">Active accounts</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="stat-label">Teams & Drivers</div>
        <div class="stat-value">{{ $stats['total_teams'] }}</div>
        <div class="stat-sub">{{ $stats['total_drivers'] }} drivers</div>
    </div>
</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">

    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Recent Orders</span>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr>
                    <th>Order</th><th>Customer</th><th>Total</th><th>Status</th>
                </tr></thead>
                <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $order) }}" style="color:var(--red); text-decoration:none; font-weight:500;">#{{ $order->order_id }}</a></td>
                    <td>{{ $order->user?->full_name ?? '—' }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge {{ match($order->order_status) {
                            'pending'   => 'badge-yellow',
                            'confirmed' => 'badge-blue',
                            'shipped'   => 'badge-blue',
                            'delivered' => 'badge-green',
                            'cancelled' => 'badge-red',
                            default     => 'badge-gray'
                        } }}">{{ ucfirst($order->order_status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:var(--gray-400); padding:32px;">No orders yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Low Stock Alert</span>
            <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr>
                    <th>Product</th><th>Stock</th><th>Min</th>
                </tr></thead>
                <tbody>
                @forelse($lowStock as $inv)
                <tr>
                    <td>{{ $inv->product?->product_name ?? '—' }}</td>
                    <td><span class="badge badge-red">{{ $inv->stock_quantity }}</span></td>
                    <td>{{ $inv->minimum_stock }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center; color:var(--gray-400); padding:32px;">All stock levels OK</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
