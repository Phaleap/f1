{{-- ─── Cars Preview — Automotive Showroom Grid ──────────────────────── --}}
<section id="products-preview">

    <div class="cars-header">
        <div class="cars-header__left">
            <p class="section-eyebrow">
                <span class="eyebrow-line"></span>
                Formula One Machines
            </p>
            <h2 class="section-title">FEATURED <span>CARS</span></h2>
        </div>
        <div class="cars-header__right">
            <p class="cars-subtext">Precision-engineered scale replicas. <br>Official F1 licensed collectibles.</p>
            <a href="{{ route('products.cars') }}" class="btn-view-all">
                <span>View Full Collection</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M1 8h14M8 1l7 7-7 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="cars-grid">
        @forelse($products ?? [] as $product)

            <a href="{{ route('products.show', $product) }}"
               class="car-card {{ $loop->first ? 'car-card--hero' : '' }}"
               data-index="{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}">

                {{-- Background image --}}
                <div class="car-card__img">
                    @if($product->mainImage)
                        <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                             alt="{{ $product->product_name }}"
                             loading="lazy">
                    @else
                        <div class="car-card__img-placeholder">
                            <svg viewBox="0 0 80 30" fill="none" xmlns="http://www.w3.org/2000/svg" width="80" opacity="0.12">
                                <path d="M5 22 L15 10 L30 8 L50 8 L65 10 L75 22 L5 22Z" fill="white"/>
                                <ellipse cx="20" cy="23" rx="5" ry="5" fill="white"/>
                                <ellipse cx="60" cy="23" rx="5" ry="5" fill="white"/>
                            </svg>
                        </div>
                    @endif
                    <div class="car-card__track-lines"></div>
                    <div class="car-card__gradient"></div>
                </div>

                {{-- Number tag --}}
                <div class="car-card__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

                {{-- Team badge --}}
                <div class="car-card__team">F1 Official</div>

                {{-- Body --}}
                <div class="car-card__body">
                    <div class="car-card__meta">
                        <span class="car-card__scale">Scale 1:18</span>
                        <span class="car-card__dot">·</span>
                        <span class="car-card__year">2024</span>
                    </div>
                    <h3 class="car-card__name">{{ $product->product_name }}</h3>

                    {{-- Spec bar — visible on hero, revealed on hover for others --}}
                    <div class="car-card__specs">
                        <div class="spec-item">
                            <span class="spec-label">Material</span>
                            <span class="spec-val">Die-Cast</span>
                        </div>
                        <div class="spec-divider"></div>
                        <div class="spec-item">
                            <span class="spec-label">Edition</span>
                            <span class="spec-val">Limited</span>
                        </div>
                        <div class="spec-divider"></div>
                        <div class="spec-item">
                            <span class="spec-label">Series</span>
                            <span class="spec-val">2024</span>
                        </div>
                    </div>

                    <div class="car-card__footer">
                        <div class="car-card__price">
                            <span class="price-currency">$</span>
                            <span class="price-amount">{{ number_format($product->base_price, 0) }}</span>
                            <span class="price-cents">.{{ substr(number_format($product->base_price, 2), -2) }}</span>
                        </div>
                        <div class="car-card__cta">
                            <span>Configure</span>
                            <svg width="10" height="10" viewBox="0 0 14 14" fill="none">
                                <path d="M1 7h12M7 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Hover rpm gauge decoration --}}
                <div class="car-card__rpm">
                    <svg viewBox="0 0 100 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 55 A45 45 0 0 1 95 55" stroke="rgba(255,255,255,0.06)" stroke-width="1.5" fill="none"/>
                        <path d="M5 55 A45 45 0 0 1 95 55" stroke="var(--red)" stroke-width="1.5" fill="none"
                              stroke-dasharray="141" stroke-dashoffset="141" class="rpm-arc"/>
                        <text x="50" y="42" text-anchor="middle" fill="rgba(255,255,255,0.2)" font-size="7" letter-spacing="2" font-family="monospace">RPM</text>
                        <text x="50" y="52" text-anchor="middle" fill="rgba(255,255,255,0.15)" font-size="5" letter-spacing="1" font-family="monospace">15,000</text>
                    </svg>
                </div>

            </a>

        @empty

            {{-- Skeleton placeholders --}}
            @for($s = 0; $s < 4; $s++)
                <div class="car-card {{ $s === 0 ? 'car-card--hero' : '' }} car-card--skeleton">
                    <div class="car-card__img" style="background:#0d0d0d;"></div>
                    <div class="car-card__body">
                        <div class="car-card__meta">
                            <div class="skel-bar" style="width:80px; height:10px;"></div>
                        </div>
                        <div class="skel-bar" style="width:200px; height:22px; margin-top:10px;"></div>
                        <div class="car-card__footer" style="margin-top:auto;">
                            <div class="skel-bar" style="width:90px; height:28px;"></div>
                            <div class="skel-bar" style="width:100px; height:36px;"></div>
                        </div>
                    </div>
                </div>
            @endfor

        @endforelse
    </div>

