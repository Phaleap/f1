@extends('layouts.app')

@section('content')

@include('home._navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    --accent: {{ $product->carModel?->team?->color ?? '#E10600' }};
}

.detail-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

/* ═══════════════════════════════════════
   BREADCRUMB
═══════════════════════════════════════ */
.breadcrumb-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 18px 48px;
    border-bottom: 1px solid var(--border);
    background: #050505;
    position: sticky;
    top: 92px;
    z-index: 20;
}
.breadcrumb-bar a {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    text-decoration: none;
    transition: color 0.2s;
}
.breadcrumb-bar a:hover { color: var(--off-white); }
.breadcrumb-sep {
    font-size: 0.55rem;
    color: rgba(255,255,255,0.1);
}
.breadcrumb-current {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
}

/* ═══════════════════════════════════════
   HERO STRIP (accent line)
═══════════════════════════════════════ */
.accent-strip {
    height: 2px;
    background: var(--accent);
    transition: background 0.5s;
}

/* ═══════════════════════════════════════
   MAIN LAYOUT
═══════════════════════════════════════ */
.detail-main {
    display: grid;
    grid-template-columns: 58% 42%;
    min-height: calc(100vh - 140px);
    border-bottom: 1px solid var(--border);
}

/* ═══════════════════════════════════════
   LEFT: IMAGE GALLERY
═══════════════════════════════════════ */
.gallery-panel {
    position: sticky;
    top: 140px;
    height: calc(100vh - 140px);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    background: #050505;
    overflow: hidden;
}

.gallery-main {
    flex: 1;
    position: relative;
    overflow: hidden;
    background: #060606;
}

.gallery-img {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 80px;
    opacity: 0;
    transform: scale(0.97);
    transition: opacity 0.45s cubic-bezier(0.16,1,0.3,1), transform 0.45s cubic-bezier(0.16,1,0.3,1);
    pointer-events: none;
}
.gallery-img.active {
    opacity: 1;
    transform: scale(1);
    pointer-events: all;
}

.gallery-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 40px 100px rgba(0,0,0,0.95));
    transition: transform 8s ease;
}
.gallery-img.active img {
    transform: scale(1.03) translateY(-4px);
}

/* Ghost year / model text */
.gallery-ghost {
    position: absolute;
    bottom: 20px;
    left: 32px;
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3.5rem, 6vw, 6rem);
    letter-spacing: 4px;
    color: rgba(255,255,255,0.03);
    line-height: 1;
    pointer-events: none;
    z-index: 1;
}

/* Glow layer */
.gallery-glow {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 60% at 55% 55%, {{ ($product->carModel?->team?->color ?? '#E10600') }}18 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

/* Thumbnails */
.gallery-thumbs {
    display: flex;
    gap: 1px;
    background: var(--border);
    border-top: 1px solid var(--border);
    height: 88px;
    flex-shrink: 0;
}

.gallery-thumb {
    flex: 1;
    overflow: hidden;
    cursor: pointer;
    background: #070707;
    position: relative;
    transition: background 0.2s;
}
.gallery-thumb::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s;
}
.gallery-thumb.active::after { transform: scaleX(1); }
.gallery-thumb:hover { background: #0e0e0e; }

.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.45;
    transition: opacity 0.25s;
}
.gallery-thumb.active img,
.gallery-thumb:hover img { opacity: 0.9; }

/* No image fallback */
.gallery-no-img {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px;
}
.gallery-no-img svg { opacity: 0.08; }

/* ═══════════════════════════════════════
   RIGHT: PRODUCT INFO
═══════════════════════════════════════ */
.info-panel {
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    background: var(--dark);
}

/* Header section */
.info-header {
    padding: 48px 48px 36px;
    border-bottom: 1px solid var(--border);
}

.info-eyebrow {
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

.info-category { color: var(--muted); font-size: 0.62rem; letter-spacing: 4px; text-transform: uppercase; }

.info-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2.2rem, 4vw, 3.4rem);
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
    margin: 8px 0 4px;
}

