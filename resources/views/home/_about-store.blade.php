{{-- ─── What Our Store Is All About ────────────────────────────────── --}}

{{-- Scroll spacer wrapper for sticky effect --}}
<div id="about-scroll-spacer">

    <div id="about-sticky">

        {{-- Red left accent bar --}}
        <div class="as-red-bar"></div>

        {{-- ════ LEFT SIDE — 50vw text ════ --}}
        <div class="as-left">

            <p class="as-eyebrow">What We're About</p>

            <h2 class="as-heading">
                Built for Those<br>Who <span>Live</span><br>the Sport.
            </h2>

            <p class="as-sub">
                Not just a store. A tribute to speed, rivalry, and the relentless
                pursuit of greatness — channeled into every product we carry.
            </p>

            <div class="as-connector"></div>

            {{-- scroll hint --}}
            <div class="as-scroll-hint">
                <div class="as-scroll-line"></div>
                <span>Scroll to explore</span>
            </div>

        </div>

        {{-- ════ RIGHT SIDE — stacked cards ════ --}}
        <div class="as-right">

            <div class="as-card-stack">

                {{-- Card 01 --}}
                <div class="as-card" id="as-card-1">
                    <div class="as-card-inner">
                        <span class="as-card-num">01</span>
                        <div class="as-card-line"></div>
                        <h3 class="as-card-title">The Machines</h3>
                        <p class="as-card-text">
                            Precision die-cast replicas of the cars that defined eras —
                            every livery, every detail, obsessively accurate.
                            From championship-winning RB19s to legendary Ferraris.
                        </p>
                        <div class="as-card-tag">Scale Models · Die-Cast · Replicas</div>
                    </div>
                    <div class="as-card-bg-number">01</div>
                </div>

                {{-- Card 02 --}}
                <div class="as-card" id="as-card-2">
                    <div class="as-card-inner">
                        <span class="as-card-num">02</span>
                        <div class="as-card-line"></div>
                        <h3 class="as-card-title">The Culture</h3>
                        <p class="as-card-text">
                            Apparel and gear that carry the identity of the paddock —
                            worn by fans who know the difference between a fan
                            and a follower. Rep your team, own your lane.
                        </p>
                        <div class="as-card-tag">Apparel · Gear · Paddock Style</div>
                    </div>
                    <div class="as-card-bg-number">02</div>
                </div>

                {{-- Card 03 --}}
                <div class="as-card" id="as-card-3">
                    <div class="as-card-inner">
                        <span class="as-card-num">03</span>
                        <div class="as-card-line"></div>
                        <h3 class="as-card-title">The Standard</h3>
                        <p class="as-card-text">
                            Every order handled with the same relentless focus that
                            goes into building an F1 car — fast, precise, no excuses.
                            Race-speed delivery, podium-grade packaging.
                        </p>
                        <div class="as-card-tag">Fast Shipping · Quality First · No Excuses</div>
                    </div>
                    <div class="as-card-bg-number">03</div>
                </div>

            </div>

            {{-- Progress indicator --}}
            <div class="as-progress">
                <div class="as-progress-dot active" data-index="0"></div>
                <div class="as-progress-dot" data-index="1"></div>
                <div class="as-progress-dot" data-index="2"></div>
            </div>

        </div>

    </div>

</div>

<style>
/* ─────────────────────────────────────────
   ABOUT STORE — Split Sticky Layout
───────────────────────────────────────── */

#about-scroll-spacer {
    height: 400vh;   /* 4x viewport = 3 cards worth of scroll */
    position: relative;
}

#about-sticky {
    position: sticky;
    top: 0;
    height: 100vh;
    display: flex;
    overflow: hidden;
    background: var(--dark);
}

/* Top separator line */
#about-sticky::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.25), transparent);
    z-index: 10;
}

/* Subtle red bloom */
#about-sticky::after {
    content: '';
    position: absolute;
    top: -80px; left: 25%;
    width: 600px; height: 500px;
    background: radial-gradient(ellipse at top, rgba(225,6,0,0.07) 0%, transparent 65%);
    pointer-events: none;
    z-index: 0;
}

/* Red left accent bar */
.as-red-bar {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
    z-index: 10;
}

