{{-- ─── Awards & Press Shelf ──────────────────────────────────────── --}}
<section id="awards-section">
    <div class="awards-top-line"></div>

    <div class="awards-inner">

        {{-- Left label --}}
        <div class="awards-label">
            <p class="section-eyebrow">Recognition</p>
            <h2 class="awards-title">AS SEEN <span>IN</span></h2>
        </div>

        {{-- Divider --}}
        <div class="awards-label-divider"></div>

        {{-- Logos row --}}
        <div class="awards-logos">

            <div class="award-item" title="Awwwards — Site of the Day">
                <div class="award-logo-wrap">
                    <svg viewBox="0 0 80 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="award-svg">
                        <text x="0" y="20" font-family="Bebas Neue, sans-serif" font-size="22" fill="currentColor" letter-spacing="2">AWWWARDS</text>
                    </svg>
                </div>
                <div class="award-badge">Site of the Day</div>
            </div>

            <div class="award-divider"></div>

            <div class="award-item" title="FWA — Favourite Website Award">
                <div class="award-logo-wrap">
                    <svg viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="award-svg">
                        <text x="0" y="20" font-family="Bebas Neue, sans-serif" font-size="22" fill="currentColor" letter-spacing="3">FWA</text>
                    </svg>
                </div>
                <div class="award-badge">Favourite Website</div>
            </div>

            <div class="award-divider"></div>

            <div class="award-item" title="CSS Design Awards">
                <div class="award-logo-wrap">
                    <svg viewBox="0 0 50 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="award-svg">
                        <text x="0" y="20" font-family="Bebas Neue, sans-serif" font-size="22" fill="currentColor" letter-spacing="2">CSSDA</text>
                    </svg>
                </div>
                <div class="award-badge">UI Design Award</div>
            </div>

            <div class="award-divider"></div>

            <div class="award-item" title="Forbes">
                <div class="award-logo-wrap">
                    <svg viewBox="0 0 60 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="award-svg">
                        <text x="0" y="20" font-family="Bebas Neue, sans-serif" font-size="22" fill="currentColor" letter-spacing="2">FORBES</text>
                    </svg>
                </div>
                <div class="award-badge">Featured</div>
            </div>

            <div class="award-divider"></div>

            <div class="award-item" title="Formula 1">
                <div class="award-logo-wrap">
                    <svg viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="award-svg">
                        <text x="0" y="20" font-family="Bebas Neue, sans-serif" font-size="22" fill="currentColor" letter-spacing="2">F1™</text>
                    </svg>
                </div>
                <div class="award-badge">Official Partner</div>
            </div>

        </div>

    </div>

    <div class="awards-bottom-line"></div>
</section>

<style>
/* ─────────────────────────────────────────
   AWARDS & PRESS
───────────────────────────────────────── */
#awards-section {
    background: var(--dark);
    padding: 60px;
    position: relative;
}

.awards-top-line,
.awards-bottom-line {
    position: absolute;
    left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.12), transparent);
}
.awards-top-line { top: 0; }
.awards-bottom-line { bottom: 0; }

/* ── Inner layout ── */
.awards-inner {
    display: flex;
    align-items: center;
    gap: 0;
    max-width: 1400px;
    margin: 0 auto;
}

/* Left label */
.awards-label { flex-shrink: 0; }
.awards-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.8rem, 3vw, 2.8rem);
    letter-spacing: 4px;
    line-height: 0.95;
    color: var(--off-white);
    margin-top: 6px;
}
.awards-title span { color: var(--red); }

/* Label divider */
.awards-label-divider {
    width: 1px;
    height: 48px;
    background: rgba(225,6,0,0.12);
    flex-shrink: 0;
    margin: 0 48px;
}

/* Logos */
.awards-logos {
    display: flex;
    align-items: center;
    gap: 0;
    flex: 1;
    flex-wrap: wrap;
}

.award-divider {
    width: 1px;
    height: 32px;
    background: rgba(255,255,255,0.05);
    flex-shrink: 0;
    margin: 0 36px;
}

/* Award item */
.award-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    opacity: 0;
    transform: translateY(10px);
    cursor: default;
    transition: opacity 0.3s;
}
.award-item:hover { opacity: 1 !important; }

.award-logo-wrap {
    height: 22px;
    display: flex;
    align-items: center;
    transition: filter 0.3s;
    filter: brightness(0.3);
}
.award-item:hover .award-logo-wrap {
    filter: brightness(1);
}

.award-svg {
    height: 100%;
    width: auto;
    color: var(--off-white);
    transition: color 0.3s;
}
.award-item:hover .award-svg {
    color: var(--off-white);
}

.award-badge {
    font-size: 0.42rem;
    letter-spacing: 4px;
    color: rgba(225,6,0,0);
    text-transform: uppercase;
    transition: color 0.3s;
    white-space: nowrap;
}
.award-item:hover .award-badge {
    color: rgba(225,6,0,0.5);
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .awards-inner { flex-direction: column; align-items: flex-start; gap: 32px; }
    .awards-label-divider { display: none; }
    .awards-logos { gap: 0; }
    .award-divider { margin: 0 24px; }
}

@media (max-width: 768px) {
    #awards-section { padding: 48px 24px; }
    .awards-top-line, .awards-bottom-line { left: 24px; right: 24px; }
    .awards-logos { gap: 0; flex-wrap: wrap; row-gap: 24px; }
    .award-divider { margin: 0 16px; height: 24px; }
    .award-logo-wrap { height: 18px; }
}
</style>

<script>
(function () {
    const section = document.getElementById('awards-section');
    if (!section) return;

    const items = section.querySelectorAll('.award-item');

    function animate() {
        items.forEach((item, i) => {
            if (typeof gsap !== 'undefined') {
                gsap.to(item, {
                    opacity: 0.35, // dim by default, bright on hover
                    y: 0,
                    duration: 0.6,
                    delay: i * 0.08,
                    ease: 'power3.out'
                });
            } else {
                item.style.opacity = '0.35';
                item.style.transform = 'translateY(0)';
            }
        });
    }

    if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 85%',
            onEnter: animate
        });
    } else {
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) { animate(); observer.disconnect(); }
        }, { threshold: 0.2 });
        observer.observe(section);
    }
})();
</script>