.info-sku {
    font-size: 0.58rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.18);
    margin-top: 6px;
}

/* Price block */
.price-block {
    display: flex;
    align-items: baseline;
    gap: 14px;
    margin-top: 28px;
}
.price-main {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1;
}
.price-label {
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
}

/* Stock badge */
.stock-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 18px;
}
.stock-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #2ecc71;
    box-shadow: 0 0 8px rgba(46,204,113,0.5);
    flex-shrink: 0;
}
.stock-dot.low { background: #f39c12; box-shadow: 0 0 8px rgba(243,156,18,0.5); }
.stock-dot.out { background: var(--red); box-shadow: 0 0 8px rgba(225,6,0,0.5); }
.stock-label {
    font-size: 0.6rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
}

/* ── Variants ── */
.variants-section {
    padding: 32px 48px;
    border-bottom: 1px solid var(--border);
}
.variants-label {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.variants-selected {
    color: var(--off-white);
    font-size: 0.62rem;
    letter-spacing: 3px;
}

.variant-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.variant-btn {
    padding: 10px 18px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Barlow', sans-serif;
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    cursor: pointer;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
    position: relative;
}
.variant-btn:hover:not(.out-of-stock) {
    border-color: rgba(255,255,255,0.25);
    color: var(--off-white);
}
.variant-btn.selected {
    border-color: var(--accent);
    color: var(--off-white);
    background: rgba(255,255,255,0.03);
}
.variant-btn.out-of-stock {
    opacity: 0.3;
    cursor: not-allowed;
    text-decoration: line-through;
}

/* Quantity + CTA */
.cta-section {
    padding: 32px 48px;
    border-bottom: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.qty-row {
    display: flex;
    align-items: center;
    gap: 0;
    border: 1px solid var(--border);
    width: fit-content;
}
.qty-btn {
    width: 44px; height: 44px;
    background: transparent;
    border: none;
    color: var(--muted);
    font-size: 1.1rem;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: color 0.2s, background 0.2s;
}
.qty-btn:hover { color: var(--off-white); background: rgba(255,255,255,0.04); }
.qty-input {
    width: 52px; height: 44px;
    background: transparent;
    border: none;
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
    color: var(--off-white);
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 2px;
    text-align: center;
    outline: none;
}
/* Remove number input arrows */
.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }
.qty-input { -moz-appearance: textfield; }

.btn-add-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
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
    transition: opacity 0.2s, transform 0.15s;
    width: 100%;
}
.btn-add-cart:hover { opacity: 0.88; }
.btn-add-cart:active { transform: scale(0.99); }
.btn-add-cart:disabled { opacity: 0.3; cursor: not-allowed; }

.btn-wishlist {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    height: 44px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Barlow', sans-serif;
    font-size: 0.6rem;
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    cursor: pointer;
    transition: border-color 0.2s, color 0.2s;
    width: 100%;
    text-decoration: none;
}
.btn-wishlist:hover { border-color: rgba(255,255,255,0.2); color: var(--off-white); }

/* ── Spec Table (Cars) ── */
.specs-section {
    padding: 32px 48px;
    border-bottom: 1px solid var(--border);
}
.specs-heading {
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 20px;
}

.spec-row {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
    gap: 20px;
}
.spec-row:last-child { border-bottom: none; }
.spec-key {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    flex-shrink: 0;
}
.spec-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 0.95rem;
    letter-spacing: 2px;
    color: var(--off-white);
    text-align: right;
}

