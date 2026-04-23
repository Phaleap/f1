@extends('layouts.app')

@section('content')
@include('home._navbar')

<style>
/* ═══════════════════════════════════════
   CONTACT PAGE — GLOBAL
═══════════════════════════════════════ */
:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(255,255,255,0.35);
    --border: rgba(255,255,255,0.07);
}

body { background: #080808; }

/* ═══════════════════════════════════════
   HERO STRIP
═══════════════════════════════════════ */
.contact-hero {
    position: relative;
    padding: 160px 80px 80px;
    background: var(--dark);
    overflow: hidden;
}

.contact-hero__bg-line {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
    opacity: 0.6;
}

.contact-hero__noise {
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    opacity: 0.4;
    pointer-events: none;
}

.contact-hero__eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.75rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}

.contact-hero__eyebrow span {
    display: inline-block;
    width: 32px; height: 1px;
    background: var(--red);
}

.contact-hero__title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(4rem, 9vw, 8rem);
    letter-spacing: 4px;
    line-height: 0.92;
    color: var(--off-white);
    margin: 0 0 24px 0;
    position: relative;
    z-index: 1;
}

.contact-hero__title em {
    font-style: normal;
    color: var(--red);
}

.contact-hero__sub {
    font-size: 1rem;
    color: var(--muted);
    letter-spacing: 0.5px;
    line-height: 1.7;
    max-width: 440px;
    position: relative;
    z-index: 1;
}

/* Large ghost text */
.contact-hero__ghost {
    position: absolute;
    bottom: -20px;
    right: -20px;
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(8rem, 18vw, 18rem);
    letter-spacing: 8px;
    color: rgba(255,255,255,0.02);
    line-height: 1;
    pointer-events: none;
    user-select: none;
    z-index: 0;
}

/* ═══════════════════════════════════════
   MAIN CONTACT LAYOUT
═══════════════════════════════════════ */
.contact-body {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    min-height: 70vh;
    background: var(--dark);
    border-top: 1px solid var(--border);
}

/* ── LEFT PANEL ── */
.contact-info {
    padding: 80px;
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 64px;
}

.contact-info__block h3 {
    font-size: 0.7rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin: 0 0 20px 0;
}

.contact-info__block p,
.contact-info__block a {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.5);
    line-height: 1.75;
    text-decoration: none;
    display: block;
    transition: color 0.2s;
    letter-spacing: 0.3px;
}

.contact-info__block a:hover {
    color: var(--off-white);
}

/* Response time stat */
.contact-stat {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 24px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}

.contact-stat__num {
    font-family: 'Bebas Neue', cursive;
    font-size: 3rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
}

.contact-stat__num span {
    color: var(--red);
}

.contact-stat__label {
    font-size: 0.7rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
}

/* Social links */
.contact-socials {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-social-link {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 0.75rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
    text-decoration: none;
    transition: color 0.2s, gap 0.2s;
}

.contact-social-link::before {
    content: '';
    display: inline-block;
    width: 20px; height: 1px;
    background: var(--red);
    transition: width 0.3s;
    flex-shrink: 0;
}

.contact-social-link:hover {
    color: var(--off-white);
    gap: 20px;
}

.contact-social-link:hover::before {
    width: 32px;
}

/* ── RIGHT PANEL: FORM ── */
.contact-form-wrap {
    padding: 80px;
}

.contact-form-wrap h2 {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2rem, 3.5vw, 3rem);
    letter-spacing: 4px;
    color: var(--off-white);
    margin: 0 0 8px 0;
}

.contact-form-wrap .form-sub {
    font-size: 0.85rem;
    color: var(--muted);
    letter-spacing: 0.5px;
    margin-bottom: 48px;
}

/* Success message */
.contact-success {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 24px;
    background: rgba(225,6,0,0.05);
    border: 1px solid rgba(225,6,0,0.2);
    border-left: 3px solid var(--red);
    margin-bottom: 40px;
}

.contact-success__icon {
    width: 20px; height: 20px;
    border-radius: 50%;
    background: var(--red);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.contact-success__icon svg {
    width: 10px; height: 10px;
    stroke: white;
    stroke-width: 2.5;
    fill: none;
}

.contact-success p {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.65);
    line-height: 1.6;
    margin: 0;
}

