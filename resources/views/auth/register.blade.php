<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — F1 Store</title>
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
        --muted:      rgba(255,255,255,0.38);
    }

    body {
        background: var(--dark);
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 16px;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 48px 16px;
        position: relative; overflow-x: hidden;
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
       AUTH CARD
    ══════════════════════════════════ */
    .auth-card {
        position: relative; z-index: 10;
        width: 100%; max-width: 600px;
        background: #080808;
        box-shadow: 0 0 0 1px var(--gold-line), 0 60px 140px rgba(0,0,0,0.85);
        animation: card-in 0.7s cubic-bezier(0.16,1,0.3,1) forwards;
        opacity: 0; transform: translateY(30px);
    }
    @keyframes card-in { to { opacity: 1; transform: translateY(0); } }

    /* Shimmer top bar */
    .auth-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--gold), var(--red), var(--gold));
        background-size: 200% 100%;
        animation: shimmer 4s linear infinite;
    }
    @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

    /* Gold corner brackets */
    .auth-card__corner { position: absolute; width: 48px; height: 48px; }
    .auth-card__corner--tl { top: 3px; left: 0; border-top: 1px solid var(--gold-line); border-left: 1px solid var(--gold-line); }
    .auth-card__corner--tr { top: 3px; right: 0; border-top: 1px solid var(--gold-line); border-right: 1px solid var(--gold-line); }
    .auth-card__corner--bl { bottom: 0; left: 0; border-bottom: 1px solid var(--gold-line); border-left: 1px solid var(--gold-line); }
    .auth-card__corner--br { bottom: 0; right: 0; border-bottom: 1px solid var(--gold-line); border-right: 1px solid var(--gold-line); }

    .auth-card__inner { padding: 56px 52px 52px; }

    /* Logo */
    .auth-logo {
        text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 36px;
    }
    .auth-logo span { font-family: 'Bebas Neue', cursive; font-size: 1.6rem; letter-spacing: 6px; color: var(--off-white); }
    .auth-logo em { width: 6px; height: 6px; border-radius: 50%; background: var(--red); flex-shrink: 0; font-style: normal; }

    /* Card eyebrow + title */
    .auth-eyebrow {
        display: flex; align-items: center; gap: 12px; margin-bottom: 12px;
    }
    .auth-eyebrow::before,
    .auth-eyebrow::after { content: ''; flex: 1; height: 1px; }
    .auth-eyebrow::before { background: linear-gradient(270deg, var(--gold-line), transparent); }
    .auth-eyebrow::after  { background: linear-gradient(90deg, var(--gold-line), transparent); }
    .auth-eyebrow span { font-size: 0.72rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); white-space: nowrap; }

    .auth-title {
        font-family: 'Bebas Neue', cursive;
        font-size: clamp(2.2rem, 3.5vw, 2.9rem); letter-spacing: 6px;
        color: var(--off-white); line-height: 1; text-align: center;
    }
    .auth-sub {
        text-align: center; font-size: 1rem; letter-spacing: 0.5px; line-height: 1.6;
        color: rgba(255,255,255,0.3); margin-top: 10px;
    }

    .auth-divider {
        width: 100%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold-line), transparent);
        margin: 28px 0;
    }

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

    /* 2-col row */
    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    /* Password strength */
    .pw-strength { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
    .pw-bars { display: flex; gap: 5px; }
    .pw-bar {
        width: 34px; height: 3px; border-radius: 2px;
        background: rgba(201,168,76,0.1); transition: background 0.3s;
    }
    .pw-bar.weak   { background: #ff4444; }
    .pw-bar.medium { background: var(--gold); }
    .pw-bar.strong { background: #00cc66; }
    .pw-label { font-size: 0.72rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); transition: color 0.3s; }

    /* CTA */
    .btn-auth {
        width: 100%; padding: 18px 32px;
        background: transparent; border: 1px solid var(--gold-line);
        color: var(--gold); font-family: 'Bebas Neue', cursive;
        font-size: 1.1rem; letter-spacing: 7px; text-transform: uppercase;
        cursor: pointer; position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; gap: 14px;
        transition: color 0.3s, border-color 0.3s;
        clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 0 100%);
        margin-top: 8px;
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
        text-align: center; margin-top: 28px;
        font-size: 0.82rem; letter-spacing: 2px; text-transform: uppercase;
        color: rgba(255,255,255,0.24);
    }
    .auth-footer a { color: var(--gold); text-decoration: none; margin-left: 6px; transition: color 0.2s; }
    .auth-footer a:hover { color: var(--gold-lt); }

    @media (max-width: 540px) {
        .auth-card__inner { padding: 44px 28px 40px; }
        .form-row-2 { grid-template-columns: 1fr; gap: 0; }
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

<div class="auth-card">
    <div class="auth-card__corner auth-card__corner--tl"></div>
    <div class="auth-card__corner auth-card__corner--tr"></div>
    <div class="auth-card__corner auth-card__corner--bl"></div>
    <div class="auth-card__corner auth-card__corner--br"></div>

    <div class="auth-card__inner">

        <a href="/" class="auth-logo">
            <span>F1</span><em></em><span>STORE</span>
        </a>

        <div class="auth-eyebrow"><span>New Member Registration</span></div>
        <h1 class="auth-title">JOIN THE GRID</h1>
        <p class="auth-sub">Create your driver profile. Get exclusive gear, early drops, and race-weekend deals.</p>

        <div class="auth-divider"></div>

        @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="auth-field">
                <label for="name">Full Name</label>
                <div class="input-box">
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        placeholder="Your full name" required autofocus autocomplete="name">
                </div>
                @error('name')<span class="auth-field-error">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div class="auth-field">
                <label for="email">Email Address</label>
                <div class="input-box">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="driver@f1store.com" required autocomplete="username">
                </div>
                @error('email')<span class="auth-field-error">{{ $message }}</span>@enderror
            </div>

            {{-- Password row --}}
            <div class="form-row-2">
                <div class="auth-field">
                    <label for="password">Password</label>
                    <div class="input-box">
                        <input id="password" type="password" name="password"
                            placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>
                <div class="auth-field">
                    <label for="password_confirmation">Confirm</label>
                    <div class="input-box">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            @error('password')<span class="auth-field-error" style="margin-top:-14px; margin-bottom:12px; display:block;">{{ $message }}</span>@enderror

            {{-- Password strength --}}
            <div class="pw-strength" id="pwStrength" style="display:none; margin-bottom:18px;">
                <div class="pw-bars">
                    <div class="pw-bar" id="b1"></div>
                    <div class="pw-bar" id="b2"></div>
                    <div class="pw-bar" id="b3"></div>
                </div>
                <span class="pw-label" id="pwLabel">Weak</span>
            </div>

            <button type="submit" class="btn-auth">
                <span>Start Your Engine</span>
                <svg viewBox="0 0 16 16"><line x1="2" y1="8" x2="14" y2="8"/><polyline points="9,3 14,8 9,13"/></svg>
            </button>
        </form>

        <p class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Sign In</a>
        </p>

    </div>
</div>

<script>
/* Telemetry blips */
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

/* Password strength */
const pw = document.getElementById('password');
const wrap = document.getElementById('pwStrength');
const [b1,b2,b3] = ['b1','b2','b3'].map(id => document.getElementById(id));
const lbl = document.getElementById('pwLabel');
pw.addEventListener('input', () => {
    const v = pw.value;
    if (!v) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'flex';
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v) && /[a-z]/.test(v)) s++;
    if (/[0-9]/.test(v) || /[^A-Za-z0-9]/.test(v)) s++;
    const cls = s === 1 ? 'weak' : s === 2 ? 'medium' : 'strong';
    const labels = ['','Weak','Medium','Strong'];
    const colors = ['','#ff4444','#c9a84c','#00cc66'];
    [b1,b2,b3].forEach((b,i) => { b.className = 'pw-bar'; if (i < s) b.classList.add(cls); });
    lbl.textContent = labels[s]; lbl.style.color = colors[s];
});
</script>
</body>
</html>n