@if(isset($products) && $products->isNotEmpty())
<section id="pp-section">

    {{-- Massive background text --}}
    <div class="pp-bg-text" aria-hidden="true">MERCH</div>

    <div class="pp-header">
        <div class="pp-header-left">
            <p class="pp-eyebrow">Official F1 Merchandise</p>
            <h2 class="pp-title">GEAR <em>UP</em></h2>
        </div>
        <div class="pp-header-right">
            <p class="pp-desc">Wear the passion. Official licensed<br>F1 apparel &amp; collectibles.</p>
            <a href="{{ route('shop') }}" class="pp-all-btn">
                <span>Shop All</span>
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 7h12M7 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="pp-grid">
        @foreach($products as $i => $product)
        <a href="{{ route('products.show', $product) }}"
           class="pp-card {{ $i === 0 ? 'pp-card--featured' : '' }}"
           style="--delay: {{ $i * 0.08 }}s">

            {{-- Image --}}
            <div class="pp-img">
                @if($product->mainImage)
                    <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                         alt="{{ $product->product_name }}" loading="lazy">
                @else
                    <div class="pp-no-img">
                        <svg viewBox="0 0 60 40" fill="none" width="60" opacity="0.1">
                            <rect x="5" y="5" width="50" height="30" rx="2" stroke="white" stroke-width="1.5"/>
                            <circle cx="22" cy="18" r="6" stroke="white" stroke-width="1.5"/>
                            <path d="M5 30 L18 18 L30 26 L40 18 L55 30" stroke="white" stroke-width="1.5"/>
                        </svg>
                    </div>
                @endif
                <div class="pp-img-overlay"></div>

                {{-- Quick add --}}
                <div class="pp-quick">
                    <span>Quick Add</span>
                </div>
            </div>

            {{-- Tag --}}
            <div class="pp-tag">{{ $product->category?->category_name ?? 'F1 Official' }}</div>

            {{-- Info --}}
            <div class="pp-info">
                <h3 class="pp-name">{{ $product->product_name }}</h3>
                <div class="pp-price-row">
                    @if($product->sale_price)
                        <span class="pp-price pp-price--sale">${{ number_format($product->sale_price, 0) }}</span>
                        <span class="pp-price pp-price--original">${{ number_format($product->base_price, 0) }}</span>
                    @else
                        <span class="pp-price">${{ number_format($product->base_price, 0) }}</span>
                    @endif
                    <span class="pp-arrow">↗</span>
                </div>
            </div>

        </a>
        @endforeach
    </div>

</section>

<style>
#pp-section {
    background: var(--dark, #080808);
    padding: 120px 60px;
    position: relative;
    overflow: hidden;
}
#pp-section::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.08), transparent);
}

/* Massive bg text */
.pp-bg-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(12rem, 25vw, 22rem);
    letter-spacing: 20px;
    color: rgba(255,255,255,0.018);
    pointer-events: none;
    white-space: nowrap;
    z-index: 0;
    user-select: none;
}

#pp-section > * { position: relative; z-index: 1; }

/* Header */
.pp-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 64px;
    gap: 40px;
}
.pp-eyebrow {
    font-size: 0.5rem;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: #E10600;
    margin-bottom: 12px;
}
.pp-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(4rem, 8vw, 9rem);
    letter-spacing: 6px;
    line-height: 0.9;
    color: #fff;
    margin: 0;
}
.pp-title em {
    font-style: normal;
    -webkit-text-stroke: 2px #E10600;
    color: transparent;
}
.pp-header-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 20px;
    text-align: right;
}
.pp-desc {
    font-size: 0.72rem;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.3);
    line-height: 1.8;
}
.pp-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 0.52rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    padding: 12px 24px;
    text-decoration: none;
    transition: background 0.25s, border-color 0.25s, color 0.25s;
}
.pp-all-btn:hover {
    background: #E10600;
    border-color: #E10600;
    color: #fff;
}

