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
}

.shop-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

/* ═══════════════════════════════════════
   HERO SHOWCASE
═══════════════════════════════════════ */
.hero-section {
    position: relative;
    height: calc(100vh - 92px);
    min-height: 560px;
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid var(--border);
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent, var(--red));
    transition: background 0.6s ease;
    z-index: 5;
}

.hero-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 24px 48px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
    z-index: 2;
    position: relative;
}
.hero-eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.65rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
}
.eyebrow-line { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.hero-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 5px;
    color: var(--off-white);
}
.hero-counter {
    font-size: 0.65rem;
    letter-spacing: 4px;
    color: var(--muted);
}
.hero-counter strong { color: var(--off-white); font-weight: 400; }

.hero-stage {
    flex: 1;
    display: grid;
    grid-template-columns: 58% 42%;
    position: relative;
    overflow: hidden;
}

/* Car Panel */
.hero-car-panel {
    position: relative;
    overflow: hidden;
    background: #050505;
    border-right: 1px solid var(--border);
}

.car-slide {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 80px;
    opacity: 0;
    transform: translateX(50px);
    transition: opacity 0.6s cubic-bezier(0.16,1,0.3,1), transform 0.6s cubic-bezier(0.16,1,0.3,1);
    pointer-events: none;
}
.car-slide.active { opacity: 1; transform: translateX(0); pointer-events: all; }
.car-slide.exit   { opacity: 0; transform: translateX(-50px); }

.car-slide img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 30px 80px rgba(0,0,0,0.9));
    transition: transform 10s ease;
}
.car-slide.active img { transform: scale(1.04) translateY(-6px); }

.car-glow {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.8s ease;
    pointer-events: none;
}
.car-glow.active { opacity: 1; }

.car-ghost-year {
    position: absolute;
    bottom: 20px; left: 32px;
    font-family: 'Bebas Neue', cursive;
    font-size: 5rem;
    letter-spacing: 4px;
    color: rgba(255,255,255,0.04);
    line-height: 1;
    pointer-events: none;
    z-index: 1;
}

.car-team-tag {
    position: absolute;
    bottom: 28px; left: 32px;
    z-index: 3;
    display: flex;
    align-items: center;
    gap: 12px;
}
.team-bar { width: 3px; height: 44px; background: var(--accent, var(--red)); transition: background 0.5s; flex-shrink: 0; }
.team-label { font-size: 0.58rem; letter-spacing: 5px; text-transform: uppercase; color: var(--muted); margin-bottom: 3px; }
.team-name  { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 3px; color: var(--off-white); }

.car-dots {
    position: absolute;
    bottom: 32px; right: 32px;
    z-index: 3;
    display: flex;
    gap: 6px;
}
.dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}
.dot.active { background: var(--accent, var(--red)); transform: scale(1.4); }

/* Driver Panel */
.hero-driver-panel {
    position: relative;
    overflow: hidden;
    background: #060606;
}

.driver-slide {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    opacity: 0;
    transform: translateX(30px);
    transition: opacity 0.55s cubic-bezier(0.16,1,0.3,1), transform 0.55s cubic-bezier(0.16,1,0.3,1);
    pointer-events: none;
}
.driver-slide.active { opacity: 1; transform: translateX(0); pointer-events: all; }
.driver-slide.exit   { opacity: 0; transform: translateX(-30px); }

.driver-photo-wrap { position: absolute; inset: 0; }
.driver-photo-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: top center;
    filter: brightness(0.75) contrast(1.05);
    transition: transform 10s ease;
}
.driver-slide.active .driver-photo-wrap img { transform: scale(1.04); }

.driver-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 55%;
    background: linear-gradient(to top, rgba(6,6,6,0.97) 0%, rgba(6,6,6,0.5) 60%, transparent 100%);
    z-index: 2;
}