.contact-success p strong {
    display: block;
    color: var(--off-white);
    font-size: 0.85rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 4px;
}

/* Form fields */
.contact-form {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.form-field {
    position: relative;
    border-bottom: 1px solid var(--border);
    padding: 24px 0 8px 0;
}

.form-field:not(:last-child) {
    border-right: none;
}

.form-row .form-field:first-child {
    border-right: 1px solid var(--border);
    padding-right: 32px;
}

.form-row .form-field:last-child {
    padding-left: 32px;
}

.form-field label {
    display: block;
    font-size: 0.65rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 10px;
}

.form-field input,
.form-field select,
.form-field textarea {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 1rem;
    letter-spacing: 1px;
    color: var(--off-white);
    padding: 0 0 16px 0;
    resize: none;
    appearance: none;
    -webkit-appearance: none;
}

.form-field input::placeholder,
.form-field textarea::placeholder {
    color: rgba(255,255,255,0.15);
}

.form-field select option {
    background: #111;
    color: var(--off-white);
}

/* Animated underline on focus */
.form-field::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--red);
    transition: width 0.4s ease;
}

.form-field:focus-within::after {
    width: 100%;
}

.form-field:focus-within label {
    color: var(--off-white);
}

/* Textarea field */
.form-field--textarea {
    padding-top: 24px;
}

.form-field--textarea textarea {
    min-height: 120px;
    line-height: 1.7;
}

/* Char counter */
.form-field__counter {
    position: absolute;
    bottom: 8px;
    right: 0;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--muted);
    transition: color 0.2s;
}

.form-field__counter.warn { color: var(--red); }

/* Validation errors */
.form-error {
    font-size: 0.7rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--red);
    margin-top: 6px;
    display: block;
}

/* Submit row */
.form-submit-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 48px;
    gap: 24px;
}

.form-submit-row .form-note {
    font-size: 0.7rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    line-height: 1.6;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    background: var(--red);
    color: white;
    border: none;
    padding: 18px 40px;
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.2s, gap 0.2s, transform 0.15s;
    white-space: nowrap;
}

.btn-submit:hover {
    background: #c00500;
    gap: 20px;
}

.btn-submit:active {
    transform: scale(0.98);
}

.btn-submit svg {
    width: 16px; height: 16px;
    stroke: white;
    stroke-width: 2;
    fill: none;
    transition: transform 0.2s;
}

.btn-submit:hover svg {
    transform: translateX(4px);
}

