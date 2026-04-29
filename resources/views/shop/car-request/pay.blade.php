@extends('layouts.app')

@section('content')

@include('home._navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
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
    --success: #1DB954;
}

.pay-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

/* ── BREADCRUMB ── */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 48px;
    border-bottom: 1px solid var(--border);
}
.breadcrumb a, .breadcrumb span {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    text-decoration: none;
    transition: color 0.2s;
    font-weight: 400;
}
.breadcrumb a:hover { color: var(--off-white); }
.breadcrumb .sep { color: rgba(255,255,255,0.12); font-size: 0.5rem; }
.breadcrumb .current { color: var(--red); }

/* ── APPROVAL STRIP ── */
.approval-strip {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 48px;
    background: rgba(29, 185, 84, 0.05);
    border-bottom: 1px solid rgba(29, 185, 84, 0.15);
}
.strip-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--success);
    animation: blink 2s ease-in-out infinite;
    flex-shrink: 0;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
.strip-text {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--success);
    font-weight: 400;
}
.strip-ref {
    margin-left: auto;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(29,185,84,0.5);
}

/* ── LAYOUT ── */
.pay-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 0;
    min-height: calc(100vh - 92px - 50px - 48px);
}

/* ── LEFT PANEL ── */
.pay-left {
    padding: 56px 48px;
    border-right: 1px solid var(--border);
}

.section-eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 12px;
}
.eyebrow-line { display: inline-block; width: 24px; height: 1px; background: var(--red); }

.pay-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2.4rem, 4vw, 3.5rem);
    letter-spacing: 4px;
    line-height: 1;
    color: var(--off-white);
    margin-bottom: 10px;
}

.pay-sub {
    font-size: 0.82rem;
    color: var(--muted);
    margin-bottom: 44px;
    line-height: 1.7;
    max-width: 480px;
}

/* ── STEP TRACK ── */
.steps {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 44px;
}
.step-item {
    display: flex;
    align-items: center;
    gap: 10px;
}
.step-num {
    width: 26px; height: 26px;
    border: 1px solid var(--border-mid);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.6rem;
    letter-spacing: 1px;
    color: var(--muted);
    flex-shrink: 0;
}
.step-item.done .step-num {
    background: var(--success);
    border-color: var(--success);
    color: #000;
}
.step-item.active .step-num {
    background: var(--red);
    border-color: var(--red);
    color: #fff;
}
.step-label {
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
}
.step-item.done .step-label  { color: var(--success); }
.step-item.active .step-label { color: var(--off-white); }
.step-line {
    flex: 0 0 40px;
    height: 1px;
    background: var(--border);
    margin: 0 10px;
}

/* ── FORM CARD ── */
.form-card {
    border: 1px solid var(--border);
    background: var(--surface);
    margin-bottom: 16px;
}

.form-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
}

.form-card-title {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
}

.form-card-body { padding: 24px; }

/* ── METHOD TABS ── */
.method-tabs {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    border: 1px solid var(--border);
    margin-bottom: 24px;
}
.method-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 14px 8px;
    background: transparent;
    border: none;
    border-right: 1px solid var(--border);
    cursor: pointer;
    color: var(--muted);
    font-family: 'Barlow', sans-serif;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-weight: 400;
    transition: all 0.2s;
}
.method-tab:last-child { border-right: none; }
.method-tab svg { opacity: 0.4; transition: opacity 0.2s; }
.method-tab.active {
    background: rgba(225,6,0,0.08);
    color: var(--off-white);
    border-bottom: 2px solid var(--red);
}
.method-tab.active svg { opacity: 0.9; }
.method-tab:not(.active):hover { color: rgba(240,236,228,0.6); background: rgba(255,255,255,0.02); }

/* ── FIELDS ── */
.field { margin-bottom: 16px; }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.field-row-3 { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px; }

label {
    display: block;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
    margin-bottom: 8px;
}

.f-input {
    width: 100%;
    background: #111;
    border: 1px solid var(--border-mid);
    color: var(--off-white);
    padding: 12px 16px;
    font-family: 'Barlow', sans-serif;
    font-size: 0.88rem;
    font-weight: 300;
    outline: none;
    transition: border-color 0.2s;
    -webkit-appearance: none;
}
.f-input:focus { border-color: rgba(225,6,0,0.5); }
.f-input::placeholder { color: rgba(240,236,228,0.18); }
.f-input.valid { border-color: rgba(29,185,84,0.35); }