.driver-info {
    position: relative;
    z-index: 3;
    padding: 0 36px 32px;
}
.driver-number {
    font-family: 'Bebas Neue', cursive;
    font-size: 5rem;
    letter-spacing: 2px;
    line-height: 1;
    color: rgba(255,255,255,0.08);
    position: absolute;
    right: 36px; bottom: 28px;
    z-index: 2;
}
.driver-nationality {
    font-size: 0.58rem; letter-spacing: 5px; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;
}
.driver-name {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    letter-spacing: 3px; color: var(--off-white); line-height: 1; margin-bottom: 6px;
}
.driver-role {
    font-size: 0.6rem; letter-spacing: 4px; text-transform: uppercase;
    color: var(--accent, var(--red)); transition: color 0.5s; margin-bottom: 20px;
}
.btn-view-details {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 12px 24px;
    border: 1px solid rgba(255,255,255,0.15);
    background: transparent; color: rgba(240,237,232,0.7);
    font-family: 'Barlow', sans-serif; font-size: 0.65rem; font-weight: 500;
    letter-spacing: 4px; text-transform: uppercase; text-decoration: none;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
}
.btn-view-details:hover { border-color: var(--accent, var(--red)); color: var(--off-white); background: rgba(255,255,255,0.04); }
.btn-view-details svg { transition: transform 0.2s; }
.btn-view-details:hover svg { transform: translateX(4px); }

.driver-car-badge { position: absolute; top: 24px; right: 28px; z-index: 4; text-align: right; }
.driver-car-badge-model { font-family: 'Bebas Neue', cursive; font-size: 0.9rem; letter-spacing: 4px; color: rgba(255,255,255,0.15); }

/* Hero Bottom Nav */
.hero-nav {
    display: grid;
    grid-template-columns: 58% 42%;
    border-top: 1px solid var(--border);
    flex-shrink: 0;
}
.hero-nav-btn {
    display: flex; align-items: center; gap: 14px;
    height: 56px; padding: 0 48px;
    background: rgba(8,8,8,0.96); border: none; cursor: pointer;
    font-family: 'Barlow', sans-serif; font-size: 0.65rem; font-weight: 500;
    letter-spacing: 4px; text-transform: uppercase; color: var(--muted);
    transition: color 0.2s, background 0.2s; position: relative;
}
.hero-nav-btn:hover { color: var(--off-white); background: rgba(14,14,14,1); }
.hero-nav-btn::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
    background: var(--red); transform: scaleX(0); transition: transform 0.35s;
}
.hero-nav-btn:hover::before { transform: scaleX(1); }
#btnPrev { justify-content: flex-start; border-right: 1px solid var(--border); }
#btnNext { justify-content: flex-end; }

.nav-arrow {
    display: flex; align-items: center; justify-content: center;
    width: 30px; height: 30px; border: 1px solid var(--border);
    transition: border-color 0.2s, background 0.2s; flex-shrink: 0;
}
.hero-nav-btn:hover .nav-arrow { border-color: var(--red); background: var(--red); color: #fff; }
.nav-label-wrap { display: flex; flex-direction: column; }
.nav-label-sub  { font-size: 0.55rem; letter-spacing: 3px; color: var(--muted); margin-bottom: 1px; }
.nav-label-name {
    font-family: 'Bebas Neue', cursive; font-size: 0.95rem;
    letter-spacing: 3px; color: rgba(255,255,255,0.25); transition: color 0.2s;
}
.hero-nav-btn:hover .nav-label-name { color: rgba(255,255,255,0.6); }

.scroll-hint {
    position: absolute; bottom: 70px; left: 50%; transform: translateX(-50%);
    z-index: 10; display: flex; flex-direction: column; align-items: center; gap: 6px;
    opacity: 0.35; transition: opacity 0.3s; pointer-events: none;
}
.scroll-hint span { font-size: 0.55rem; letter-spacing: 4px; text-transform: uppercase; color: var(--muted); }
.scroll-arrow { width: 1px; height: 28px; background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.3)); animation: scrollPulse 2s ease infinite; }
@keyframes scrollPulse { 0%,100%{opacity:0.3;transform:scaleY(1)} 50%{opacity:1;transform:scaleY(1.2)} }

/* ═══════════════════════════════════════
   TAB BAR
═══════════════════════════════════════ */
.tab-bar {
    display: flex;
    align-items: stretch;
    background: #050505;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 92px;
    z-index: 30;
}

.tab-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    height: 60px;
    background: transparent;
    border: none;
    cursor: pointer;
    font-family: 'Barlow', sans-serif;
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    position: relative;
    transition: color 0.25s, background 0.25s;
}
.tab-btn + .tab-btn { border-left: 1px solid var(--border); }

.tab-btn::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s cubic-bezier(0.16,1,0.3,1);
}
.tab-btn.active { color: var(--off-white); background: rgba(255,255,255,0.01); }
.tab-btn.active::after { transform: scaleX(1); }
.tab-btn:hover:not(.active) { color: rgba(240,236,228,0.6); background: rgba(255,255,255,0.015); }

