@extends('layouts.app')

@section('content')

@include('home._navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(240,236,228,0.35);
    --border: rgba(255,255,255,0.06);
    --border-mid: rgba(255,255,255,0.10);
    --surface: #0d0d0d;
}
body { background: var(--dark); }

.requests-page {
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

.requests-wrap { max-width: 960px; margin: 0 auto; padding: 48px; }

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

/* Request cards */
.request-card {
    border: 1px solid var(--border);
    background: #0a0a0a;
    margin-bottom: 1px;
    display: grid;
    grid-template-columns: 100px 1fr auto;
    overflow: hidden;
    position: relative;
    transition: background 0.2s;
}
.request-card:hover { background: #0d0d0d; }
.request-card-accent {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
}

.request-card-img {
    background: #060606;
    overflow: hidden;
}
.request-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
}
.request-card-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
}

.request-card-body { padding: 24px 28px; }
.request-card-label {
    font-size: 0.58rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 4px;
}
.request-card-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 2px;
    color: var(--off-white);
    margin-bottom: 12px;
}
.request-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.request-meta-item {
    font-size: 0.6rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 6px;
}
.request-meta-item strong {
    color: var(--off-white);
    font-weight: 400;
}

.request-card-status { padding: 24px 28px; display: flex; flex-direction: column; align-items: flex-end; justify-content: center; gap: 12px; }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    font-size: 0.6rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-family: 'Barlow', sans-serif;
    font-weight: 500;
}
.status-pending  { border: 1px solid rgba(234,179,8,0.3);  color: #eab308; background: rgba(234,179,8,0.05); }
.status-approved { border: 1px solid rgba(34,197,94,0.3);  color: #22c55e; background: rgba(34,197,94,0.05); }
.status-rejected { border: 1px solid rgba(225,6,0,0.3);    color: var(--red); background: rgba(225,6,0,0.05); }
.status-cancelled{ border: 1px solid var(--border);         color: var(--muted); background: transparent; }

.status-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

.request-date { font-size: 0.58rem; letter-spacing: 2px; color: var(--muted); }

.rejection-note {
    margin-top: 12px;
    padding: 12px 16px;
    border: 1px solid rgba(225,6,0,0.15);
    background: rgba(225,6,0,0.04);
}
.rejection-note-label { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--red); margin-bottom: 4px; }
.rejection-note-text { font-size: 0.78rem; color: var(--muted); }

/* Order info block */
.order-info {
    margin-top: 12px;
    padding: 12px 16px;
    border: 1px solid rgba(34,197,94,0.15);
    background: rgba(34,197,94,0.04);
}
.order-info-label { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: #22c55e; margin-bottom: 4px; }
.order-info-status {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}
</style>

<div class="requests-page">
    <div class="accent-strip"></div>

    <div class="page-header">
        <div class="page-eyebrow">
            <span class="eyebrow-line"></span>
            My Account
        </div>
        <h1 class="page-title">My Car Requests</h1>
        <p class="page-sub">Track the status of your F1 car purchase requests</p>
    </div>

    <div class="requests-wrap">

        @if(session('success'))
        <div style="border:1px solid rgba(34,197,94,0.3);padding:16px 20px;margin-bottom:28px;background:rgba(34,197,94,0.05);color:#22c55e;font-size:0.7rem;letter-spacing:3px;text-transform:uppercase;">
            ✓ {{ session('success') }}
        </div>
        @endif

        @if($requests->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                    <path d="M8 48l10-16 12 8 10-14 16 22H8z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
                    <circle cx="20" cy="24" r="6" stroke="white" stroke-width="1.5"/>
                </svg>
            </div>
            <div class="empty-title">No Requests Yet</div>
            <p class="empty-sub">You haven't submitted any car purchase requests yet.</p>
            <a href="{{ route('products.cars') }}" class="btn-shop">
                Browse F1 Cars
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
        @else

        @foreach($requests as $req)
        @php
            $accent = $req->product?->carModel?->team?->color ?? '#E10600';
            $mainImg = $req->product?->images?->where('is_main', true)->first() ?? $req->product?->images?->first();
        @endphp
        <div class="request-card">
            <div class="request-card-accent" style="background: {{ $accent }}"></div>

            <div class="request-card-img">
                @if($mainImg)
                    <img src="{{ asset('storage/' . $mainImg->image_url) }}" alt="{{ $req->product?->product_name }}">
                @else
                    <div class="request-card-img-placeholder">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                            <rect x="3" y="7" width="22" height="16" rx="2" stroke="white" stroke-opacity=".2" stroke-width="1.3"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div class="request-card-body">
                <div class="request-card-label">{{ $req->product?->carModel?->team?->team_name ?? 'F1 Car' }}</div>
                <div class="request-card-name">{{ $req->product?->product_name ?? 'Product' }}</div>

                <div class="request-meta">
                    <div class="request-meta-item">
                        Price: <strong>${{ number_format($req->product?->base_price ?? 0, 0) }}</strong>
                    </div>
                    <div class="request-meta-item">
                        Payment: <strong>{{ $req->payment_preference === 'online' ? 'Online' : 'Walk-in' }}</strong>
                    </div>
                    <div class="request-meta-item">
                        Ref: <strong>#{{ $req->request_id }}</strong>
                    </div>
                </div>

                @if($req->request_status === 'rejected' && $req->rejection_reason)
                <div class="rejection-note">
                    <div class="rejection-note-label">Rejection Reason</div>
                    <div class="rejection-note-text">{{ $req->rejection_reason }}</div>
                </div>
                @endif

                @if($req->request_status === 'approved' && $req->carOrder)
                <div class="order-info">
                    <div class="order-info-label">Car Order Created</div>
                    <div class="order-info-status">Order #{{ $req->carOrder->car_order_id }} — {{ ucfirst(str_replace('_', ' ', $req->carOrder->car_order_status)) }}</div>
                </div>
                @endif
            </div>

            <div class="request-card-status">
                <div class="status-badge status-{{ $req->request_status }}">
                    <span class="status-dot"></span>
                    {{ ucfirst($req->request_status) }}
                </div>
                <div class="request-date">{{ $req->created_at->format('d M Y') }}</div>
            </div>
        </div>
        @endforeach

        @endif
    </div>
</div>

@include('home._footer')
@endsection