/* ════ LEFT SIDE ════ */
.as-left {
    width: 50%;
    padding: 0 70px 0 80px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    z-index: 2;
}

.as-eyebrow {
    font-size: 0.68rem;
    letter-spacing: 8px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.1s forwards;
}
.as-eyebrow::before,
.as-eyebrow::after {
    content: '';
    display: block;
    width: 24px; height: 1px;
    background: var(--red);
    opacity: 0.5;
}

.as-heading {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3.5rem, 5.5vw, 6.5rem);
    letter-spacing: 5px;
    line-height: 0.95;
    color: #ffffff;
    margin: 0 0 28px;
    opacity: 0;
    animation: fadeUp 0.9s ease 0.3s forwards;
}
.as-heading span {
    color: var(--red);
    text-shadow: 0 0 60px rgba(225,6,0,0.5);
    font-style: italic;
}

.as-sub {
    font-size: 0.95rem;
    letter-spacing: 1px;
    color: rgba(240,237,232,0.5);
    line-height: 1.9;
    max-width: 400px;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.5s forwards;
}

.as-connector {
    width: 1px;
    height: 48px;
    background: linear-gradient(to bottom, rgba(225,6,0,0.7), transparent);
    margin-bottom: 24px;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.65s forwards;
}

.as-scroll-hint {
    display: flex;
    align-items: center;
    gap: 14px;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.8s forwards;
}
.as-scroll-line {
    width: 32px; height: 1px;
    background: linear-gradient(to right, var(--red), transparent);
}
.as-scroll-hint span {
    font-size: 0.58rem;
    letter-spacing: 5px;
    color: rgba(240,237,232,0.25);
    text-transform: uppercase;
}

/* ════ RIGHT SIDE ════ */
.as-right {
    width: 50%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 70px 60px 40px;
    z-index: 2;
}

/* vertical divider between left and right */
.as-right::before {
    content: '';
    position: absolute;
    left: 0; top: 15%; bottom: 15%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(225,6,0,0.15), transparent);
}

.as-card-stack {
    position: relative;
    width: calc(100% - 56px);  /* leave 56px on right for the offset cards to peek */
    max-width: 440px;
    height: 360px;
    margin-bottom: 36px;       /* room at bottom for the offset */
}

/* ── Individual cards ── */
.as-card {
    position: absolute;
    inset: 0;
    background: #0f0f0f;
    border: 1px solid rgba(255,255,255,0.05);
    border-top: 2px solid rgba(225,6,0,0.0); /* animated in via JS */
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;

    /* Stack offset — each card slightly offset behind */
    transition: transform 0.65s cubic-bezier(0.22,1,0.36,1),
                opacity   0.65s cubic-bezier(0.22,1,0.36,1),
                box-shadow 0.65s ease,
                border-top-color 0.4s ease;
}

/* Default stacked state — diagonal offset like stacked papers */
#as-card-1 { z-index: 3; transform: translate(0px,   0px);  opacity: 1;   box-shadow: 0 24px 60px rgba(0,0,0,0.7); border-top-color: var(--red); }
#as-card-2 { z-index: 2; transform: translate(18px, 18px);  opacity: 1; }
#as-card-3 { z-index: 1; transform: translate(36px, 36px);  opacity: 1; }

/* Active (front) state */
.as-card.is-active {
    transform: translate(0px, 0px) !important;
    opacity: 1 !important;
    z-index: 10 !important;
    box-shadow: 0 24px 60px rgba(0,0,0,0.7) !important;
    border-top-color: var(--red) !important;
}

/* Exited (slides up-left and fades out) */
.as-card.is-exited {
    transform: translate(-30px, -30px) !important;
    opacity: 0 !important;
    z-index: 0 !important;
    pointer-events: none;
}

.as-card-inner {
    padding: 44px 48px;
    width: 100%;
    position: relative;
    z-index: 2;
}

.as-card-num {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.62rem;
    letter-spacing: 6px;
    color: var(--red);
    font-weight: 700;
    display: block;
    margin-bottom: 16px;
}

.as-card-line {
    width: 36px; height: 1px;
    background: rgba(225,6,0,0.4);
    margin-bottom: 20px;
}