.tab-icon {
    width: 15px; height: 15px;
    opacity: 0.4;
    transition: opacity 0.25s;
    flex-shrink: 0;
}
.tab-btn.active .tab-icon { opacity: 0.9; }

.tab-count {
    font-size: 0.52rem;
    letter-spacing: 3px;
    padding: 3px 8px;
    border: 1px solid var(--border);
    color: var(--muted);
    transition: border-color 0.25s, color 0.25s;
    font-weight: 400;
}
.tab-btn.active .tab-count {
    border-color: rgba(225,6,0,0.35);
    color: rgba(225,6,0,0.85);
}

/* ═══════════════════════════════════════
   TAB PANELS
═══════════════════════════════════════ */
.tab-panel { display: none; }
.tab-panel.active {
    display: block;
    animation: panelIn 0.35s cubic-bezier(0.16,1,0.3,1);
}
@keyframes panelIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ═══════════════════════════════════════
   SECTION HEADER (shared)
═══════════════════════════════════════ */
.section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    padding: 56px 48px 40px;
    border-bottom: 1px solid var(--border);
}
.section-header-left {}
.section-eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.65rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 10px;
}
.section-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2rem, 4vw, 3rem);
    letter-spacing: 4px;
    color: var(--off-white);
    line-height: 1;
}
.section-meta {
    font-size: 0.62rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
}

/* ═══════════════════════════════════════
   CARS GRID
═══════════════════════════════════════ */
.cars-body { padding: 48px; }

.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
}

.product-card {
    background: #080808;
    display: flex;
    flex-direction: column;
    transition: background 0.25s;
    text-decoration: none;
    color: inherit;
    position: relative;
    overflow: hidden;
}
.product-card:hover { background: #0e0e0e; }
.product-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--card-accent, var(--red));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s ease;
}
.product-card:hover::before { transform: scaleX(1); }

.product-card-img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: #060606;
    position: relative;
}
.product-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease, filter 0.4s;
    filter: brightness(0.85);
}
.product-card:hover .product-card-img img { transform: scale(1.05); filter: brightness(1); }

.product-card-badge {
    position: absolute;
    top: 14px; left: 14px;
    font-size: 0.55rem; letter-spacing: 4px; text-transform: uppercase;
    padding: 4px 10px;
    background: rgba(8,8,8,0.85);
    border: 1px solid var(--border);
    color: var(--muted);
    backdrop-filter: blur(8px);
}

.product-card-body {
    padding: 24px 28px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
    border-top: 1px solid var(--border);
}
.product-card-team { font-size: 0.58rem; letter-spacing: 4px; text-transform: uppercase; color: var(--muted); }
.product-card-name { font-family: 'Bebas Neue', cursive; font-size: 1.3rem; letter-spacing: 2px; color: var(--off-white); line-height: 1.1; }
.product-card-driver { font-size: 0.62rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); margin-top: 2px; }

.product-card-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 28px;
    border-top: 1px solid var(--border);
}
.product-card-price { font-family: 'Bebas Neue', cursive; font-size: 1.4rem; letter-spacing: 2px; color: var(--off-white); }
.product-card-cta {
    font-size: 0.6rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
    display: flex; align-items: center; gap: 6px; transition: color 0.2s;
}
.product-card:hover .product-card-cta { color: var(--off-white); }
.product-card-cta svg { transition: transform 0.2s; }
.product-card:hover .product-card-cta svg { transform: translateX(4px); }

.grid-empty {
    grid-column: 1 / -1; padding: 80px; text-align: center;
    color: var(--muted); font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase;
}

/* ═══════════════════════════════════════
   MERCH
═══════════════════════════════════════ */
.merch-body { padding: 48px; }

.merch-filters {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}
.merch-pill {
    padding: 8px 20px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Barlow', sans-serif;
    font-size: 0.62rem; font-weight: 500; letter-spacing: 3px; text-transform: uppercase;
    cursor: pointer;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
    white-space: nowrap;
}
.merch-pill:hover { border-color: rgba(255,255,255,0.2); color: var(--off-white); }
.merch-pill.active { border-color: var(--red); color: var(--off-white); background: rgba(225,6,0,0.08); }

.merch-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
}