/* Card number wrap */
.card-num-wrap { position: relative; }
.card-num-wrap .f-input { padding-right: 110px; }
.card-brands {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    gap: 6px;
}
.brand-pill {
    font-family: 'Bebas Neue', cursive;
    font-size: 0.6rem;
    letter-spacing: 1px;
    padding: 3px 7px;
    border: 1px solid var(--border);
    color: var(--muted);
    background: #0d0d0d;
}
.brand-pill.visa  { color: #4A90D9; border-color: rgba(74,144,217,0.25); }
.brand-pill.mc    { color: #EB001B; border-color: rgba(235,0,27,0.25); }
.brand-pill.amex  { color: #5AABFF; border-color: rgba(90,171,255,0.25); }

/* ── SECURITY LINE ── */
.security-line {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border: 1px solid var(--border);
    background: rgba(255,255,255,0.02);
    margin-top: 4px;
}
.security-line span {
    font-size: 0.58rem;
    letter-spacing: 2px;
    color: var(--muted);
    line-height: 1.5;
}
.security-line svg { flex-shrink: 0; }

/* ── CONTACT BLOCK ── */
.contact-prefill {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    border: 1px solid var(--border);
    background: rgba(255,255,255,0.015);
    margin-bottom: 12px;
}
.contact-prefill-info { flex: 1; }
.contact-prefill-name {
    font-size: 0.85rem;
    color: var(--off-white);
    margin-bottom: 2px;
}
.contact-prefill-email {
    font-size: 0.7rem;
    color: var(--muted);
}
.contact-prefill-badge {
    font-size: 0.52rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--success);
    border: 1px solid rgba(29,185,84,0.2);
    padding: 3px 8px;
}

/* ── RIGHT PANEL — ORDER SUMMARY ── */
.pay-right {
    padding: 56px 40px;
    background: #060606;
    position: sticky;
    top: 92px;
    height: calc(100vh - 92px);
    overflow-y: auto;
    scrollbar-width: none;
}
.pay-right::-webkit-scrollbar { display: none; }

.summary-eyebrow {
    font-size: 0.58rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 28px;
    font-weight: 400;
}

/* Car image */
.car-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    background: #0d0d0d;
    border: 1px solid var(--border);
    overflow: hidden;
    position: relative;
    margin-bottom: 24px;
}
.car-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.8);
    transition: transform 8s ease;
}
.car-thumb:hover img { transform: scale(1.04); }
.car-thumb-team {
    position: absolute;
    bottom: 12px;
    left: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.team-bar { width: 3px; height: 32px; background: var(--red); flex-shrink: 0; }
.team-bar-label {
    font-size: 0.52rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(240,236,228,0.5);
    margin-bottom: 1px;
}
.team-bar-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 0.85rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

/* Summary table */
.sum-car-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 3px;
    color: var(--off-white);
    margin-bottom: 6px;
    line-height: 1;
}
.sum-car-driver {
    font-size: 0.62rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 24px;
}

.sum-rows { border-top: 1px solid var(--border); }
.sum-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
}
.sum-key {
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
}
.sum-val {
    font-size: 0.78rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--off-white);
    font-weight: 400;
}

.sum-total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 20px 0 0;
}
.sum-total-label {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
}
.sum-total-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.4rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1;
}

/* ── PAY BUTTON ── */
.btn-pay {
    width: 100%;
    background: var(--red);
    border: none;
    color: #fff;
    padding: 18px 24px;
    font-family: 'Barlow', sans-serif;
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: background 0.2s;
    position: relative;
    overflow: hidden;
}
.btn-pay:hover { background: #c00400; }
.btn-pay::after {
    content: '';
    position: absolute;
    left: -100%;
    top: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07), transparent);
    animation: sweep 2.5s ease-in-out infinite;
}
@keyframes sweep { 0%{left:-100%} 100%{left:200%} }
.btn-pay svg { transition: transform 0.2s; }
.btn-pay:hover svg { transform: translateX(4px); }
.btn-pay:disabled { background: #3a0000; color: rgba(255,255,255,0.3); cursor: not-allowed; }

.pay-note {
    font-size: 0.6rem;
    letter-spacing: 2px;
    color: var(--muted);
    text-align: center;
    margin-top: 14px;
    line-height: 1.6;
}
.pay-note a { color: rgba(240,236,228,0.5); }

/* ── SUCCESS MODAL ── */
.modal-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(4,4,4,0.88);
    z-index: 500;
    align-items: center;
    justify-content: center;
}
.modal-backdrop.show { display: flex; }

