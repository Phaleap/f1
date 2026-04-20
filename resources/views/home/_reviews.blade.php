{{-- ─── Social Proof — Reviews Wall ──────────────────────────────── --}}
@php
    $reviews = \App\Models\Review::with(['user', 'product.mainImage'])
        ->where('review_status', 'visible')
        ->whereNotNull('comment')
        ->where('rating', '>=', 4)
        ->latest()
        ->take(5)
        ->get();
@endphp

@if($reviews->isNotEmpty())
<section id="reviews-section">

    {{-- Top border --}}
    <div class="rv-top-line"></div>

    {{-- Header --}}
    <div class="rv-header">
        <div>
            <p class="section-eyebrow">Verified Buyers</p>
            <h2 class="section-title">WHAT THEY <span>SAY</span></h2>
        </div>
        <div class="rv-header-right">
            <div class="rv-overall">
                <div class="rv-overall-score">{{ number_format($reviews->avg('rating'), 1) }}</div>
                <div class="rv-overall-meta">
                    <div class="rv-stars-row">
                        @for($s = 1; $s <= 5; $s++)
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="{{ $s <= round($reviews->avg('rating')) ? '#e10600' : 'none' }}" stroke="#e10600" stroke-width="1">
                                <polygon points="6,1 7.5,4.5 11,4.8 8.5,7 9.3,10.5 6,8.7 2.7,10.5 3.5,7 1,4.8 4.5,4.5"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="rv-count">{{ $reviews->count() }} reviews</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <div class="rv-body">

        {{-- Featured review (left, big) --}}
        <div class="rv-featured" id="rv-featured">
            @php $featured = $reviews->first(); @endphp

            {{-- Product image background --}}
            <div class="rv-feat-bg">
                @if($featured->product?->mainImage)
                    <img src="{{ asset('storage/' . $featured->product->mainImage->image_url) }}"
                         alt="{{ $featured->product->product_name }}"
                         class="rv-feat-bg-img">
                @endif
                <div class="rv-feat-bg-overlay"></div>
            </div>

            {{-- Content --}}
            <div class="rv-feat-content">
                {{-- Stars --}}
                <div class="rv-stars">
                    @for($s = 1; $s <= 5; $s++)
                        <svg width="14" height="14" viewBox="0 0 12 12"
                             fill="{{ $s <= $featured->rating ? '#e10600' : 'none' }}"
                             stroke="#e10600" stroke-width="1">
                            <polygon points="6,1 7.5,4.5 11,4.8 8.5,7 9.3,10.5 6,8.7 2.7,10.5 3.5,7 1,4.8 4.5,4.5"/>
                        </svg>
                    @endfor
                </div>

                {{-- Big quote --}}
                <div class="rv-quote-mark">"</div>
                <blockquote class="rv-feat-quote">{{ $featured->comment }}</blockquote>

                {{-- Buyer --}}
                <div class="rv-feat-buyer">
                    <div class="rv-buyer-avatar">
                        {{ strtoupper(substr($featured->user->full_name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="rv-buyer-name">{{ $featured->user->full_name }}</div>
                        @if($featured->product)
                        <div class="rv-buyer-product">{{ $featured->product->product_name }}</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Corner brackets --}}
            <div class="rv-bracket rv-bracket--tl"></div>
            <div class="rv-bracket rv-bracket--br"></div>
        </div>

        {{-- Side stack (right, smaller cards) --}}
        <div class="rv-stack">
            @foreach($reviews->skip(1) as $review)
            <div class="rv-card" data-index="{{ $loop->index }}">

                {{-- Product image strip --}}
                @if($review->product?->mainImage)
                <div class="rv-card-img">
                    <img src="{{ asset('storage/' . $review->product->mainImage->image_url) }}"
                         alt="{{ $review->product->product_name }}">
                    <div class="rv-card-img-overlay"></div>
                </div>
                @endif

                <div class="rv-card-body">
                    {{-- Stars --}}
                    <div class="rv-stars rv-stars--sm">
                        @for($s = 1; $s <= 5; $s++)
                            <svg width="10" height="10" viewBox="0 0 12 12"
                                 fill="{{ $s <= $review->rating ? '#e10600' : 'none' }}"
                                 stroke="#e10600" stroke-width="1.2">
                                <polygon points="6,1 7.5,4.5 11,4.8 8.5,7 9.3,10.5 6,8.7 2.7,10.5 3.5,7 1,4.8 4.5,4.5"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p class="rv-card-quote">"{{ Str::limit($review->comment, 100) }}"</p>

                    {{-- Buyer --}}
                    <div class="rv-card-footer">
                        <div class="rv-buyer-avatar rv-buyer-avatar--sm">
                            {{ strtoupper(substr($review->user->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="rv-buyer-name rv-buyer-name--sm">{{ $review->user->full_name }}</div>
                            @if($review->product)
                            <div class="rv-buyer-product">{{ $review->product->product_name }}</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>{{-- /rv-body --}}

</section>

<style>
/* ─────────────────────────────────────────
   REVIEWS WALL
───────────────────────────────────────── */
#reviews-section {
    padding: 120px 60px;
    background: var(--dark-2);
    position: relative;
}

.rv-top-line {
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.2), transparent);
}

/* ── Header ── */
.rv-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 52px;
}
.rv-header .section-title { margin-bottom: 0; }
.rv-header .section-title span { color: var(--red); }

.rv-overall {
    display: flex;
    align-items: center;
    gap: 16px;
}
.rv-overall-score {
    font-family: 'Bebas Neue', cursive;
    font-size: 3.5rem;
    letter-spacing: 2px;
    line-height: 1;
    color: var(--off-white);
}
.rv-stars-row {
    display: flex;
    gap: 3px;
    margin-bottom: 6px;
}
.rv-count {
    font-size: 0.52rem;
    letter-spacing: 4px;
    color: rgba(240,237,232,0.25);
    text-transform: uppercase;
}

/* ── Body layout ── */
.rv-body {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 4px;
    align-items: stretch;
}

/* ── Featured ── */
.rv-featured {
    position: relative;
    overflow: hidden;
    background: #0c0c0c;
    min-height: 520px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    opacity: 0;
    transform: translateY(30px);
}
.rv-featured::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    z-index: 5;
}

/* Background image */
.rv-feat-bg {
    position: absolute;
    inset: 0;
    z-index: 1;
}
.rv-feat-bg-img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: grayscale(30%) brightness(0.4);
    transition: transform 8s ease, filter 0.5s;
}
.rv-featured:hover .rv-feat-bg-img {
    transform: scale(1.04);
    filter: grayscale(10%) brightness(0.45);
}
.rv-feat-bg-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        to top,
        rgba(5,5,5,0.98) 0%,
        rgba(5,5,5,0.7) 40%,
        rgba(5,5,5,0.2) 100%
    );
}