/* Loading state */
.btn-submit.loading {
    pointer-events: none;
    opacity: 0.7;
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .contact-hero { padding: 120px 32px 60px; }

    .contact-body {
        grid-template-columns: 1fr;
    }

    .contact-info {
        padding: 48px 32px;
        border-right: none;
        border-bottom: 1px solid var(--border);
        gap: 40px;
    }

    .contact-form-wrap { padding: 48px 32px; }

    .form-row {
        grid-template-columns: 1fr;
    }

    .form-row .form-field:first-child {
        border-right: none;
        padding-right: 0;
    }

    .form-row .form-field:last-child {
        padding-left: 0;
    }

    .form-submit-row {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

{{-- ── HERO ── --}}
<section class="contact-hero">
    <div class="contact-hero__bg-line"></div>
    <div class="contact-hero__noise"></div>

    <p class="contact-hero__eyebrow">
        <span></span>
        Get In Touch
    </p>

    <h1 class="contact-hero__title">
        LET'S TALK<br><em>RACING.</em>
    </h1>

    <p class="contact-hero__sub">
        Questions about an order, a product, or just want to talk F1?
        We're real people who actually love this sport. We'll get back to you fast.
    </p>

    <div class="contact-hero__ghost">CONTACT</div>
</section>

{{-- ── BODY ── --}}
<div class="contact-body">

    {{-- LEFT: Info --}}
    <div class="contact-info">

        <div class="contact-stat">
            <span class="contact-stat__num">24<span>H</span></span>
            <span class="contact-stat__label">Average Response Time</span>
        </div>

        <div class="contact-info__block">
            <h3>Email Us</h3>
            <a href="mailto:hello@f1store.com">hello@f1store.com</a>
            <a href="mailto:orders@f1store.com">orders@f1store.com</a>
        </div>

        <div class="contact-info__block">
            <h3>Hours</h3>
            <p>Monday — Friday</p>
            <p>09:00 — 18:00 (ICT)</p>
            <p style="margin-top:8px; font-size:0.8rem;">
                Race weekends? We're awake at 3AM too.
            </p>
        </div>

        <div class="contact-info__block">
            <h3>Follow the Race</h3>
            <div class="contact-socials">
                <a href="#" class="contact-social-link">Instagram</a>
                <a href="#" class="contact-social-link">Twitter / X</a>
                <a href="#" class="contact-social-link">YouTube</a>
            </div>
        </div>

    </div>

    {{-- RIGHT: Form --}}
    <div class="contact-form-wrap">
        <h2>SEND A MESSAGE</h2>
        <p class="form-sub">We respond within 24 hours. Usually faster.</p>

        {{-- Success state --}}
        @if(session('success'))
        <div class="contact-success">
            <div class="contact-success__icon">
                <svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg>
            </div>
            <p>
                <strong>Message Received</strong>
                {{ session('success') }}
            </p>
        </div>
        @endif

        <form class="contact-form" action="{{ route('contact.store') }}" method="POST" id="contactForm">
            @csrf

            {{-- Row 1: Name + Email --}}
            <div class="form-row">
                <div class="form-field">
                    <label for="name">Your Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Max Verstappen"
                        value="{{ old('name') }}"
                        autocomplete="off"
                    >
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        autocomplete="off"
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Row 2: Subject --}}
            <div class="form-field">
                <label for="subject">Subject</label>
                <select id="subject" name="subject">
                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic</option>
                    <option value="General Inquiry"    {{ old('subject') == 'General Inquiry'    ? 'selected' : '' }}>General Inquiry</option>
                    <option value="Order Issue"        {{ old('subject') == 'Order Issue'        ? 'selected' : '' }}>Order Issue</option>
                    <option value="Product Question"   {{ old('subject') == 'Product Question'   ? 'selected' : '' }}>Product Question</option>
                    <option value="Partnership"        {{ old('subject') == 'Partnership'        ? 'selected' : '' }}>Partnership</option>
                    <option value="Press"              {{ old('subject') == 'Press'              ? 'selected' : '' }}>Press</option>
                </select>
                @error('subject')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Row 3: Message --}}
            <div class="form-field form-field--textarea">
                <label for="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    placeholder="Tell us what's on your mind..."
                    maxlength="2000"
                >{{ old('message') }}</textarea>
                <span class="form-field__counter" id="charCounter">0 / 2000</span>
                @error('message')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="form-submit-row">
                <p class="form-note">
                    No spam.<br>Just racing talk.
                </p>
                <button type="submit" class="btn-submit" id="submitBtn">
                    Send Message
                    <svg viewBox="0 0 16 16">
                        <line x1="2" y1="8" x2="14" y2="8"/>
                        <polyline points="9,3 14,8 9,13"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>

</div>

@include('home._footer')
@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ── Char counter ── */
    const textarea = document.getElementById('message');
    const counter  = document.getElementById('charCounter');

    if (textarea && counter) {
        const update = () => {
            const len = textarea.value.length;
            counter.textContent = `${len} / 2000`;
            counter.classList.toggle('warn', len > 1800);
        };
        textarea.addEventListener('input', update);
        update();
    }

    /* ── Submit loading state ── */
    const form      = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form && submitBtn) {
        form.addEventListener('submit', () => {
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Sending...';
        });
    }

    /* ── Hero title entrance ── */
    const title = document.querySelector('.contact-hero__title');
    if (title) {
        title.style.opacity = '0';
        title.style.transform = 'translateY(40px)';
        title.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        requestAnimationFrame(() => {
            setTimeout(() => {
                title.style.opacity = '1';
                title.style.transform = 'translateY(0)';
            }, 100);
        });
    }

    /* ── Stagger info blocks on scroll ── */
    const blocks = document.querySelectorAll('.contact-info__block, .contact-stat');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'translateY(0)';
                }, i * 100);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.2 });

    blocks.forEach(b => {
        b.style.opacity = '0';
        b.style.transform = 'translateY(24px)';
        b.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        obs.observe(b);
    });
});
</script>