@extends('layouts.app')

@section('title', 'Checkout - F1 Store')

@section('content')

@include('home._navbar')

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
body { background: var(--dark); color: var(--off-white); font-family: 'Barlow', sans-serif; font-weight: 300; }

.checkout-page { min-height: 100vh; padding-top: 120px; padding-bottom: 80px; }
.checkout-container { max-width: 1100px; margin: 0 auto; padding: 0 48px; }

.checkout-header { margin-bottom: 40px; border-bottom: 1px solid var(--border); padding-bottom: 24px; }
.checkout-eyebrow { font-size: 0.6rem; letter-spacing: 5px; text-transform: uppercase; color: var(--red); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
.checkout-eyebrow span { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.checkout-title { font-family: 'Bebas Neue', cursive; font-size: 2.8rem; letter-spacing: 4px; color: var(--off-white); }
.checkout-sub { font-size: 0.65rem; letter-spacing: 2px; color: var(--muted); margin-top: 8px; text-transform: uppercase; }

.checkout-layout { display: grid; grid-template-columns: 1fr 340px; gap: 32px; align-items: start; }

/* ── Form ── */
.checkout-form-card { background: #0a0a0a; border: 1px solid var(--border); padding: 32px; }

.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); margin-bottom: 8px; }
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    background: #060606;
    border: 1px solid var(--border);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-size: 0.85rem;
    padding: 12px 16px;
    outline: none;
    transition: border-color 0.2s;
    appearance: none;
}
.form-group input:focus,
.form-group select:focus { border-color: rgba(225,6,0,0.4); }
.form-group select option { background: #111; }
.form-group textarea { resize: vertical; min-height: 80px; }

.form-section-title { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 3px; color: var(--off-white); margin-bottom: 16px; margin-top: 28px; padding-bottom: 8px; border-bottom: 1px solid var(--border); }

.form-error { color: #e74c3c; font-size: 0.6rem; letter-spacing: 2px; margin-top: 4px; }

.btn-place-order {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    width: 100%; height: 52px; margin-top: 24px;
    background: var(--red); border: none; color: #fff;
    font-family: 'Barlow', sans-serif; font-size: 0.65rem; font-weight: 500;
    letter-spacing: 5px; text-transform: uppercase;
    cursor: pointer; transition: opacity 0.2s;
}
.btn-place-order:hover { opacity: 0.88; }

/* ── Summary ── */
.checkout-summary { background: #0a0a0a; border: 1px solid var(--border); position: sticky; top: 120px; }
.summary-header { padding: 20px 24px; border-bottom: 1px solid var(--border); }
.summary-title { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 3px; color: var(--off-white); }
.summary-body { padding: 20px 24px; display: flex; flex-direction: column; gap: 12px; }

.summary-item { display: flex; gap: 12px; align-items: center; padding-bottom: 12px; border-bottom: 1px solid var(--border); }
.summary-item:last-child { border-bottom: none; }
.summary-item-img { width: 48px; height: 36px; background: #060606; overflow: hidden; flex-shrink: 0; }
.summary-item-img img { width: 100%; height: 100%; object-fit: cover; }
.summary-item-info { flex: 1; }
.summary-item-name { font-size: 0.7rem; letter-spacing: 1px; color: var(--off-white); }
.summary-item-qty { font-size: 0.58rem; letter-spacing: 2px; color: var(--muted); text-transform: uppercase; }
.summary-item-price { font-family: 'Bebas Neue', cursive; font-size: 0.95rem; letter-spacing: 1px; color: var(--off-white); white-space: nowrap; }

.summary-totals { padding: 16px 24px; border-top: 1px solid var(--border); display: flex; flex-direction: column; gap: 10px; }
.summary-row { display: flex; justify-content: space-between; align-items: center; }
.summary-label { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.summary-val { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 2px; color: var(--off-white); }
.summary-divider { height: 1px; background: var(--border); }
.summary-total-label { font-size: 0.62rem; letter-spacing: 4px; text-transform: uppercase; color: var(--off-white); }
.summary-total-val { font-family: 'Bebas Neue', cursive; font-size: 1.6rem; letter-spacing: 2px; color: var(--off-white); }

/* ── Alerts ── */
.alert-error { margin-bottom: 20px; padding: 12px 20px; border: 1px solid rgba(231,76,60,0.3); background: rgba(231,76,60,0.05); font-size: 0.62rem; letter-spacing: 2px; text-transform: uppercase; color: #e74c3c; }

@media (max-width: 768px) {
    .checkout-container { padding: 0 24px; }
    .checkout-layout { grid-template-columns: 1fr; }
}
</style>

<div class="checkout-page">
    <div class="checkout-container">

        <div class="checkout-header">
            <div class="checkout-eyebrow"><span></span> Checkout</div>
            <h1 class="checkout-title">Complete Your Order</h1>
            <p class="checkout-sub">Review your order and enter delivery details</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="checkout-layout">

            {{-- Form --}}
            <div class="checkout-form-card">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                   {{-- Delivery Address --}}
<div class="form-section-title">Delivery Address</div>

<div class="form-group">
    <label>Street Address</label>
    <input type="text" name="street_address" value="{{ old('street_address') }}"
           placeholder="Enter your street address" required>
    @error('street_address') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" value="{{ old('city') }}"
               placeholder="City" required>
        @error('city') <div class="form-error">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" value="{{ old('country') }}"
               placeholder="Country" required>
        @error('country') <div class="form-error">{{ $message }}</div> @enderror
    </div>
</div>

                    {{-- Shipping Method --}}
                    <div class="form-section-title">Shipping Method</div>

                    <div class="form-group">
                        <label>Select Shipping</label>
                        <select name="shipping_method_id" id="shippingSelect" required onchange="updateTotal()">
                            @foreach($shippingMethods as $method)
                                <option value="{{ $method->shipping_method_id }}"
                                        data-fee="{{ $method->fee }}"
                                        {{ old('shipping_method_id') == $method->shipping_method_id ? 'selected' : '' }}>
                                    {{ $method->method_name }} — ${{ number_format($method->fee, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('shipping_method_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="form-section-title">Order Notes</div>
                    <div class="form-group">
                        <label>Notes (optional)</label>
                        <textarea name="notes" placeholder="Special instructions for your order...">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn-place-order">
                        Place Order
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Summary --}}
            <div class="checkout-summary">
                <div class="summary-header">
                    <div class="summary-title">Order Summary</div>
                </div>
                <div class="summary-body">
                    @foreach($items as $item)
                    <div class="summary-item">
                        <div class="summary-item-img">
                            @if($item->product->mainImage)
                                <img src="{{ asset('storage/' . $item->product->mainImage->image_url) }}"
                                     alt="{{ $item->product->product_name }}">
                            @endif
                        </div>
                        <div class="summary-item-info">
                            <div class="summary-item-name">{{ $item->product->product_name }}</div>
                            <div class="summary-item-qty">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="summary-item-price">${{ number_format($item->unit_price * $item->quantity, 2) }}</div>
                    </div>
                    @endforeach
                </div>
                <div class="summary-totals">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-val">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-val" id="shippingDisplay">—</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-val" id="totalDisplay">${{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('home._footer')

<script>
const subtotal = {{ $subtotal }};

function updateTotal() {
    const select = document.getElementById('shippingSelect');
    const option = select.options[select.selectedIndex];
    const fee = parseFloat(option.getAttribute('data-fee')) || 0;
    document.getElementById('shippingDisplay').textContent = '$' + fee.toFixed(2);
    document.getElementById('totalDisplay').textContent = '$' + (subtotal + fee).toFixed(2);
}

// Run on page load
document.addEventListener('DOMContentLoaded', updateTotal);
</script>

@endsection