/* Content */
.rv-feat-content {
    position: relative;
    z-index: 3;
    padding: 48px;
}
.rv-stars {
    display: flex;
    gap: 4px;
    margin-bottom: 20px;
}
.rv-stars--sm { gap: 3px; margin-bottom: 10px; }

.rv-quote-mark {
    font-family: 'Bebas Neue', cursive;
    font-size: 6rem;
    color: rgba(225,6,0,0.15);
    line-height: 0.6;
    margin-bottom: 8px;
    letter-spacing: 0;
}
.rv-feat-quote {
    font-size: clamp(1rem, 1.8vw, 1.3rem);
    line-height: 1.65;
    color: rgba(240,237,232,0.85);
    letter-spacing: 0.5px;
    margin-bottom: 32px;
    font-style: italic;
    font-weight: 400;
}

.rv-feat-buyer {
    display: flex;
    align-items: center;
    gap: 14px;
    border-top: 1px solid rgba(255,255,255,0.06);
    padding-top: 24px;
}
.rv-buyer-avatar {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: rgba(225,6,0,0.12);
    border: 1px solid rgba(225,6,0,0.3);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Bebas Neue', cursive;
    font-size: 1.2rem;
    color: var(--red);
    flex-shrink: 0;
}
.rv-buyer-avatar--sm {
    width: 32px; height: 32px;
    font-size: 0.9rem;
}
.rv-buyer-name {
    font-family: 'Bebas Neue', cursive;
    font-size: 1rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
}
.rv-buyer-name--sm { font-size: 0.85rem; letter-spacing: 2px; }
.rv-buyer-product {
    font-size: 0.48rem;
    letter-spacing: 4px;
    color: var(--red);
    text-transform: uppercase;
    margin-top: 4px;
}

