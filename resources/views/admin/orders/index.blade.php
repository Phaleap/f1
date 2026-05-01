@extends('admin.layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')
@section('breadcrumb')
    <span>›</span> <span>Orders</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Orders</div>
        <div class="page-sub">Manage customer orders</div>
    </div>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
            <div class="form-group" style="flex:1; min-width:200px;">
                <label>Search Customer</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Customer name…">
            </div>
            <div class="form-group" style="min-width:160px;">
                <label>Status</label>
                <select name="status">
                    <option value="">All</option>
                    <option value="pending"    {{ request('status') === 'pending'    ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped"    {{ request('status') === 'shipped'    ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered"  {{ request('status') === 'delivered'  ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled"  {{ request('status') === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">All Orders</span>
        <span style="font-size:0.78rem; color:var(--gray-400);">{{ $orders->total() }} total</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    $statusClass = match($order->order_status) {
                        'delivered'  => 'badge-green',
                        'cancelled'  => 'badge-red',
                        'pending'    => 'badge-yellow',
                        'processing' => 'badge-blue',
                        'shipped'    => 'badge-blue',
                        default      => 'badge-gray',
                    };
                @endphp
                <tr>
                    <td style="font-weight:600; color:var(--gray-900);">#{{ $order->order_id }}</td>
                    <td>
                        <div style="font-weight:500;">{{ $order->user->full_name ?? '—' }}</div>
                        <div style="font-size:0.75rem; color:var(--gray-400);">{{ $order->user->email ?? '' }}</div>
                    </td>
                    <td style="color:var(--gray-400);">
                        {{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d M Y') : '—' }}
                    </td>
                    <td>{{ $order->items->count() }} item(s)</td>
                    <td style="font-weight:600;">${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        @if($order->payment)
                            @php
                                $payClass = match($order->payment->payment_status) {
                                    'paid', 'completed' => 'badge-green',
                                    'failed'            => 'badge-red',
                                    default             => 'badge-yellow',
                                };
                            @endphp
                            <span class="badge {{ $payClass }}">{{ ucfirst($order->payment->payment_status) }}</span>
                        @else
                            <span class="badge badge-gray">—</span>
                        @endif
                    </td>
                    <td><span class="badge {{ $statusClass }}">{{ ucfirst($order->order_status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:var(--gray-400); padding:40px;">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="pagination-wrap">
        {{ $orders->links() }}
    </div>
    @endif
</div>

@endsection