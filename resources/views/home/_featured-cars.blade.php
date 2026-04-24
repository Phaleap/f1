@if($featuredCars->isNotEmpty())
{{-- ─── Featured Cars — Pinned Horizontal Scroll ─────────────────── --}}
<section id="featured-cars-section">
    <div id="cars-sticky">

        {{-- Top border line --}}
        <div class="fc-top-line"></div>

        {{-- Section header — inline with track, not absolute --}}
        <div class="fc-header">
            <div>
                <p class="section-eyebrow">Formula One Machines</p>
                <h2 class="section-title">FEATURED <span>CARS</span></h2>
            </div>
            <div class="fc-header-right">
                <p class="fc-sub">Drag or scroll to explore</p>
                <div class="fc-progress-wrap">
                    <div class="fc-progress-bar">
                        <div id="fc-progress-fill"></div>
                    </div>
                    <div class="fc-progress-label">
                        <span id="fc-current">01</span><span class="fc-sep"> / </span><span>0{{ $featuredCars->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Horizontal track --}}
        <div id="cars-track-wrap">
            <div id="cars-track">

                @foreach($featuredCars as $i => $car)
                <div class="car-card" data-index="{{ $i }}">

                    {{-- Full-bleed image --}}
                    <div class="car-card-img">
                        @if($car->mainImage)
                            <img src="{{ asset('storage/' . $car->mainImage->image_url) }}"
                                 alt="{{ $car->mainImage->alt_text ?? $car->product_name }}"
                                 loading="lazy">
                        @else
                            <div class="car-img-placeholder">
                                <span>NO IMAGE</span>
                            </div>
                        @endif
                        {{-- Gradient overlay --}}
                        <div class="car-img-overlay"></div>
                        {{-- Red glow floor --}}
                        <div class="car-glow"></div>
                        {{-- Card number watermark --}}
                        <div class="car-watermark">0{{ $i + 1 }}</div>
                    </div>

                    {{-- Info bar (always visible) --}}
                    <div class="car-card-base">
                        <div class="car-name-wrap">
                            @if($car->carModel?->team)
                                <span class="car-team">{{ $car->carModel->team->team_name }}</span>
                            @endif
                            <h3 class="car-name">{{ $car->product_name }}</h3>
                        </div>
                        <div class="car-price">
                            <span>$</span>{{ number_format($car->base_price, 0) }}
                        </div>
                    </div>

                    {{-- Specs overlay — slides up on hover --}}
                    <div class="car-specs-overlay">
                        <div class="car-specs-grid">
                            @if($car->carModel?->horsepower)
                            <div class="spec-item">
                                <div class="spec-val">{{ $car->carModel->horsepower }}<span>HP</span></div>
                                <div class="spec-label">Horsepower</div>
                            </div>
                            @endif
                            @if($car->carModel?->top_speed)
                            <div class="spec-item">
                                <div class="spec-val">{{ number_format($car->carModel->top_speed, 0) }}<span>KM/H</span></div>
                                <div class="spec-label">Top Speed</div>
                            </div>
                            @endif
                            @if($car->carModel?->engine)
                            <div class="spec-item spec-item--wide">
                                <div class="spec-val spec-val--sm">{{ $car->carModel->engine }}</div>
                                <div class="spec-label">Engine</div>
                            </div>
                            @endif
                            @if($car->carModel?->driver)
                            <div class="spec-item spec-item--wide">
                                <div class="spec-val spec-val--sm">{{ $car->carModel->driver->driver_name }}</div>
                                <div class="spec-label">Driver</div>
                            </div>
                            @endif
                        </div>

                        <div class="spec-footer">
                            @if($car->carModel?->season_year)
                            <div class="spec-season">{{ $car->carModel->season_year }} SEASON</div>
                            @endif
                            <a href="{{ route('shop', $car) }}" class="btn-primary car-cta">
                                Configure &amp; Buy
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>{{-- /cars-track --}}
        </div>{{-- /cars-track-wrap --}}

    </div>{{-- /cars-sticky --}}
</section>

<style>
/* ─────────────────────────────────────────
   FEATURED CARS
───────────────────────────────────────── */
#featured-cars-section {
    position: relative;
}

#cars-sticky {
    position: sticky;
    top: 28px; /* ticker offset */
    height: calc(100vh - 28px);
    overflow: hidden;
    background: var(--dark);
    display: flex;
    flex-direction: column;
    padding: 48px 0 40px;
    gap: 28px;
}

.fc-top-line {
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.25), transparent);
}

/* ── Header ── */
.fc-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding: 0 60px;
    flex-shrink: 0;
}
.fc-header .section-title {
    margin-bottom: 0;
    line-height: 0.9;
}
.fc-header .section-title span { color: var(--red); }

.fc-header-right {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
}
.fc-sub {
    font-size: 0.58rem;
    letter-spacing: 5px;
    color: rgba(240,237,232,0.2);
    text-transform: uppercase;
}