/* ── Driver Card (Cars) ── */
.driver-card {
    margin: 32px 48px;
    border: 1px solid var(--border);
    display: grid;
    grid-template-columns: 80px 1fr;
    overflow: hidden;
    position: relative;
}
.driver-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
}
.driver-card-photo {
    background: #0a0a0a;
    overflow: hidden;
}
.driver-card-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    filter: brightness(0.8) grayscale(0.2);
}
.driver-card-photo-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: #0d0d0d;
}
.driver-card-info {
    padding: 20px 24px;
    border-left: 1px solid var(--border);
}
.driver-card-label {
    font-size: 0.55rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 4px;
}
.driver-card-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.4rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
    margin-bottom: 8px;
}
.driver-card-meta {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}
.driver-meta-pill {
    font-size: 0.56rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 6px;
}
.driver-meta-pill strong {
    color: var(--off-white);
    font-weight: 400;
    font-family: 'Bebas Neue', cursive;
    font-size: 0.85rem;
    letter-spacing: 2px;
}

/* ── Description ── */
.desc-section {
    padding: 32px 48px;
    border-bottom: 1px solid var(--border);
}
.desc-heading {
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 16px;
}
.desc-body {
    font-size: 0.85rem;
    line-height: 1.8;
    color: rgba(240,236,228,0.55);
    font-weight: 300;
}

/* ── Warranty ── */
.warranty-bar {
    margin: 0 48px 32px;
    padding: 16px 20px;
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 14px;
}
.warranty-icon { opacity: 0.4; flex-shrink: 0; }
.warranty-text { font-size: 0.62rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.warranty-text strong { color: var(--off-white); font-weight: 400; display: block; margin-bottom: 2px; }

/* ── Merch info ── */
.merch-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border);
    margin: 0 48px 32px;
    border: 1px solid var(--border);
}
.merch-info-cell {
    background: var(--dark);
    padding: 18px 20px;
}
.merch-info-label {
    font-size: 0.55rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 5px;
}
.merch-info-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

/* ═══════════════════════════════════════
   RELATED PRODUCTS
═══════════════════════════════════════ */
.related-section {
    padding: 64px 48px;
    border-top: 1px solid var(--border);
}
.related-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 40px;
}
.related-eyebrow {
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.related-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 4px;
    color: var(--off-white);
    line-height: 1;
}
.related-link {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.2s;
}
.related-link:hover { color: var(--off-white); }
.related-link svg { transition: transform 0.2s; }
.related-link:hover svg { transform: translateX(4px); }

.related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
}

.rel-card {
    background: #080808;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    position: relative;
    overflow: hidden;
    transition: background 0.25s;
}
.rel-card:hover { background: #0e0e0e; }
.rel-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--card-accent, var(--red));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s;
}
.rel-card:hover::before { transform: scaleX(1); }

.rel-card-img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: #060606;
}
.rel-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease, filter 0.4s;
    filter: brightness(0.85);
}
.rel-card:hover .rel-card-img img { transform: scale(1.05); filter: brightness(1); }

.rel-card-body {
    padding: 20px 24px;
    flex: 1;
    border-top: 1px solid var(--border);
}
.rel-card-team { font-size: 0.56rem; letter-spacing: 4px; text-transform: uppercase; color: var(--muted); margin-bottom: 4px; }
.rel-card-name { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 2px; color: var(--off-white); line-height: 1.1; }

.rel-card-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 24px;
    border-top: 1px solid var(--border);
}
.rel-card-price { font-family: 'Bebas Neue', cursive; font-size: 1.2rem; letter-spacing: 2px; color: var(--off-white); }
.rel-card-cta {
    font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
    display: flex; align-items: center; gap: 5px; transition: color 0.2s;
}
.rel-card:hover .rel-card-cta { color: var(--off-white); }
.rel-card-cta svg { transition: transform 0.2s; }
.rel-card:hover .rel-card-cta svg { transform: translateX(3px); }

/* Flash overlay */
.flash-overlay {
    position: fixed; inset: 0; background: rgba(8,8,8,0.4);
    pointer-events: none; opacity: 0; z-index: 999; transition: opacity 0.12s;
}
.flash-overlay.flash { opacity: 1; }