/* Corner brackets */
.rv-bracket {
    position: absolute;
    width: 18px; height: 18px;
    z-index: 4;
    pointer-events: none;
}
.rv-bracket::before, .rv-bracket::after {
    content: '';
    position: absolute;
    background: rgba(225,6,0,0.4);
}
.rv-bracket::before { width: 100%; height: 1px; top: 0; left: 0; }
.rv-bracket::after  { width: 1px; height: 100%; top: 0; left: 0; }
.rv-bracket--tl { top: 20px; left: 20px; }
.rv-bracket--br { bottom: 20px; right: 20px; transform: rotate(180deg); }

/* ── Side stack ── */
.rv-stack {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.rv-card {
    flex: 1;
    background: #0c0c0c;
    display: flex;
    overflow: hidden;
    position: relative;
    opacity: 0;
    transform: translateX(20px);
    transition: border-color 0.3s;
    border: 1px solid rgba(255,255,255,0.03);
    min-height: 0;
}
.rv-card:hover {
    border-color: rgba(225,6,0,0.15);
}
.rv-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 2px; height: 0;
    background: var(--red);
    transition: height 0.4s ease;
    z-index: 5;
}
.rv-card:hover::before { height: 100%; }

/* Product image strip */
.rv-card-img {
    width: 90px;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}
.rv-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: grayscale(30%) brightness(0.6);
    transition: filter 0.4s, transform 0.5s;
}
.rv-card:hover .rv-card-img img {
    filter: grayscale(0%) brightness(0.8);
    transform: scale(1.06);
}
.rv-card-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to right, transparent 60%, rgba(12,12,12,1) 100%);
}

/* Card body */
.rv-card-body {
    flex: 1;
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-width: 0;
}
.rv-card-quote {
    font-size: 0.78rem;
    line-height: 1.6;
    color: rgba(240,237,232,0.5);
    letter-spacing: 0.3px;
    font-style: italic;
    flex: 1;
    margin: 8px 0 14px;
}
.rv-card-footer {
    display: flex;
    align-items: center;
    gap: 10px;
    border-top: 1px solid rgba(255,255,255,0.04);
    padding-top: 12px;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .rv-body { grid-template-columns: 1fr; }
    .rv-featured { min-height: 420px; }
    .rv-stack { flex-direction: row; flex-wrap: wrap; }
    .rv-card { flex: 1 1 calc(50% - 2px); min-height: 160px; }
}

@media (max-width: 768px) {
    #reviews-section { padding: 80px 24px; }
    .rv-top-line { left: 24px; right: 24px; }
    .rv-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .rv-feat-content { padding: 28px; }
    .rv-stack { flex-direction: column; }
    .rv-card { flex: none; min-height: 120px; }
    .rv-card-img { width: 70px; }
}
</style>

<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);

    // Featured review entrance
    gsap.to('.rv-featured', {
        opacity: 1,
        y: 0,
        duration: 1,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '#reviews-section',
            start: 'top 75%',
        }
    });

    // Side cards staggered
    gsap.utils.toArray('.rv-card').forEach((card, i) => {
        gsap.to(card, {
            opacity: 1,
            x: 0,
            duration: 0.7,
            ease: 'power3.out',
            delay: i * 0.1,
            scrollTrigger: {
                trigger: '#reviews-section',
                start: 'top 70%',
            }
        });
    });
})();
</script>
@endif