/* Progress */
.fc-progress-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
}
.fc-progress-bar {
    width: 160px;
    height: 1px;
    background: rgba(255,255,255,0.08);
}
#fc-progress-fill {
    height: 100%;
    background: var(--red);
    width: 0%;
    transition: width 0.15s linear;
    box-shadow: 0 0 8px rgba(225,6,0,0.6);
}
.fc-progress-label {
    font-size: 0.52rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.2);
    text-transform: uppercase;
    white-space: nowrap;
}
#fc-current { color: var(--red); }
.fc-sep { color: rgba(240,237,232,0.1); margin: 0 2px; }

/* ── Track ── */
#cars-track-wrap {
    flex: 1;
    overflow: hidden;
    padding: 0 60px;
    min-height: 0;
}

#cars-track {
    display: flex;
    gap: 16px;
    height: 100%;
    width: max-content;
    will-change: transform;
    cursor: grab;
    align-items: stretch;
}
#cars-track.is-dragging { cursor: grabbing; }

/* ── Card ── */
.car-card {
    /* Width = roughly show 2.3 cards so user knows there's more */
    width: calc((100vw - 120px - 16px * 2) / 2.3);
    min-width: 340px;
    max-width: 520px;
    flex-shrink: 0;
    background: #0c0c0c;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.05);
    transition: border-color 0.4s;
    display: flex;
    flex-direction: column;
}
.car-card:hover {
    border-color: rgba(225,6,0,0.3);
}
/* Red top bar */
.car-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.45s ease;
    z-index: 6;
}
.car-card:hover::before { transform: scaleX(1); }

/* ── Image ── */
.car-card-img {
    flex: 1;
    position: relative;
    overflow: hidden;
    background: #111;
    min-height: 0;
}
.car-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease, filter 0.5s ease;
    filter: grayscale(25%) brightness(0.75);
}
.car-card:hover .car-card-img img {
    transform: scale(1.07);
    filter: grayscale(0%) brightness(0.95);
}
.car-img-placeholder {
    width: 100%; height: 100%;
    min-height: 300px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.55rem; letter-spacing: 6px;
    color: rgba(255,255,255,0.05); text-transform: uppercase;
}

/* Overlays */
.car-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        to bottom,
        transparent 40%,
        rgba(5,5,5,0.5) 70%,
        rgba(5,5,5,0.9) 100%
    );
    z-index: 2;
    transition: background 0.4s;
}
.car-card:hover .car-img-overlay {
    background: linear-gradient(
        to bottom,
        transparent 30%,
        rgba(5,5,5,0.6) 65%,
        rgba(5,5,5,0.97) 100%
    );
}

.car-glow {
    position: absolute;
    bottom: 0; left: 50%;
    transform: translateX(-50%);
    width: 90%; height: 140px;
    background: radial-gradient(ellipse at bottom, rgba(225,6,0,0.25) 0%, transparent 70%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.5s;
    z-index: 3;
}
.car-card:hover .car-glow { opacity: 1; }

/* Watermark number */
.car-watermark {
    position: absolute;
    top: 16px; right: 20px;
    font-family: 'Bebas Neue', cursive;
    font-size: 5rem;
    color: rgba(255,255,255,0.04);
    letter-spacing: 4px;
    line-height: 1;
    z-index: 2;
    pointer-events: none;
    transition: color 0.3s;
}
.car-card:hover .car-watermark {
    color: rgba(225,6,0,0.06);
}

/* ── Base info bar ── */
.car-card-base {
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    border-top: 1px solid rgba(255,255,255,0.05);
    background: #0c0c0c;
    transition: opacity 0.3s, transform 0.3s;
    flex-shrink: 0;
    position: relative;
    z-index: 5;
}
.car-card:hover .car-card-base {
    opacity: 0;
    transform: translateY(4px);
}

.car-name-wrap { min-width: 0; }
.car-team {
    display: block;
    font-size: 0.48rem;
    letter-spacing: 5px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 4px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.car-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.3rem;
    letter-spacing: 3px;
    line-height: 1;
    color: var(--off-white);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.car-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 1px;
    color: var(--off-white);
    flex-shrink: 0;
}
.car-price span {
    font-size: 0.8rem;
    color: var(--red);
    margin-right: 1px;
}

/* ── Specs overlay ── */
.car-specs-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: rgba(5,5,5,0.97);
    backdrop-filter: blur(16px);
    padding: 24px;
    transform: translateY(100%);
    transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 10;
    border-top: 1px solid rgba(225,6,0,0.2);
}
.car-card:hover .car-specs-overlay {
    transform: translateY(0);
}

.car-specs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px 12px;
    margin-bottom: 20px;
}
.spec-item--wide {
    grid-column: span 1;
}
.spec-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    letter-spacing: 2px;
    line-height: 1;
    color: var(--off-white);
}
.spec-val span {
    font-size: 0.65rem;
    color: var(--red);
    letter-spacing: 2px;
    margin-left: 3px;
}
.spec-val--sm {
    font-size: 0.95rem;
    letter-spacing: 1.5px;
    padding-top: 5px;
    line-height: 1.3;
}
.spec-label {
    font-size: 0.48rem;
    letter-spacing: 5px;
    color: rgba(240,237,232,0.2);
    text-transform: uppercase;
    margin-top: 4px;
}

