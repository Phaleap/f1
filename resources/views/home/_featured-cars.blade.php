@if($featuredCars->isNotEmpty())
<section id="fc-section">

    <div class="fc-eyebrow">
        <span class="fc-eyebrow-line"></span>
        <span>Formula One Machines</span>
        <span class="fc-eyebrow-line"></span>
    </div>

    <div class="fc-title-wrap">
        <h2 class="fc-title">FEATURED <em>CARS</em></h2>
        <a href="{{ route('shop') }}" class="fc-view-all">View All →</a>
    </div>

    <div class="fc-grid">
        @foreach($featuredCars as $i => $car)
        <a href="{{ route('products.show', $car) }}" class="fc-card fc-card--{{ $i % 2 === 0 ? 'even' : 'odd' }}">

            {{-- Big index number --}}
            <div class="fc-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>

            {{-- Image --}}
            <div class="fc-img-wrap">
                @if($car->mainImage)
                    <img src="{{ asset('storage/' . $car->mainImage->image_url) }}"
                         alt="{{ $car->product_name }}" loading="lazy">
                @else
                    <div class="fc-no-img">NO IMAGE</div>
                @endif
                <div class="fc-img-overlay"></div>
            </div>

            {{-- Info --}}
            <div class="fc-info">
                @if($car->carModel?->team)
                    <span class="fc-team">{{ $car->carModel->team->team_name }}</span>
                @endif
                <h3 class="fc-name">{{ $car->product_name }}</h3>
                <div class="fc-bottom">
                    <span class="fc-price">${{ number_format($car->base_price, 0) }}</span>
                    <span class="fc-cta">Configure &amp; Buy ↗</span>
                </div>
            </div>

            {{-- Specs on hover --}}
            <div class="fc-specs">
                @if($car->carModel?->season_year)
                <div class="fc-spec-item">
                    <span class="fc-spec-val">{{ $car->carModel->season_year }}</span>
                    <span class="fc-spec-label">Season</span>
                </div>
                @endif
                @if($car->carModel?->horsepower)
                <div class="fc-spec-item">
                    <span class="fc-spec-val">{{ $car->carModel->horsepower }}<small>hp</small></span>
                    <span class="fc-spec-label">Power</span>
                </div>
                @endif
                @if($car->carModel?->top_speed)
                <div class="fc-spec-item">
                    <span class="fc-spec-val">{{ number_format($car->carModel->top_speed, 0) }}<small>km/h</small></span>
                    <span class="fc-spec-label">Top Speed</span>
                </div>
                @endif
                @if($car->carModel?->driver)
                <div class="fc-spec-item">
                    <span class="fc-spec-val fc-spec-val--sm">{{ $car->carModel->driver->driver_name }}</span>
                    <span class="fc-spec-label">Driver</span>
                </div>
                @endif
            </div>

        </a>
        @endforeach
    </div>

</section>

<style>
#fc-section {
    background: var(--dark, #080808);
    padding: 100px 60px;
    position: relative;
    overflow: hidden;
}
#fc-section::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.4), transparent);
}

/* Eyebrow */
.fc-eyebrow {
    display: flex;
    align-items: center;
    gap: 16px;
    justify-content: center;
    font-size: 0.5rem;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
    margin-bottom: 24px;
}
.fc-eyebrow-line {
    flex: 1;
    max-width: 80px;
    height: 1px;
    background: rgba(255,255,255,0.1);
}

/* Title */
.fc-title-wrap {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 60px;
}
.fc-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(4rem, 8vw, 9rem);
    letter-spacing: 6px;
    line-height: 0.9;
    color: #fff;
    margin: 0;
}
.fc-title em {
    font-style: normal;
    color: #E10600;
    -webkit-text-stroke: 0px;
}
.fc-view-all {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    padding-bottom: 4px;
    transition: color 0.2s, border-color 0.2s;
    margin-bottom: 12px;
}
.fc-view-all:hover { color: #E10600; border-color: #E10600; }

/* Grid — asymmetric stagger */
.fc-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 3px;
}

