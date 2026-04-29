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
    --accent: {{ $carRequest->product?->carModel?->team?->color ?? '#E10600' }};
}
body { background: var(--dark); }

.book-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}
.accent-strip { height: 2px; background: var(--accent); }

.breadcrumb-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 18px 48px;
    border-bottom: 1px solid var(--border);
    background: #050505;
}
.breadcrumb-bar a { font-size: 0.6rem; letter-spacing: 4px; text-transform: uppercase; color: var(--muted); text-decoration: none; }
.breadcrumb-bar a:hover { color: var(--off-white); }
.breadcrumb-sep { font-size: 0.55rem; color: rgba(255,255,255,0.1); }
.breadcrumb-current { font-size: 0.6rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); }

.book-wrap {
    max-width: 960px;
    margin: 0 auto;
    padding: 60px 48px;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 48px;
    align-items: start;
}

.section-eyebrow {
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

.section-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
    margin-bottom: 8px;
}
.section-sub { font-size: 0.82rem; color: var(--muted); line-height: 1.7; margin-bottom: 40px; }

/* Date tabs */
.date-tabs {
    display: flex;
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
    margin-bottom: 24px;
    overflow-x: auto;
    scrollbar-width: none;
}
.date-tabs::-webkit-scrollbar { display: none; }

.date-tab {
    flex-shrink: 0;
    padding: 14px 20px;
    background: #0a0a0a;
    cursor: pointer;
    text-align: center;
    transition: background 0.2s;
    border: none;
    color: var(--muted);
    font-family: 'Barlow', sans-serif;
    position: relative;
}
.date-tab::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s;
}
.date-tab.active { background: #111; color: var(--off-white); }
.date-tab.active::before { transform: scaleX(1); }
.date-tab:hover:not(.active) { background: #0d0d0d; }

.date-tab-day { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 4px; }
.date-tab-date {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 2px;
    line-height: 1;
}
.date-tab-month { font-size: 0.56rem; letter-spacing: 3px; text-transform: uppercase; margin-top: 2px; }

/* Slot grid */
.slot-panel { display: none; }
.slot-panel.active { display: block; }

.slot-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
}

.slot-btn {
    padding: 20px 16px;
    background: #0a0a0a;
    border: none;
    cursor: pointer;
    text-align: center;
    transition: background 0.2s;
    position: relative;
    font-family: 'Barlow', sans-serif;
}
.slot-btn::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s;
}
.slot-btn:hover:not(.booked):not(.selected) { background: #0d0d0d; }
.slot-btn.selected { background: #111; }
.slot-btn.selected::before { transform: scaleX(1); }
.slot-btn.booked { opacity: 0.3; cursor: not-allowed; }

.slot-time {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1;
    margin-bottom: 4px;
}
.slot-btn.booked .slot-time { text-decoration: line-through; }
.slot-status {
    font-size: 0.56rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
}
.slot-btn.selected .slot-status { color: var(--accent); }
.slot-btn.booked .slot-status { color: rgba(225,6,0,0.5); }

/* Confirm button */
.btn-confirm {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
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
    transition: opacity 0.2s;
    margin-top: 24px;
}
.btn-confirm:hover { opacity: 0.88; }
.btn-confirm:disabled { opacity: 0.3; cursor: not-allowed; }

/* Info card */
.info-card {
    border: 1px solid var(--border);
    background: #0a0a0a;
    position: sticky;
    top: 112px;
}
.info-card::before { content: ''; display: block; height: 2px; background: var(--accent); }
.info-card-body { padding: 24px; }
.info-card-label { font-size: 0.58rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 6px; }
.info-card-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.4rem;
    letter-spacing: 2px;
    color: var(--off-white);
    margin-bottom: 20px;
    line-height: 1;
}
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
}
.info-row:last-child { border-bottom: none; }
.info-key { font-size: 0.6rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); }
.info-val { font-family: 'Bebas Neue', cursive; font-size: 0.9rem; letter-spacing: 2px; color: var(--off-white); }

/* Selected summary */
.selected-summary {
    margin-top: 20px;
    padding: 16px;
    border: 1px solid rgba(255,255,255,0.08);
    background: #0d0d0d;
    display: none;
}
.selected-summary.show { display: block; }
.selected-summary-label { font-size: 0.58rem; letter-spacing: 3px; text-transform: uppercase; color: var(--muted); margin-bottom: 6px; }
.selected-summary-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

