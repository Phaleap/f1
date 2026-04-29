@extends('layouts.app')

@section('title', 'Payment - F1 Store')

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
}
body { background: var(--dark); color: var(--off-white); font-family: 'Barlow', sans-serif; font-weight: 300; }

.payment-page { min-height: 100vh; padding-top: 120px; padding-bottom: 80px; }
.payment-container { max-width: 800px; margin: 0 auto; padding: 0 48px; }

.payment-header { margin-bottom: 40px; border-bottom: 1px solid var(--border); padding-bottom: 24px; }
.payment-eyebrow { font-size: 0.6rem; letter-spacing: 5px; text-transform: uppercase; color: var(--red); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
.payment-eyebrow span { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.payment-title { font-family: 'Bebas Neue', cursive; font-size: 2.8rem; letter-spacing: 4px; color: var(--off-white); }
.payment-sub { font-size: 0.65rem; letter-spacing: 2px; color: var(--muted); margin-top: 8px; text-transform: uppercase; }

/* Order Summary */
.order-summary-card { background: #0a0a0a; border: 1px solid var(--border); padding: 24px; margin-bottom: 24px; }
.card-title { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 3px; color: var(--off-white); margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--border); }
.summary-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; }
.summary-label { font-size: 0.62rem; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
.summary-val { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 1px; color: var(--off-white); }
.summary-divider { height: 1px; background: var(--border); margin: 8px 0; }
.summary-total-label { font-size: 0.65rem; letter-spacing: 3px; text-transform: uppercase; color: var(--off-white); font-weight: 500; }
.summary-total-val { font-family: 'Bebas Neue', cursive; font-size: 1.6rem; letter-spacing: 2px; color: var(--off-white); }

/* Payment Form */
.payment-card { background: #0a0a0a; border: 1px solid var(--border); padding: 24px; }
.payment-methods { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
.payment-method-option { display: flex; align-items: center; gap: 14px; padding: 14px 18px; border: 1px solid var(--border); cursor: pointer; transition: border-color 0.2s; }
.payment-method-option:hover { border-color: rgba(225,6,0,0.3); }
.payment-method-option input[type="radio"] { accent-color: var(--red); width: 16px; height: 16px; }
.payment-method-option label { cursor: pointer; font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: var(--off-white); }
.payment-method-option.selected { border-color: rgba(225,6,0,0.5); background: rgba(225,6,0,0.03); }

.btn-pay {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    width: 100%; height: 52px;
    background: var(--red); border: none; color: #fff;
    font-family: 'Barlow', sans-serif; font-size: 0.65rem; font-weight: 500;
    letter-spacing: 5px; text-transform: uppercase;
    cursor: pointer; transition: opacity 0.2s;
}
.btn-pay:hover { opacity: 0.88; }

.secure-note { text-align: center; margin-top: 12px; font-size: 0.58rem; letter-spacing: 2px; color: var(--muted); text-transform: uppercase; display: flex; align-items: center; justify-content: center; gap: 6px; }

@media (max-width: 768px) {
    .payment-container { padding: 0 24px; }
}
</style>

<div class="payment-page">
    <div class="payment-container">

        <div class="payment-header">
            <div class="payment-eyebrow"><span></span> Payment</div>
            <h1 class="payment-title">Complete Payment</h1>
            <p class="payment-sub">Order #{{ $order->id }} — Select your payment method</p>
        </div>

        @if(session('success'))
            <div style="margin-bottom:20px;padding:12px 20px;border:1px solid rgba(46,204,113,0.3);background:rgba(46,204,113,0.05);font-size:0.65rem;letter-spacing:3px;text-transform:uppercase;color:#2ecc71;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Order Summary --}}
        <div class="order-summary-card">
            <div class="card-title">Order Summary</div>
            @foreach($order->items as $item)
            <div class="summary-row">
                <span class="summary-label">{{ $item->product->product_name }} × {{ $item->quantity }}</span>
                <span class="summary-val">${{ number_format($item->subtotal, 2) }}</span>
            </div>
            @endforeach
            <div class="summary-divider"></div>
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-val">${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Shipping</span>
                <span class="summary-val">${{ number_format($order->shipping_fee, 2) }}</span>
            </div>
            @if($order->discount_amount > 0)
            <div class="summary-row">
                <span class="summary-label">Discount</span>
                <span class="summary-val" style="color:#2ecc71;">-${{ number_format($order->discount_amount, 2) }}</span>
            </div>
            @endif
            <div class="summary-divider"></div>
            <div class="summary-row">
                <span class="summary-total-label">Total Due</span>
                <span class="summary-total-val">${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>

        {{-- Payment Form --}}
        <div class="payment-card">
            <div class="card-title">Payment Method</div>
            <form action="{{ route('payment.process', $order) }}" method="POST">
                @csrf
                <div class="payment-methods">
                    @foreach($paymentMethods as $method)
                    <div class="payment-method-option" onclick="selectMethod(this, {{ $method->payment_method_id }})">
                        <input type="radio" name="payment_method_id"
                               id="method_{{ $method->payment_method_id }}"
                               value="{{ $method->payment_method_id }}"
                               {{ $loop->first ? 'checked' : '' }}>
                        <label for="method_{{ $method->payment_method_id }}">{{ $method->method_name }}</label>
                    </div>
                    @endforeach
                </div>

                @error('payment_method_id')
                    <div style="color:#e74c3c;font-size:0.6rem;letter-spacing:2px;margin-bottom:16px;">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-pay">
                    Pay ${{ number_format($order->total_amount, 2) }}
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
            <div class="secure-note">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                Secure payment — 256-bit SSL encrypted
            </div>
        </div>

    </div>
</div>

@include('home._footer')

<script>
function selectMethod(el, id) {
    document.querySelectorAll('.payment-method-option').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type="radio"]').checked = true;
}
// Highlight first on load
document.addEventListener('DOMContentLoaded', () => {
    const first = document.querySelector('.payment-method-option');
    if (first) first.classList.add('selected');
});
</script>

@endsection