/* Toast */
.toast {
    position: fixed;
    bottom: 32px; right: 32px;
    background: #111;
    border: 1px solid var(--border);
    border-left: 3px solid var(--accent);
    padding: 16px 22px;
    display: flex;
    align-items: center;
    gap: 14px;
    z-index: 9999;
    transform: translateY(20px);
    opacity: 0;
    transition: transform 0.35s cubic-bezier(0.16,1,0.3,1), opacity 0.35s;
    pointer-events: none;
    min-width: 280px;
}
.toast.show { transform: translateY(0); opacity: 1; pointer-events: all; }
.toast-icon { flex-shrink: 0; }
.toast-msg { font-size: 0.65rem; letter-spacing: 3px; text-transform: uppercase; color: var(--off-white); }
.toast-sub { font-size: 0.56rem; letter-spacing: 2px; color: var(--muted); margin-top: 2px; }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .detail-main { grid-template-columns: 1fr; }
    .gallery-panel { position: relative; top: auto; height: 60vw; min-height: 340px; }
    .related-grid { grid-template-columns: repeat(2, 1fr); }
    .breadcrumb-bar, .info-header, .variants-section, .cta-section,
    .specs-section, .desc-section { padding-left: 32px; padding-right: 32px; }
    .driver-card, .warranty-bar, .merch-info-grid { margin-left: 32px; margin-right: 32px; }
    .related-section { padding: 48px 32px; }
}
@media (max-width: 768px) {
    .breadcrumb-bar { padding: 14px 24px; }
    .info-header, .variants-section, .cta-section,
    .specs-section, .desc-section { padding-left: 24px; padding-right: 24px; }
    .driver-card, .warranty-bar, .merch-info-grid { margin-left: 24px; margin-right: 24px; }
    .related-section { padding: 40px 24px; }
    .related-grid { grid-template-columns: 1fr; }
    .merch-info-grid { grid-template-columns: 1fr; }
}
</style>

<div class="flash-overlay" id="flashOverlay"></div>
<div class="toast" id="toast">
    <div class="toast-icon">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <circle cx="9" cy="9" r="8" stroke="var(--accent)" stroke-width="1.3"/>
            <path d="M5.5 9l2.5 2.5 4.5-5" stroke="var(--accent)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div>
        <div class="toast-msg">Added to cart</div>
        <div class="toast-sub" id="toastSub">{{ $product->product_name }}</div>
    </div>
</div>

@php
    $isCar   = $product->product_type === 'car';
    $driver  = $product->carModel?->driver;
    $team    = $product->carModel?->team;
    $model   = $product->carModel;
    $images  = $product->images ?? collect();
    $mainImg = $images->where('is_main', true)->first() ?? $images->first();
    $totalStock = $product->inventory->sum('stock_quantity') ?? 0;
@endphp

<div class="detail-page">

    {{-- Accent strip --}}
    <div class="accent-strip"></div>

    {{-- Breadcrumb --}}
    <nav class="breadcrumb-bar">
    <a href="{{ route('shop') }}">Shop</a>  {{-- ← change shop.index to shop --}}
    <span class="breadcrumb-sep">›</span>
    <a href="{{ route('shop') }}">          {{-- ← same here --}}
        {{ $isCar ? 'Scale Cars' : 'Merchandise' }}
    </a>
    <span class="breadcrumb-sep">›</span>
    <span class="breadcrumb-current">{{ $product->product_name }}</span>