/* Grid */
.pp-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3px;
    align-items: start;
}

/* Stagger — odd cards push down */
.pp-card:nth-child(even) { margin-top: 48px; }

/* Card */
.pp-card {
    display: block;
    text-decoration: none;
    color: inherit;
    position: relative;
    background: #0a0a0a;
    border: 1px solid rgba(255,255,255,0.04);
    transition: border-color 0.3s, transform 0.3s;
    opacity: 0;
    transform: translateY(20px);
    animation: pp-in 0.6s ease forwards;
    animation-delay: var(--delay, 0s);
    animation-play-state: paused;
}
.pp-card.is-visible {
    animation-play-state: running;
}
@keyframes pp-in {
    to { opacity: 1; transform: translateY(0); }
}
.pp-card:hover {
    border-color: rgba(225,6,0,0.3);
    transform: translateY(-4px);
}

/* Featured card spans 2 cols */
.pp-card--featured {
    grid-column: span 2;
}

/* Image */
.pp-img {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
    background: #111;
}
.pp-card--featured .pp-img { aspect-ratio: 4/3; }

.pp-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease, filter 0.4s ease;
    filter: brightness(0.75) saturate(0.9);
}
.pp-card:hover .pp-img img {
    transform: scale(1.05);
    filter: brightness(0.9) saturate(1);
}
.pp-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.6) 100%);
    z-index: 1;
}
.pp-no-img {
    width: 100%; height: 100%;
    min-height: 200px;
    display: flex; align-items: center; justify-content: center;
    background: #0d0d0d;
}

/* Quick add overlay */
.pp-quick {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: #E10600;
    color: #fff;
    font-size: 0.48rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    text-align: center;
    padding: 12px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
    z-index: 5;
}
.pp-card:hover .pp-quick { transform: translateY(0); }

/* Tag */
.pp-tag {
    position: absolute;
    top: 16px; left: 16px;
    font-size: 0.38rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
    background: rgba(0,0,0,0.65);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(6px);
    padding: 4px 10px;
    z-index: 3;
}

/* Info */
.pp-info {
    padding: 16px 20px 20px;
    background: #0a0a0a;
}
.pp-name {
    font-size: 0.78rem;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.85);
    margin: 0 0 10px;
    line-height: 1.4;
    font-weight: 500;
}
.pp-card--featured .pp-name { font-size: 1rem; }
.pp-price-row {
    display: flex;
    align-items: center;
    gap: 10px;
}
.pp-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.4rem;
    letter-spacing: 2px;
    color: #fff;
}
.pp-price--sale { color: #E10600; }
.pp-price--original {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.3);
    text-decoration: line-through;
}
.pp-arrow {
    margin-left: auto;
    color: rgba(255,255,255,0.2);
    font-size: 1rem;
    transition: color 0.2s, transform 0.2s;
}
.pp-card:hover .pp-arrow { color: #E10600; transform: translate(2px, -2px); }

/* Responsive */
@media (max-width: 1100px) {
    .pp-grid { grid-template-columns: repeat(2, 1fr); }
    .pp-card--featured { grid-column: span 2; }
}
@media (max-width: 768px) {
    #pp-section { padding: 72px 20px; }
    #pp-section::before { left: 20px; right: 20px; }
    .pp-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .pp-header-right { align-items: flex-start; text-align: left; }
    .pp-grid { grid-template-columns: 1fr 1fr; }
    .pp-card--featured { grid-column: span 2; }
    .pp-card:nth-child(even) { margin-top: 0; }
}
@media (max-width: 480px) {
    .pp-grid { grid-template-columns: 1fr; }
    .pp-card--featured { grid-column: span 1; }
}
</style>

<script>
// Trigger animations when cards enter viewport
(function() {
    const cards = document.querySelectorAll('.pp-card');
    if (!cards.length) return;
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    cards.forEach(c => obs.observe(c));
})();
</script>
@endif
