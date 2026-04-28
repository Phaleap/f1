@extends('layouts.app')

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

.cart-page { min-height: 100vh; padding-top: 120px; padding-bottom: 80px; }

.cart-container { max-width: 1100px; margin: 0 auto; padding: 0 48px; }

.cart-header { margin-bottom: 40px; border-bottom: 1px solid var(--border); padding-bottom: 24px; }
.cart-eyebrow { font-size: 0.6rem; letter-spacing: 5px; text-transform: uppercase; color: var(--red); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
.cart-eyebrow span { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.cart-title { font-family: 'Bebas Neue', cursive; font-size: 2.8rem; letter-spacing: 4px; color: var(--off-white); }

.cart-layout { display: grid; grid-template-columns: 1fr 340px; gap: 32px; align-items: start; }

/* ── Items ── */
.cart-items { display: flex; flex-direction: column; gap: 1px; background: var(--border); border: 1px solid var(--border); }

.cart-item {
    background: #0a0a0a;
    display: grid;
    grid-template-columns: 88px 1fr auto;
    gap: 20px;
    align-items: center;
    padding: 20px 24px;
    transition: background 0.2s;
}
.cart-item:hover { background: #0d0d0d; }

.cart-item-img {
    width: 88px; height: 66px;
    overflow: hidden;
    background: #060606;
    flex-shrink: 0;
}
.cart-item-img img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.85); }

.cart-item-info { display: flex; flex-direction: column; gap: 4px; }
.cart-item-name { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 2px; color: var(--off-white); }
.cart-item-variant { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.cart-item-price { font-size: 0.7rem; letter-spacing: 2px; color: var(--muted); margin-top: 4px; }

.cart-item-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }

.qty-row { display: flex; align-items: center; border: 1px solid var(--border); }
.qty-btn { width: 32px; height: 32px; background: transparent; border: none; color: var(--muted); font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: color 0.2s; }
.qty-btn:hover { color: var(--off-white); }
.qty-num { width: 36px; height: 32px; background: transparent; border: none; border-left: 1px solid var(--border); border-right: 1px solid var(--border); color: var(--off-white); font-family: 'Bebas Neue', cursive; font-size: 0.95rem; letter-spacing: 2px; text-align: center; outline: none; -moz-appearance: textfield; }
.qty-num::-webkit-inner-spin-button, .qty-num::-webkit-outer-spin-button { -webkit-appearance: none; }

.item-subtotal { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 2px; color: var(--off-white); }

.remove-btn { background: none; border: none; color: rgba(255,255,255,0.15); cursor: pointer; font-size: 0.6rem; letter-spacing: 3px; text-transform: uppercase; transition: color 0.2s; padding: 0; }
.remove-btn:hover { color: var(--red); }

/* ── Empty state ── */
.cart-empty { text-align: center; padding: 80px 40px; border: 1px solid var(--border); background: #0a0a0a; }
.cart-empty-icon { opacity: 0.08; margin-bottom: 24px; }
.cart-empty-title { font-family: 'Bebas Neue', cursive; font-size: 2rem; letter-spacing: 4px; color: var(--off-white); margin-bottom: 8px; }
.cart-empty-sub { font-size: 0.65rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); margin-bottom: 32px; }
.btn-shop { display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; background: var(--red); color: #fff; font-size: 0.65rem; letter-spacing: 4px; text-transform: uppercase; text-decoration: none; transition: opacity 0.2s; }
.btn-shop:hover { opacity: 0.85; }

/* ── Summary ── */
.cart-summary { background: #0a0a0a; border: 1px solid var(--border); position: sticky; top: 120px; }
.summary-header { padding: 20px 24px; border-bottom: 1px solid var(--border); }
.summary-title { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 3px; color: var(--off-white); }
.summary-body { padding: 20px 24px; display: flex; flex-direction: column; gap: 12px; }
.summary-row { display: flex; justify-content: space-between; align-items: center; }
.summary-label { font-size: 0.6rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.summary-val { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 2px; color: var(--off-white); }
.summary-divider { height: 1px; background: var(--border); margin: 4px 0; }
.summary-total-label { font-size: 0.62rem; letter-spacing: 4px; text-transform: uppercase; color: var(--off-white); }
.summary-total-val { font-family: 'Bebas Neue', cursive; font-size: 1.6rem; letter-spacing: 2px; color: var(--off-white); }
.summary-footer { padding: 16px 24px; border-top: 1px solid var(--border); display: flex; flex-direction: column; gap: 10px; }

.btn-checkout { display: flex; align-items: center; justify-content: center; gap: 10px; height: 50px; background: var(--red); border: none; color: #fff; font-family: 'Barlow', sans-serif; font-size: 0.65rem; font-weight: 500; letter-spacing: 5px; text-transform: uppercase; cursor: pointer; transition: opacity 0.2s; width: 100%; text-decoration: none; }
.btn-checkout:hover { opacity: 0.88; }

.btn-clear { display: flex; align-items: center; justify-content: center; height: 38px; background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow', sans-serif; font-size: 0.58rem; letter-spacing: 4px; text-transform: uppercase; cursor: pointer; transition: border-color 0.2s, color 0.2s; width: 100%; }
.btn-clear:hover { border-color: var(--red); color: var(--off-white); }

@media (max-width: 768px) {
    .cart-container { padding: 0 24px; }
    .cart-layout { grid-template-columns: 1fr; }
    .cart-item { grid-template-columns: 72px 1fr; }
    .cart-item-actions { flex-direction: row; align-items: center; grid-column: 1 / -1; justify-content: space-between; }
}
</style>

<div class="cart-page">
    <div class="cart-container">

        <div class="cart-header">
            <div class="cart-eyebrow"><span></span> Your Cart</div>
            <h1 class="cart-title">Cart ({{ $items->count() }})</h1>
        </div>

        @if(session('success'))
            <div style="margin-bottom:20px;padding:12px 20px;border:1px solid rgba(46,204,113,0.3);background:rgba(46,204,113,0.05);font-size:0.65rem;letter-spacing:3px;text-transform:uppercase;color:#2ecc71;">
                {{ session('success') }}
            </div>
        @endif

        @if($items->count() > 0)
        <div class="cart-layout">

            {{-- Items --}}
            <div>
                <div class="cart-items">
                    @foreach($items as $item)
                    <div class="cart-item" id="cart-item-{{ $item->id }}">

                        {{-- Image --}}
                        <div class="cart-item-img">
                            @if($item->product->mainImage)
                                <img src="{{ asset('storage/' . $item->product->mainImage->image_url) }}"
                                     alt="{{ $item->product->product_name }}">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#0d0d0d;">
                                    <svg width="24" height="24" fill="none"><rect x="3" y="6" width="18" height="13" rx="1" stroke="white" stroke-opacity=".1" stroke-width="1.2"/></svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="cart-item-info">
                            <div class="cart-item-name">{{ $item->product->product_name }}</div>
                            @if($item->variant)
                                <div class="cart-item-variant">{{ $item->variant->variant_name }}</div>
                            @endif
                            <div class="cart-item-price">${{ number_format($item->unit_price, 2) }} each</div>
                        </div>

                        {{-- Actions --}}
                        <div class="cart-item-actions">
                            <div class="qty-row">
                                <button class="qty-btn" onclick="updateQty({{ $item->id }}, -1)">−</button>
                                <input class="qty-num" type="number" value="{{ $item->quantity }}" min="1"
                                       id="qty-{{ $item->id }}" onchange="setQty({{ $item->id }}, this.value)">
                                <button class="qty-btn" onclick="updateQty({{ $item->id }}, 1)">+</button>
                            </div>
                            <div class="item-subtotal" id="subtotal-{{ $item->id }}">
                                ${{ number_format($item->unit_price * $item->quantity, 2) }}
                            </div>
                            <form method="POST" action="{{ route('cart.remove', $item) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Summary --}}
            <div class="cart-summary">
                <div class="summary-header">
                    <div class="summary-title">Order Summary</div>
                </div>
                <div class="summary-body">
                    <div class="summary-row">
                        <span class="summary-label">Items ({{ $items->sum('quantity') }})</span>
                        <span class="summary-val">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-val">TBD</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-val">${{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>
                <div class="summary-footer">
                    <a href="#" class="btn-checkout">
                        Proceed to Checkout
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        <button type="submit" class="btn-clear">Clear Cart</button>
                    </form>
                </div>
            </div>

        </div>
        @else
        <div class="cart-empty">
            <div class="cart-empty-icon">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                    <path d="M8 8h6l8 32h28l6-24H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="28" cy="52" r="4" stroke="white" stroke-width="2"/>
                    <circle cx="48" cy="52" r="4" stroke="white" stroke-width="2"/>
                </svg>
            </div>
            <div class="cart-empty-title">Your Cart is Empty</div>
            <div class="cart-empty-sub">Add some products to get started</div>
            <a href="{{ route('shop') }}" class="btn-shop">
                Browse Shop
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        @endif

    </div>
</div>

@include('home._footer')

<script>
function updateQty(itemId, delta) {
    const input = document.getElementById('qty-' + itemId);
    const newVal = Math.max(1, parseInt(input.value) + delta);
    input.value = newVal;
    setQty(itemId, newVal);
}

function setQty(itemId, qty) {
    qty = Math.max(1, parseInt(qty));
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ quantity: qty, _method: 'PATCH' })
    }).then(r => r.json()).then(() => {
        // Update item subtotal display
        const priceText = document.querySelector(`#cart-item-${itemId} .cart-item-price`).textContent;
        const price = parseFloat(priceText.replace('$','').replace(' each',''));
        document.getElementById('subtotal-' + itemId).textContent = '$' + (price * qty).toFixed(2);
    });
}
</script>

@endsection