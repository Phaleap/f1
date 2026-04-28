@extends('admin.layouts.admin')

@section('title', 'Car Order #' . $order->car_order_id)
@section('page-title', 'Car Order Detail')
@section('breadcrumb')
    <span>›</span> <a href="{{ route('admin.car-orders.index') }}">Car Orders</a>
    <span>›</span> <span>#{{ $order->car_order_id }}</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Car Order #{{ $order->car_order_id }}</div>
        <div class="page-sub">Created {{ $order->created_at->format('d M Y, H:i') }}</div>
    </div>
    <a href="{{ route('admin.car-orders.index') }}" class="btn btn-secondary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back
    </a>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;">

    {{-- LEFT --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Order Summary --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Order Summary</div></div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Customer</div>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $order->user?->full_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ $order->user?->email }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Product</div>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $order->request?->product?->product_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ $order->request?->product?->carModel?->team?->team_name }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Final Price</div>
                        <div style="font-size:1.4rem;font-weight:700;color:var(--gray-900);">${{ number_format($order->final_price, 0) }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Payment Method</div>
                        <span class="badge {{ $order->payment_preference === 'online' ? 'badge-blue' : 'badge-gray' }}">
                            {{ $order->payment_preference === 'online' ? 'Online Payment' : 'Walk-in Showroom' }}
                        </span>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Current Status</div>
                        @php
                            $badgeClass = match($order->car_order_status) {
                                'confirmed'      => 'badge-yellow',
                                'paid'           => 'badge-blue',
                                'in_preparation' => 'badge-blue',
                                'ready'          => 'badge-green',
                                'delivered'      => 'badge-green',
                                'cancelled'      => 'badge-red',
                                default          => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_',' ',$order->car_order_status)) }}</span>
                    </div>
                    @if($order->expected_delivery)
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Expected Delivery</div>
                        <div style="font-weight:500;">{{ \Carbon\Carbon::parse($order->expected_delivery)->format('d M Y') }}</div>
                    </div>
                    @endif
                </div>

                {{-- Walk-in payment confirmation --}}
                @if($order->payment_confirmed_at)
                <div style="margin-top:16px;padding:12px 16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:4px;">
                    <div style="font-size:0.72rem;color:#16a34a;font-weight:600;margin-bottom:4px;">Payment Confirmed</div>
                    <div style="font-size:0.8rem;color:#166534;">
                        By {{ $order->confirmedBy?->full_name }} on {{ \Carbon\Carbon::parse($order->payment_confirmed_at)->format('d M Y, H:i') }}
                        @if($order->payment_notes) — {{ $order->payment_notes }} @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Status History --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Status History</div></div>
            <div class="card-body" style="padding:0;">
                @forelse($order->statusHistory as $history)
                <div style="display:flex;align-items:flex-start;gap:14px;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
                    <div style="width:8px;height:8px;border-radius:50%;background:var(--red);flex-shrink:0;margin-top:5px;"></div>
                    <div style="flex:1;">
                        <div style="font-weight:500;color:var(--gray-900);font-size:0.85rem;">{{ ucfirst(str_replace('_',' ',$history->status)) }}</div>
                        @if($history->remarks)
                        <div style="font-size:0.78rem;color:var(--gray-500);margin-top:2px;">{{ $history->remarks }}</div>
                        @endif
                    </div>
                    <div style="text-align:right;flex-shrink:0;">
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ \Carbon\Carbon::parse($history->changed_at)->format('d M Y, H:i') }}</div>
                        <div style="font-size:0.72rem;color:var(--gray-400);">{{ $history->changedBy?->full_name }}</div>
                    </div>
                </div>
                @empty
                <div style="padding:20px;text-align:center;color:var(--gray-400);font-size:0.83rem;">No history yet</div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- RIGHT: Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Confirm Walk-in Payment --}}
        @if($order->payment_preference === 'walk_in' && $order->car_order_status === 'confirmed')
        <div class="card" style="border-color:#bbf7d0;">
            <div class="card-header" style="background:#f0fdf4;">
                <div class="card-title" style="color:#16a34a;">Confirm Walk-in Payment</div>
            </div>
            <div class="card-body">
                <p style="font-size:0.82rem;color:var(--gray-500);margin-bottom:14px;">Mark this order as paid after the customer has paid in the showroom.</p>
                <form method="POST" action="{{ route('admin.car-orders.confirm-payment', $order->car_order_id) }}">
                    @csrf
                    <div class="form-group" style="margin-bottom:12px;">
                        <label>Payment Notes <span style="color:var(--gray-400);font-weight:400;">(optional)</span></label>
                        <input type="text" name="payment_notes" placeholder="e.g. Paid cash in showroom">
                    </div>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;background:#16a34a;color:white;border-color:#16a34a;"
                            onclick="return confirm('Confirm walk-in payment received?')">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                        Confirm Payment Received
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- Update Status --}}
        @if(!in_array($order->car_order_status, ['delivered', 'cancelled']))
        <div class="card">
            <div class="card-header"><div class="card-title">Update Status</div></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.car-orders.update-status', $order->car_order_id) }}">
                    @csrf
                    <div class="form-group" style="margin-bottom:12px;">
                        <label>New Status</label>
                        <select name="status">
                            <option value="confirmed"      {{ $order->car_order_status === 'confirmed'      ? 'selected' : '' }}>Confirmed</option>
                            <option value="paid"           {{ $order->car_order_status === 'paid'           ? 'selected' : '' }}>Paid</option>
                            <option value="in_preparation" {{ $order->car_order_status === 'in_preparation' ? 'selected' : '' }}>In Preparation</option>
                            <option value="ready"          {{ $order->car_order_status === 'ready'          ? 'selected' : '' }}>Ready</option>
                            <option value="delivered"      {{ $order->car_order_status === 'delivered'      ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:12px;">
                        <label>Remarks <span style="color:var(--gray-400);font-weight:400;">(optional)</span></label>
                        <input type="text" name="remarks" placeholder="Any notes about this status change">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- View Original Request --}}
        <a href="{{ route('admin.car-requests.show', $order->request_id) }}" class="btn btn-secondary" style="justify-content:center;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            View Original Request
        </a>

    </div>
</div>
@endsection