.modal-box {
    background: var(--surface);
    border: 1px solid rgba(29,185,84,0.25);
    padding: 48px 44px;
    max-width: 440px;
    width: 90%;
    text-align: center;
    animation: modalIn 0.4s cubic-bezier(0.16,1,0.3,1);
}
@keyframes modalIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:none} }

.modal-check {
    width: 60px; height: 60px;
    border: 1px solid var(--success);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
}

.modal-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 4px;
    color: var(--off-white);
    margin-bottom: 10px;
}

.modal-sub {
    font-size: 0.8rem;
    color: var(--muted);
    margin-bottom: 28px;
    line-height: 1.7;
}

.modal-ref-label {
    font-size: 0.55rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 4px;
}
.modal-ref-num {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 4px;
    color: var(--success);
    margin-bottom: 32px;
}

.btn-outline {
    display: inline-block;
    border: 1px solid var(--border-mid);
    padding: 12px 28px;
    font-family: 'Barlow', sans-serif;
    font-size: 0.6rem;
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--off-white);
    cursor: pointer;
    background: transparent;
    text-decoration: none;
    transition: border-color 0.2s;
}
.btn-outline:hover { border-color: var(--off-white); }

/* ── LOADING ── */
.loading-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(4,4,4,0.75);
    z-index: 400;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 20px;
}
.loading-overlay.show { display: flex; }
.spinner {
    width: 44px; height: 44px;
    border: 1px solid var(--border-mid);
    border-top-color: var(--red);
    border-radius: 50%;
    animation: spin 0.75s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.loading-text {
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
}

/* ── RESPONSIVE ── */
@media (max-width: 960px) {
    .pay-layout { grid-template-columns: 1fr; }
    .pay-right { position: static; height: auto; border-top: 1px solid var(--border); background: #080808; }
    .pay-left, .pay-right { padding: 40px 32px; }
}
@media (max-width: 600px) {
    .breadcrumb, .approval-strip { padding: 12px 20px; }
    .pay-left, .pay-right { padding: 32px 20px; }
    .field-row, .field-row-3 { grid-template-columns: 1fr; }
    .steps { flex-wrap: wrap; gap: 8px; }
    .step-line { display: none; }
}
</style>

<div class="pay-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="{{ route('shop') }}">Shop</a>
        <span class="sep">&#9656;</span>
        <a href="{{ route('products.show', $carRequest->product) }}">{{ $carRequest->product->product_name }}</a>
        <span class="sep">&#9656;</span>
        <a href="{{ route('shop.car-request.my-requests') }}">My Requests</a>
        <span class="sep">&#9656;</span>
        <span class="current">Payment</span>
    </div>

    {{-- APPROVAL STRIP --}}
    <div class="approval-strip">
        <div class="strip-dot"></div>
        <span class="strip-text">Request #{{ $carRequest->request_id }} Approved &mdash; Payment Required</span>
        <span class="strip-ref">Approved {{ $carRequest->updated_at->diffForHumans() }}</span>
    </div>

    {{-- LAYOUT --}}
    <div class="pay-layout">

        {{-- LEFT: FORM --}}
        <div class="pay-left">

            <div class="section-eyebrow">
                <span class="eyebrow-line"></span>
                Secure Checkout
            </div>
            <h1 class="pay-title">Complete<br>Payment</h1>
            <p class="pay-sub">Your purchase request has been approved. Complete your payment details below to finalise your order. You'll receive a confirmation email immediately after.</p>

            {{-- STEP TRACK --}}
            <div class="steps">
                <div class="step-item done">
                    <div class="step-num">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M2 5l2.5 2.5L8 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="step-label">Request</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item done">
                    <div class="step-num">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M2 5l2.5 2.5L8 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="step-label">Approved</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item active">
                    <div class="step-num">3</div>
                    <span class="step-label">Payment</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-num">4</div>
                    <span class="step-label">Confirmed</span>
                </div>
            </div>

            <form id="paymentForm" action="{{ route('shop.car-payment.process', $carRequest) }}" method="POST">
                @csrf

                {{-- CONTACT INFO --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <span class="form-card-title">Contact Information</span>
                    </div>
                    <div class="form-card-body">
                        <div class="contact-prefill">
                            <div class="contact-prefill-info">
                                <div class="contact-prefill-name">{{ auth()->user()->full_name }}</div>
                                <div class="contact-prefill-email">{{ auth()->user()->email }}</div>
                            </div>
                            <span class="contact-prefill-badge">Verified</span>
                        </div>
                        <div class="field">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="f-input"
                                   placeholder="+1 234 567 8900"
                                   value="{{ $carRequest->phone }}">
                        </div>
                    </div>
                </div>

                {{-- PAYMENT METHOD --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <span class="form-card-title">Payment Method</span>
                    </div>
                    <div class="form-card-body">

                        <div class="method-tabs">
                            <button type="button" class="method-tab active" data-method="card" onclick="setMethod('card', this)">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round">
                                    <rect x="2" y="4" width="14" height="10" rx="1.5"/>
                                    <path d="M2 7.5h14"/>
                                    <path d="M5 11.5h3"/>
                                </svg>
                                Credit Card
                            </button>
                            <button type="button" class="method-tab" data-method="bank" onclick="setMethod('bank', this)">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round">
                                    <path d="M2 7h14M9 3l7 4H2l7-4zM4 7v7M9 7v7M14 7v7M2 14h14"/>
                                </svg>
                                Bank Transfer
                            </button>
                            <button type="button" class="method-tab" data-method="crypto" onclick="setMethod('crypto', this)">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round">
                                    <path d="M9 2v2M9 14v2M4.2 4.2l1.4 1.4M12.4 12.4l1.4 1.4M2 9h2M14 9h2M4.2 13.8l1.4-1.4M12.4 5.6l1.4-1.4"/>
                                    <circle cx="9" cy="9" r="3"/>
                                </svg>
                                Crypto
                            </button>
                        </div>

                        <input type="hidden" name="payment_method" id="paymentMethodInput" value="card">

                        {{-- CARD FIELDS --}}
                        <div id="cardFields">
                            <div class="field">
                                <label>Cardholder Name</label>
                                <input type="text" name="card_name" class="f-input" placeholder="As it appears on your card" autocomplete="cc-name">
                            </div>
                            <div class="field">
                                <label>Card Number</label>
                                <div class="card-num-wrap">
                                    <input type="text" name="card_number" id="cardNumber" class="f-input"
                                           placeholder="0000 0000 0000 0000"
                                           maxlength="19"
                                           autocomplete="cc-number"
                                           oninput="formatCard(this)">
                                    <div class="card-brands">
                                        <span class="brand-pill visa">VISA</span>
                                        <span class="brand-pill mc">MC</span>
                                        <span class="brand-pill amex">AMEX</span>
                                    </div>
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field" style="margin:0">
                                    <label>Expiry Date</label>
                                    <input type="text" name="card_expiry" class="f-input" placeholder="MM / YY" maxlength="7" oninput="formatExpiry(this)" autocomplete="cc-exp">
                                </div>
                                <div class="field" style="margin:0">
                                    <label>Security Code</label>
                                    <input type="text" name="card_cvv" class="f-input" placeholder="CVV" maxlength="4" autocomplete="cc-csc">
                                </div>
                            </div>
                        </div>

                        {{-- BANK TRANSFER FIELDS --}}
                        <div id="bankFields" style="display:none;">
                            <div class="security-line" style="margin-bottom:16px;">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.2">
                                    <path d="M7 1l6 3v3c0 3.3-2.6 6.3-6 7-3.4-.7-6-3.7-6-7V4l6-3z"/>
                                </svg>
                                <span>Bank details will be sent to your email after submission. Payment must be completed within 48 hours.</span>
                            </div>
                            <div class="field">
                                <label>Account Holder Name</label>
                                <input type="text" name="bank_name" class="f-input" placeholder="Full legal name">
                            </div>
                            <div class="field-row">
                                <div class="field" style="margin:0">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_institution" class="f-input" placeholder="e.g. Chase, HSBC">
                                </div>
                                <div class="field" style="margin:0">
                                    <label>Country</label>
                                    <input type="text" name="bank_country" class="f-input" placeholder="United States">
                                </div>
                            </div>
                        </div>

                        {{-- CRYPTO FIELDS --}}
                        <div id="cryptoFields" style="display:none;">
                            <div class="security-line" style="margin-bottom:16px;">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.2">
                                    <path d="M7 1l6 3v3c0 3.3-2.6 6.3-6 7-3.4-.7-6-3.7-6-7V4l6-3z"/>
                                </svg>
                                <span>A wallet address will be provided after submission. Send exact amount to confirm your order.</span>
                            </div>
                            <div class="field">
                                <label>Preferred Network</label>
                                <select name="crypto_network" class="f-input" style="cursor:pointer;">
                                    <option value="">Select network</option>
                                    <option value="btc">Bitcoin (BTC)</option>
                                    <option value="eth">Ethereum (ETH)</option>
                                    <option value="usdt">Tether (USDT — ERC20)</option>
                                    <option value="usdc">USD Coin (USDC)</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Your Wallet Address (for refunds)</label>
                                <input type="text" name="crypto_wallet" class="f-input" placeholder="0x...">
                            </div>
                        </div>

                        <div class="security-line" style="margin-top:16px;">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.2">
                                <rect x="3" y="6" width="8" height="6" rx="1"/>
                                <path d="M5 6V4a2 2 0 014 0v2"/>
                            </svg>
                            <span>Your payment data is encrypted with 256-bit SSL. We never store full card details.</span>
                        </div>

                    </div>
                </div>

                {{-- BILLING ADDRESS --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <span class="form-card-title">Billing Address</span>
                    </div>
                    <div class="form-card-body">
                        <div class="field">
                            <label>Street Address</label>
                            <input type="text" name="billing_address" class="f-input" placeholder="123 Main Street">
                        </div>
                        <div class="field-row">
                            <div class="field" style="margin:0">
                                <label>City</label>
                                <input type="text" name="billing_city" class="f-input" placeholder="New York">
                            </div>
                            <div class="field" style="margin:0">
                                <label>ZIP / Postal Code</label>
                                <input type="text" name="billing_zip" class="f-input" placeholder="10001">
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label>Country</label>
                            <input type="text" name="billing_country" class="f-input" placeholder="United States">
                        </div>
                    </div>
                </div>

            </form>

        </div>

        {{-- RIGHT: ORDER SUMMARY --}}
        <div class="pay-right">

            <div class="summary-eyebrow">Order Summary</div>

            {{-- Car thumb --}}
            <div class="car-thumb">
                @if($carRequest->product->mainImage)
                    <img src="{{ asset('storage/' . $carRequest->product->mainImage->image_url) }}"
                         alt="{{ $carRequest->product->product_name }}"
                         onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80'">
                @else
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80"
                         alt="{{ $carRequest->product->product_name }}">
                @endif
                <div class="car-thumb-team">
                    <div class="team-bar" style="background: {{ $carRequest->product->carModel?->team?->color ?? 'var(--red)' }};"></div>
                    <div>
                        <div class="team-bar-label">Constructor</div>
                        <div class="team-bar-name">{{ $carRequest->product->carModel?->team?->team_name ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="sum-car-name">{{ $carRequest->product->product_name }}</div>
            <div class="sum-car-driver">
                @if($carRequest->product->carModel?->driver)
                    #{{ $carRequest->product->carModel->driver->car_number }} &middot; {{ $carRequest->product->carModel->driver->driver_name }}
                @else
                    Scale Model &middot; {{ $carRequest->product->carModel?->season_year ?? '' }}
                @endif
            </div>

            <div class="sum-rows">
                <div class="sum-row">
                    <span class="sum-key">Season</span>
                    <span class="sum-val">{{ $carRequest->product->carModel?->season_year ?? '—' }}</span>
                </div>
                <div class="sum-row">
                    <span class="sum-key">Engine</span>
                    <span class="sum-val">{{ $carRequest->product->carModel?->engine ?? '—' }}</span>
                </div>
                <div class="sum-row">
                    <span class="sum-key">SKU</span>
                    <span class="sum-val" style="font-size:0.65rem; letter-spacing:2px;">{{ $carRequest->product->sku ?? '—' }}</span>
                </div>
                <div class="sum-row">
                    <span class="sum-key">Request ID</span>
                    <span class="sum-val">#{{ $carRequest->request_id }}</span>
                </div>
                <div class="sum-row">
                    <span class="sum-key">Base Price</span>
                    <span class="sum-val">${{ number_format($carRequest->product->base_price, 0) }}</span>
                </div>
                <div class="sum-row">
                    <span class="sum-key">Tax (0%)</span>
                    <span class="sum-val">—</span>
                </div>
            </div>

            <div class="sum-total">
                <span class="sum-total-label">Total Due</span>
                <span class="sum-total-price">${{ number_format($carRequest->product->base_price, 0) }}</span>
            </div>

            <button type="submit" form="paymentForm" class="btn-pay" id="btnPay">
                Pay ${{ number_format($carRequest->product->base_price, 0) }}
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M3 7h8M8 4l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <p class="pay-note">
                By completing payment you agree to our <a href="#">terms of sale</a>.<br>
                All sales are final. Contact support within 48h for disputes.
            </p>

        </div>
    </div>

</div>

{{-- SUCCESS MODAL --}}
<div class="modal-backdrop" id="successModal">
    <div class="modal-box">
        <div class="modal-check">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M5 12l5 5L19 7" stroke="#1DB954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-title">Payment Confirmed</div>
        <p class="modal-sub">Your order has been placed. A confirmation has been sent to <strong>{{ auth()->user()->email }}</strong>. Our team will be in touch shortly.</p>
        <div class="modal-ref-label">Transaction Reference</div>
        <div class="modal-ref-num" id="txRef">—</div>
        <a href="{{ route('shop.car-request.my-requests') }}" class="btn-outline">View My Requests</a>
    </div>
</div>

{{-- LOADING --}}
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <div class="loading-text">Processing Payment</div>
</div>

@include('home._footer')

<script>
/* ── Payment Method Switch ── */
function setMethod(method, el) {
    document.querySelectorAll('.method-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('paymentMethodInput').value = method;
    document.getElementById('cardFields').style.display   = method === 'card'   ? 'block' : 'none';
    document.getElementById('bankFields').style.display   = method === 'bank'   ? 'block' : 'none';
    document.getElementById('cryptoFields').style.display = method === 'crypto' ? 'block' : 'none';
}

/* ── Card Formatting ── */
function formatCard(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 16);
    input.value = v.match(/.{1,4}/g)?.join(' ') ?? v;
    // Detect card brand
    const brands = document.querySelectorAll('.brand-pill');
    brands.forEach(b => b.style.opacity = '0.3');
    if (v[0] === '4') document.querySelector('.brand-pill.visa').style.opacity  = '1';
    if (v[0] === '5') document.querySelector('.brand-pill.mc').style.opacity    = '1';
    if (v[0] === '3') document.querySelector('.brand-pill.amex').style.opacity  = '1';
    if (!v)           brands.forEach(b => b.style.opacity = '1');
}

function formatExpiry(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 4);
    if (v.length >= 3) v = v.slice(0, 2) + ' / ' + v.slice(2);
    input.value = v;
}

/* ── Form Submit ── */
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Basic validation
    const method = document.getElementById('paymentMethodInput').value;
    if (method === 'card') {
        const num = document.getElementById('cardNumber').value.replace(/\s/g, '');
        if (num.length < 16) {
            alert('Please enter a valid card number.');
            return;
        }
    }

    // Show loading
    document.getElementById('loadingOverlay').classList.add('show');
    document.getElementById('btnPay').disabled = true;

    // Submit via fetch
    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('loadingOverlay').classList.remove('show');
        if (data.success) {
            document.getElementById('txRef').textContent = data.transaction_ref ?? 'TXN-' + Date.now();
            document.getElementById('successModal').classList.add('show');
        } else {
            alert(data.message ?? 'Payment failed. Please try again.');
            document.getElementById('btnPay').disabled = false;
        }
    })
    .catch(() => {
        document.getElementById('loadingOverlay').classList.remove('show');
        document.getElementById('btnPay').disabled = false;
        alert('Something went wrong. Please try again.');
    });
});
</script>

@endsection