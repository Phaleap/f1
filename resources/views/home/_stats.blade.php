{{-- ─── Stats Strip ───────────────────────────────────────────────── --}}
@php
    $statsData = [
        'orders'       => \App\Models\Order::where('order_status', '!=', 'cancelled')->count(),
        'teams'        => \App\Models\Team::count(),
        'avg_rating'   => \App\Models\Review::where('review_status', 'visible')->avg('rating'),
        'championships'=> \App\Models\Driver::sum('championships'),
    ];
@endphp

<section id="stats-section">
    <div class="stats-top-line"></div>

    <div class="stats-inner">

        <div class="stat-item" data-target="{{ $statsData['orders'] }}" data-suffix="+">
            <div class="stat-value">
                <span class="stat-number">0</span>
                <span class="stat-suffix">+</span>
            </div>
            <div class="stat-label">Cars Delivered</div>
            <div class="stat-sublabel">& counting</div>
        </div>

        <div class="stat-divider"></div>

        <div class="stat-item" data-target="{{ $statsData['teams'] }}" data-suffix="">
            <div class="stat-value">
                <span class="stat-number">0</span>
            </div>
            <div class="stat-label">F1 Teams</div>
            <div class="stat-sublabel">officially served</div>
        </div>

        <div class="stat-divider"></div>

        <div class="stat-item" data-target="{{ number_format($statsData['avg_rating'] ?? 0, 1) }}" data-suffix="★" data-decimal="true">
            <div class="stat-value">
                <span class="stat-number">0.0</span>
                <span class="stat-suffix">★</span>
            </div>
            <div class="stat-label">Avg Rating</div>
            <div class="stat-sublabel">verified buyers</div>
        </div>

        <div class="stat-divider"></div>

        <div class="stat-item" data-target="{{ $statsData['championships'] }}" data-suffix="">
            <div class="stat-value">
                <span class="stat-number">0</span>
            </div>
            <div class="stat-label">Championships</div>
            <div class="stat-sublabel">across all drivers</div>
        </div>

    </div>

    <div class="stats-bottom-line"></div>
</section>

<style>
/* ─────────────────────────────────────────
   STATS STRIP
───────────────────────────────────────── */
#stats-section {
    background: var(--dark-2);
    padding: 80px 60px;
    position: relative;
    overflow: hidden;
}

/* Subtle red radial bg */
#stats-section::after {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 600px; height: 200px;
    background: radial-gradient(ellipse, rgba(225,6,0,0.04) 0%, transparent 70%);
    pointer-events: none;
}

.stats-top-line,
.stats-bottom-line {
    position: absolute;
    left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.15), transparent);
}
.stats-top-line { top: 0; }
.stats-bottom-line { bottom: 0; }

/* ── Inner row ── */
.stats-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

/* ── Divider ── */
.stat-divider {
    width: 1px;
    height: 60px;
    background: rgba(225,6,0,0.12);
    flex-shrink: 0;
    margin: 0 60px;
}

/* ── Stat item ── */
.stat-item {
    text-align: center;
    flex: 1;
    opacity: 0;
    transform: translateY(20px);
}

.stat-value {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 2px;
    line-height: 1;
    margin-bottom: 10px;
}

.stat-number {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 5vw, 5rem);
    letter-spacing: 3px;
    color: var(--off-white);
    font-variant-numeric: tabular-nums;
    transition: color 0.3s;
}
.stat-item:hover .stat-number { color: var(--red); }

.stat-suffix {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.5rem, 2.5vw, 2.5rem);
    color: var(--red);
    letter-spacing: 2px;
    line-height: 1;
}

.stat-label {
    font-size: 0.6rem;
    letter-spacing: 6px;
    color: rgba(240,237,232,0.5);
    text-transform: uppercase;
    margin-bottom: 4px;
}

.stat-sublabel {
    font-size: 0.48rem;
    letter-spacing: 4px;
    color: rgba(240,237,232,0.15);
    text-transform: uppercase;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    #stats-section { padding: 60px 24px; }
    .stats-top-line, .stats-bottom-line { left: 24px; right: 24px; }
    .stats-inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px 20px;
    }
    .stat-divider { display: none; }
    .stat-item { flex: none; }
}
</style>

<script>
(function () {
    const section = document.getElementById('stats-section');
    if (!section) return;

    const items = section.querySelectorAll('.stat-item');
    let animated = false;

    function animateCounters() {
        if (animated) return;
        animated = true;

        items.forEach((item, i) => {
            const numEl    = item.querySelector('.stat-number');
            const target   = parseFloat(item.dataset.target) || 0;
            const isDecimal = item.dataset.decimal === 'true';
            const duration = 2000; // ms
            const start    = performance.now();

            // Entrance animation
            if (typeof gsap !== 'undefined') {
                gsap.to(item, {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    delay: i * 0.12,
                    ease: 'power3.out'
                });
            } else {
                item.style.opacity = 1;
                item.style.transform = 'translateY(0)';
            }

            // Count up
            setTimeout(() => {
                function tick(now) {
                    const elapsed  = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease out expo
                    const ease     = 1 - Math.pow(2, -10 * progress);
                    const current  = target * ease;

                    numEl.textContent = isDecimal
                        ? current.toFixed(1)
                        : Math.floor(current).toLocaleString();

                    if (progress < 1) requestAnimationFrame(tick);
                    else numEl.textContent = isDecimal ? target.toFixed(1) : target.toLocaleString();
                }
                requestAnimationFrame(tick);
            }, i * 120);
        });
    }

    // Trigger on scroll into view
    if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 80%',
            onEnter: animateCounters
        });
    } else {
        // Fallback IntersectionObserver
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                animateCounters();
                observer.disconnect();
            }
        }, { threshold: 0.3 });
        observer.observe(section);
    }
})();
</script>