@media (max-width: 900px) {
    .book-wrap { grid-template-columns: 1fr; padding: 40px 24px; }
    .info-card { position: static; }
    .slot-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<div class="book-page">
    <div class="accent-strip"></div>

    <nav class="breadcrumb-bar">
        <a href="{{ route('shop.car-request.my-requests') }}">My Requests</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Book Appointment</span>
    </nav>

    <div class="book-wrap">

        {{-- LEFT: SLOT PICKER --}}
        <div>
            <div class="section-eyebrow">
                <span class="eyebrow-line"></span>
                Showroom Visit
            </div>
            <h1 class="section-title">Book Your Slot</h1>
            <p class="section-sub">
                Select a date and time to visit our showroom. Each slot is 2 hours 30 minutes.
                Our team will be ready to assist you with your purchase.
            </p>

            @if(session('error'))
            <div style="border:1px solid rgba(225,6,0,0.3);padding:14px 18px;margin-bottom:24px;background:rgba(225,6,0,0.05);color:var(--red);font-size:0.7rem;letter-spacing:3px;text-transform:uppercase;">
                ✕ {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('shop.appointment.store') }}" id="appointmentForm">
                @csrf
                <input type="hidden" name="request_id" value="{{ $carRequest->request_id }}">
                <input type="hidden" name="appointment_date" id="selectedSlot" value="">

                {{-- Date tabs --}}
                <div class="date-tabs" id="dateTabs">
                    @foreach($slots as $dateKey => $dateData)
                    @php $carbon = \Carbon\Carbon::parse($dateKey); @endphp
                    <button type="button"
                            class="date-tab {{ $loop->first ? 'active' : '' }}"
                            onclick="switchDate('{{ $dateKey }}', this)">
                        <div class="date-tab-day">{{ $carbon->format('D') }}</div>
                        <div class="date-tab-date">{{ $carbon->format('d') }}</div>
                        <div class="date-tab-month">{{ $carbon->format('M') }}</div>
                    </button>
                    @endforeach
                </div>

                {{-- Slot panels --}}
                @foreach($slots as $dateKey => $dateData)
                <div class="slot-panel {{ $loop->first ? 'active' : '' }}" id="panel-{{ $dateKey }}">
                    <div class="slot-grid">
                        @foreach($dateData['slots'] as $slot)
                        <button type="button"
                                class="slot-btn {{ $slot['is_booked'] ? 'booked' : '' }}"
                                data-datetime="{{ $slot['datetime'] }}"
                                onclick="{{ $slot['is_booked'] ? '' : 'selectSlot(this)' }}"
                                {{ $slot['is_booked'] ? 'disabled' : '' }}>
                            <div class="slot-time">{{ \Carbon\Carbon::parse($slot['datetime'])->format('g:i') }}<span style="font-size:0.7rem;"> {{ \Carbon\Carbon::parse($slot['datetime'])->format('A') }}</span></div>
                            <div class="slot-status">{{ $slot['is_booked'] ? 'Booked' : 'Available' }}</div>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- Confirm --}}
                <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <rect x="1" y="2" width="12" height="11" rx="1" stroke="currentColor" stroke-width="1.2"/>
                        <path d="M5 1v2M9 1v2M1 6h12" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                        <path d="M4.5 9l2 2 3-3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Confirm Appointment
                </button>
            </form>
        </div>

        {{-- RIGHT: INFO CARD --}}
        <div>
            <div class="info-card">
                <div class="info-card-body">
                    <div class="info-card-label">{{ $carRequest->product?->carModel?->team?->team_name ?? 'F1 Car' }}</div>
                    <div class="info-card-name">{{ $carRequest->product?->product_name }}</div>

                    <div class="info-row">
                        <span class="info-key">Price</span>
                        <span class="info-val">${{ number_format($carRequest->product?->base_price ?? 0, 0) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Location</span>
                        <span class="info-val" style="font-size:0.7rem;text-align:right;max-width:160px;">F1 Store Showroom</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Duration</span>
                        <span class="info-val">2h 30min</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Request</span>
                        <span class="info-val">#{{ $carRequest->request_id }}</span>
                    </div>

                    <div class="selected-summary" id="selectedSummary">
                        <div class="selected-summary-label">Your Selected Slot</div>
                        <div class="selected-summary-val" id="selectedSummaryText">—</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('home._footer')

<script>
function switchDate(dateKey, tab) {
    // Update tabs
    document.querySelectorAll('.date-tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    // Update panels
    document.querySelectorAll('.slot-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('panel-' + dateKey).classList.add('active');

    // Clear selection
    document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
    document.getElementById('selectedSlot').value = '';
    document.getElementById('confirmBtn').disabled = true;
    document.getElementById('selectedSummary').classList.remove('show');
}

function selectSlot(btn) {
    // Deselect all
    document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));

    // Select this
    btn.classList.add('selected');

    const datetime = btn.dataset.datetime;
    document.getElementById('selectedSlot').value = datetime;
    document.getElementById('confirmBtn').disabled = false;

    // Update summary
    const date = new Date(datetime);
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const timeOptions = { hour: 'numeric', minute: '2-digit', hour12: true };
    const formatted = date.toLocaleDateString('en-US', options) + ' at ' + date.toLocaleTimeString('en-US', timeOptions);
    document.getElementById('selectedSummaryText').textContent = formatted;
    document.getElementById('selectedSummary').classList.add('show');
}
</script>

@endsection