</section>

<style>
/* ─────────────────────────────────────────
   F1 CARS — AUTOMOTIVE SHOWROOM GRID
───────────────────────────────────────── */

#products-preview {
    padding: 120px 60px;
    background: var(--dark);
    position: relative;
    overflow: hidden;
}

/* Subtle grid texture background */
#products-preview::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
    z-index: 0;
}

/* Top separator */
#products-preview::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.35), transparent);
    z-index: 1;
}

#products-preview > * { position: relative; z-index: 2; }

/* ── Header ── */
.cars-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 56px;
    gap: 40px;
}

.cars-header__left .section-eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--red);
    font-size: 0.52rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.eyebrow-line {
    display: inline-block;
    width: 32px;
    height: 1px;
    background: var(--red);
    flex-shrink: 0;
}

.cars-header .section-title {
    font-size: clamp(2.8rem, 5vw, 4.5rem);
    margin: 0;
    line-height: 0.9;
    letter-spacing: 4px;
}
.cars-header .section-title span { color: var(--red); }

.cars-header__right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 20px;
    text-align: right;
}

.cars-subtext {
    font-size: 0.75rem;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.35);
    line-height: 1.7;
}

.btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 0.55rem;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--off-white);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 13px 24px;
    text-decoration: none;
    transition: border-color 0.3s, background 0.3s, color 0.3s;
}
.btn-view-all:hover {
    border-color: var(--red);
    background: var(--red);
    color: #fff;
}

/* ── Grid Layout ──
   Hero card: left column, full height
   3 smaller cards: right column stacked
*/
.cars-grid {
    display: grid;
    grid-template-columns: 1.55fr 1fr;
    grid-template-rows: auto;
    gap: 3px;
    max-width: 1400px;
}

/* Hero takes full left column spanning all rows */
.car-card--hero {
    grid-column: 1;
    grid-row: 1 / 4;
    min-height: 680px;
}

/* Right column cards */
.car-card:nth-child(2) { grid-column: 2; grid-row: 1; }
.car-card:nth-child(3) { grid-column: 2; grid-row: 2; }
.car-card:nth-child(4) { grid-column: 2; grid-row: 3; }

/* ── Card Base ── */
.car-card {
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    background: #0a0a0a;
    text-decoration: none;
    color: inherit;
    border: 1px solid rgba(255,255,255,0.04);
    opacity: 0;
    transform: translateY(24px);
    transition:
        border-color 0.4s ease,
        transform 0.3s ease;
    min-height: 220px;
}

.car-card:hover {
    border-color: rgba(225,6,0,0.3);
    transform: translateY(-2px);
}