</nav>

    {{-- Main 2-col layout --}}
    <div class="detail-main">

        {{-- ═══ LEFT: GALLERY ═══ --}}
        <div class="gallery-panel">
            <div class="gallery-main" id="galleryMain">
                <div class="gallery-glow"></div>

                @if($images->count() > 0)
                    @foreach($images as $i => $img)
                    <div class="gallery-img {{ $i === 0 ? 'active' : '' }}" id="galleryImg{{ $i }}">
                        <img src="{{ asset('storage/' . $img->image_url) }}"
                             alt="{{ $img->alt_text ?? $product->product_name }}"
                             onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80'">
                    </div>
                    @endforeach
                @else
                    <div class="gallery-img active">
                        <div class="gallery-no-img">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <rect x="10" y="20" width="60" height="44" rx="3" stroke="white" stroke-width="1.5"/>
                                <circle cx="30" cy="35" r="7" stroke="white" stroke-width="1.5"/>
                                <path d="M10 52l18-14 14 10 10-8 18 14" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                @endif

                <div class="gallery-ghost">
                    {{ $isCar ? ($model?->season_year ?? '') : ($product->brand?->brand_name ?? '') }}
                </div>
            </div>

            {{-- Thumbnails --}}
            @if($images->count() > 1)
            <div class="gallery-thumbs">
                @foreach($images as $i => $img)
                <div class="gallery-thumb {{ $i === 0 ? 'active' : '' }}"
                     onclick="switchGallery({{ $i }})" id="thumb{{ $i }}">
                    <img src="{{ asset('storage/' . $img->image_url) }}"
                         alt="{{ $img->alt_text ?? '' }}"
                         onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=60'">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ═══ RIGHT: INFO ═══ --}}
        <div class="info-panel">

            {{-- Header --}}
            <div class="info-header">
                <div class="info-eyebrow">
                    <span class="eyebrow-line"></span>
                    @if($isCar)
                        {{ $team?->team_name ?? 'Scale Model' }}
                    @else
                        {{ $product->category?->category_name ?? 'Merchandise' }}
                    @endif
                </div>
                <div class="info-category">{{ $product->category?->category_name ?? '' }}</div>
                <h1 class="info-title">{{ $product->product_name }}</h1>
                <div class="info-sku">SKU: {{ $product->sku }}</div>

                <div class="price-block">
                    <div class="price-main">${{ number_format($product->base_price, 0) }}</div>
                    <div class="price-label">USD</div>
                </div>

                <div class="stock-row">
                    @php
                        $stockClass = $totalStock > 10 ? '' : ($totalStock > 0 ? 'low' : 'out');
                        $stockText  = $totalStock > 10 ? 'In Stock'
                                    : ($totalStock > 0 ? "Only {$totalStock} left" : 'Out of Stock');
                    @endphp
                    <div class="stock-dot {{ $stockClass }}"></div>
                    <span class="stock-label">{{ $stockText }}</span>
                </div>
            </div>

            {{-- Variants --}}
            @if($product->variants && $product->variants->count() > 0)
            <div class="variants-section">
                <div class="variants-label">
                    Select Variant
                    <span class="variants-selected" id="variantSelected">—</span>
                </div>
                <div class="variant-grid">
                    @foreach($product->variants as $variant)
                    @php
                        $vStock = $variant->inventory?->stock_quantity ?? 0;
                    @endphp
                    <button class="variant-btn {{ $vStock <= 0 ? 'out-of-stock' : '' }}"
                            data-variant-id="{{ $variant->variant_id }}"
                            data-extra="{{ $variant->extra_price ?? 0 }}"
                            data-label="{{ $variant->variant_name }}"
                            onclick="selectVariant(this)"
                            {{ $vStock <= 0 ? 'disabled' : '' }}>
                        {{ $variant->variant_name }}
                        @if($variant->extra_price > 0)
                        <span style="color:var(--accent);margin-left:4px;">+${{ number_format($variant->extra_price, 0) }}</span>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add to Cart --}}
            <div class="cta-section">
                @if($product->product_type !== 'car')
<div class="qty-row">
    <button class="qty-btn" onclick="changeQty(-1)">−</button>
    <input class="qty-input" type="number" id="qtyInput" value="1" min="1" max="{{ $totalStock }}">
    <button class="qty-btn" onclick="changeQty(1)">+</button>
</div>
@endif

                @if($product->product_type === 'car')
    @auth
        <a href="{{ route('shop.car-request.create', $product->id) }}"
           class="btn-add-cart"
           style="text-decoration:none;display:flex;align-items:center;justify-content:center;gap:12px;">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2 8h12M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Request to Buy
        </a>
    @else
        <a href="{{ route('login') }}"
           class="btn-add-cart"
           style="text-decoration:none;display:flex;align-items:center;justify-content:center;">
            Login to Request
        </a>
    @endauth