.merch-card {
    background: #080808;
    display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    position: relative; overflow: hidden;
    transition: background 0.25s;
}
.merch-card:hover { background: #0e0e0e; }
.merch-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--red); transform: scaleX(0); transform-origin: left;
    transition: transform 0.35s ease;
}
.merch-card:hover::before { transform: scaleX(1); }
.merch-card.hidden { display: none; }

.merch-card-img {
    aspect-ratio: 1/1;
    overflow: hidden; background: #060606; position: relative;
}
.merch-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.6s ease, filter 0.4s; filter: brightness(0.85);
}
.merch-card:hover .merch-card-img img { transform: scale(1.06); filter: brightness(1); }
.merch-card-cat {
    position: absolute; top: 12px; left: 12px;
    font-size: 0.52rem; letter-spacing: 3px; text-transform: uppercase;
    padding: 3px 9px; background: rgba(8,8,8,0.85); border: 1px solid var(--border);
    color: var(--muted); backdrop-filter: blur(8px);
}

.merch-card-body {
    padding: 18px 20px; flex: 1; display: flex; flex-direction: column; gap: 4px;
    border-top: 1px solid var(--border);
}
.merch-card-name { font-family: 'Bebas Neue', cursive; font-size: 1.1rem; letter-spacing: 2px; color: var(--off-white); line-height: 1.1; }
.merch-card-sub { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }

.merch-card-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 20px; border-top: 1px solid var(--border);
}
.merch-card-price { font-family: 'Bebas Neue', cursive; font-size: 1.2rem; letter-spacing: 2px; color: var(--off-white); }
.merch-card-cta {
    font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
    display: flex; align-items: center; gap: 5px; transition: color 0.2s;
}
.merch-card:hover .merch-card-cta { color: var(--off-white); }
.merch-card-cta svg { transition: transform 0.2s; }
.merch-card:hover .merch-card-cta svg { transform: translateX(3px); }

.merch-empty {
    grid-column: 1 / -1; padding: 60px; text-align: center;
    color: var(--muted); font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase;
}

/* Pagination */
.pagination-wrap {
    margin-top: 48px;
    display: flex;
    justify-content: center;
    border-top: 1px solid var(--border);
    padding-top: 48px;
}

/* Flash overlay */
.flash-overlay {
    position: fixed; inset: 0; background: rgba(8,8,8,0.4);
    pointer-events: none; opacity: 0; z-index: 999; transition: opacity 0.12s;
}
.flash-overlay.flash { opacity: 1; }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .hero-header, .hero-nav-btn { padding-left: 32px; padding-right: 32px; }
    .section-header { padding: 48px 32px 36px; }
    .cars-body, .merch-body { padding: 40px 32px; }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
    .merch-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .hero-stage { grid-template-columns: 1fr; }
    .hero-driver-panel { display: none; }
    .hero-nav { grid-template-columns: 1fr 1fr; }
    .hero-nav-btn { padding: 0 24px; }
    .hero-header { padding: 20px 24px; }
    .section-header { padding: 36px 24px 28px; }
    .cars-body, .merch-body { padding: 28px 24px; }
    .product-grid { grid-template-columns: 1fr; }
    .merch-grid { grid-template-columns: repeat(2, 1fr); }
    .hero-section { height: auto; min-height: 70vh; }
    .hero-car-panel { min-height: 300px; }
    .tab-btn { font-size: 0.58rem; letter-spacing: 3px; gap: 8px; }
    .tab-count { display: none; }
}
@media (max-width: 480px) {
    .merch-grid { grid-template-columns: 1fr; }
}
</style>

<div class="flash-overlay" id="flashOverlay"></div>