.spec-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    border-top: 1px solid rgba(255,255,255,0.04);
    padding-top: 16px;
}
.spec-season {
    font-size: 0.48rem;
    letter-spacing: 6px;
    color: rgba(225,6,0,0.45);
    text-transform: uppercase;
}
.car-cta {
    pointer-events: all;
    font-size: 0.62rem;
    padding: 10px 24px;
    white-space: nowrap;
}

/* ─── Responsive ─── */
@media (max-width: 768px) {
    #featured-cars-section { height: auto !important; }
    #cars-sticky {
        position: relative;
        top: 0;
        height: auto;
        padding: 60px 0 48px;
    }
    .fc-header { padding: 0 24px; flex-direction: column; align-items: flex-start; gap: 16px; }
    .fc-header-right { align-items: flex-start; }
    #cars-track-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; padding: 0 24px; }
    #cars-track { height: 420px; gap: 12px; }
    .car-card { width: 280px; min-width: 280px; }
    .car-specs-overlay { transform: translateY(0); }
    .car-card-base { display: none; }
    .fc-top-line { left: 24px; right: 24px; }
}
</style>

<script>
(function () {
    const section = document.getElementById('featured-cars-section');
    const sticky  = document.getElementById('cars-sticky');
    const wrap    = document.getElementById('cars-track-wrap');
    const track   = document.getElementById('cars-track');
    const fill    = document.getElementById('fc-progress-fill');
    const current = document.getElementById('fc-current');

    if (!track || !section || !sticky) return;

    const cards = track.querySelectorAll('.car-card');
    const total = cards.length;

    // Mobile: native scroll only
    if (window.innerWidth <= 768) return;

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);

    // ── Section height = controls how long it stays pinned ──
    function getMaxX() {
        return track.scrollWidth - wrap.offsetWidth;
    }

    function setSectionHeight() {
        // Pin duration = how far cards need to travel + 100px buffer
        const scrollDist = getMaxX() + 100;
        section.style.height = (sticky.offsetHeight + scrollDist) + 'px';
    }

    setSectionHeight();

    // ── Update UI ──
    function updateUI(progress) {
        if (fill)   fill.style.width = (progress * 100) + '%';
        if (current) {
            const idx = Math.min(total - 1, Math.floor(progress * total));
            current.textContent = String(idx + 1).padStart(2, '0');
        }
    }

    // ── ScrollTrigger pin + horizontal move ──
    ScrollTrigger.create({
        trigger: section,
        start: 'top top+=28',
        end: () => '+=' + getMaxX(),
        pin: sticky,
        pinSpacing: false,
        anticipatePin: 1,
        scrub: false,
        invalidateOnRefresh: true,
        onUpdate: self => {
            const newX = -(self.progress * getMaxX());
            gsap.set(track, { x: newX });
            updateUI(self.progress);
        }
    });

    // ── Drag support ──
    let isDragging = false;
    let dragStartX = 0;
    let dragStartTrackX = 0;
    let velX = 0, prevX = 0;

    track.addEventListener('mousedown', e => {
        isDragging     = true;
        dragStartX     = e.clientX;
        dragStartTrackX = gsap.getProperty(track, 'x');
        prevX          = e.clientX;
        track.classList.add('is-dragging');
        e.preventDefault();
    });

    document.addEventListener('mousemove', e => {
        if (!isDragging) return;
        velX = e.clientX - prevX;
        prevX = e.clientX;
        const dx   = e.clientX - dragStartX;
        const newX = Math.max(-getMaxX(), Math.min(0, dragStartTrackX + dx));
        gsap.set(track, { x: newX });
        updateUI(Math.abs(newX) / getMaxX());
    });

    document.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;
        track.classList.remove('is-dragging');
        // Momentum flick
        const curX = gsap.getProperty(track, 'x');
        const newX = Math.max(-getMaxX(), Math.min(0, curX + velX * 6));
        gsap.to(track, { x: newX, duration: 0.5, ease: 'power3.out', onUpdate: () => {
            updateUI(Math.abs(gsap.getProperty(track, 'x')) / getMaxX());
        }});
    });

    // Touch
    let touchStartX = 0, touchTrackX = 0;
    track.addEventListener('touchstart', e => {
        touchStartX  = e.touches[0].clientX;
        touchTrackX  = gsap.getProperty(track, 'x');
    }, { passive: true });
    track.addEventListener('touchmove', e => {
        const dx   = e.touches[0].clientX - touchStartX;
        const newX = Math.max(-getMaxX(), Math.min(0, touchTrackX + dx));
        gsap.set(track, { x: newX });
        updateUI(Math.abs(newX) / getMaxX());
    }, { passive: true });

    // Resize
    window.addEventListener('resize', () => {
        setSectionHeight();
        ScrollTrigger.refresh();
    });
})();
</script>
@endif