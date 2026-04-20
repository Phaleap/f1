{{-- ─── Merchandise Preview — Masonry Grid ──────────────────────── --}}
<section id="products-preview">

    <div class="merch-header">
        <div>
            <p class="section-eyebrow">Shop Now</p>
            <h2 class="section-title">LATEST <span>MERCH</span></h2>
        </div>
        <a href="{{ route('products.merchandise') }}" class="btn-secondary">View All</a>
    </div>

    <div class="masonry-grid">
        @forelse($products ?? [] as $product)

            <div class="masonry-item {{ $loop->first ? 'masonry-item--featured' : '' }}">
                <a href="{{ route('products.show', $product) }}" class="masonry-link">

                    {{-- Image --}}
                    <div class="masonry-img">
                        @if($product->mainImage)
                            <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                 alt="{{ $product->product_name }}"
                                 loading="lazy">
                        @else
                            <div class="masonry-img-placeholder">No Image</div>
                        @endif
                        <div class="masonry-img-overlay"></div>
                    </div>

                    {{-- Badge --}}
                    <div class="masonry-badge">F1 Official</div>

                    {{-- Info --}}
                    <div class="masonry-info">
                        <div class="masonry-tag">F1 Official</div>
                        <div class="masonry-bottom">
                            <h3 class="masonry-name">{{ $product->product_name }}</h3>
                            <div class="masonry-price">
                                <span>$</span>{{ number_format($product->base_price, 2) }}
                            </div>
                        </div>
                    </div>

                    {{-- Hover CTA --}}
                    <div class="masonry-cta">
                        <span>Shop Now</span>
                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                            <path d="M1 7h12M7 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
                        </svg>
                    </div>

                </a>
            </div>

        @empty

            {{-- Skeleton placeholders --}}
            @for($s = 0; $s < 4; $s++)
                <div class="masonry-item {{ $s === 0 ? 'masonry-item--featured' : '' }} masonry-skeleton"
                     style="opacity:0.35; pointer-events:none;">
                    <div class="masonry-img" style="position:absolute;inset:0;background:#0f0f0f;"></div>
                    <div class="masonry-info">
                        <div class="masonry-bottom">
                            <div class="skel-bar" style="width:140px;height:14px;"></div>
                            <div class="skel-bar" style="width:70px;height:22px;"></div>
                        </div>
                    </div>
                </div>
            @endfor

        @endforelse
    </div>

</section>

<style>
/* ─────────────────────────────────────────
   MERCHANDISE — MASONRY
───────────────────────────────────────── */
#products-preview {
    padding: 120px 60px;
    background: var(--dark);
    position: relative;
}
#products-preview::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.2), transparent);
}

/* ── Header ── */
.merch-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 48px;
}
.merch-header .section-title { margin-bottom: 0; }
.merch-header .section-title span { color: var(--red); }

/* ── Grid ──
   Layout:
   [ FEATURED (tall, col 1, spans 2 rows) ] [ item 2 ]
                                             [ item 3 ]
                                             [ item 4 ]  ← spans 2 cols
*/
.masonry-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr;
    grid-template-rows: 320px 280px;
    gap: 4px;
    max-width: 1400px;
}

/* Featured: col 1, spans both rows */
.masonry-item--featured {
    grid-column: 1;
    grid-row: 1 / 3;
}

/* Item 2 */
.masonry-item:nth-child(2) {
    grid-column: 2;
    grid-row: 1;
}

/* Item 3 */
.masonry-item:nth-child(3) {
    grid-column: 3;
    grid-row: 1;
}

/* Item 4: spans bottom 2 cols */
.masonry-item:nth-child(4) {
    grid-column: 2 / 4;
    grid-row: 2;
}

/* ── Card ── */
.masonry-item {
    position: relative;
    overflow: hidden;
    background: #0c0c0c;
    opacity: 0;
    transform: translateY(28px);
    transition: border-color 0.4s;
}
.masonry-link {
    display: block;
    width: 100%; height: 100%;
    text-decoration: none;
    color: inherit;
    position: relative;
}

/* Red top line on hover */
.masonry-item::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
    z-index: 6;
}
.masonry-item:hover::before { transform: scaleX(1); }

