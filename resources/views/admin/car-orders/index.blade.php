@extends('admin.layouts.admin')

@section('title', 'Car Orders')
@section('page-title', 'Car Orders')
@section('breadcrumb')
    <span>›</span> <span>Car Orders</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Car Orders</div>
        <div class="page-sub">Manage confirmed F1 car orders</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">All Car Orders</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="font-weight:600;color:var(--gray-900);">#{{ $order->car_order_id }}</td>
                    <td>
                        <div style="font-weight:500;">{{ $order->user?->full_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ $order->user?->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight:500;">{{ $order->request?->product?->product_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ $order->request?->product?->carModel?->team?->team_name }}</div>
                    </td>
                    <td style="font-weight:600;">${{ number_format($order->final_price, 0) }}</td>
                    <td>
                        <span class="badge {{ $order->payment_preference === 'online' ? 'badge-blue' : 'badge-gray' }}">
                            {{ $order->payment_preference === 'online' ? 'Online' : 'Walk-in' }}
                        </span>
                    </td>
                    <td>
                        @php
                            $badgeClass = match($order->car_order_status) {
                                'confirmed'       => 'badge-yellow',
                                'paid'            => 'badge-blue',
                                'in_preparation'  => 'badge-blue',
                                'ready'           => 'badge-green',
                                'delivered'       => 'badge-green',
                                'cancelled'       => 'badge-red',
                                default           => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_',' ',$order->car_order_status)) }}</span>
                    </td>
                    <td style="font-size:0.78rem;color:var(--gray-400);">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.car-orders.show', $order->car_order_id) }}" class="btn btn-secondary btn-sm">Manage</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:40px;color:var(--gray-400);">No car orders yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="pagination-wrap">{{ $orders->links() }}</div>
    @endif
</div>
@endsection