/* Red left accent bar on hover */
.car-card::before {
    content: '';
    position: absolute;
    top: 0; bottom: 0; left: 0;
    width: 2px;
    background: var(--red);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.45s ease;
    z-index: 10;
}
.car-card:hover::before { transform: scaleY(1); }

/* ── Image ── */
.car-card__img {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.car-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 40%;
    transition: transform 0.9s ease, filter 0.5s ease;
    filter: brightness(0.55) saturate(0.85);
}

.car-card:hover .car-card__img img {
    transform: scale(1.06);
    filter: brightness(0.72) saturate(1);
}

/* Gradient — stronger at bottom for text legibility */
.car-card__gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(0,0,0,0.1) 0%,
        rgba(0,0,0,0.15) 35%,
        rgba(0,0,0,0.75) 65%,
        rgba(0,0,0,0.97) 100%
    );
    z-index: 1;
}

/* Track line decoration */
.car-card__track-lines {
    position: absolute;
    inset: 0;
    z-index: 2;
    opacity: 0;
    transition: opacity 0.4s;
    background-image: repeating-linear-gradient(
        -55deg,
        transparent,
        transparent 18px,
        rgba(225,6,0,0.025) 18px,
        rgba(225,6,0,0.025) 19px
    );
}
.car-card:hover .car-card__track-lines { opacity: 1; }

/* Placeholder icon */
.car-card__img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: #0c0c0c;
}

/* ── Number Tag ── */
.car-card__number {
    position: absolute;
    top: 20px;
    right: 20px;
    font-family: 'Bebas Neue', cursive;
    font-size: 4rem;
    line-height: 1;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.06);
    z-index: 3;
    transition: color 0.4s, opacity 0.4s;
    pointer-events: none;
}
.car-card--hero .car-card__number {
    font-size: 9rem;
    color: rgba(255,255,255,0.04);
}
.car-card:hover .car-card__number {
    color: rgba(225,6,0,0.08);
}

/* ── Team Badge ── */
.car-card__team {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 0.42rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.7);
    background: rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(6px);
    padding: 5px 12px;
    z-index: 5;
    transition: border-color 0.3s, color 0.3s;
}
.car-card:hover .car-card__team {
    border-color: rgba(225,6,0,0.4);
    color: #fff;
}

/* ── Body (text content at bottom) ── */
.car-card__body {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 28px;
    z-index: 5;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.car-card--hero .car-card__body { padding: 36px; }

/* Meta line */
.car-card__meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}
.car-card__scale,
.car-card__year {
    font-size: 0.48rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--red);
}
.car-card__dot {
    color: rgba(255,255,255,0.2);
    font-size: 0.6rem;
}

/* Name */
.car-card__name {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.3rem, 2vw, 1.9rem);
    letter-spacing: 3px;
    line-height: 1.05;
    color: #fff;
    margin: 0 0 16px 0;
}
.car-card--hero .car-card__name {
    font-size: clamp(1.8rem, 2.8vw, 2.8rem);
    margin-bottom: 20px;
}

/* ── Specs bar ── */
.car-card__specs {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 20px;
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transition: max-height 0.4s ease, opacity 0.3s ease 0.05s, margin 0.3s;
}

/* Always visible on hero */
.car-card--hero .car-card__specs {
    max-height: 60px;
    opacity: 1;
}

.car-card:not(.car-card--hero):hover .car-card__specs {
    max-height: 60px;
    opacity: 1;
}

.spec-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
    padding: 10px 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    flex: 1;
    min-width: 0;
}
.spec-label {
    font-size: 0.38rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.35);
}
.spec-val {
    font-size: 0.6rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.75);
    font-weight: 600;
}
.spec-divider {
    width: 1px;
    align-self: stretch;
    background: rgba(255,255,255,0.06);
}

/* ── Footer: price + CTA ── */
.car-card__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

