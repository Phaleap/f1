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

.wishlist-page {
    background: var(--dark);
    min-height: 100vh;
    padding: 60px 24px;
    font-family: 'Barlow', sans-serif;
    color: var(--off-white);
}

.wishlist-container { max-width: 900px; margin: 0 auto; }

.wishlist-heading {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}
.wishlist-sub {
    color: var(--muted);
    font-size: 0.85rem;
    margin-bottom: 40px;
}

.wishlist-empty {
    text-align: center;
    padding: 80px 20px;
    color: var(--muted);
}
.wishlist-empty-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.3;
}
.wishlist-empty-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.5rem;
    letter-spacing: 0.05em;
    color: var(--off-white);
    margin-bottom: 8px;
}
.wishlist-empty-sub { font-size: 0.88rem; margin-bottom: 24px; }
.btn-shop {
    display: inline-block;
    padding: 12px 32px;
    background: var(--red);
    color: white;
    text-decoration: none;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

.wishlist-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 4px;
    overflow: hidden;
    transition: border-color 0.2s;
}
.wishlist-card:hover { border-color: rgba(255,255,255,0.15); }

.wishlist-card-img {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    background: rgba(255,255,255,0.04);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    font-size: 0.75rem;
    letter-spacing: 0.1em;
}
.wishlist-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.wishlist-card-body { padding: 16px; }

.wishlist-card-name {
    font-weight: 500;
    font-size: 0.92rem;
    color: var(--off-white);
    margin-bottom: 6px;
    line-height: 1.3;
}

.wishlist-card-price {
    font-size: 1rem;
    font-weight: 600;
    color: var(--red);
    margin-bottom: 14px;
}

.wishlist-card-actions {
    display: flex;
    gap: 8px;
}

.btn-view {
    flex: 1;
    padding: 9px 12px;
    background: var(--red);
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    transition: background 0.2s;
}
.btn-view:hover { background: #c00500; color: white; }

.btn-remove {
    padding: 9px 12px;
    background: transparent;
    border: 1px solid var(--border);
    color: var(--muted);
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.btn-remove:hover { border-color: #f87171; color: #f87171; }
</style>

<div class="wishlist-page">
    <div class="wishlist-container">

        @if(session('success'))
        <div style="background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.2); color:#4ade80; padding:12px 16px; border-radius:4px; margin-bottom:24px; font-size:0.88rem;">
            {{ session('success') }}
        </div>
        @endif

        <div class="wishlist-heading">My Wishlist</div>
        <div class="wishlist-sub">{{ $wishlist->items->count() }} saved item(s)</div>

        @if($wishlist->items->isEmpty())
        <div class="wishlist-empty">
            <div class="wishlist-empty-icon">♡</div>
            <div class="wishlist-empty-title">Your wishlist is empty</div>
            <div class="wishlist-empty-sub">Save items you love and come back to them later.</div>
            <a href="{{ route('shop') }}" class="btn-shop">Browse Shop</a>
        </div>
        @else
        <div class="wishlist-grid">
            @foreach($wishlist->items as $item)
            @php $product = $item->product; @endphp
            <div class="wishlist-card">
                <div class="wishlist-card-img">
                    @if($product->mainImage)
                        <img src="{{ asset('storage/' . $product->mainImage->image_url) }}" alt="{{ $product->product_name }}">
                    @else
                        NO IMAGE
                    @endif
                </div>
                <div class="wishlist-card-body">
                    <div class="wishlist-card-name">{{ $product->product_name }}</div>
                    <div class="wishlist-card-price">${{ number_format($product->base_price, 2) }}</div>
                    <div class="wishlist-card-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-view">View</a>
                        <form method="POST" action="{{ route('wishlist.remove', $item->wishlist_item_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

@include('home._footer')
@endsection