@else
    <form method="POST"
          action="{{ route('cart.add', $product) }}"
          id="cartForm"
          onsubmit="handleCart(event)">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <input type="hidden" name="variant_id" id="variantIdInput" value="">
        <input type="hidden" name="quantity" id="quantityInput" value="1">
        <button type="submit" class="btn-add-cart" id="addCartBtn"
                {{ $totalStock <= 0 ? 'disabled' : '' }}>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2 2h1.5l2 8h7l1.5-6H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="7" cy="13" r="1" fill="currentColor"/>
                <circle cx="12" cy="13" r="1" fill="currentColor"/>
            </svg>
            {{ $totalStock <= 0 ? 'Out of Stock' : 'Add to Cart' }}
        </button>
    </form>
@endif

                <button class="btn-wishlist">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M7 12S1.5 8.5 1.5 4.5A2.5 2.5 0 016 3a2.5 2.5 0 011 .5A2.5 2.5 0 0112.5 4.5C12.5 8.5 7 12 7 12z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                    </svg>
                    Save to Wishlist
                </button>
            </div>

            {{-- Car Specs --}}
            @if($isCar && $model)
            <div class="specs-section">
                <div class="specs-heading">Technical Specifications</div>

                @if($model->season_year)
                <div class="spec-row">
                    <span class="spec-key">Season</span>
                    <span class="spec-val">{{ $model->season_year }}</span>
                </div>
                @endif
                @if($product->scale)
                <div class="spec-row">
                    <span class="spec-key">Scale</span>
                    <span class="spec-val">{{ $product->scale }}</span>
                </div>
                @endif
                @if($product->material)
                <div class="spec-row">
                    <span class="spec-key">Material</span>
                    <span class="spec-val">{{ $product->material }}</span>
                </div>
                @endif
                @if($model->engine)
                <div class="spec-row">
                    <span class="spec-key">Engine</span>
                    <span class="spec-val">{{ $model->engine }}</span>
                </div>
                @endif
                @if($model->horsepower)
                <div class="spec-row">
                    <span class="spec-key">Horsepower</span>
                    <span class="spec-val">{{ number_format($model->horsepower) }} HP</span>
                </div>
                @endif
                @if($model->top_speed)
                <div class="spec-row">
                    <span class="spec-key">Top Speed</span>
                    <span class="spec-val">{{ $model->top_speed }} km/h</span>
                </div>
                @endif
                @if($model->color)
                <div class="spec-row">
                    <span class="spec-key">Livery Color</span>
                    <span class="spec-val">{{ $model->color }}</span>
                </div>
                @endif
                @if($product->weight)
                <div class="spec-row">
                    <span class="spec-key">Weight</span>
                    <span class="spec-val">{{ $product->weight }} kg</span>
                </div>
                @endif
                @if($product->brand)
                <div class="spec-row">
                    <span class="spec-key">Brand</span>
                    <span class="spec-val">{{ $product->brand->brand_name }}</span>
                </div>
                @endif
            </div>

            {{-- Driver Card --}}
            @if($driver)
            <div class="driver-card">
                <div class="driver-card-photo">
                    @php
                        $driverPhoto = match(true) {
                            !$driver->photo_url => null,
                            str_starts_with($driver->photo_url, 'http') => $driver->photo_url,
                            default => asset('storage/' . $driver->photo_url)
                        };
                    @endphp
                    @if($driverPhoto)
                        <img src="{{ $driverPhoto }}" alt="{{ $driver->driver_name }}"
                             onerror="this.parentElement.innerHTML='<div class=\'driver-card-photo-placeholder\'><svg width=\'32\' height=\'32\' fill=\'none\'><circle cx=\'16\' cy=\'10\' r=\'6\' stroke=\'white\' stroke-opacity=\'.2\' stroke-width=\'1.5\'/><path d=\'M4 28c0-6.627 5.373-12 12-12s12 5.373 12 12\' stroke=\'white\' stroke-opacity=\'.2\' stroke-width=\'1.5\'/></svg></div>'">
                    @else
                        <div class="driver-card-photo-placeholder">
                            <svg width="32" height="32" fill="none"><circle cx="16" cy="10" r="6" stroke="white" stroke-opacity=".2" stroke-width="1.5"/><path d="M4 28c0-6.627 5.373-12 12-12s12 5.373 12 12" stroke="white" stroke-opacity=".2" stroke-width="1.5"/></svg>
                        </div>
                    @endif
                </div>
                <div class="driver-card-info">
                    <div class="driver-card-label">Racing Driver</div>
                    <div class="driver-card-name">{{ $driver->driver_name }}</div>
                    <div class="driver-card-meta">
                        @if($driver->car_number)
                        <div class="driver-meta-pill">
                            No. <strong>#{{ $driver->car_number }}</strong>
                        </div>
                        @endif
                        @if($driver->nationality)
                        <div class="driver-meta-pill">
                            <strong>{{ $driver->nationality }}</strong>
                        </div>
                        @endif
                        @if($driver->championships > 0)
                        <div class="driver-meta-pill">
                            <strong>{{ $driver->championships }}×</strong> WDC
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endif

            {{-- Merch extra info --}}
            @if(!$isCar)
            <div class="merch-info-grid">
                @if($product->brand)
                <div class="merch-info-cell">
                    <div class="merch-info-label">Brand</div>
                    <div class="merch-info-val">{{ $product->brand->brand_name }}</div>
                </div>
                @endif
                @if($product->material)
                <div class="merch-info-cell">
                    <div class="merch-info-label">Material</div>
                    <div class="merch-info-val">{{ $product->material }}</div>
                </div>
                @endif
                @if($product->weight)
                <div class="merch-info-cell">
                    <div class="merch-info-label">Weight</div>
                    <div class="merch-info-val">{{ $product->weight }} kg</div>
                </div>
                @endif
                @if($product->category)
                <div class="merch-info-cell">
                    <div class="merch-info-label">Category</div>
                    <div class="merch-info-val">{{ $product->category->category_name }}</div>
                </div>
                @endif
            </div>
            @endif

            {{-- Description --}}
            @if($product->description)
            <div class="desc-section">
                <div class="desc-heading">About This Product</div>
                <div class="desc-body">{{ $product->description }}</div>
            </div>
            @endif

            {{-- Warranty --}}
            @if($product->warranty)
            <div class="warranty-bar">
                <div class="warranty-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M11 2L3 5.5v5c0 5 3.5 9.5 8 11 4.5-1.5 8-6 8-11v-5L11 2z" stroke="white" stroke-width="1.3" stroke-linejoin="round"/>
                        <path d="M7.5 11l2.5 2.5 4.5-5" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="warranty-text">
                    <strong>{{ $product->warranty->warranty_name }}</strong>
                    {{ $product->warranty->duration_months }} months · {{ ucfirst($product->warranty->warranty_type) }}
                </div>
            </div>
            @endif

        </div>{{-- /info-panel --}}
    </div>{{-- /detail-main --}}

    {{-- ═══════════════════════════════════════
         RELATED PRODUCTS
    ═══════════════════════════════════════ --}}
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="related-section">
        <div class="related-header">
            <div>
                <div class="related-eyebrow">
                    <span style="display:inline-block;width:28px;height:1px;background:var(--red);"></span>
                    More Like This
                </div>
                <div class="related-title">You May Also Like</div>
            </div>
             <a href="{{ route('shop') }}">Shop</a> 
                View All
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="related-grid">
            @foreach($relatedProducts as $rel)
            @php $relAccent = $rel->carModel?->team?->color ?? '#E10600'; @endphp
            <a href="{{ route('products.show', $rel) }}"
               class="rel-card"
               style="--card-accent: {{ $relAccent }}">
                <div class="rel-card-img">
                    @if($rel->mainImage)
                        <img src="{{ asset('storage/' . $rel->mainImage->image_url) }}"
                             alt="{{ $rel->product_name }}"
                             onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=70'">
                    @else
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=70" alt="{{ $rel->product_name }}">
                    @endif
                </div>
                <div class="rel-card-body">
                    <div class="rel-card-team">{{ $rel->carModel?->team?->team_name ?? $rel->category?->category_name ?? '' }}</div>
                    <div class="rel-card-name">{{ $rel->product_name }}</div>
                </div>
                <div class="rel-card-footer">
                    <span class="rel-card-price">${{ number_format($rel->base_price, 0) }}</span>
                    <span class="rel-card-cta">
                        View
                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

