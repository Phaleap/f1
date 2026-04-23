<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — F1 Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --red:        #E10600;
        --dark:       #080808;
        --off-white:  #f0ece4;
        --gold:       #c9a84c;
        --gold-lt:    #e8c96a;
        --gold-line:  rgba(201,168,76,0.35);
        --gold-dim:   rgba(201,168,76,0.08);
        --muted:      rgba(255,255,255,0.38);
        --border:     rgba(255,255,255,0.06);
    }

    body {
        background: var(--dark);
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 16px;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; position: relative;
    }

    /* ══════════════════════════════════
       TELEMETRY BG
    ══════════════════════════════════ */
    .telem-bg { position: fixed; inset: 0; z-index: 0; overflow: hidden; }
    .telem-bg__grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
        background-size: 60px 60px;
        animation: grid-drift 20s linear infinite;
    }
    @keyframes grid-drift { 0% { transform: translateY(0); } 100% { transform: translateY(60px); } }
    .telem-bg__scan {
        position: absolute; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(225,6,0,0.4) 20%, rgba(225,6,0,0.85) 50%, rgba(225,6,0,0.4) 80%, transparent);
        animation: scan 6s ease-in-out infinite;
        box-shadow: 0 0 14px rgba(225,6,0,0.35);
    }
    @keyframes scan { 0% { top: -2px; opacity: 0; } 5% { opacity: 1; } 95% { opacity: 1; } 100% { top: 100%; opacity: 0; } }
    .telem-bg__noise {
        position: absolute; inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        opacity: 0.5; pointer-events: none;
    }
    .telem-bg__data { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .telem-blip {
        position: absolute; font-family: 'Bebas Neue', cursive;
        font-size: 0.7rem; letter-spacing: 3px;
        color: rgba(225,6,0,0.13); white-space: nowrap;
        animation: blip-fade 8s ease-in-out infinite;
    }
    @keyframes blip-fade { 0%,100% { opacity: 0; } 20%,80% { opacity: 1; } }
    .telem-bg__vignette {
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 85% 85% at 50% 50%, transparent 10%, rgba(0,0,0,0.92) 100%);
    }

    /* ══════════════════════════════════
       BACK LINK
    ══════════════════════════════════ */
    .auth-back {
        position: fixed; top: 28px; left: 32px; z-index: 20;
        display: flex; align-items: center; gap: 10px;
        font-size: 0.78rem; letter-spacing: 4px; text-transform: uppercase;
        color: var(--muted); text-decoration: none;
        transition: color 0.2s, gap 0.2s;
    }
    .auth-back svg { width: 15px; height: 15px; stroke: currentColor; stroke-width: 2; fill: none; transition: transform 0.2s; }
    .auth-back:hover { color: var(--off-white); gap: 15px; }
    .auth-back:hover svg { transform: translateX(-3px); }

    /* ══════════════════════════════════
       SPLIT WRAP
    ══════════════════════════════════ */
    .auth-wrap {
        position: relative; z-index: 10;
        width: 95%; max-width: 940px;
        display: grid; grid-template-columns: 1fr 1fr;
        min-height: 620px;
        animation: card-in 0.7s cubic-bezier(0.16,1,0.3,1) forwards;
        opacity: 0; transform: translateY(30px);
        box-shadow: 0 0 0 1px var(--gold-line), 0 60px 140px rgba(0,0,0,0.85);
    }
    @keyframes card-in { to { opacity: 1; transform: translateY(0); } }

    /* ══════════════════════════════════
       LEFT PANEL
    ══════════════════════════════════ */
    .auth-panel-left {
        background: linear-gradient(155deg, #111009 0%, #0c0908 50%, #0e0707 100%);
        border-right: 1px solid var(--gold-line);
        padding: 56px 48px;
        display: flex; flex-direction: column; justify-content: space-between;
        position: relative; overflow: hidden;
    }
    /* Gradient top bar */
    .auth-panel-left::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--red), var(--gold));
    }
    /* Decorative ring */
    .auth-panel-left::after {
        content: '';
        position: absolute; bottom: -80px; right: -80px;
        width: 280px; height: 280px; border-radius: 50%;
        border: 1px solid rgba(201,168,76,0.07);
        box-shadow: 0 0 0 40px rgba(201,168,76,0.03), 0 0 0 80px rgba(201,168,76,0.015);
    }

    .panel-badge {
        display: flex; align-items: center; gap: 12px;
    }
    .panel-badge__line { width: 32px; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }
    .panel-badge__text { font-size: 0.72rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); }

    .panel-logo {
        text-decoration: none; display: flex; align-items: center; gap: 10px; margin-top: 24px;
    }
    .panel-logo span {
        font-family: 'Bebas Neue', cursive; font-size: 1.6rem; letter-spacing: 6px; color: var(--off-white);
    }
    .panel-logo em { width: 6px; height: 6px; border-radius: 50%; background: var(--red); flex-shrink: 0; font-style: normal; }

    .panel-headline { margin-top: auto; padding-top: 40px; }
    .panel-headline h2 {
        font-family: 'Bebas Neue', cursive;
        font-size: clamp(3rem, 4vw, 3.8rem);
        letter-spacing: 4px; line-height: 0.92;
        color: var(--off-white);
    }
    .panel-headline h2 em { display: block; color: var(--red); font-style: normal; }
    .panel-headline p {
        margin-top: 18px; font-size: 1rem; letter-spacing: 0.3px; line-height: 1.7;
        color: rgba(255,255,255,0.32); max-width: 260px;
    }

    .panel-stats {
        display: flex; gap: 32px; margin-top: 40px;
        padding-top: 24px; border-top: 1px solid rgba(201,168,76,0.13);
    }
    .stat-num { font-family: 'Bebas Neue', cursive; font-size: 1.9rem; letter-spacing: 2px; color: var(--gold); }
    .stat-lbl { font-size: 0.72rem; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.28); display: block; margin-top: 2px; }

    /* ══════════════════════════════════
       RIGHT PANEL
    ══════════════════════════════════ */
    .auth-panel-right {
        background: #080808;
        padding: 56px 52px;
        display: flex; flex-direction: column; justify-content: center;
        position: relative;
    }
    .auth-panel-right::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--gold), var(--red));
    }
    /* bottom-right corner accent */
    .auth-panel-right::after {
        content: '';
        position: absolute; bottom: 0; right: 0;
        width: 52px; height: 52px;
        border-bottom: 1px solid var(--gold-line);
        border-right: 1px solid var(--gold-line);
    }
    .corner-tl {
        position: absolute; top: 3px; left: 0;
        width: 40px; height: 40px;
        border-top: 1px solid var(--gold-line);
        border-left: 1px solid var(--gold-line);
    }

    /* Form heading */
    .form-heading { text-align: center; margin-bottom: 36px; }
    .form-heading__eyebrow {
        display: flex; align-items: center; gap: 12px; margin-bottom: 12px;
    }
    .form-heading__eyebrow::before,
    .form-heading__eyebrow::after {
        content: ''; flex: 1; height: 1px;
    }
    .form-heading__eyebrow::before { background: linear-gradient(270deg, var(--gold-line), transparent); }
    .form-heading__eyebrow::after  { background: linear-gradient(90deg, var(--gold-line), transparent); }
    .form-heading__eyebrow span { font-size: 0.72rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); white-space: nowrap; }
    .form-heading h1 {
        font-family: 'Bebas Neue', cursive;
        font-size: clamp(2.2rem, 3vw, 2.8rem); letter-spacing: 6px;
        color: var(--off-white); line-height: 1;
    }
    .form-heading p { font-size: 1rem; color: rgba(255,255,255,0.3); margin-top: 8px; letter-spacing: 0.5px; }

    /* Error box */
    .auth-errors {
        background: rgba(225,6,0,0.05); border: 1px solid rgba(225,6,0,0.2);
        border-left: 3px solid var(--red); padding: 14px 18px; margin-bottom: 24px;
    }
    .auth-errors p { font-size: 0.9rem; color: rgba(255,255,255,0.6); line-height: 1.6; }

    /* ══════════════════════════════════
       INPUTS — clipped polygon style
    ══════════════════════════════════ */
    .auth-field { position: relative; margin-bottom: 22px; }
    .auth-field label {
        display: block; font-size: 0.72rem; letter-spacing: 4px;
        text-transform: uppercase; color: var(--muted);
        margin-bottom: 9px; transition: color 0.25s;
    }
    .auth-field:focus-within label { color: var(--gold-lt); }

    .input-box {
        position: relative;
        background: rgba(255,255,255,0.025);
        border: 1px solid rgba(255,255,255,0.07);
        clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        transition: background 0.3s, border-color 0.3s, transform 0.3s;
    }
    .input-box::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0;
        width: 3px; background: var(--gold-line); transition: background 0.3s, width 0.3s;
    }
    .auth-field:focus-within .input-box {
        background: rgba(201,168,76,0.05);
        border-color: rgba(201,168,76,0.28);
        transform: translateX(5px);
    }
    .auth-field:focus-within .input-box::before { background: var(--red); width: 4px; }

    .auth-field input {
        width: 100%; background: transparent; border: none; outline: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.05rem; letter-spacing: 1.5px;
        color: var(--off-white); padding: 15px 18px;
    }
    .auth-field input::placeholder { color: rgba(255,255,255,0.08); }
    .auth-field-error {
        font-size: 0.78rem; letter-spacing: 2px; text-transform: uppercase;
        color: var(--red); display: block; margin-top: 7px;
    }

    /* Meta row */
    .auth-meta {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 0 28px;
    }
    .auth-remember { display: flex; align-items: center; gap: 10px; cursor: pointer; }
    .auth-remember input[type="checkbox"] { width: 14px; height: 14px; accent-color: var(--gold); cursor: pointer; }
    .auth-remember span { font-size: 0.78rem; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
    .auth-forgot {
        font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase;
        color: rgba(201,168,76,0.5); text-decoration: none; transition: color 0.2s;
    }
    .auth-forgot:hover { color: var(--gold-lt); }

    /* CTA Button */
    .btn-auth {
        width: 100%; padding: 18px 32px;
        background: transparent; border: 1px solid var(--gold-line);
        color: var(--gold); font-family: 'Bebas Neue', cursive;
        font-size: 1.1rem; letter-spacing: 7px; text-transform: uppercase;
        cursor: pointer; position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; gap: 14px;
        transition: color 0.3s, border-color 0.3s;
        clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 0 100%);
    }
    .btn-auth::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, var(--red), #b30400);
        transform: translateX(-101%);
        transition: transform 0.4s cubic-bezier(0.16,1,0.3,1); z-index: 0;
    }
    .btn-auth:hover::before { transform: translateX(0); }
    .btn-auth:hover { color: #fff; border-color: var(--red); }
    .btn-auth:active { transform: scale(0.99); }
    .btn-auth span, .btn-auth svg { position: relative; z-index: 1; }
    .btn-auth svg { width: 16px; height: 16px; stroke: currentColor; stroke-width: 2; fill: none; transition: transform 0.2s; }
    .btn-auth:hover svg { transform: translateX(5px); }

    /* Footer */
    .auth-footer {
        text-align: center; margin-top: 26px;
        font-size: 0.82rem; letter-spacing: 2px; text-transform: uppercase;
        color: rgba(255,255,255,0.24);
    }
    .auth-footer a { color: var(--gold); text-decoration: none; margin-left: 6px; transition: color 0.2s; }
    .auth-footer a:hover { color: var(--gold-lt); }

    /* Responsive */
    @media (max-width: 720px) {
        .auth-wrap { grid-template-columns: 1fr; max-width: 440px; }
        .auth-panel-left { display: none; }
        .auth-panel-right { padding: 52px 32px; }
    }
    </style>
</head>
<body>

{{-- TELEMETRY BG --}}
<div class="telem-bg">
    <div class="telem-bg__grid"></div>
    <div class="telem-bg__scan"></div>
    <div class="telem-bg__noise"></div>
    <div class="telem-bg__vignette"></div>
    <div class="telem-bg__data" id="telemData"></div>
</div>

<a href="/" class="auth-back">
    <svg viewBox="0 0 16 16"><line x1="14" y1="8" x2="2" y2="8"/><polyline points="7,3 2,8 7,13"/></svg>
    Back to Store
</a>

<div class="auth-wrap">

    {{-- LEFT --}}
    <div class="auth-panel-left">
        <div>
            <div class="panel-badge">
                <div class="panel-badge__line"></div>
                <span class="panel-badge__text">Official Members Club</span>
            </div>
            <a href="/" class="panel-logo">
                <span>F1</span><em></em><span>STORE</span>
            </a>
        </div>

        <div class="panel-headline">
            <h2>WELCOME<em>BACK</em></h2>
            <p>Access your garage, exclusive drops, and race-day deals.</p>
            <div class="panel-stats">
                <div>
                    <div class="stat-num">20+</div>
                    <span class="stat-lbl">Teams</span>
                </div>
                <div>
                    <div class="stat-num">500+</div>
                    <span class="stat-lbl">Products</span>
                </div>
                <div>
                    <div class="stat-num">24</div>
                    <span class="stat-lbl">Rounds</span>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="auth-panel-right">
        <div class="corner-tl"></div>

        <div class="form-heading">
            <div class="form-heading__eyebrow"><span>Authentication Required</span></div>
            <h1>PIT LANE ACCESS</h1>
            <p>Sign in to continue</p>
        </div>

        @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-field">
                <label for="email">Email Address</label>
                <div class="input-box">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="driver@f1store.com" required autofocus autocomplete="username">
                </div>
                @error('email')<span class="auth-field-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-field">
                <label for="password">Access Key</label>
                <div class="input-box">
                    <input id="password" type="password" name="password"
                        placeholder="••••••••" required autocomplete="current-password">
                </div>
                @error('password')<span class="auth-field-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-meta">
                <label class="auth-remember">
                    <input type="checkbox" name="remember">
                    <span>Remember Me</span>
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-forgot">Forgot Key?</a>
                @endif
            </div>

            <button type="submit" class="btn-auth">
                <span>Initialize Login</span>
                <svg viewBox="0 0 16 16"><line x1="2" y1="8" x2="14" y2="8"/><polyline points="9,3 14,8 9,13"/></svg>
            </button>
        </form>

        <p class="auth-footer">
            New team member?
            <a href="{{ route('register') }}">Register Now</a>
        </p>
    </div>

</div>

<script>
const container = document.getElementById('telemData');
const blipTexts = [
    'DRS ENABLED','LAP 47/57','SECTOR 2','GAP +1.4S',
    'TYRE: SOFT','FUEL LOAD 42%','ERS DEPLOY 100%',
    'BRAKE BIAS 56%','ENGINE MODE 8','VMAX 342 KM/H',
    'PIT WINDOW OPEN','SAFETY CAR','OIL TEMP 118°C',
    'WATER TEMP 92°C','THROTTLE 98%','GEAR 7',
];
blipTexts.forEach((text, i) => {
    const el = document.createElement('div');
    el.className = 'telem-blip';
    el.textContent = text;
    el.style.top  = `${Math.random() * 90 + 2}%`;
    el.style.left = `${Math.random() * 85 + 2}%`;
    el.style.animationDelay    = `${i * 0.6}s`;
    el.style.animationDuration = `${6 + Math.random() * 6}s`;
    container.appendChild(el);
});
</script>
</body>
</html>