.as-card-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2rem, 3.5vw, 3rem);
    letter-spacing: 5px;
    color: #ffffff;
    margin-bottom: 18px;
    line-height: 1;
}

.as-card-text {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    line-height: 1.85;
    color: rgba(240,237,232,0.55);
    margin-bottom: 28px;
    max-width: 340px;
}

.as-card-tag {
    font-size: 0.55rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(225,6,0,0.6);
    padding: 6px 12px;
    border: 1px solid rgba(225,6,0,0.2);
    display: inline-block;
}

/* Big background number watermark */
.as-card-bg-number {
    position: absolute;
    right: -10px;
    bottom: -20px;
    font-family: 'Bebas Neue', cursive;
    font-size: 11rem;
    letter-spacing: -5px;
    color: rgba(255,255,255,0.025);
    line-height: 1;
    pointer-events: none;
    user-select: none;
    z-index: 1;
}

/* ── Progress dots ── */
.as-progress {
    position: absolute;
    right: 24px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.as-progress-dot {
    width: 3px; height: 3px;
    border-radius: 50%;
    background: rgba(240,237,232,0.2);
    transition: all 0.4s;
}
.as-progress-dot.active {
    background: var(--red);
    transform: scale(2.2);
    box-shadow: 0 0 8px rgba(225,6,0,0.7);
}

/* ── Responsive ── */
@media (max-width: 900px) {
    #about-scroll-spacer { height: 350vh; }

    #about-sticky {
        flex-direction: column;
        height: 100vh;
        overflow: hidden;
    }
    .as-left {
        width: 100%;
        padding: 80px 32px 32px;
        justify-content: flex-end;
    }
    .as-sub { display: none; }
    .as-scroll-hint { display: none; }
    .as-right {
        width: 100%;
        padding: 20px 32px 40px;
        justify-content: center;
    }
    .as-right::before { display: none; }
    .as-card-stack { height: 280px; max-width: 100%; }
    .as-card-inner { padding: 28px 30px; }
    .as-card-bg-number { font-size: 8rem; }
}

@media (max-width: 480px) {
    .as-left { padding: 70px 24px 24px; }
    .as-right { padding: 16px 24px 32px; }
    .as-heading { font-size: 3rem; }
}
</style>

<script>
(function () {
    const spacer  = document.getElementById('about-scroll-spacer');
    const cards   = [
        document.getElementById('as-card-1'),
        document.getElementById('as-card-2'),
        document.getElementById('as-card-3'),
    ];
    const dots = document.querySelectorAll('.as-progress-dot');

    let currentCard = 0;

    function setCard(index) {
        if (index === currentCard) return;

        // Exit current
        cards[currentCard].classList.remove('is-active');
        cards[currentCard].classList.add('is-exited');

        currentCard = index;

        // Re-stack the behind cards with diagonal offset
        cards.forEach((card, i) => {
            if (i === currentCard) return;
            card.classList.remove('is-exited', 'is-active');

            const behind = (i - currentCard + cards.length) % cards.length;
            if (behind === 1) {
                card.style.transform = 'translate(18px, 18px)';
                card.style.opacity   = '1';
                card.style.zIndex    = '2';
                card.style.borderTopColor = 'rgba(225,6,0,0)';
            } else {
                card.style.transform = 'translate(36px, 36px)';
                card.style.opacity   = '1';
                card.style.zIndex    = '1';
                card.style.borderTopColor = 'rgba(225,6,0,0)';
            }
        });

        // Bring new card to front
        cards[currentCard].style.transform = '';
        cards[currentCard].style.opacity   = '';
        cards[currentCard].style.zIndex    = '';
        cards[currentCard].classList.add('is-active');

        // Dots
        dots.forEach((d, i) => d.classList.toggle('active', i === currentCard));
    }

    function onScroll() {
        if (!spacer) return;

        const rect     = spacer.getBoundingClientRect();
        const total    = spacer.offsetHeight - window.innerHeight;
        const scrolled = -rect.top;                      // px scrolled into section
        const progress = Math.max(0, Math.min(1, scrolled / total));

        // 3 cards → split progress into 3 equal bands
        const band = 1 / 3;
        let idx = Math.floor(progress / band);
        if (idx >= cards.length) idx = cards.length - 1;

        setCard(idx);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // init on load
})();
</script>