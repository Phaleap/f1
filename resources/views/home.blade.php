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
           RACE TICKER
        ───────────────────────────────────────── */
        .ticker-wrap {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 32px;                          /* was 28px */
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
            font-size: 0.72rem;                    /* was 0.6rem */
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,1);             /* was 0.9 → full white */
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .ticker-item::before {
            content: '●';
            font-size: 0.45rem;
            color: rgba(255,255,255,0.7);          /* was 0.5 */
        }
        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Push content below ticker */
        body { padding-top: 32px; }
        nav  { top: 32px; }

        /* ─────────────────────────────────────────
           NAVBAR
        ───────────────────────────────────────── */
        nav {
            position: fixed;
            left: 0; right: 0;
            z-index: 1000;
            padding: 22px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.4s, padding 0.4s;
        }
        nav.scrolled {
            background: rgba(5,5,5,0.95);
            backdrop-filter: blur(20px);
            padding: 16px 60px;
            border-bottom: 1px solid rgba(225,6,0,0.2);  /* was 0.08 → more visible */
        }
        .nav-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.9rem;                     /* was 1.6rem */
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
            color: rgba(240,237,232,0.7);          /* was 0.45 → much more readable */
            text-decoration: none;
            font-size: 0.8rem;                     /* was 0.72rem */
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
            width: 24px; height: 2px;              /* was 22px/1.5px */
            background: var(--off-white);
            transition: all 0.3s;
        }
        .nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; }
        .nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

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
            font-size: clamp(2.8rem, 8vw, 4.5rem); /* was clamp(2.5rem…4rem) */
            letter-spacing: 8px;
            color: rgba(240,237,232,0.65);          /* was 0.4 */
            text-decoration: none;
            transition: color 0.3s;
        }
        .nav-mobile a:hover { color: var(--off-white); }
        .nav-mobile a span { color: var(--red); }

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
            filter: brightness(0.7) contrast(1.15) saturate(1.2); /* was 0.55 → brighter */
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(5,5,5,0.45) 0%, transparent 50%, rgba(5,5,5,0.25) 100%),
                radial-gradient(ellipse at 50% 60%, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.6) 80%, rgba(0,0,0,0.92) 100%);
            z-index: -1;
        }

        .hero-red-bar {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 5px;                            /* was 4px */
            background: linear-gradient(to bottom, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            padding: 0 20px;
        }

        .hero-eyebrow {
            font-size: 0.8rem;                     /* was 0.65rem */
            letter-spacing: 10px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 12px;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.2s forwards;
        }

        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(5.5rem, 13vw, 12rem); /* was clamp(4.5rem,11vw,10rem) */
            letter-spacing: 10px;
            line-height: 0.92;
            opacity: 0;
            animation: fadeUp 0.9s ease 0.4s forwards;
        }
        .hero-title .line-2 {
            display: block;
            color: var(--red);
            text-shadow: 0 0 80px rgba(225,6,0,0.7); /* was 0.5 */
        }
        .hero-title .line-1 {
            display: block;
            color: #ffffff;                        /* was semi-transparent stroke only → now solid white */
            -webkit-text-stroke: 0px;
        }

        .hero-speed {
            margin-top: 18px;
            font-size: 0.85rem;                    /* was 0.7rem */
            letter-spacing: 6px;
            color: rgba(255,255,255,0.5);           /* was 0.25 */
            text-transform: uppercase;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.6s forwards;
        }
        .hero-speed strong {
            color: var(--red);
            font-family: 'Bebas Neue', cursive;
            font-size: 1.2rem;                     /* was 1rem */
            letter-spacing: 2px;
        }

        .hero-cta {
            margin-top: 40px;
            display: flex;
            gap: 16px;
            justify-content: center;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.8s forwards;
        }

        .btn-primary {
            padding: 15px 38px;                    /* was 13px 32px */
            background: var(--red);
            color: white;
            text-decoration: none;
            font-size: 0.85rem;                    /* was 0.72rem */
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
        .btn-primary:hover { background: var(--red-glow); box-shadow: 0 0 40px rgba(225,6,0,0.5); transform: translateY(-2px); }
        .btn-primary:hover::after { opacity: 1; }

        .btn-secondary {
            padding: 15px 38px;                    /* was 13px 32px */
            border: 1px solid rgba(255,255,255,0.3); /* was 0.15 */
            color: rgba(255,255,255,0.9);           /* was 0.7 */
            text-decoration: none;
            font-size: 0.85rem;                    /* was 0.72rem */
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
            font-size: 3rem;                       /* was 2.2rem */
            letter-spacing: 3px;
            line-height: 1;
            color: #ffffff;                        /* was var(--off-white) */
        }
        .hero-stat-value span { color: var(--red); }
        .hero-stat-label {
            font-size: 0.65rem;                    /* was 0.55rem */
            letter-spacing: 5px;
            color: rgba(255,255,255,0.5);           /* was 0.25 */
            text-transform: uppercase;
            margin-top: 6px;
        }
        .hero-stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(225,6,0,0.4);         /* was 0.2 */
            align-self: center;
        }

        .scroll-hint {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 0.65rem;                    /* was 0.55rem */
            letter-spacing: 6px;
            color: rgba(255,255,255,0.45);          /* was 0.2 */
            z-index: 2;
        }
        .scroll-line {
            width: 1px; height: 40px;              /* was 36px */
            background: linear-gradient(to bottom, var(--red), transparent);
            margin: 0 auto 8px;
            animation: pulse 2s infinite;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%,100% { opacity: 0.3; }
            50%      { opacity: 1; }
        }

        /* ─────────────────────────────────────────
           MARQUEE STRIP
        ───────────────────────────────────────── */
        .marquee-section {
            height: 52px;                          /* was 48px */
            background: var(--dark-2);
            border-top: 1px solid rgba(225,6,0,0.2);  /* was 0.12 */
            border-bottom: 1px solid rgba(225,6,0,0.2);
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
            font-size: 1rem;                       /* was 0.85rem */
            letter-spacing: 6px;
            color: rgba(240,237,232,0.18);          /* was 0.08 */
            padding: 0 30px;
            text-transform: uppercase;
        }
        .marquee-item.red {
            color: rgba(225,6,0,0.65);             /* was 0.4 */
        }
        @keyframes marquee-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ─────────────────────────────────────────
           3D SCROLL / STICKY CAR SECTION
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
                rgba(0,0,0,0.012) 2px,
                rgba(0,0,0,0.012) 4px
            );
            pointer-events: none;
            z-index: 6;
        }

        /* ── HUD wrapper ── */
        .hud {
            position: absolute;
            inset: 0;
            z-index: 10;
            pointer-events: none;
            padding: 90px 70px 70px;               /* was 80px 60px 60px */
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
            font-size: 0.7rem;                     /* was 0.55rem */
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .hud-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 3.5rem;                     /* was 2.8rem */
            letter-spacing: 3px;
            line-height: 1;
            color: #ffffff;                        /* was var(--off-white) */
            text-shadow: 0 2px 20px rgba(0,0,0,0.8);
        }
        .hud-unit {
            font-size: 0.9rem;                     /* was 0.75rem */
            color: rgba(240,237,232,0.45);          /* was 0.25 */
            letter-spacing: 2px;
            margin-left: 4px;
        }

        /* ── Speed counter (top-right) ── */
        #hud-speed-wrap {
            position: absolute;
            top: 90px;
            right: 70px;
            z-index: 10;
            text-align: right;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s;
        }
        .hud-speed-label {
            font-size: 0.7rem;                     /* was 0.55rem */
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .hud-speed-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 9rem;                       /* was 4.5rem → dramatically bigger */
            letter-spacing: 2px;
            line-height: 1;
            color: #ffffff;
            font-variant-numeric: tabular-nums;
            text-shadow: 0 0 60px rgba(225,6,0,0.4), 0 4px 30px rgba(0,0,0,0.9);
        }
        .hud-speed-unit {
            font-size: 1rem;                       /* was 0.7rem */
            color: rgba(240,237,232,0.55);          /* was 0.2 */
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* ── RPM bar (bottom-right) ── */
        #hud-rpm-wrap {
            position: absolute;
            bottom: 70px;
            right: 70px;
            z-index: 10;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s;
            text-align: right;
        }
        .hud-rpm-label {
            font-size: 0.65rem;                    /* was 0.5rem */
            letter-spacing: 6px;
            color: rgba(240,237,232,0.5);           /* was 0.25 */
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .rpm-bar-track {
            width: 200px;                          /* was 160px */
            height: 4px;                           /* was 3px */
            background: rgba(255,255,255,0.1);      /* was 0.05 */
            margin-left: auto;
            position: relative;
            overflow: visible;
        }
        .rpm-bar-fill {
            height: 100%;
            background: linear-gradient(to right, var(--red), #ff4400);
            box-shadow: 0 0 16px rgba(225,6,0,1);  /* was 0.8 → max glow */
            width: 0%;
            transition: width 0.1s linear;
        }
        .rpm-ticks {
            display: flex;
            justify-content: space-between;
            margin-top: 6px;
        }
        .rpm-tick {
            font-size: 0.55rem;                    /* was 0.45rem */
            letter-spacing: 1px;
            color: rgba(240,237,232,0.35);          /* was 0.15 */
        }
        .rpm-tick.active { color: var(--red); }

        /* ── Gear indicator (bottom-left) ── */
        #hud-gear {
            position: absolute;
            bottom: 70px;
            left: 70px;
            z-index: 10;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s;
        }
        .gear-label {
            font-size: 0.65rem;                    /* was 0.5rem */
            letter-spacing: 6px;
            color: rgba(240,237,232,0.55);          /* was 0.2 */
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .gear-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 8rem;                       /* was 5rem */
            letter-spacing: 2px;
            line-height: 1;
            color: rgba(240,237,232,0.35);          /* was 0.08 → actually visible */
            font-variant-numeric: tabular-nums;
            transition: color 0.15s, text-shadow 0.15s;
        }
        .gear-value.shift {
            color: var(--red);
            text-shadow: 0 0 40px rgba(225,6,0,0.7);
        }

        /* ── Car name / model (bottom-center) ── */
        .hud-center {
            position: absolute;
            bottom: 60px;
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
            font-size: 0.8rem;                     /* was 0.6rem */
            letter-spacing: 8px;
            color: rgba(240,237,232,0.7);           /* was 0.3 */
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .hud-center .model {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3.5rem, 6vw, 6.5rem); /* was clamp(2.5rem,5vw,4.5rem) */
            letter-spacing: 8px;
            color: #ffffff;
            text-shadow: 0 2px 30px rgba(0,0,0,0.8);
        }
        .hud-center .model span {
            color: var(--red);
            text-shadow: 0 0 40px rgba(225,6,0,0.7);
        }

        /* ── Corner brackets ── */
        .corner-bracket {
            position: absolute;
            width: 24px; height: 24px;             /* was 20px */
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
        .corner-bracket::before { width: 100%; height: 1.5px; }  /* was 1px */
        .corner-bracket::after  { width: 1.5px; height: 100%; }  /* was 1px */
        .cb-tl { top: 50px; left: 50px; }
        .cb-tr { top: 50px; right: 50px; transform: scaleX(-1); }
        .cb-bl { bottom: 50px; left: 50px; transform: scaleY(-1); }
        .cb-br { bottom: 50px; right: 50px; transform: scale(-1); }

        /* Red glow floor */
        .hud-glow {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 70%; height: 280px;             /* was 250px */
            background: radial-gradient(ellipse at bottom, rgba(225,6,0,0.25) 0%, transparent 70%); /* was 0.18 */
            pointer-events: none;
            z-index: 5;
        }

        /* ── Why items ── */
        .why-text {
            position: absolute;
            inset: 0;
            z-index: 20;
            pointer-events: none;
        }
        .why-item {
            position: absolute;
            bottom: 140px;
            left: 70px;
            max-width: 440px;
            opacity: 0;
            transform: translateY(40px);
            pointer-events: none;
        }
        .why-item .why-number {
            font-size: 0.72rem;                    /* was 0.6rem */
            letter-spacing: 7px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .why-item .why-number::after {
            content: '';
            display: block;
            width: 28px; height: 1px;
            background: var(--red);
            opacity: 0.6;
        }
        .why-item h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(2.8rem, 5.5vw, 4.5rem); /* was clamp(2.2rem…3.5rem) */
            letter-spacing: 4px;
            line-height: 1;
            margin-bottom: 16px;
            color: #ffffff;
            text-shadow: 0 2px 24px rgba(0,0,0,0.9);
        }
        .why-item p {
            font-size: 1rem;                       /* was 0.88rem */
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.65);          /* was 0.4 */
            line-height: 1.8;
            max-width: 340px;
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
            gap: 16px;
            pointer-events: none;
        }
        .why-dot {
            width: 4px; height: 4px;               /* was 3px */
            border-radius: 50%;
            background: rgba(240,237,232,0.25);     /* was 0.15 */
            transition: all 0.4s;
        }
        .why-dot.active {
            background: var(--red);
            transform: scale(2);
            box-shadow: 0 0 10px rgba(225,6,0,0.7);
        }

        /* ── Camera label (top-left) ── */
        .cam-label {
            position: absolute;
            top: 90px;
            left: 70px;
            z-index: 20;
            text-align: left;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .cam-label-tag {
            font-size: 0.65rem;                    /* was 0.5rem */
            letter-spacing: 6px;
            color: rgba(225,6,0,1);                /* was 0.6 → full red */
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .cam-label-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;                       /* was 1.3rem */
            letter-spacing: 5px;
            color: rgba(240,237,232,0.9);           /* was 0.5 */
        }

        /* ─────────────────────────────────────────
           SECTION EYEBROW + TITLE (shared)
        ───────────────────────────────────────── */
        .section-eyebrow {
            font-size: 0.72rem;                    /* was 0.6rem */
            letter-spacing: 8px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-eyebrow::before {
            content: '';
            display: block;
            width: 24px; height: 1px;              /* was 20px */
            background: var(--red);
        }
        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3.5rem, 7vw, 6rem);   /* was clamp(3rem,6vw,5rem) */
            letter-spacing: 3px;
            margin-bottom: 60px;
            line-height: 1;
            color: #ffffff;                        /* ensure full white */
        }

        /* ─────────────────────────────────────────
           PRODUCTS
        ───────────────────────────────────────── */
        #products-preview {
            padding: 130px 70px;                   /* was 120px 60px */
            background: var(--dark);
            position: relative;
        }
        #products-preview::before {
            content: '';
            position: absolute;
            top: 0; left: 70px; right: 70px;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(225,6,0,0.35), transparent); /* was 0.2 */
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* was 280px */
            gap: 3px;                              /* was 2px */
            max-width: 1400px;
        }
        .product-card {
            background: #0f0f0f;                   /* was #0c0c0c → slightly lighter */
            overflow: hidden;
            opacity: 0;
            transform: translateY(40px);
            cursor: pointer;
            position: relative;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
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
        .product-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 30px rgba(225,6,0,0.08);
        }

        .product-card-img {
            width: 100%; height: 240px;            /* was 220px */
            background: #161616;
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
            filter: grayscale(10%);               /* was 20% → less desaturated */
        }
        .product-card:hover .product-card-img img {
            transform: scale(1.08);
            filter: grayscale(0%) brightness(1.08);
        }
        .product-card-img-placeholder {
            font-size: 0.7rem;
            letter-spacing: 4px;
            color: rgba(255,255,255,0.1);          /* was 0.06 */
            text-transform: uppercase;
        }

        .product-tag {
            position: absolute;
            bottom: 12px; left: 12px;
            font-size: 0.58rem;                    /* was 0.5rem */
            letter-spacing: 4px;
            text-transform: uppercase;
            padding: 5px 10px;
            background: rgba(225,6,0,0.2);         /* was 0.15 */
            border: 1px solid rgba(225,6,0,0.4);   /* was 0.25 */
            color: var(--red);
            z-index: 2;
        }

        .product-card-body {
            padding: 20px 24px;                    /* was 18px 22px */
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.06); /* was 0.03 */
            position: relative;
        }
        .product-card-name {
            font-size: 0.9rem;                     /* was 0.8rem */
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(240,237,232,0.95);          /* was 0.85 */
        }
        .product-card-price {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;                       /* was 1.6rem */
            color: #ffffff;
            letter-spacing: 1px;
        }
        .product-card-price span {
            font-size: 0.9rem;                     /* was 0.75rem */
            color: var(--red);
            letter-spacing: 1px;
            margin-right: 2px;
        }

        /* ─────────────────────────────────────────
           FOOTER
        ───────────────────────────────────────── */
        footer {
            padding: 60px 70px;                    /* was 50px 60px */
            border-top: 1px solid rgba(225,6,0,0.15); /* was 0.08 */
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
        .footer-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2rem;                     /* was 1.8rem */
            letter-spacing: 6px;
            color: rgba(240,237,232,0.35);          /* was 0.18 */
            display: block;
            margin-bottom: 12px;
        }
        .footer-logo span { color: rgba(225,6,0,0.7); } /* was 0.5 */
        .footer-tagline {
            font-size: 0.68rem;                    /* was 0.6rem */
            letter-spacing: 5px;
            color: rgba(240,237,232,0.2);           /* was 0.08 */
            text-transform: uppercase;
        }
        .footer-links-group { display: flex; gap: 60px; }
        .footer-col-title {
            font-size: 0.65rem;                    /* was 0.55rem */
            letter-spacing: 6px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 18px;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .footer-col ul a {
            font-size: 0.82rem;                    /* was 0.72rem */
            letter-spacing: 2px;
            color: rgba(240,237,232,0.4);           /* was 0.2 */
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.3s;
        }
        .footer-col ul a:hover { color: rgba(240,237,232,0.9); } /* was 0.7 */
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.06); /* was 0.03 */
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-copy {
            font-size: 0.65rem;                    /* was 0.58rem */
            letter-spacing: 3px;
            color: rgba(240,237,232,0.2);           /* was 0.08 */
            text-transform: uppercase;
        }
        .footer-badges { display: flex; gap: 16px; align-items: center; }
        .footer-badge {
            font-size: 0.58rem;                    /* was 0.5rem */
            letter-spacing: 3px;
            color: rgba(240,237,232,0.15);          /* was 0.06 */
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.08); /* was 0.04 */
            padding: 5px 10px;
        }

        /* ─────────────────────────────────────────
           MUSIC CARD
        ───────────────────────────────────────── */
        #music-card {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(10,10,10,0.88);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(225,6,0,0.25);  /* was 0.15 */
            padding: 14px 18px;
            border-radius: 2px;
            box-shadow: 0 0 40px rgba(0,0,0,0.6), 0 0 20px rgba(225,6,0,0.06);
            animation: fadeUp 1s ease 1.5s both;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        #music-card:hover {
            border-color: rgba(225,6,0,0.5);
            box-shadow: 0 0 40px rgba(0,0,0,0.6), 0 0 30px rgba(225,6,0,0.15);
        }
        #hans-img {
            width: 44px; height: 44px;             /* was 40px */
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid rgba(225,6,0,0.5); /* was 1px 0.35 */
            filter: grayscale(10%);
        }
        #music-label { font-size: 0.58rem; letter-spacing: 5px; color: var(--red); text-transform: uppercase; }
        #music-name  { font-family: 'Bebas Neue', cursive; font-size: 1.2rem; letter-spacing: 3px; line-height: 1; } /* was 1rem */
        #music-track { font-size: 0.62rem; letter-spacing: 2px; color: rgba(240,237,232,0.45); text-transform: uppercase; } /* was 0.28 */
        #mute-btn {
            background: none;
            border: 1px solid rgba(255,255,255,0.14);
            color: rgba(240,237,232,0.6);           /* was 0.4 */
            cursor: pointer;
            padding: 9px;
            border-radius: 1px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s;
            flex-shrink: 0;
        }
        #mute-btn:hover { border-color: var(--red); color: var(--red); }
        #mute-btn svg { width: 16px; height: 16px; } /* was 14px */

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
            background: radial-gradient(circle, transparent 60%, rgba(0,0,0,0.4) 100%); /* softer than before */
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

            .hero-stats { gap: 28px; bottom: 60px; }
            .hero-stat-value { font-size: 2rem; }  /* was 1.6rem */

            #products-preview { padding: 80px 24px; }
            .products-grid { grid-template-columns: 1fr; }

            .hud { padding: 60px 24px 40px; }
            .why-item { left: 24px; bottom: 110px; max-width: 290px; }
            .hud-speed-value { font-size: 5rem; }  /* was 3rem */
            .gear-value { font-size: 5rem; }
            .cam-label-name { font-size: 1.4rem; }

            footer { padding: 40px 24px; }
            .footer-inner { flex-direction: column; }
            .footer-links-group { flex-wrap: wrap; gap: 30px; }

            .ticker-item { padding: 0 20px; }
            #music-card { bottom: 16px; right: 16px; padding: 10px 12px; }
        }
    </style>
</head>
<body>
    @include('home._ticker')
    @include('home._navbar')
    @include('home._hero')
    @include('home._marquee', ['direction' => 'normal', 'duration' => '20s'])
    @include('home._about-store')
    @include('home._marquee', ['direction' => 'normal', 'duration' => '20s'])
    @include('home._sticky-car')
    @include('home._marquee', ['direction' => 'reverse', 'duration' => '25s'])
    @include('home._featured-cars')
    @include('home._products-preview')
    @include('home._reviews')
    @include('home._stats')
    @include('home._awards')
    @include('home._footer')

    <audio id="bg-music" loop>
        <source src="{{ asset('music/hans-zimmer.mp3') }}" type="audio/mp3">
    </audio>
    @include('home._music-card')

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    @include('home._scripts-nav')
    @include('home._scripts-three')
</body>
</html>j