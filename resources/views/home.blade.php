<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Store — Own The Race</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red:       #e10600;
            --red-glow:  #ff1a0d;
            --dark:      #050505;
            --dark-2:    #0a0a0a;
            --off-white: #f0ede8;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background: var(--dark);
            color: var(--off-white);
            font-family: 'Barlow Condensed', sans-serif;
            overflow-x: hidden;
        }

        /* ─────────────────────────────────────────
           NAVBAR
        ───────────────────────────────────────── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.4s, padding 0.4s;
        }
        nav.scrolled {
            background: rgba(5,5,5,0.92);
            backdrop-filter: blur(20px);
            padding: 14px 50px;
            border-bottom: 1px solid rgba(225,6,0,0.08);
        }
        .nav-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            letter-spacing: 6px;
            color: var(--off-white);
        }
        .nav-logo span { color: var(--red); }

        .nav-links {
            display: flex;
            gap: 36px;
            list-style: none;
        }
        .nav-links a {
            color: rgba(240,237,232,0.45);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            transition: color 0.3s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 1px;
            background: var(--red);
            transition: width 0.3s;
        }
        .nav-links a:hover { color: var(--off-white); }
        .nav-links a:hover::after { width: 100%; }

        /* Hamburger (mobile) */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }
        .nav-hamburger span {
            display: block;
            width: 22px; height: 1.5px;
            background: var(--off-white);
            transition: all 0.3s;
        }
        .nav-hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; }
        .nav-hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        .nav-mobile {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(5,5,5,0.97);
            backdrop-filter: blur(24px);
            z-index: 999;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 40px;
        }
        .nav-mobile.open { display: flex; }
        .nav-mobile a {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(2.5rem, 8vw, 4rem);
            letter-spacing: 8px;
            color: rgba(240,237,232,0.4);
            text-decoration: none;
            transition: color 0.3s;
        }
        .nav-mobile a:hover { color: var(--off-white); }
        .nav-mobile a span { color: var(--red); }

        /* ─────────────────────────────────────────
           RACE TICKER
        ───────────────────────────────────────── */
        .ticker-wrap {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 28px;
            background: var(--red);
            z-index: 1001;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .ticker-track {
            display: flex;
            white-space: nowrap;
            animation: ticker-scroll 28s linear infinite;
            will-change: transform;
        }
        .ticker-track:hover { animation-play-state: paused; }
        .ticker-item {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.9);
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .ticker-item::before {
            content: '●';
            font-size: 0.4rem;
            color: rgba(255,255,255,0.5);
        }
        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Push content below ticker */
        body { padding-top: 28px; }

        nav { top: 28px; }

        /* ─────────────────────────────────────────
           HERO
        ───────────────────────────────────────── */
        #hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #hero-video {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            z-index: -2;
            filter: brightness(0.55) contrast(1.15) saturate(1.1);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(5,5,5,0.5) 0%, transparent 50%, rgba(5,5,5,0.3) 100%),
                radial-gradient(ellipse at 50% 60%, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.75) 80%, rgba(0,0,0,0.97) 100%);
            z-index: -1;
        }

        /* Red side accent */
        .hero-red-bar {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            padding: 0 20px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 0.65rem;
            letter-spacing: 7px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        .hero-label::before,
        .hero-label::after {
            content: '';
            display: block;
            width: 30px; height: 1px;
            background: rgba(225,6,0,0.6);
        }

        .hero-eyebrow {
            font-size: 0.65rem;
            letter-spacing: 10px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 10px;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.2s forwards;
        }

        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(4.5rem, 11vw, 10rem);
            letter-spacing: 10px;
            line-height: 0.92;
            opacity: 0;
            animation: fadeUp 0.9s ease 0.4s forwards;
        }
        .hero-title .line-2 {
            display: block;
            color: var(--red);
            -webkit-text-stroke: 0px;
            text-shadow: 0 0 60px rgba(225,6,0,0.5);
        }
        .hero-title .line-1 {
            display: block;
            -webkit-text-stroke: 1px rgba(240,237,232,0.15);
        }

        .hero-speed {
            margin-top: 16px;
            font-size: 0.7rem;
            letter-spacing: 6px;
            color: rgba(255,255,255,0.25);
            text-transform: uppercase;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.6s forwards;
        }
        .hero-speed strong {
            color: var(--red);
            font-family: 'Bebas Neue', cursive;
            font-size: 1rem;
            letter-spacing: 2px;
        }

        .hero-cta {
            margin-top: 36px;
            display: flex;
            gap: 16px;
            justify-content: center;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.8s forwards;
        }

        .btn-primary {
            padding: 13px 32px;
            background: var(--red);
            color: white;
            text-decoration: none;
            font-size: 0.72rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.08);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn-primary:hover { background: var(--red-glow); box-shadow: 0 0 30px rgba(225,6,0,0.35); transform: translateY(-2px); }
        .btn-primary:hover::after { opacity: 1; }

        .btn-secondary {
            padding: 13px 32px;
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.72rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            transition: all 0.3s;
        }
        .btn-secondary:hover {
            border-color: var(--red);
            color: var(--red);
            transform: translateY(-2px);
        }

        /* Hero stats row */
        .hero-stats {
            position: absolute;
            bottom: 80px;
            left: 0; right: 0;
            display: flex;
            justify-content: center;
            gap: 60px;
            z-index: 2;
            opacity: 0;
            animation: fadeUp 0.8s ease 1.1s forwards;
        }
        .hero-stat { text-align: center; }
        .hero-stat-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2rem;
            letter-spacing: 3px;
            line-height: 1;
            color: var(--off-white);
        }
        .hero-stat-value span { color: var(--red); }
        .hero-stat-label {
            font-size: 0.55rem;
            letter-spacing: 5px;
            color: rgba(255,255,255,0.25);
            text-transform: uppercase;
            margin-top: 4px;
        }
        .hero-stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(225,6,0,0.2);
            align-self: center;
        }

        .scroll-hint {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 0.55rem;
            letter-spacing: 6px;
            color: rgba(255,255,255,0.2);
            z-index: 2;
        }
        .scroll-line {
            width: 1px; height: 36px;
            background: linear-gradient(to bottom, var(--red), transparent);
            margin: 0 auto 8px;
            animation: pulse 2s infinite;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%,100% { opacity: 0.2; }
            50%      { opacity: 1; }
        }

        /* ─────────────────────────────────────────
           SECTION DIVIDER — Marquee Strip
        ───────────────────────────────────────── */
        .marquee-section {
            height: 48px;
            background: var(--dark-2);
            border-top: 1px solid rgba(225,6,0,0.12);
            border-bottom: 1px solid rgba(225,6,0,0.12);
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .marquee-inner {
            display: flex;
            white-space: nowrap;
            animation: marquee-scroll 20s linear infinite;
        }
        .marquee-inner:hover { animation-play-state: paused; }
        .marquee-item {
            font-family: 'Bebas Neue', cursive;
            font-size: 0.85rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.08);
            padding: 0 30px;
            text-transform: uppercase;
        }
        .marquee-item.red {
            color: rgba(225,6,0,0.4);
        }
        @keyframes marquee-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ─────────────────────────────────────────
           3D SCROLL SECTION
        ───────────────────────────────────────── */
        #scroll-spacer {
            height: 500vh;
            position: relative;
        }

        #sticky-car {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
            background: var(--dark);
        }

        #car-fullscreen-canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            opacity: 1;
        }

        /* Scan-line overlay */
        #sticky-car::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.015) 2px,
                rgba(0,0,0,0.015) 4px
            );
            pointer-events: none;
            z-index: 6;
        }

        /* ── HUD ── */
        .hud {
            position: absolute;
            inset: 0;
            z-index: 10;
            pointer-events: none;
            padding: 80px 60px 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hud-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .hud-panel {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.6s, transform 0.6s;
        }
        .hud-label {
            font-size: 0.55rem;
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .hud-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.8rem;
            letter-spacing: 3px;
            line-height: 1;
        }
        .hud-unit {
            font-size: 0.75rem;
            color: rgba(240,237,232,0.25);
            letter-spacing: 2px;
            margin-left: 4px;
        }

        /* Speed counter */
        #hud-speed-wrap {
            position: absolute;
            top: 80px;
            right: 60px;
            z-index: 10;
            text-align: right;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s;
        }
        .hud-speed-label {
            font-size: 0.55rem;
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .hud-speed-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 4.5rem;
            letter-spacing: 2px;
            line-height: 1;
            color: var(--off-white);
            font-variant-numeric: tabular-nums;
        }
        .hud-speed-unit {
            font-size: 0.7rem;
            color: rgba(240,237,232,0.2);
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* RPM bar */
        #hud-rpm-wrap {
            position: absolute;
            bottom: 60px;
            right: 60px;
            z-index: 10;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s;
            text-align: right;
        }
        .hud-rpm-label {
            font-size: 0.5rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.25);
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .rpm-bar-track {
            width: 160px;
            height: 3px;
            background: rgba(255,255,255,0.05);
            margin-left: auto;
            position: relative;
            overflow: visible;
        }
        .rpm-bar-fill {
            height: 100%;
            background: linear-gradient(to right, var(--red), #ff4400);
            box-shadow: 0 0 12px rgba(225,6,0,0.8);
            width: 0%;
            transition: width 0.1s linear;
        }
        .rpm-ticks {
            display: flex;
            justify-content: space-between;
            margin-top: 4px;
        }
        .rpm-tick {
            font-size: 0.45rem;
            letter-spacing: 1px;
            color: rgba(240,237,232,0.15);
        }
        .rpm-tick.active { color: var(--red); }

        /* Gear indicator */
        #hud-gear {
            position: absolute;
            bottom: 60px;
            left: 60px;
            z-index: 10;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s;
        }
        .gear-label {
            font-size: 0.5rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.2);
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .gear-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 5rem;
            letter-spacing: 2px;
            line-height: 1;
            color: rgba(240,237,232,0.08);
            font-variant-numeric: tabular-nums;
            transition: color 0.15s, text-shadow 0.15s;
        }
        .gear-value.shift {
            color: var(--red);
            text-shadow: 0 0 30px rgba(225,6,0,0.5);
        }

        /* Car name */
        .hud-center {
            position: absolute;
            bottom: 55px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            opacity: 0;
            white-space: nowrap;
            z-index: 10;
            pointer-events: none;
            transition: opacity 0.6s;
        }
        .hud-center .team {
            font-size: 0.6rem;
            letter-spacing: 8px;
            color: rgba(240,237,232,0.3);
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .hud-center .model {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            letter-spacing: 6px;
        }
        .hud-center .model span { color: var(--red); }

        /* Corner brackets */
        .corner-bracket {
            position: absolute;
            width: 20px; height: 20px;
            z-index: 10;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.8s;
        }
        .corner-bracket::before, .corner-bracket::after {
            content: '';
            position: absolute;
            background: var(--red);
        }
        .corner-bracket::before { width: 100%; height: 1px; }
        .corner-bracket::after  { width: 1px; height: 100%; }
        .cb-tl { top: 50px; left: 50px; }
        .cb-tr { top: 50px; right: 50px; transform: scaleX(-1); }
        .cb-bl { bottom: 50px; left: 50px; transform: scaleY(-1); }
        .cb-br { bottom: 50px; right: 50px; transform: scale(-1); }

        /* Red glow floor */
        .hud-glow {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 70%; height: 250px;
            background: radial-gradient(ellipse at bottom, rgba(225,6,0,0.18) 0%, transparent 70%);
            pointer-events: none;
            z-index: 5;
        }

        /* Why items */
        .why-text {
            position: absolute;
            inset: 0;
            z-index: 20;
            pointer-events: none;
        }
        .why-item {
            position: absolute;
            bottom: 130px;
            left: 60px;
            max-width: 400px;
            opacity: 0;
            transform: translateY(40px);
            pointer-events: none;
        }
        .why-item .why-number {
            font-size: 0.6rem;
            letter-spacing: 7px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .why-item .why-number::after {
            content: '';
            display: block;
            width: 24px; height: 1px;
            background: var(--red);
            opacity: 0.5;
        }
        .why-item h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(2.2rem, 4.5vw, 3.5rem);
            letter-spacing: 4px;
            line-height: 1;
            margin-bottom: 14px;
        }
        .why-item p {
            font-size: 0.88rem;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            line-height: 1.7;
            max-width: 320px;
        }

        /* Progress dots */
        .why-progress {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 30;
            display: flex;
            flex-direction: column;
            gap: 14px;
            pointer-events: none;
        }
        .why-dot {
            width: 3px; height: 3px;
            border-radius: 50%;
            background: rgba(240,237,232,0.15);
            transition: all 0.4s;
        }
        .why-dot.active {
            background: var(--red);
            transform: scale(2);
            box-shadow: 0 0 8px rgba(225,6,0,0.6);
        }

        /* Camera label */
        .cam-label {
            position: absolute;
            top: 80px;
            left: 60px;
            z-index: 20;
            text-align: left;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .cam-label-tag {
            font-size: 0.5rem;
            letter-spacing: 6px;
            color: rgba(225,6,0,0.6);
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .cam-label-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.3rem;
            letter-spacing: 4px;
            color: rgba(240,237,232,0.5);
        }

        /* ─────────────────────────────────────────
           PRODUCTS
        ───────────────────────────────────────── */
        #products-preview {
            padding: 120px 60px;
            background: var(--dark);
            position: relative;
        }
        #products-preview::before {
            content: '';
            position: absolute;
            top: 0; left: 60px; right: 60px;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(225,6,0,0.2), transparent);
        }
        .section-eyebrow {
            font-size: 0.6rem;
            letter-spacing: 8px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-eyebrow::before {
            content: '';
            display: block;
            width: 20px; height: 1px;
            background: var(--red);
        }
        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 6vw, 5rem);
            letter-spacing: 3px;
            margin-bottom: 60px;
            line-height: 1;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2px;
            max-width: 1400px;
        }
        .product-card {
            background: #0c0c0c;
            overflow: hidden;
            opacity: 0;
            transform: translateY(40px);
            cursor: pointer;
            position: relative;
        }
        .product-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--red);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            z-index: 2;
        }
        .product-card:hover::before { transform: scaleX(1); }
        .product-card:hover { transform: translateY(-6px) !important; }

        .product-card-img {
            width: 100%; height: 220px;
            background: #131313;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .product-card-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease, filter 0.4s ease;
            filter: grayscale(20%);
        }
        .product-card:hover .product-card-img img {
            transform: scale(1.08);
            filter: grayscale(0%) brightness(1.05);
        }
        .product-card-img-placeholder {
            font-size: 0.6rem;
            letter-spacing: 4px;
            color: rgba(255,255,255,0.06);
            text-transform: uppercase;
        }

        /* Team color tag */
        .product-tag {
            position: absolute;
            bottom: 10px; left: 10px;
            font-size: 0.5rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            padding: 4px 8px;
            background: rgba(225,6,0,0.15);
            border: 1px solid rgba(225,6,0,0.25);
            color: var(--red);
            z-index: 2;
        }

        .product-card-body {
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.03);
            position: relative;
        }
        .product-card-name {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(240,237,232,0.85);
        }
        .product-card-price {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            color: var(--off-white);
            letter-spacing: 1px;
        }
        .product-card-price span {
            font-size: 0.75rem;
            color: var(--red);
            letter-spacing: 1px;
            margin-right: 2px;
        }

        /* ─────────────────────────────────────────
           FOOTER
        ───────────────────────────────────────── */
        footer {
            padding: 50px 60px;
            border-top: 1px solid rgba(225,6,0,0.08);
            position: relative;
        }
        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 50px;
        }
        .footer-brand {}
        .footer-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.8rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.18);
            display: block;
            margin-bottom: 10px;
        }
        .footer-logo span { color: rgba(225,6,0,0.5); }
        .footer-tagline {
            font-size: 0.6rem;
            letter-spacing: 5px;
            color: rgba(240,237,232,0.08);
            text-transform: uppercase;
        }
        .footer-links-group { display: flex; gap: 60px; }
        .footer-col {}
        .footer-col-title {
            font-size: 0.55rem;
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul a {
            font-size: 0.72rem;
            letter-spacing: 2px;
            color: rgba(240,237,232,0.2);
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.3s;
        }
        .footer-col ul a:hover { color: rgba(240,237,232,0.7); }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 28px;
            border-top: 1px solid rgba(255,255,255,0.03);
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-copy {
            font-size: 0.58rem;
            letter-spacing: 3px;
            color: rgba(240,237,232,0.08);
            text-transform: uppercase;
        }
        .footer-badges { display: flex; gap: 16px; align-items: center; }
        .footer-badge {
            font-size: 0.5rem;
            letter-spacing: 3px;
            color: rgba(240,237,232,0.06);
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.04);
            padding: 4px 8px;
        }

        /* ─────────────────────────────────────────
           MUSIC CARD
        ───────────────────────────────────────── */
        #music-card {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(8,8,8,0.82);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(225,6,0,0.15);
            padding: 12px 16px;
            border-radius: 2px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5), 0 0 20px rgba(225,6,0,0.04);
            animation: fadeUp 1s ease 1.5s both;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        #music-card:hover {
            border-color: rgba(225,6,0,0.4);
            box-shadow: 0 0 40px rgba(0,0,0,0.5), 0 0 30px rgba(225,6,0,0.1);
        }
        #hans-img {
            width: 40px; height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid rgba(225,6,0,0.35);
            filter: grayscale(20%);
        }
        #music-info { display: flex; flex-direction: column; gap: 2px; }
        #music-label { font-size: 0.5rem; letter-spacing: 5px; color: var(--red); text-transform: uppercase; }
        #music-name { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 3px; line-height: 1; }
        #music-track { font-size: 0.55rem; letter-spacing: 2px; color: rgba(240,237,232,0.28); text-transform: uppercase; }
        #mute-btn {
            background: none;
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(240,237,232,0.4);
            cursor: pointer;
            padding: 8px;
            border-radius: 1px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s;
            flex-shrink: 0;
        }
        #mute-btn:hover { border-color: var(--red); color: var(--red); }
        #mute-btn svg { width: 14px; height: 14px; }

        /* Vinyl spin */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        #hans-img.playing { animation: spin 8s linear infinite; }

        /* ─────────────────────────────────────────
           VIGNETTE
        ───────────────────────────────────────── */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle, transparent 55%, rgba(0,0,0,0.5) 100%);
            z-index: 9998;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE
        ───────────────────────────────────────── */
        @media (max-width: 768px) {
            nav { padding: 16px 24px; }
            nav.scrolled { padding: 12px 24px; }
            .nav-links { display: none; }
            .nav-hamburger { display: flex; }

            .hero-stats { gap: 24px; bottom: 60px; }
            .hero-stat-value { font-size: 1.6rem; }

            #products-preview { padding: 80px 24px; }
            .products-grid { grid-template-columns: 1fr; }

            .hud { padding: 60px 24px 40px; }
            .why-item { left: 24px; bottom: 100px; max-width: 280px; }
            .hud-speed-value { font-size: 3rem; }

            footer { padding: 40px 24px; }
            .footer-inner { flex-direction: column; }
            .footer-links-group { flex-wrap: wrap; gap: 30px; }

            .ticker-item { padding: 0 20px; }
            #music-card { bottom: 16px; right: 16px; padding: 10px 12px; }
        }
    </style>