/* Price */
.car-card__price {
    display: flex;
    align-items: baseline;
    gap: 2px;
    line-height: 1;
}
.price-currency {
    font-size: 0.8rem;
    color: var(--red);
    letter-spacing: 1px;
    margin-right: 1px;
    align-self: flex-start;
    padding-top: 4px;
}
.price-amount {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.4rem;
    letter-spacing: 2px;
    color: #fff;
}
.price-cents {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    color: rgba(255,255,255,0.4);
    align-self: flex-end;
    padding-bottom: 4px;
}
.car-card--hero .price-amount { font-size: 3.2rem; }

/* CTA button */
.car-card__cta {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--red);
    color: #fff;
    font-size: 0.5rem;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
    padding: 12px 20px;
    white-space: nowrap;
    opacity: 0;
    transform: translateX(8px);
    transition: opacity 0.3s, transform 0.3s, background 0.2s;
    pointer-events: none;
}
.car-card:hover .car-card__cta {
    opacity: 1;
    transform: translateX(0);
    pointer-events: all;
}
.car-card__cta:hover {
    background: #ff2a1a;
}
.car-card--hero .car-card__cta {
    padding: 14px 28px;
    font-size: 0.55rem;
}

/* ── RPM Gauge Decoration ── */
.car-card__rpm {
    position: absolute;
    bottom: 80px;
    right: 24px;
    width: 80px;
    opacity: 0;
    transition: opacity 0.5s 0.1s;
    z-index: 4;
    pointer-events: none;
}
.car-card:hover .car-card__rpm { opacity: 1; }
.rpm-arc {
    transition: stroke-dashoffset 0.9s ease;
}
.car-card:hover .rpm-arc { stroke-dashoffset: 35; }

/* ── Skeleton ── */
.car-card--skeleton { pointer-events: none; opacity: 0.3 !important; }
.skel-bar {
    background: #1c1c1c;
    border-radius: 1px;
    animation: skel-pulse 1.6s ease-in-out infinite;
}
@keyframes skel-pulse {
    0%, 100% { opacity: 0.3; }
    50%       { opacity: 0.6; }
}

/* ── Responsive ── */
@media (max-width: 1100px) {
    .cars-grid {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 400px 250px 250px;
    }
    .car-card--hero {
        grid-column: 1 / 3;
        grid-row: 1;
        min-height: 400px;
    }
    .car-card:nth-child(2) { grid-column: 1; grid-row: 2; }
    .car-card:nth-child(3) { grid-column: 2; grid-row: 2; }
    .car-card:nth-child(4) { grid-column: 1 / 3; grid-row: 3; }
}

@media (max-width: 768px) {
    #products-preview { padding: 72px 20px; }
    #products-preview::before { left: 20px; right: 20px; }

    .cars-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .cars-header__right { align-items: flex-start; text-align: left; }

    .cars-grid {
        grid-template-columns: 1fr;
        grid-template-rows: 320px 260px 260px 260px;
    }
    .car-card--hero,
    .car-card:nth-child(2),
    .car-card:nth-child(3),
    .car-card:nth-child(4) {
        grid-column: 1;
        grid-row: auto;
        min-height: 260px;
    }
    .car-card--hero { min-height: 320px; }

    .car-card__cta { opacity: 1; transform: translateX(0); }
    .car-card__specs { max-height: 60px; opacity: 1; }
}
</style>

<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);

    // Hero enters first with a cinematic reveal
    const hero = document.querySelector('.car-card--hero');
    if (hero) {
        gsap.to(hero, {
            opacity: 1, y: 0,
            duration: 1.1,
            ease: 'power4.out',
            scrollTrigger: { trigger: hero, start: 'top 85%' }
        });
    }

    // Remaining cards stagger in
    gsap.utils.toArray('.car-card:not(.car-card--hero)').forEach((card, i) => {
        gsap.to(card, {
            opacity: 1, y: 0,
            duration: 0.8,
            delay: i * 0.12,
            ease: 'power3.out',
            scrollTrigger: { trigger: card, start: 'top 88%' }
        });
    });
})();
</script>