</div>

@include('home._footer')

<script>
/* ─── Gallery switcher ─── */
const totalImgs = {{ $images->count() }};

function switchGallery(idx) {
    document.querySelectorAll('.gallery-img').forEach((el, i) => {
        el.classList.toggle('active', i === idx);
    });
    document.querySelectorAll('.gallery-thumb').forEach((el, i) => {
        el.classList.toggle('active', i === idx);
    });
}

/* Keyboard navigation */
let currentImg = 0;
document.addEventListener('keydown', e => {
    if (totalImgs <= 1) return;
    if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        currentImg = (currentImg + 1) % totalImgs;
        switchGallery(currentImg);
    }
    if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
        currentImg = (currentImg - 1 + totalImgs) % totalImgs;
        switchGallery(currentImg);
    }
});

/* ─── Variants ─── */
let selectedVariantId = null;
const basePrice = {{ $product->base_price }};

function selectVariant(btn) {
    document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    selectedVariantId = btn.dataset.variantId;
    document.getElementById('variantIdInput').value = selectedVariantId;
    document.getElementById('variantSelected').textContent = btn.dataset.label;

    const extra = parseFloat(btn.dataset.extra || 0);
    const total = basePrice + extra;
    document.querySelector('.price-main').textContent = '$' + Math.round(total).toLocaleString();
}