</head>
<body>

    {{-- ── RACE TICKER ── --}}
    <div class="ticker-wrap">
        <div class="ticker-track" id="ticker-track">
            {{-- Items duplicated in JS for seamless loop --}}
            <span class="ticker-item">F1 2024 Season</span>
            <span class="ticker-item red">New Collection Live</span>
            <span class="ticker-item">Max Verstappen — World Champion</span>
            <span class="ticker-item red">RB20 Replica Now Available</span>
            <span class="ticker-item">Free Shipping Over $250</span>
            <span class="ticker-item red">Monza · Silverstone · Suzuka</span>
            <span class="ticker-item">Official Merchandise</span>
            <span class="ticker-item red">Limited Edition Items</span>
            <span class="ticker-item">Formula One Store</span>
            <span class="ticker-item red">Own The Race</span>
            {{-- Duplicate set for seamless --}}
            <span class="ticker-item">F1 2024 Season</span>
            <span class="ticker-item red">New Collection Live</span>
            <span class="ticker-item">Max Verstappen — World Champion</span>
            <span class="ticker-item red">RB20 Replica Now Available</span>
            <span class="ticker-item">Free Shipping Over $250</span>
            <span class="ticker-item red">Monza · Silverstone · Suzuka</span>
            <span class="ticker-item">Official Merchandise</span>
            <span class="ticker-item red">Limited Edition Items</span>
            <span class="ticker-item">Formula One Store</span>
            <span class="ticker-item red">Own The Race</span>
        </div>
    </div>

    {{-- ── NAVBAR ── --}}
    <nav id="navbar">
        <div class="nav-logo">F1<span>·</span>Store</div>
        <ul class="nav-links">
            <li><a href="{{ route('products.cars') }}">Cars</a></li>
            <li><a href="{{ route('products.merchandise') }}">Merchandise</a></li>
            <li><a href="{{ route('cart.index') }}">Cart</a></li>
            @auth
                <li><a href="{{ route('orders.index') }}">Orders</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
        </ul>
        <div class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()">
            <span></span><span></span><span></span>
        </div>
    </nav>

    {{-- ── MOBILE NAV ── --}}
    <div class="nav-mobile" id="mobile-nav">
        <a href="{{ route('products.cars') }}" onclick="toggleMobileNav()">Cars</a>
        <a href="{{ route('products.merchandise') }}" onclick="toggleMobileNav()">Merch</a>
        <a href="{{ route('cart.index') }}" onclick="toggleMobileNav()">Cart</a>
        @auth
            <a href="{{ route('orders.index') }}" onclick="toggleMobileNav()">Orders</a>
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileNav()">Login</a>
        @endauth
    </div>

    {{-- ── HERO ── --}}
    <section id="hero">
        <video autoplay muted loop playsinline id="hero-video" poster="/images/fallback.jpg">
            <source src="{{ asset('F1.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-red-bar"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">Formula One — 2024 Collection</p>
            <h1 class="hero-title">
                <span class="line-1">Own The</span>
                <span class="line-2">Race</span>
            </h1>
            <p class="hero-speed">
                Top Speed <strong id="hero-speed-val">0</strong> <strong>km/h</strong>
                &nbsp;·&nbsp; 0–100 in <strong>2.6s</strong>
            </p>
            <div class="hero-cta">
                <a href="#products-preview" class="btn-primary">Shop Now</a>
                <a href="{{ route('products.cars') }}" class="btn-secondary">Explore Cars</a>
            </div>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-hp">0<span>HP</span></div>
                <div class="hero-stat-label">Power Output</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-rpm">0<span>k</span></div>
                <div class="hero-stat-label">Max RPM</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-g">0<span>G</span></div>
                <div class="hero-stat-label">Lateral Force</div>
            </div>
        </div>

        <div class="scroll-hint">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    {{-- ── MARQUEE DIVIDER ── --}}
    <div class="marquee-section">
        <div class="marquee-inner">
            @php
                $items = ['Aerodynamics', '·', 'Performance', '·', 'Speed', '·', 'Precision', '·', 'Power', '·', 'Technology', '·', 'Carbon Fibre', '·', 'Hybrid Unit', '·', 'Downforce', '·', 'Podium', '·', 'Aerodynamics', '·', 'Performance', '·', 'Speed', '·', 'Precision', '·', 'Power', '·', 'Technology', '·', 'Carbon Fibre', '·', 'Hybrid Unit', '·', 'Downforce', '·', 'Podium', '·'];
            @endphp
            @foreach($items as $idx => $item)
                <span class="marquee-item {{ $item !== '·' && $idx % 4 === 0 ? 'red' : '' }}">{{ $item }}</span>
            @endforeach
        </div>
    </div>

    {{-- ── 3D SCROLL / STICKY ── --}}
    <div id="scroll-spacer">
        <div id="sticky-car">

            <canvas id="car-fullscreen-canvas"></canvas>
            <div class="hud-glow"></div>

            {{-- Corner brackets --}}
            <div class="corner-bracket cb-tl" id="cb-tl"></div>
            <div class="corner-bracket cb-tr" id="cb-tr"></div>
            <div class="corner-bracket cb-bl" id="cb-bl"></div>
            <div class="corner-bracket cb-br" id="cb-br"></div>

            {{-- HUD specs --}}
            <div class="hud">
                <div class="hud-row">
                    <div class="hud-panel" id="spec-1">
                        <div class="hud-label">Power Output</div>
                        
                    </div>
                </div>
                <div class="hud-row">
                    <div class="hud-panel" id="spec-3">
                        <div class="hud-label">Constructor</div>
                        <div class="hud-value" style="font-size:1.8rem">Red Bull Racing</div>
                    </div>
                    <div class="hud-panel" id="spec-4" style="text-align:right">
                        <div class="hud-label">Engine</div>
                        <div class="hud-value" style="font-size:1.8rem">Honda RBPTH002</div>
                    </div>
                </div>
            </div>

            {{-- Speed Counter --}}
            <div id="hud-speed-wrap">
                <div class="hud-speed-label">Speed</div>
                <div class="hud-speed-value"><span id="hud-speed-num">0</span></div>
                <div class="hud-speed-unit">km/h</div>
            </div>

            {{-- RPM bar --}}
            <div id="hud-rpm-wrap">
                <div class="hud-rpm-label">Engine RPM</div>
                <div class="rpm-bar-track">
                    <div class="rpm-bar-fill" id="rpm-fill"></div>
                </div>
                <div class="rpm-ticks">
                    <span class="rpm-tick">2k</span>
                    <span class="rpm-tick">5k</span>
                    <span class="rpm-tick">8k</span>
                    <span class="rpm-tick">11k</span>
                    <span class="rpm-tick">15k</span>
                </div>
            </div>

            {{-- Gear indicator --}}
            <div id="hud-gear">
                <div class="gear-label">Gear</div>
                <div class="gear-value" id="gear-val">1</div>
            </div>

            {{-- Car name --}}
            <div class="hud-center" id="car-name">
                <div class="team">Oracle Red Bull Racing</div>
                <div class="model">RB<span>20</span></div>
            </div>

            {{-- Camera label --}}
            <div class="cam-label" id="cam-label">
                <div class="cam-label-tag">Viewing</div>
                <div class="cam-label-name" id="cam-label-name">Front Wing</div>
            </div>

            {{-- Progress dots --}}
            <div class="why-progress">
                <div class="why-dot active" id="dot-0"></div>
                <div class="why-dot" id="dot-1"></div>
                <div class="why-dot" id="dot-2"></div>
                <div class="why-dot" id="dot-3"></div>
            </div>

            {{-- Why Choose Us panels --}}
            <div class="why-text">
                <div class="why-item" id="why-1">
                    <div class="why-number">01 — Aerodynamics</div>
                    <h2>Cutting Edge<br>Front Wing</h2>
                    <p>Over 20,000 aerodynamic simulations shape every element for maximum downforce and minimal drag at 300km/h.</p>
                </div>
                <div class="why-item" id="why-2">
                    <div class="why-number">02 — Grip</div>
                    <h2>Precision<br>Wheel Control</h2>
                    <p>Multi-element suspension geometry delivers 3G of lateral force through the fastest corners on any circuit.</p>
                </div>
                <div class="why-item" id="why-3">
                    <div class="why-number">03 — Driver</div>
                    <h2>Command<br>The Cockpit</h2>
                    <p>The halo-protected cockpit puts 150 data channels at the driver's fingertips. Every input, measured and perfected.</p>
                </div>
                <div class="why-item" id="why-4">
                    <div class="why-number">04 — Power</div>
                    <h2>1000HP<br>Rear Exit</h2>
                    <p>The Honda RBPTH002 hybrid unit delivers 1000 combined horsepower through a seamless electric-combustion symphony.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── MARQUEE 2 ── --}}
    <div class="marquee-section">
        <div class="marquee-inner" style="animation-direction: reverse; animation-duration: 25s;">
            @foreach($items as $idx => $item)
                <span class="marquee-item {{ $item !== '·' && $idx % 3 === 0 ? 'red' : '' }}">{{ $item }}</span>
            @endforeach
        </div>
    </div>

    {{-- ── PRODUCTS ── --}}
    <section id="products-preview">
        <p class="section-eyebrow">Shop Now</p>
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            @forelse($products ?? [] as $product)
                <a href="{{ route('products.show', $product) }}" class="product-card" style="text-decoration:none;color:inherit">
                    <div class="product-card-img">
                        @if($product->mainImage)
                            <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                 alt="{{ $product->product_name }}"
                                 loading="lazy">
                        @else
                            <span class="product-card-img-placeholder">No Image</span>
                        @endif
                        <div class="product-tag">F1 Official</div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-name">{{ $product->product_name }}</div>
                        <div class="product-card-price"><span>$</span>{{ number_format($product->base_price, 2) }}</div>
                    </div>
                </a>
            @empty
                {{-- Skeleton placeholders when no products --}}
                @for($i = 0; $i < 4; $i++)
                    <div class="product-card" style="opacity:0.4;pointer-events:none">
                        <div class="product-card-img" style="background:#111"></div>
                        <div class="product-card-body">
                            <div class="product-card-name" style="background:#1a1a1a;height:12px;width:120px;border-radius:1px"></div>
                            <div class="product-card-price" style="background:#1a1a1a;height:20px;width:60px;border-radius:1px"></div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </section>

    {{-- ── FOOTER ── --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">F1<span>·</span>Store</span>
                <div class="footer-tagline">Precision · Power · Performance</div>
            </div>
            <div class="footer-links-group">
                <div class="footer-col">
                    <div class="footer-col-title">Shop</div>
                    <ul>
                        <li><a href="{{ route('products.cars') }}">Race Cars</a></li>
                        <li><a href="{{ route('products.merchandise') }}">Merchandise</a></li>
                        <li><a href="#">Helmets</a></li>
                        <li><a href="#">Accessories</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="footer-col-title">Account</div>
                    <ul>
                        @auth
                            <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endauth
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="footer-col-title">Info</div>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copy">© 2024 Formula One Store — All rights reserved</div>
            <div class="footer-badges">
                <span class="footer-badge">Secure Checkout</span>
                <span class="footer-badge">Official Merch</span>
                <span class="footer-badge">Worldwide Shipping</span>
            </div>
        </div>
    </footer>

    {{-- ── SCRIPTS ── --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    <script type="importmap">
    {
        "imports": {
            "three":         "https://cdn.jsdelivr.net/npm/three@0.161.0/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.161.0/examples/jsm/"
        }
    }
    </script>

    {{-- Non-module: nav + music + hero counters --}}
    <script>
        /* ── Navbar scroll ── */
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
        });

        /* ── Mobile nav ── */
        function toggleMobileNav() {
            document.getElementById('mobile-nav').classList.toggle('open');
            document.getElementById('hamburger').classList.toggle('open');
            document.body.style.overflow = document.getElementById('mobile-nav').classList.contains('open') ? 'hidden' : '';
        }

        /* ── Hero stat counters (fire once on load) ── */
        function animateCounter(el, target, suffix, duration, decimals) {
            let start = null;
            function step(ts) {
                if (!start) start = ts;
                const p   = Math.min((ts - start) / duration, 1);
                const val = p * target;
                el.textContent = decimals
                    ? val.toFixed(1) + suffix
                    : Math.round(val) + suffix;
                if (p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        window.addEventListener('load', () => {
            setTimeout(() => {
                animateCounter(document.getElementById('stat-hp'),  1000, '', 2200, false);
                animateCounter(document.getElementById('stat-rpm'), 15,   'k', 1800, false);
                animateCounter(document.getElementById('stat-g'),   5,    '', 2000, true);
                animateCounter(document.getElementById('hero-speed-val'), 372, '', 2500, false);
            }, 800);
        });

        /* ── Music ── */
        let musicStarted = false;
        function startMusic() {
            const music   = document.getElementById('bg-music');
            const hansImg = document.getElementById('hans-img');
            if (!musicStarted && music) {
                music.volume = 0.35;
                music.play().catch(() => {});
                musicStarted = true;
                hansImg.classList.add('playing');
            }
        }
        function toggleMute() {
            const music   = document.getElementById('bg-music');
            const iconOn  = document.getElementById('icon-unmute');
            const iconOff = document.getElementById('icon-mute');
            const hansImg = document.getElementById('hans-img');
            startMusic();
            music.muted = !music.muted;
            iconOn.style.display  = music.muted ? 'none'  : 'block';
            iconOff.style.display = music.muted ? 'block' : 'none';
            music.muted ? hansImg.classList.remove('playing') : hansImg.classList.add('playing');
            document.getElementById('mute-btn').style.borderColor = music.muted ? 'rgba(225,6,0,0.5)' : '';
        }
        document.addEventListener('click',  startMusic, { once: true });
        document.addEventListener('scroll', startMusic, { once: true });
    </script>

    {{-- Module: Three.js + GSAP scroll ── --}}
    <script type="module">
        import * as THREE from 'three';
        import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

        gsap.registerPlugin(ScrollTrigger);

        /* ══════════════════════════════════════
           SCENE SETUP
        ══════════════════════════════════════ */
        const fsCanvas   = document.getElementById('car-fullscreen-canvas');
        const fsRenderer = new THREE.WebGLRenderer({ canvas: fsCanvas, antialias: true, alpha: true });
        fsRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        fsRenderer.setSize(window.innerWidth, window.innerHeight);
        fsRenderer.outputColorSpace    = THREE.SRGBColorSpace;
        fsRenderer.toneMapping         = THREE.ACESFilmicToneMapping;
        fsRenderer.toneMappingExposure = 1.6;

        const fsScene  = new THREE.Scene();
        const fsCamera = new THREE.PerspectiveCamera(38, window.innerWidth / window.innerHeight, 0.1, 100);
        fsCamera.position.set(0, 1, 6);

        // Fog
        fsScene.fog = new THREE.FogExp2(0x000000, 0.06);

        // Lighting
        fsScene.add(new THREE.AmbientLight(0xffffff, 0.3));

        const fsKey = new THREE.DirectionalLight(0xffffff, 1.8);
        fsKey.position.set(-5, 4, 3);
        fsScene.add(fsKey);

        const fsFill = new THREE.DirectionalLight(0xffffff, 0.3);
        fsFill.position.set(5, 2, 3);
        fsScene.add(fsFill);

        const fsRed1 = new THREE.PointLight(0xe10600, 8, 16);
        fsRed1.position.set(0, -1, -4);
        fsScene.add(fsRed1);

        const fsRed2 = new THREE.PointLight(0xe10600, 4, 10);
        fsRed2.position.set(-5, 1, -2);
        fsScene.add(fsRed2);

        // Rim light
        const fsRim = new THREE.DirectionalLight(0xff2200, 0.6);
        fsRim.position.set(0, -2, -5);
        fsScene.add(fsRim);

        /* ══════════════════════════════════════
           LOAD CAR
        ══════════════════════════════════════ */
        let fsCar = null;
        const loader = new GLTFLoader();

        loader.load(
            '/models/f1-car.glb',
            gltf => {
                fsCar = gltf.scene;

                const box    = new THREE.Box3().setFromObject(fsCar);
                const center = box.getCenter(new THREE.Vector3());
                const size   = box.getSize(new THREE.Vector3());
                const scale  = 4.5 / Math.max(size.x, size.y, size.z);

                fsCar.scale.setScalar(scale);
                fsCar.position.sub(center.multiplyScalar(scale));
                fsCar.rotation.y = Math.PI / 2;

                fsCar.traverse(child => {
                    if (child.isMesh && child.material) {
                        child.material.transparent = false;
                        child.material.opacity      = 1;
                    }
                });

                fsScene.add(fsCar);

                // Show HUD after load
                gsap.to(['#spec-1', '#spec-3', '#spec-4'], {
                    opacity: 1, y: 0,
                    duration: 0.9, stagger: 0.15, ease: 'power3.out'
                });
                gsap.to('#car-name',        { opacity: 1, duration: 1,   delay: 0.5 });
                gsap.to('#cam-label',       { opacity: 1, duration: 1,   delay: 0.8 });
                gsap.to('#hud-speed-wrap',  { opacity: 1, duration: 0.8, delay: 0.6 });
                gsap.to('#hud-rpm-wrap',    { opacity: 1, duration: 0.8, delay: 0.7 });
                gsap.to('#hud-gear',        { opacity: 1, duration: 0.8, delay: 0.9 });

                // Corner brackets
                gsap.to(['.cb-tl', '.cb-tr', '.cb-bl', '.cb-br'], {
                    opacity: 1, duration: 1, stagger: 0.1, delay: 1, ease: 'power2.out'
                });

                // Show first why-item
                gsap.to('#why-1', { opacity: 1, y: 0, duration: 0.8, delay: 0.6 });
            },
            undefined,
            err => console.error('GLB load error:', err)
        );

        /* ══════════════════════════════════════
           RENDER LOOP
        ══════════════════════════════════════ */
        let fsT = 0;
        function animateFS() {
            requestAnimationFrame(animateFS);
            fsT += 0.005;
            if (fsCar) {
                fsCar.position.y = Math.sin(fsT) * 0.03;
                // subtle yaw oscillation
                fsCar.rotation.y = (Math.PI / 2) + Math.sin(fsT * 0.4) * 0.008;
            }
            // Pulse red lights
            fsRed1.intensity = 8  + Math.sin(fsT * 2) * 1.5;
            fsRed2.intensity = 4  + Math.sin(fsT * 2 + 1) * 0.8;

            fsRenderer.render(fsScene, fsCamera);
        }
        animateFS();

        /* ══════════════════════════════════════
           CAMERA STEPS — 4 stops + proper fix
        ══════════════════════════════════════ */
        const camLabels = ['Front Wing', 'Wheel & Sidepod', 'Cockpit & Halo', 'Rear Wing'];

        const steps = [
            {
                cam:  new THREE.Vector3(0,    1,    6),
                look: new THREE.Vector3(0,    0.5,  0),
                text: '#why-1', dot: 0,
                speed: 60,   rpm: 18, gear: 1,
                keyInt: 1.8, redInt: 8
            },
            {
                cam:  new THREE.Vector3(2.5,  1.2,  3),
                look: new THREE.Vector3(1.5,  0.5,  0),
                text: '#why-2', dot: 1,
                speed: 180,  rpm: 52, gear: 4,
                keyInt: 1.4, redInt: 10
            },
            {
                cam:  new THREE.Vector3(0,    2,    1.5),
                look: new THREE.Vector3(0,    0.8,  0),
                text: '#why-3', dot: 2,
                speed: 260,  rpm: 74, gear: 6,
                keyInt: 1.0, redInt: 12
            },
            {
                cam:  new THREE.Vector3(-3,   1.2,  -3),
                look: new THREE.Vector3(-1,   0.5,  0),
                text: '#why-4', dot: 3,
                speed: 340,  rpm: 95, gear: 8,
                keyInt: 0.8, redInt: 15
            }
        ];

        // Speed counter animation
        let displayedSpeed = 0;
        let targetSpeed    = steps[0].speed;

        function tickSpeed() {
            const diff = targetSpeed - displayedSpeed;
            displayedSpeed += diff * 0.06;
            const el = document.getElementById('hud-speed-num');
            if (el) el.textContent = Math.round(displayedSpeed);
        }

        // Gear flash
        let lastGear = 1;
        function setGear(g) {
            if (g === lastGear) return;
            lastGear = g;
            const el = document.getElementById('gear-val');
            if (!el) return;
            el.textContent = g;
            el.classList.add('shift');
            setTimeout(() => el.classList.remove('shift'), 300);
        }

        let activeIndex = -1;

        function showStep(i) {
            const cur = steps[i];

            // Fade out all why-items
            steps.forEach(s => {
                gsap.to(s.text, { opacity: 0, y: 40, duration: 0.35, ease: 'power2.in' });
            });
            // Fade in current
            gsap.to(cur.text, { opacity: 1, y: 0, duration: 0.7, delay: 0.3, ease: 'power3.out' });

            // Dots
            steps.forEach((s, idx) => {
                document.getElementById('dot-' + idx)?.classList.toggle('active', idx === i);
            });

            // Camera label
            const labelEl = document.getElementById('cam-label-name');
            if (labelEl) {
                gsap.to('#cam-label', { opacity: 0, duration: 0.2, onComplete: () => {
                    labelEl.textContent = camLabels[i];
                    gsap.to('#cam-label', { opacity: 1, duration: 0.4 });
                }});
            }

            // Lighting
            fsKey.intensity  = cur.keyInt;
            fsRed1.intensity = cur.redInt;

            // Speed & gear target
            targetSpeed = cur.speed;
            setGear(cur.gear);

            // RPM bar
            const rpmFill = document.getElementById('rpm-fill');
            if (rpmFill) rpmFill.style.width = cur.rpm + '%';
        }

        ScrollTrigger.create({
            trigger: '#scroll-spacer',
            start:   'top top',
            end:     'bottom bottom',
            scrub:   2,
            onUpdate: self => {
                // Map 0–1 across ALL 4 steps (0,1,2,3)
                // progress 0.00–0.33 → i=0,  0.33–0.66 → i=1,  0.66–1.00 → i=2→3
                const total = self.progress * (steps.length - 1);
                const i     = Math.min(Math.floor(total), steps.length - 2);
                const raw   = total - i;
                const t     = gsap.parseEase('power2.inOut')(raw);

                const cur  = steps[i];
                const next = steps[i + 1];

                // Camera interpolation
                const pos  = new THREE.Vector3().lerpVectors(cur.cam,  next.cam,  t);
                const look = new THREE.Vector3().lerpVectors(cur.look, next.look, t);
                fsCamera.position.copy(pos);
                fsCamera.lookAt(look);

                // Interpolate speed display target
                targetSpeed = cur.speed + (next.speed - cur.speed) * t;

                // Step changed?
                if (i !== activeIndex) {
                    activeIndex = i;
                    showStep(i);
                }

                // Always update speed counter
                tickSpeed();
            }
        });

        // FOV zoom
        ScrollTrigger.create({
            trigger: '#scroll-spacer',
            start:   'top top',
            end:     'bottom bottom',
            scrub:   2,
            onUpdate: self => {
                fsCamera.fov = 38 - self.progress * 8;
                fsCamera.updateProjectionMatrix();
            }
        });

        // Hero fade
        gsap.to('#hero', {
            opacity: 0,
            scrollTrigger: {
                trigger: '#scroll-spacer',
                start:   'top 80%',
                end:     'top 40%',
                scrub:   true
            }
        });

        // Products reveal
        gsap.to('.product-card', {
            opacity: 1, y: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '#products-preview',
                start:   'top 80%'
            }
        });

        // Resize
        window.addEventListener('resize', () => {
            fsCamera.aspect = window.innerWidth / window.innerHeight;
            fsCamera.updateProjectionMatrix();
            fsRenderer.setSize(window.innerWidth, window.innerHeight);
        });

    </script>

    <!-- AUDIO -->
    <audio id="bg-music" loop>
        <source src="{{ asset('music/hans-zimmer.mp3') }}" type="audio/mp3">
    </audio>

    <!-- MUSIC CARD -->
    <div id="music-card">
        <div id="music-card-inner">
            <img id="hans-img" src="{{ asset('image/hans-zimmer.png') }}" alt="Hans Zimmer">
            <div id="music-info">
                <span id="music-label">Now Playing</span>
                <span id="music-name">Hans Zimmer</span>
                <span id="music-track">Two Steps From Hell</span>
            </div>
        </div>
        <button id="mute-btn" onclick="toggleMute()" title="Toggle Audio">
            <svg id="icon-unmute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
                <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
            </svg>
            <svg id="icon-mute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <line x1="23" y1="9" x2="17" y2="15"/>
                <line x1="17" y1="9" x2="23" y2="15"/>
            </svg>
        </button>
    </div>

</body>
</html>