/* Card */
.fc-card {
    position: relative;
    display: block;
    text-decoration: none;
    color: inherit;
    overflow: hidden;
    background: #0a0a0a;
    aspect-ratio: 3/4;
    border: 1px solid rgba(255,255,255,0.04);
    transition: border-color 0.3s;
}
.fc-card--odd  { transform: translateY(40px); }
.fc-card--even { transform: translateY(0); }
.fc-card:hover { border-color: rgba(225,6,0,0.35); }

/* Red left bar */
.fc-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; bottom: 0;
    width: 3px;
    background: #E10600;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.4s ease;
    z-index: 10;
}
.fc-card:hover::before { transform: scaleY(1); }

/* Big index number */
.fc-num {
    position: absolute;
    top: 16px; right: 20px;
    font-family: 'Bebas Neue', cursive;
    font-size: 7rem;
    line-height: 1;
    color: rgba(255,255,255,0.04);
    letter-spacing: 4px;
    z-index: 3;
    pointer-events: none;
    transition: color 0.3s;
}
.fc-card:hover .fc-num { color: rgba(225,6,0,0.07); }

/* Image */
.fc-img-wrap {
    position: absolute;
    inset: 0;
}
.fc-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease, filter 0.4s ease;
    filter: brightness(0.5) saturate(0.8);
}
.fc-card:hover .fc-img-wrap img {
    transform: scale(1.06);
    filter: brightness(0.7) saturate(1);
}
.fc-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 30%, rgba(0,0,0,0.95) 100%);
    z-index: 1;
}
.fc-no-img {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.5rem; letter-spacing: 6px;
    color: rgba(255,255,255,0.05);
    background: #0d0d0d;
}

/* Info */
.fc-info {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 28px;
    z-index: 5;
    transition: transform 0.35s ease, opacity 0.35s ease;
}
.fc-team {
    display: block;
    font-size: 0.42rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: #E10600;
    margin-bottom: 8px;
}
.fc-name {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.4rem, 2.5vw, 2rem);
    letter-spacing: 3px;
    color: #fff;
    margin: 0 0 16px;
    line-height: 1.1;
}
.fc-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fc-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.2rem;
    letter-spacing: 2px;
    color: #fff;
}
.fc-price::before {
    content: '$';
    font-size: 0.9rem;
    color: #E10600;
    margin-right: 2px;
    vertical-align: super;
}
.fc-cta {
    font-size: 0.48rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    transition: color 0.2s;
}
.fc-card:hover .fc-cta { color: #E10600; }

/* Specs overlay */
.fc-specs {
    position: absolute;
    inset: 0;
    background: rgba(5,5,5,0.92);
    backdrop-filter: blur(12px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 24px;
    z-index: 8;
    opacity: 0;
    transition: opacity 0.35s ease;
    padding: 32px;
    border-top: 2px solid #E10600;
}
.fc-card:hover .fc-specs { opacity: 1; }
.fc-card:hover .fc-info { opacity: 0; }

.fc-spec-item {
    text-align: center;
}
.fc-spec-val {
    display: block;
    font-family: 'Bebas Neue', cursive;
    font-size: 3rem;
    letter-spacing: 3px;
    color: #fff;
    line-height: 1;
}
.fc-spec-val small {
    font-size: 0.8rem;
    color: #E10600;
    letter-spacing: 2px;
    margin-left: 4px;
}
.fc-spec-val--sm { font-size: 1.2rem; }
.fc-spec-label {
    font-size: 0.42rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.25);
    margin-top: 4px;
}

/* Responsive */
@media (max-width: 768px) {
    #fc-section { padding: 72px 20px; }
    #fc-section::before { left: 20px; right: 20px; }
    .fc-title-wrap { flex-direction: column; align-items: flex-start; gap: 16px; }
    .fc-grid { grid-template-columns: 1fr 1fr; gap: 3px; }
    .fc-card--odd, .fc-card--even { transform: none; }
    .fc-specs { opacity: 0 !important; }
    .fc-info { opacity: 1 !important; }
}
@media (max-width: 480px) {
    .fc-grid { grid-template-columns: 1fr; }
}
</style>
@endif
