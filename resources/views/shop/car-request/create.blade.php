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
    --surface: #0d0d0d;
    --accent: {{ $product->carModel?->team?->color ?? '#E10600' }};
}

body { background: var(--dark); }

.request-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

.accent-strip { height: 2px; background: var(--accent); }

.breadcrumb-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 18px 48px;
    border-bottom: 1px solid var(--border);
    background: #050505;
}
.breadcrumb-bar a { font-size: 0.6rem; letter-spacing: 4px; text-transform: uppercase; color: var(--muted); text-decoration: none; }
.breadcrumb-bar a:hover { color: var(--off-white); }
.breadcrumb-sep { font-size: 0.55rem; color: rgba(255,255,255,0.1); }
.breadcrumb-current { font-size: 0.6rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); }

.request-wrap {
    max-width: 960px;
    margin: 0 auto;
    padding: 60px 48px;
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 48px;
    align-items: start;
}

/* Left: Form */
.form-side {}

.form-eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 14px;
}
.eyebrow-line { display: inline-block; width: 28px; height: 1px; background: var(--accent); }

.form-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
    margin-bottom: 8px;
}

.form-subtitle {
    font-size: 0.82rem;
    color: var(--muted);
    line-height: 1.7;
    margin-bottom: 40px;
}

.field-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 24px;
}

.field-label {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
}

.field-input {
    width: 100%;
    padding: 14px 16px;
    background: #0d0d0d;
    border: 1px solid var(--border);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-size: 0.88rem;
    font-weight: 300;
    outline: none;
    transition: border-color 0.2s;
}
.field-input:focus { border-color: var(--accent); }
.field-input::placeholder { color: rgba(240,236,228,0.2); }

textarea.field-input { resize: vertical; min-height: 100px; }

.field-error {
    font-size: 0.62rem;
    letter-spacing: 2px;
    color: var(--red);
}

/* Payment preference toggle */
.payment-toggle {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
    margin-bottom: 32px;
}

.payment-option { display: none; }

.payment-label {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 20px 24px;
    background: #0d0d0d;
    cursor: pointer;
    transition: background 0.2s;
    position: relative;
}
.payment-label::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s;
}
.payment-option-wrap {
    position: relative;
}

.payment-option { display: none; }

.payment-label {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 20px 24px;
    background: #0d0d0d;
    cursor: pointer;
    transition: background 0.2s;
    position: relative;
    height: 100%;
}
.payment-label::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s;
}

/* ✅ This is the fix — target label inside checked wrap */
.payment-option:checked ~ .payment-label { background: #111; }
.payment-option:checked ~ .payment-label::before { transform: scaleX(1); }
.payment-option:checked + .payment-label::before { transform: scaleX(1); }

.payment-label-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}
.payment-label-desc {
    font-size: 0.62rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
}

.btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    height: 54px;
    background: var(--accent);
    border: none;
    color: #fff;
    font-family: 'Barlow', sans-serif;
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: opacity 0.2s;
}
.btn-submit:hover { opacity: 0.88; }

/* Right: Product card */
.product-side {}

.product-card {
    border: 1px solid var(--border);
    background: #0a0a0a;
    position: sticky;
    top: 112px;
}
.product-card::before {
    content: '';
    display: block;
    height: 2px;
    background: var(--accent);
}

.product-card-img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: #060606;
}
.product-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: brightness(0.85);
}

.product-card-body { padding: 24px; }

.product-card-label {
    font-size: 0.58rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 6px;
}
.product-card-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1;
    margin-bottom: 16px;
}

.product-card-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
}
.product-card-row:last-child { border-bottom: none; }
.product-card-key { font-size: 0.6rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.product-card-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 0.9rem;
    letter-spacing: 2px;
    color: var(--off-white);
}
.product-card-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

@media (max-width: 900px) {
    .request-wrap { grid-template-columns: 1fr; padding: 40px 24px; }
    .product-side { order: -1; }
    .product-card { position: static; }
}
</style>

@php
    $mainImg = $product->images?->where('is_main', true)->first() ?? $product->images?->first();
    $isCar = $product->product_type === 'car';
@endphp

