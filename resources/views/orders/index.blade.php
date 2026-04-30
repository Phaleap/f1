@extends('layouts.app')

@section('content')

@include('home._navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(240,236,228,0.35);
    --border: rgba(255,255,255,0.06);
    --surface: #0d0d0d;
}
body { background: var(--dark); }

.orders-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

.accent-strip { height: 2px; background: var(--red); }

.page-header {
    padding: 48px 48px 40px;
    border-bottom: 1px solid var(--border);
}
.page-eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 14px;
}
.eyebrow-line { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.page-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
}
.page-sub { font-size: 0.78rem; color: var(--muted); margin-top: 8px; }

.orders-wrap { max-width: 960px; margin: 0 auto; padding: 48px; }

/* Empty state */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    border: 1px solid var(--border);
    background: #0a0a0a;
}
.empty-icon { opacity: 0.15; margin-bottom: 24px; }
.empty-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.6rem;
    letter-spacing: 3px;
    color: var(--off-white);
    margin-bottom: 8px;
}
.empty-sub { font-size: 0.78rem; color: var(--muted); margin-bottom: 28px; }
.btn-shop {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: var(--red);
    color: white;
    text-decoration: none;
    font-size: 0.62rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    font-family: 'Barlow', sans-serif;
    font-weight: 500;
    transition: opacity 0.2s;
}
.btn-shop:hover { opacity: 0.85; }

/* Orders table */
.orders-table {
    border: 1px solid var(--border);
    overflow: hidden;
}

.orders-table table {
    width: 100%;
    border-collapse: collapse;
}

.orders-table thead th {
    padding: 14px 20px;
    text-align: left;
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    background: #0a0a0a;
    border-bottom: 1px solid var(--border);
    font-weight: 400;
}

.orders-table tbody td {
    padding: 18px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 0.82rem;
    color: var(--off-white);
    vertical-align: middle;
}

.orders-table tbody tr:last-child td { border-bottom: none; }
.orders-table tbody tr { transition: background 0.2s; }
.orders-table tbody tr:hover td { background: #0d0d0d; }

.order-id {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

.order-date { color: var(--muted); font-size: 0.78rem; }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-family: 'Barlow', sans-serif;
    font-weight: 500;
}
.status-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

.status-pending    { border: 1px solid rgba(234,179,8,0.3);  color: #eab308; background: rgba(234,179,8,0.05); }
.status-processing { border: 1px solid rgba(59,130,246,0.3); color: #3b82f6; background: rgba(59,130,246,0.05); }
.status-shipped    { border: 1px solid rgba(139,92,246,0.3); color: #8b5cf6; background: rgba(139,92,246,0.05); }
.status-delivered  { border: 1px solid rgba(34,197,94,0.3);  color: #22c55e; background: rgba(34,197,94,0.05); }
.status-cancelled  { border: 1px solid var(--border);        color: var(--muted); background: transparent; }

.order-total {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 2px;
    color: var(--off-white);
    text-align: right;
}

.btn-view {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    text-decoration: none;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-family: 'Barlow', sans-serif;
    font-weight: 500;
    transition: border-color 0.2s, color 0.2s;
    white-space: nowrap;
}
.btn-view:hover {
    border-color: var(--red);
    color: var(--off-white);
}
</style>

<div class="orders-page">
    <div class="accent-strip"></div>

    <div class="page-header">
        <div class="page-eyebrow">
            <span class="eyebrow-line"></span>
            My Account
        </div>
        <h1 class="page-title">My Orders</h1>
        <p class="page-sub">Track and manage your merchandise orders</p>
    </div>

    <div class="orders-wrap">

        @if($orders->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                    <path d="M16 6H48L56 20V56H8V20L16 6Z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M8 20H56" stroke="white" stroke-width="1.5"/>
                    <path d="M24 20V14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M40 20V14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="empty-title">No Orders Yet</div>
            <p class="empty-sub">You haven't placed any orders yet. Browse our shop to get started.</p>
            <a href="{{ route('shop') }}" class="btn-shop">
                Browse Shop
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </a>
        </div>

        @else

        <div class="orders-table">
            <table>
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th style="text-align:right;">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    @php
                        $statusClass = match($order->order_status ?? $order->status ?? 'pending') {
                            'pending'    => 'status-pending',
                            'processing' => 'status-processing',
                            'shipped'    => 'status-shipped',
                            'delivered'  => 'status-delivered',
                            'cancelled'  => 'status-cancelled',
                            default      => 'status-pending',
                        };
                        $statusLabel = ucfirst($order->order_status ?? $order->status ?? 'pending');
                    @endphp
                    <tr>
                        <td>
                            <div class="order-id">#{{ $order->order_id ?? $order->id }}</div>
                        </td>
                        <td>
                            <div class="order-date">{{ $order->created_at->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div style="font-size:0.78rem;color:var(--muted);">
                                {{ $order->items?->count() ?? '—' }} item(s)
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $statusClass }}">
                                <span class="status-dot"></span>
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td>
                            <div class="order-total">
                                ${{ number_format($order->total_amount ?? $order->total ?? 0, 0) }}
                            </div>
                        </td>
                        <td style="text-align:right;">
                            <a href="{{ route('orders.show', $order) }}" class="btn-view">
                                View
                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                    <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endif
    </div>
</div>

@include('home._footer')
@endsection