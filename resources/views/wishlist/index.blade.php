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
}

.wl {
    background: var(--dark);
    min-height: 100vh;
    padding: 80px 48px 64px;
    font-family: 'Barlow', sans-serif;
    color: var(--off-white);
}

.wl-top {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 40px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 28px;
}

.wl-eyebrow {
    font-size: 0.58rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}
.wl-eyebrow span { display: inline-block; width: 22px; height: 1px; background: var(--red); }

.wl-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
}

.wl-count {
    font-size: 0.62rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-top: 6px;
}

.wl-shop-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border: 1px solid rgba(255,255,255,0.12);
    color: var(--muted);
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    text-decoration: none;
    font-family: 'Barlow', sans-serif;
    background: transparent;
    transition: border-color 0.2s, color 0.2s;
}
.wl-shop-btn:hover { border-color: rgba(255,255,255,0.3); color: var(--off-white); }

.wl-flash {
    background: rgba(34,197,94,0.08);
    border: 1px solid rgba(34,197,94,0.2);
    color: #4ade80;
    padding: 12px 18px;
    font-size: 0.75rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 28px;
}

/* Grid */
.wl-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
}

/* Card */
.wl-card {
    background: var(--dark);
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    transition: background 0.25s;
}
.wl-card:hover { background: #0e0e0e; }
.wl-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s;
}
.wl-card:hover::before { transform: scaleX(1); }

.wl-card-img {
    aspect-ratio: 4/3;
    overflow: hidden;
    background: #060606;
    position: relative;
}
.wl-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease, filter 0.4s;
    filter: brightness(0.85);
}
.wl-card:hover .wl-card-img img { transform: scale(1.04); filter: brightness(1); }

.wl-card-num {
    position: absolute;
    bottom: 10px; left: 14px;
    font-family: 'Bebas Neue', cursive;
    font-size: 2.5rem;
    color: rgba(255,255,255,0.06);
    letter-spacing: 2px;
    line-height: 1;
    pointer-events: none;
}

.wl-card-body {
    padding: 18px 20px;
    flex: 1;
    border-top: 1px solid var(--border);
}
.wl-card-team {
    font-size: 0.56rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 4px;
}
.wl-card-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.2rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1.1;
    margin-bottom: 10px;
}
.wl-card-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

.wl-card-footer {
    display: flex;
    border-top: 1px solid var(--border);
}
.wl-btn-view {
    flex: 1;
    padding: 12px 16px;
    background: var(--red);
    color: #fff;
    text-align: center;
    font-size: 0.62rem;
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    font-family: 'Barlow', sans-serif;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.wl-btn-view:hover { background: #c00500; color: #fff; }

.wl-btn-remove {
    padding: 12px 16px;
    background: transparent;
    border: none;
    border-left: 1px solid var(--border);
    color: var(--muted);
    font-size: 0.6rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    cursor: pointer;
    font-family: 'Barlow', sans-serif;
    transition: color 0.2s, background 0.2s;
}
.wl-btn-remove:hover { color: #f87171; background: rgba(248,113,113,0.06); }

/* Empty state */
.wl-empty {
    text-align: center;
    padding: 100px 20px;
}
.wl-empty-icon {
    font-size: 2.5rem;
    opacity: 0.12;
    margin-bottom: 20px;
    color: var(--off-white);
}
.wl-empty-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.8rem;
    letter-spacing: 4px;
    color: var(--off-white);
    margin-bottom: 8px;
}
.wl-empty-sub {
    font-size: 0.7rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 28px;
}
.wl-empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: var(--red);
    color: #fff;
    text-decoration: none;
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    font-family: 'Barlow', sans-serif;
    transition: background 0.2s;
}
.wl-empty-btn:hover { background: #c00500; color: #fff; }

@media (max-width: 768px) {
    .wl { padding: 60px 24px 48px; }
    .wl-top { flex-direction: column; align-items: flex-start; gap: 20px; }
    .wl-grid { grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); }
}
</style>

<div class="wl">

    @if(session('success'))
    <div class="wl-flash">{{ session('success') }}</div>
    @endif

    <div class="wl-top">
        <div>
            <div class="wl-eyebrow"><span></span> Saved Items</div>
            <div class="wl-title">My Wishlist</div>
            <div class="wl-count">{{ $wishlist->items->count() }} item(s) saved</div>
        </div>
        <a href="{{ route('shop') }}" class="wl-shop-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Browse Shop
        </a>
    </div>

    @if($wishlist->items->isEmpty())
    <div class="wl-empty">
        <div class="wl-empty-icon">♡</div>
        <div class="wl-empty-title">Your Wishlist Is Empty</div>
        <div class="wl-empty-sub">Save items you love and come back to them later</div>
        <a href="{{ route('shop') }}" class="wl-empty-btn">
            <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Browse Shop
        </a>
    </div>

    @else
    <div class="wl-grid">
        @foreach($wishlist->items as $i => $item)
        @php $product = $item->product; @endphp
        <div class="wl-card">
            <div class="wl-card-img">
                @if($product->mainImage)
                    <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                         alt="{{ $product->product_name }}"
                         onerror="this.src=''; this.parentElement.style.background='#111'">
                @endif
                <div class="wl-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="wl-card-body">
                <div class="wl-card-team">
                    {{ $product->carModel?->team?->team_name ?? $product->category?->category_name ?? '—' }}
                </div>
                <div class="wl-card-name">{{ $product->product_name }}</div>
                <div class="wl-card-price">${{ number_format($product->base_price, 0) }}</div>
            </div>
            <div class="wl-card-footer">
                <a href="{{ route('products.show', $product->id) }}" class="wl-btn-view">View Product</a>
                <form method="POST" action="{{ route('wishlist.remove', $item->wishlist_item_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="wl-btn-remove" title="Remove">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M2 3.5h10M5.5 3.5V2.5h3v1M5.5 6v4M8.5 6v4M3 3.5l.7 7.5h6.6L11 3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

@include('home._footer')
@endsection