<div class="request-page">
    <div class="accent-strip"></div>

    <nav class="breadcrumb-bar">
        <a href="{{ route('shop') }}">Shop</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('products.show', $product) }}">{{ $product->product_name }}</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Request to Buy</span>
    </nav>

    <div class="request-wrap">

        {{-- LEFT: FORM --}}
        <div class="form-side">
            <div class="form-eyebrow">
                <span class="eyebrow-line"></span>
                Purchase Inquiry
            </div>
            <h1 class="form-title">Request To Buy</h1>
            <p class="form-subtitle">
                Fill in your details below. Our team will review your request and get back to you within 24 hours.
            </p>

            @if($errors->any())
            <div style="border:1px solid var(--red);padding:16px 20px;margin-bottom:28px;background:rgba(225,6,0,0.05);">
                <div style="font-size:0.6rem;letter-spacing:4px;text-transform:uppercase;color:var(--red);margin-bottom:8px;">Please fix the following</div>
                @foreach($errors->all() as $error)
                    <div style="font-size:0.78rem;color:rgba(240,236,228,0.6);margin-top:4px;">— {{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('shop.car-request.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="field-group">
                    <label class="field-label">Full Name</label>
                    <input type="text" name="full_name" class="field-input"
                           placeholder="Your full name"
                           value="{{ old('full_name', auth()->user()->full_name ?? '') }}">
                    @error('full_name')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Phone Number</label>
                    <input type="text" name="phone" class="field-input"
                           placeholder="+1 234 567 8900"
                           value="{{ old('phone', auth()->user()->phone ?? '') }}">
                    @error('phone')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Message <span style="color:var(--muted);font-size:0.58rem;">(optional)</span></label>
                    <textarea name="message" class="field-input"
                              placeholder="Any special requirements or questions...">{{ old('message') }}</textarea>
                    @error('message')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" style="margin-bottom:12px;">Payment Preference</label>
                    <div class="payment-toggle">
    <div class="payment-option-wrap">
        <input type="radio" name="payment_preference" id="pref_online" value="online" class="payment-option"
               {{ old('payment_preference', 'online') === 'online' ? 'checked' : '' }}>
        <label for="pref_online" class="payment-label">
            <div class="payment-label-title">Pay Online</div>
            <div class="payment-label-desc">Secure online payment after approval</div>
        </label>
    </div>

    <div class="payment-option-wrap">
        <input type="radio" name="payment_preference" id="pref_walkin" value="walk_in" class="payment-option"
               {{ old('payment_preference') === 'walk_in' ? 'checked' : '' }}>
        <label for="pref_walkin" class="payment-label">
            <div class="payment-label-title">Visit Showroom</div>
            <div class="payment-label-desc">Book an appointment & pay in person</div>
        </label>
    </div>
</div>
                    @error('payment_preference')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M2 8h12M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Submit Request
                </button>
            </form>
        </div>

        {{-- RIGHT: PRODUCT CARD --}}
        <div class="product-side">
            <div class="product-card">
                @if($mainImg)
                <div class="product-card-img">
                    <img src="{{ asset('storage/' . $mainImg->image_url) }}" alt="{{ $product->product_name }}">
                </div>
                @endif

                <div class="product-card-body">
                    <div class="product-card-label">{{ $product->carModel?->team?->team_name ?? 'F1 Car' }}</div>
                    <div class="product-card-name">{{ $product->product_name }}</div>

                    <div class="product-card-row">
                        <span class="product-card-key">Base Price</span>
                        <span class="product-card-price">${{ number_format($product->base_price, 0) }}</span>
                    </div>
                    @if($product->carModel?->season_year)
                    <div class="product-card-row">
                        <span class="product-card-key">Season</span>
                        <span class="product-card-val">{{ $product->carModel->season_year }}</span>
                    </div>
                    @endif
                    @if($product->carModel?->driver)
                    <div class="product-card-row">
                        <span class="product-card-key">Driver</span>
                        <span class="product-card-val">{{ $product->carModel->driver->driver_name }}</span>
                    </div>
                    @endif
                    @if($product->carModel?->engine)
                    <div class="product-card-row">
                        <span class="product-card-key">Engine</span>
                        <span class="product-card-val">{{ $product->carModel->engine }}</span>
                    </div>
                    @endif
                    <div class="product-card-row">
                        <span class="product-card-key">SKU</span>
                        <span class="product-card-val">{{ $product->sku }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('home._footer')
@endsection