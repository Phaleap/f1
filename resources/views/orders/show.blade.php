@extends('layouts.app')

@section('content')
@include('home._navbar')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(240,236,228,0.35);
    --border: rgba(255,255,255,0.06);
}

.order-page {
    background: var(--dark);
    min-height: 100vh;
    padding: 60px 24px;
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
}

.order-container {
    max-width: 860px;
    margin: 0 auto;
}

.order-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--muted);
    text-decoration: none;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 32px;
    transition: color 0.2s;
}
.order-back:hover { color: var(--off-white); }

.order-heading {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}

.order-sub {
    color: var(--muted);
    font-size: 0.85rem;
    margin-bottom: 40px;
}

.order-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 24px;
    align-items: start;
}

.order-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 4px;
    margin-bottom: 20px;
}

.order-card-header {
    padding: 16px 24px;
    border-bottom: 1px solid var(--border);
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--muted);
}

.order-card-body {
    padding: 24px;
}

.order-table {
    width: 100%;
    border-collapse: collapse;
}
.order-table th {
    text-align: left;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
    padding: 0 0 12px;
    border-bottom: 1px solid var(--border);
}
.order-table td {
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    font-size: 0.9rem;
    color: var(--off-white);
    vertical-align: middle;
}
.order-table tr:last-child td { border-bottom: none; }

.order-totals {
    padding-top: 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.order-total-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.88rem;
    color: var(--muted);
}
.order-total-row.final {
    color: var(--off-white);
    font-weight: 600;
    font-size: 1rem;
    padding-top: 12px;
    border-top: 1px solid var(--border);
    margin-top: 4px;
}

.status-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.status-processing { background: rgba(59,130,246,0.15); color: #60a5fa; }
.status-pending    { background: rgba(234,179,8,0.15);  color: #fbbf24; }
.status-shipped    { background: rgba(59,130,246,0.15); color: #60a5fa; }
.status-delivered  { background: rgba(34,197,94,0.15);  color: #4ade80; }
.status-cancelled  { background: rgba(239,68,68,0.15);  color: #f87171; }

.info-row {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 16px;
}
.info-label {
    font-size: 0.68rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
}
.info-value {
    font-size: 0.9rem;
    color: var(--off-white);
    line-height: 1.5;
}
</style>

<div class="order-page">
    <div class="order-container">

        <a href="{{ route('orders.index') }}" class="order-back">← Back to Orders</a>

        <div class="order-heading">Order #{{ $order->id }}</div>
        <div class="order-sub">
            {{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d M Y, H:i') : '' }}
        </div>

        <div class="order-grid">

            {{-- Left --}}
            <div>
                {{-- Items --}}
                <div class="order-card">
                    <div class="order-card-header">Items Ordered</div>
                    <div class="order-card-body">
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th style="text-align:center;">Qty</th>
                                    <th style="text-align:right;">Price</th>
                                    <th style="text-align:right;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td style="font-weight:500;">{{ $item->product->product_name ?? '—' }}</td>
                                    <td style="color:var(--muted); font-size:0.82rem;">{{ $item->variant->variant_name ?? '—' }}</td>
                                    <td style="text-align:center;">{{ $item->quantity }}</td>
                                    <td style="text-align:right;">${{ number_format($item->unit_price, 2) }}</td>
                                    <td style="text-align:right; font-weight:500;">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="order-totals">
                            <div class="order-total-row">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            @if($order->discount_amount > 0)
                            <div class="order-total-row">
                                <span>Discount</span>
                                <span style="color:#f87171;">-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif
                            <div class="order-total-row">
                                <span>Shipping</span>
                                <span>${{ number_format($order->shipping_fee, 2) }}</span>
                            </div>
                            <div class="order-total-row final">
                                <span>Total</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                @if($order->address)
                <div class="order-card">
                    <div class="order-card-header">Shipping Address</div>
                    <div class="order-card-body">
                        <div class="info-value" style="line-height:1.8;">
                            <div style="font-weight:500;">{{ $order->address->receiver_name }}</div>
                            <div>{{ $order->address->phone }}</div>
                            <div>{{ $order->address->street_address }}</div>
                            <div>{{ $order->address->city }}@if($order->address->province), {{ $order->address->province }}@endif</div>
                            <div>{{ $order->address->postal_code }}, {{ $order->address->country }}</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Right --}}
            <div>
                {{-- Order Summary --}}
                <div class="order-card">
                    <div class="order-card-header">Order Summary</div>
                    <div class="order-card-body" style="display:flex; flex-direction:column; gap:0;">
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            @php
                                $cls = match($order->order_status) {
                                    'processing' => 'status-processing',
                                    'pending'    => 'status-pending',
                                    'shipped'    => 'status-shipped',
                                    'delivered'  => 'status-delivered',
                                    'cancelled'  => 'status-cancelled',
                                    default      => 'status-pending',
                                };
                            @endphp
                            <span class="status-badge {{ $cls }}">{{ ucfirst($order->order_status) }}</span>
                        </div>
                        @if($order->shippingMethod)
                        <div class="info-row">
                            <span class="info-label">Shipping Method</span>
                            <span class="info-value">{{ $order->shippingMethod->method_name }}</span>
                        </div>
                        @endif
                        @if($order->notes)
                        <div class="info-row">
                            <span class="info-label">Notes</span>
                            <span class="info-value">{{ $order->notes }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Shipment --}}
                @if($order->shipment)
                <div class="order-card">
                    <div class="order-card-header">Shipment</div>
                    <div class="order-card-body" style="display:flex; flex-direction:column; gap:0;">
                        <div class="info-row">
                            <span class="info-label">Courier</span>
                            <span class="info-value">{{ $order->shipment->courier_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tracking Number</span>
                            <span class="info-value">{{ $order->shipment->tracking_number }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value">{{ ucfirst($order->shipment->shipment_status) }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('home._footer')
@endsection