/* ─── Quantity ─── */
function changeQty(delta) {
    const input = document.getElementById('qtyInput');
    const max   = parseInt(input.max) || 99;
    let val = parseInt(input.value) || 1;
    val = Math.max(1, Math.min(max, val + delta));
    input.value = val;
    document.getElementById('quantityInput').value = val;
}

const qtyInput = document.getElementById('qtyInput');
if (qtyInput) {
    qtyInput.addEventListener('input', function() {
        document.getElementById('quantityInput').value = this.value;
    });
}

/* ─── Cart handler ─── */
function handleCart(e) {
    e.preventDefault();
    const form = document.getElementById('cartForm');
    const btn  = document.getElementById('addCartBtn')

    // If product has variants and none selected, shake the button
    const hasVariants = {{ $product->variants && $product->variants->count() > 0 ? 'true' : 'false' }};
    if (hasVariants && !selectedVariantId) {
        const section = document.querySelector('.variants-section');
        section.style.outline = '1px solid var(--accent)';
        setTimeout(() => section.style.outline = '', 1000);
        return;
    }

    const form   = document.getElementById('cartForm');
    const btn    = document.getElementById('addCartBtn');
    const formData = new FormData(form);

    btn.disabled = true;
    btn.textContent = 'Adding...';

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        showToast();
        btn.disabled = false;
        btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 2h1.5l2 8h7l1.5-6H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/><circle cx="7" cy="13" r="1" fill="currentColor"/><circle cx="12" cy="13" r="1" fill="currentColor"/></svg> Add to Cart`;
    })
    .catch(() => {
        // Fallback: submit normally
        form.submit();
    });
}

function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}

/* Flash effect on load */
(function() {
    const o = document.getElementById('flashOverlay');
    o.classList.add('flash');
    setTimeout(() => o.classList.remove('flash'), 200);
})();
</script>

@endsection