<div class="shop-page">

    {{-- ═══════════════════════════════════════
         HERO SHOWCASE
    ═══════════════════════════════════════ --}}
    <section class="hero-section" id="heroSection">

        <div class="hero-header">
            <div class="hero-eyebrow">
                <span class="eyebrow-line"></span>
                Featured Cars
            </div>
            <span class="hero-title">THE COLLECTION</span>
            <span class="hero-counter">
                <strong id="heroCurrent">01</strong> / <span id="heroTotal">{{ str_pad(count($featuredCars), 2, '0', STR_PAD_LEFT) }}</span>
            </span>
        </div>

        <div class="hero-stage">

            {{-- Car images --}}
            <div class="hero-car-panel" id="carPanel">
                @foreach($featuredCars as $i => $car)
                <div class="car-glow {{ $i === 0 ? 'active' : '' }}" id="glow{{ $i }}"
                     style="background: radial-gradient(ellipse 70% 60% at 60% 55%, {{ $car->carModel->team->color ?? 'rgba(225,6,0,0.12)' }}22 0%, transparent 70%);"></div>
                @endforeach

                @foreach($featuredCars as $i => $car)
                <div class="car-slide {{ $i === 0 ? 'active' : '' }}" id="carSlide{{ $i }}">
                    @if($car->mainImage)
                        <img src="{{ asset('storage/' . $car->mainImage->image_url) }}"
                             alt="{{ $car->product_name }}"
                             onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80'">
                    @else
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80"
                             alt="{{ $car->product_name }}">
                    @endif
                </div>
                @endforeach

                <div class="car-ghost-year" id="ghostYear">
                    {{ $featuredCars->first()?->carModel?->season_year ?? '2025' }}
                </div>

                <div class="car-team-tag">
                    <div class="team-bar" id="teamBar" style="background: {{ $featuredCars->first()?->carModel?->team?->color ?? 'var(--red)' }};"></div>
                    <div>
                        <div class="team-label">Constructor</div>
                        <div class="team-name" id="teamName">{{ $featuredCars->first()?->carModel?->team?->team_name ?? '—' }}</div>
                    </div>
                </div>

                <div class="car-dots" id="carDots"></div>
            </div>

            {{-- Driver photos --}}
            <div class="hero-driver-panel">
                @foreach($featuredCars as $i => $car)
                @php $driver = $car->carModel?->driver; @endphp
                <div class="driver-slide {{ $i === 0 ? 'active' : '' }}" id="driverSlide{{ $i }}">
                    <div class="driver-car-badge">
                        <div class="driver-car-badge-model">{{ $car->carModel?->model_name ?? '' }}</div>
                    </div>
                    <div class="driver-photo-wrap">
                        @if($driver?->photo_url)
                            <img src="{{ asset('storage/' . $driver->photo_url) }}"
                                 alt="{{ $driver->driver_name }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=800&q=80'">
                        @else
                            <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=800&q=80"
                                 alt="{{ $driver?->driver_name ?? 'Driver' }}">
                        @endif
                    </div>
                    <div class="driver-overlay"></div>
                    <div class="driver-info">
                        <div class="driver-nationality">{{ $driver?->nationality ?? '—' }}</div>
                        <div class="driver-name">{{ $driver?->driver_name ?? 'Unknown Driver' }}</div>
                        <div class="driver-role" style="color: {{ $car->carModel?->team?->color ?? 'var(--red)' }};">
                            {{ $car->carModel?->team?->team_name ?? '' }}
                        </div>
                        <a href="{{ route('products.show', $car) }}" class="btn-view-details">
                            View Details
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div class="driver-number">{{ $driver?->car_number ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="hero-nav">
            <button class="hero-nav-btn" id="btnPrev">
                <div class="nav-arrow">
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                        <path d="M7 2L4 5.5l3 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="nav-label-wrap">
                    <span class="nav-label-sub">Previous</span>
                    <span class="nav-label-name" id="prevName">—</span>
                </div>
            </button>
            <button class="hero-nav-btn" id="btnNext" style="justify-content: flex-end;">
                <div class="nav-label-wrap" style="text-align:right;">
                    <span class="nav-label-sub" style="text-align:right;">Next</span>
                    <span class="nav-label-name" id="nextName">
                        {{ $featuredCars->count() > 1 ? $featuredCars[1]->product_name : '—' }}
                    </span>
                </div>
                <div class="nav-arrow">
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                        <path d="M4 2l3 3.5-3 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </button>
        </div>

        <div class="scroll-hint">
            <span>Scroll</span>
            <div class="scroll-arrow"></div>
        </div>

    </section>

    {{-- ═══════════════════════════════════════
         TAB BAR
    ═══════════════════════════════════════ --}}
    <div class="tab-bar" id="tabBar">
        <button class="tab-btn active" id="tab-cars" onclick="switchTab('cars')">
            {{-- Car icon --}}
            <svg class="tab-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 9.5l1.5-4h9l1.5 4"/>
                <rect x="1" y="9.5" width="14" height="3" rx="1"/>
                <circle cx="4" cy="13" r="1.2"/>
                <circle cx="12" cy="13" r="1.2"/>
                <path d="M4 7.5h8"/>
            </svg>
            Scale Cars
            <span class="tab-count">{{ $allCars->total() }}</span>
        </button>
        <button class="tab-btn" id="tab-merch" onclick="switchTab('merch')">
            {{-- Shirt icon --}}
            <svg class="tab-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5.5 2C5.5 2 5 4 8 4s2.5-2 2.5-2L13 4l-2 2v8H5V6L3 4z"/>
            </svg>
            Merchandise
            <span class="tab-count">{{ $merchandise->total() }}</span>
        </button>
    </div>

    {{-- ═══════════════════════════════════════
         PANEL: CARS
    ═══════════════════════════════════════ --}}
    <div class="tab-panel active" id="panel-cars">

        <div class="section-header">
            <div class="section-header-left">
                <div class="section-eyebrow">
                    <span class="eyebrow-line"></span>
                    All Models
                </div>
                <div class="section-title">THE FULL GRID</div>
            </div>
            <div class="section-meta">{{ $allCars->total() }} cars available</div>
        </div>

        <div class="cars-body">
            <div class="product-grid">
                @forelse($allCars as $car)
                @php
                    $accent = $car->carModel?->team?->color ?? '#E10600';
                    $driver = $car->carModel?->driver;
                @endphp
                <a href="{{ route('products.show', $car) }}"
                   class="product-card"
                   style="--card-accent: {{ $accent }};">
                    <div class="product-card-img">
                        @if($car->mainImage)
                            <img src="{{ asset('storage/' . $car->mainImage->image_url) }}"
                                 alt="{{ $car->product_name }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80'">
                        @else
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80"
                                 alt="{{ $car->product_name }}">
                        @endif
                        <div class="product-card-badge">{{ $car->carModel?->season_year ?? 'Scale Model' }}</div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-team">{{ $car->carModel?->team?->team_name ?? '—' }}</div>
                        <div class="product-card-name">{{ $car->product_name }}</div>
                        @if($driver)
                        <div class="product-card-driver">#{{ $driver->car_number }} · {{ $driver->driver_name }}</div>
                        @endif
                    </div>
                    <div class="product-card-footer">
                        <span class="product-card-price">${{ number_format($car->base_price, 0) }}</span>
                        <span class="product-card-cta">
                            View
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </a>
                @empty
                <div class="grid-empty">No cars available</div>
                @endforelse
            </div>

            @if($allCars->hasPages())
            <div class="pagination-wrap">{{ $allCars->links() }}</div>
            @endif
        </div>

    </div>

    {{-- ═══════════════════════════════════════
         PANEL: MERCHANDISE
    ═══════════════════════════════════════ --}}
    <div class="tab-panel" id="panel-merch">

        <div class="section-header">
            <div class="section-header-left">
                <div class="section-eyebrow">
                    <span class="eyebrow-line"></span>
                    Official Merchandise
                </div>
                <div class="section-title">THE STORE</div>
            </div>
            <div class="section-meta">{{ $merchandise->total() }} items</div>
        </div>

        <div class="merch-body">
            <div class="merch-filters">
                <button class="merch-pill active" data-cat="all">All</button>
                @foreach($merchCategories as $cat)
                <button class="merch-pill" data-cat="{{ $cat->category_id }}">{{ $cat->category_name }}</button>
                @endforeach
            </div>

            <div class="merch-grid" id="merchGrid">
                @forelse($merchandise as $item)
                <a href="{{ route('products.show', $item) }}"
                   class="merch-card"
                   data-cat="{{ $item->category_id }}">
                    <div class="merch-card-img">
                        @if($item->mainImage)
                            <img src="{{ asset('storage/' . $item->mainImage->image_url) }}"
                                 alt="{{ $item->product_name }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1523381294911-8d3cead13475?w=800&q=80'">
                        @else
                            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?w=800&q=80"
                                 alt="{{ $item->product_name }}">
                        @endif
                        <div class="merch-card-cat">{{ $item->category?->category_name ?? 'Merch' }}</div>
                    </div>
                    <div class="merch-card-body">
                        <div class="merch-card-name">{{ $item->product_name }}</div>
                        @if($item->brand)
                        <div class="merch-card-sub">{{ $item->brand->brand_name }}</div>
                        @endif
                    </div>
                    <div class="merch-card-footer">
                        <span class="merch-card-price">${{ number_format($item->base_price, 0) }}</span>
                        <span class="merch-card-cta">
                            View
                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </a>
                @empty
                <div class="merch-empty">No merchandise available</div>
                @endforelse
            </div>

            @if($merchandise->hasPages())
            <div class="pagination-wrap">{{ $merchandise->links() }}</div>
            @endif
        </div>

    </div>

</div>

@include('home._footer')

<script>
/* ─── Hero Carousel ─── */
const FEATURED = [
    @foreach($featuredCars as $i => $car)
    {
        name:   "{{ addslashes($car->product_name) }}",
        team:   "{{ addslashes($car->carModel?->team?->team_name ?? '—') }}",
        accent: "{{ $car->carModel?->team?->color ?? '#E10600' }}",
        year:   "{{ $car->carModel?->season_year ?? '2025' }}",
    },
    @endforeach
];

let current = 0, animating = false;
const total = FEATURED.length;

// Build dots
const dotsWrap = document.getElementById('carDots');
FEATURED.forEach((_, i) => {
    const d = document.createElement('div');
    d.className = 'dot' + (i === 0 ? ' active' : '');
    d.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(d);
});

function goTo(next) {
    if (animating || next === current || next < 0 || next >= total) return;
    animating = true;
    const prev = current;
    current = next;

    const prevCar = document.getElementById('carSlide' + prev);
    const nextCar = document.getElementById('carSlide' + next);
    prevCar.classList.remove('active'); prevCar.classList.add('exit');
    document.getElementById('glow' + prev).classList.remove('active');
    document.getElementById('glow' + next).classList.add('active');
    setTimeout(() => { prevCar.classList.remove('exit'); nextCar.classList.add('active'); }, 120);

    const prevDrv = document.getElementById('driverSlide' + prev);
    const nextDrv = document.getElementById('driverSlide' + next);
    if (prevDrv && nextDrv) {
        prevDrv.classList.remove('active'); prevDrv.classList.add('exit');
        setTimeout(() => { prevDrv.classList.remove('exit'); nextDrv.classList.add('active'); }, 160);
    }

    const car = FEATURED[next];
    document.getElementById('heroCurrent').textContent = String(next + 1).padStart(2, '0');
    document.getElementById('teamName').textContent    = car.team;
    document.getElementById('teamBar').style.background = car.accent;
    document.getElementById('ghostYear').textContent  = car.year;
    document.getElementById('heroSection').style.setProperty('--accent', car.accent);
    document.getElementById('carPanel').style.setProperty('--accent', car.accent);

    document.querySelectorAll('.dot').forEach((d, i) => d.classList.toggle('active', i === next));
    document.getElementById('prevName').textContent = next === 0 ? '—' : FEATURED[next - 1].name;
    document.getElementById('nextName').textContent = next === total - 1 ? '—' : FEATURED[next + 1].name;

    setTimeout(() => { animating = false; }, 700);
}

document.getElementById('heroSection').style.setProperty('--accent', FEATURED[0]?.accent ?? '#E10600');
document.getElementById('carPanel').style.setProperty('--accent', FEATURED[0]?.accent ?? '#E10600');
document.getElementById('btnPrev').addEventListener('click', () => goTo(current - 1));
document.getElementById('btnNext').addEventListener('click', () => goTo(current + 1));

document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') goTo(current + 1);
    if (e.key === 'ArrowLeft')  goTo(current - 1);
});

let tx = 0;
document.addEventListener('touchstart', e => { tx = e.touches[0].clientX; });
document.addEventListener('touchend', e => {
    const dx = e.changedTouches[0].clientX - tx;
    if (Math.abs(dx) > 60) dx < 0 ? goTo(current + 1) : goTo(current - 1);
});

/* ─── Tab Switcher ─── */
function switchTab(id) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('active');
    document.getElementById('panel-' + id).classList.add('active');
    // Persist tab state in URL hash
    history.replaceState(null, '', '#' + id);
}

// Restore tab from hash on load
(function() {
    const hash = window.location.hash.replace('#', '');
    if (hash === 'cars' || hash === 'merch') switchTab(hash);
})();

/* ─── Merch Category Filter ─── */
const pills = document.querySelectorAll('.merch-pill');
const cards = document.querySelectorAll('.merch-card');

pills.forEach(pill => {
    pill.addEventListener('click', () => {
        pills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        const cat = pill.dataset.cat;
        cards.forEach(card => {
            card.classList.toggle('hidden', cat !== 'all' && card.dataset.cat !== cat);
        });
    });
});
</script>

@endsection