/* ── Image ── */
.masonry-img {
    position: absolute;
    inset: 0;
}
.masonry-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease, filter 0.5s ease;
    filter: grayscale(20%) brightness(0.65);
}
.masonry-item:hover .masonry-img img {
    transform: scale(1.08);
    filter: grayscale(0%) brightness(0.85);
}
.masonry-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        to top,
        rgba(5,5,5,0.95) 0%,
        rgba(5,5,5,0.3) 50%,
        transparent 100%
    );
    transition: background 0.4s;
    z-index: 1;
}
.masonry-item:hover .masonry-img-overlay {
    background: linear-gradient(
        to top,
        rgba(5,5,5,0.98) 0%,
        rgba(5,5,5,0.5) 55%,
        rgba(225,6,0,0.04) 100%
    );
}
.masonry-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.52rem; letter-spacing: 6px;
    color: rgba(255,255,255,0.05); text-transform: uppercase;
}

/* ── Badge (top-left corner) ── */
.masonry-badge {
    position: absolute;
    top: 16px; left: 16px;
    font-size: 0.45rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--red);
    border: 1px solid rgba(225,6,0,0.25);
    background: rgba(225,6,0,0.08);
    padding: 4px 10px;
    z-index: 5;
    opacity: 0;
    transform: translateY(-4px);
    transition: opacity 0.3s, transform 0.3s;
}
.masonry-item:hover .masonry-badge {
    opacity: 1;
    transform: translateY(0);
}

/* ── Info (bottom) ── */
.masonry-info {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 24px;
    z-index: 4;
}
.masonry-tag {
    font-size: 0.48rem;
    letter-spacing: 5px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 8px;
    opacity: 0;
    transform: translateY(6px);
    transition: opacity 0.3s 0.06s, transform 0.3s 0.06s;
}
.masonry-item:hover .masonry-tag {
    opacity: 1;
    transform: translateY(0);
}
.masonry-bottom {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 10px;
}
.masonry-name {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.1rem, 1.6vw, 1.5rem);
    letter-spacing: 3px;
    line-height: 1.1;
    color: var(--off-white);
    max-width: 60%;
}
.masonry-price {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.8rem;
    letter-spacing: 1px;
    color: var(--off-white);
    white-space: nowrap;
    flex-shrink: 0;
}
.masonry-price span {
    font-size: 0.75rem;
    color: var(--red);
    margin-right: 2px;
}

/* ── Hover CTA ── */
.masonry-cta {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, calc(-50% + 14px));
    opacity: 0;
    transition: opacity 0.3s, transform 0.3s;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: #fff;
    background: var(--red);
    padding: 12px 28px;
    z-index: 5;
    white-space: nowrap;
    pointer-events: none;
}
.masonry-item:hover .masonry-cta {
    opacity: 1;
    transform: translate(-50%, -50%);
    pointer-events: all;
}
.masonry-cta:hover {
    background: var(--red-glow);
    box-shadow: 0 0 30px rgba(225,6,0,0.3);
}

/* ── Skeleton ── */
.skel-bar {
    background: #1a1a1a;
    border-radius: 1px;
    animation: skel-pulse 1.5s ease-in-out infinite;
}
@keyframes skel-pulse {
    0%, 100% { opacity: 0.4; }
    50%       { opacity: 0.7; }
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .masonry-grid {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 300px 260px 260px;
    }
    .masonry-item--featured { grid-column: 1; grid-row: 1 / 3; }
    .masonry-item:nth-child(2) { grid-column: 2; grid-row: 1; }
    .masonry-item:nth-child(3) { grid-column: 2; grid-row: 2; }
    .masonry-item:nth-child(4) { grid-column: 1 / 3; grid-row: 3; }
}

@media (max-width: 768px) {
    #products-preview { padding: 80px 24px; }
    #products-preview::before { left: 24px; right: 24px; }
    .merch-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .masonry-grid {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(4, 260px);
    }
    .masonry-item--featured,
    .masonry-item:nth-child(2),
    .masonry-item:nth-child(3),
    .masonry-item:nth-child(4) {
        grid-column: 1;
        grid-row: auto;
    }
}
</style>

<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);

    // Staggered entrance per item
    gsap.utils.toArray('.masonry-item').forEach((item, i) => {
        gsap.to(item, {
            opacity: 1,
            y: 0,
            duration: 0.85,
            delay: i * 0.08,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: item,
                start: 'top 82%',
            }
        });
    });
})();
</script>