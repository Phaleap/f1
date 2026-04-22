{{-- ─── What Our Store Is All About ────────────────────────────────── --}}
<section id="about-store">

    {{-- Red left accent bar (mirrors hero) --}}
    <div class="as-red-bar"></div>

    {{-- Inner wrapper --}}
    <div class="as-inner">

        {{-- Eyebrow --}}
        <p class="as-eyebrow">What We're About</p>

        {{-- Big statement --}}
        <h2 class="as-heading">
            Built for Those Who<br><span>Live</span> the Sport.
        </h2>

        {{-- Short poetic line --}}
        <p class="as-sub">
            Not just a store. A tribute to speed, rivalry, and the relentless pursuit<br>
            of greatness — channeled into every product we carry.
        </p>

        {{-- Vertical connector --}}
        <div class="as-connector"></div>

        {{-- 3 Pillars --}}
        <div class="as-pillars">

            <div class="as-pillar">
                <span class="as-num">01</span>
                <h3 class="as-pillar-title">The Machines</h3>
                <p class="as-pillar-text">
                    Precision die-cast replicas of the cars that defined eras —
                    every livery, every detail, obsessively accurate.
                </p>
            </div>

            <div class="as-pillar-sep"></div>

            <div class="as-pillar">
                <span class="as-num">02</span>
                <h3 class="as-pillar-title">The Culture</h3>
                <p class="as-pillar-text">
                    Apparel and gear that carry the identity of the paddock —
                    worn by fans who know the difference between a fan and a follower.
                </p>
            </div>

            <div class="as-pillar-sep"></div>

            <div class="as-pillar">
                <span class="as-num">03</span>
                <h3 class="as-pillar-title">The Standard</h3>
                <p class="as-pillar-text">
                    Every order handled with the same relentless focus that goes into
                    building an F1 car — fast, precise, no excuses.
                </p>
            </div>

        </div>

    </div>

</section>

<style>
/* ─────────────────────────────────────────
   ABOUT STORE
───────────────────────────────────────── */
#about-store {
    position: relative;
    padding: 140px 60px;
    background: var(--dark);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Top border line — same pattern as #products-preview */
#about-store::before {
    content: '';
    position: absolute;
    top: 0; left: 60px; right: 60px;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.2), transparent);
}

/* Subtle red bloom from top center */
#about-store::after {
    content: '';
    position: absolute;
    top: -80px; left: 50%;
    transform: translateX(-50%);
    width: 700px; height: 400px;
    background: radial-gradient(ellipse at top, rgba(225,6,0,0.06) 0%, transparent 70%);
    pointer-events: none;
}

/* Red left accent bar — mirrors hero */
.as-red-bar {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
    z-index: 2;
}

/* ── Inner ── */
.as-inner {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 100%;
    max-width: 1100px;
}

/* ── Eyebrow — same pattern as .section-eyebrow / .hero-eyebrow ── */
.as-eyebrow {
    font-size: 0.6rem;
    letter-spacing: 8px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 20px;
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

/* ── Heading — Bebas Neue, huge ── */
.as-heading {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3.2rem, 8vw, 7rem);
    letter-spacing: 6px;
    line-height: 0.95;
    color: var(--off-white);
    margin: 0 0 28px;
    opacity: 0;
    animation: fadeUp 0.9s ease 0.3s forwards;
}
.as-heading span {
    color: var(--red);
    text-shadow: 0 0 60px rgba(225,6,0,0.4);
    font-style: italic;
}

/* ── Sub copy ── */
.as-sub {
    font-size: 0.88rem;
    letter-spacing: 1.5px;
    color: rgba(240,237,232,0.35);
    line-height: 1.85;
    max-width: 520px;
    margin: 0 auto 52px;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.5s forwards;
}

/* ── Vertical connector line ── */
.as-connector {
    width: 1px;
    height: 52px;
    background: linear-gradient(to bottom, rgba(225,6,0,0.6), transparent);
    margin-bottom: 52px;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.7s forwards;
}

/* ── Pillars ── */
.as-pillars {
    display: flex;
    align-items: flex-start;
    width: 100%;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.85s forwards;
}

.as-pillar {
    flex: 1;
    padding: 0 48px;
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: transform 0.35s ease;
}
.as-pillar:hover { transform: translateY(-5px); }

.as-pillar-sep {
    width: 1px;
    align-self: stretch;
    background: rgba(255,255,255,0.05);
    flex-shrink: 0;
}

/* Number — same style as .nm-num in navbar */
.as-num {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.55rem;
    letter-spacing: 5px;
    color: var(--red);
    font-weight: 600;
    opacity: 0.6;
    transition: opacity 0.3s;
}
.as-pillar:hover .as-num { opacity: 1; }

/* Title — Bebas Neue */
.as-pillar-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.6rem;
    letter-spacing: 4px;
    color: rgba(240,237,232,0.75);
    margin: 0;
    transition: color 0.3s;
}
.as-pillar:hover .as-pillar-title { color: var(--off-white); }

/* Body text */
.as-pillar-text {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.85rem;
    font-weight: 400;
    letter-spacing: 0.5px;
    line-height: 1.8;
    color: rgba(240,237,232,0.28);
    margin: 0;
    transition: color 0.3s;
}
.as-pillar:hover .as-pillar-text { color: rgba(240,237,232,0.48); }

/* ── Responsive ── */
@media (max-width: 900px) {
    #about-store { padding: 100px 32px; }
    #about-store::before { left: 32px; right: 32px; }

    .as-pillars {
        flex-direction: column;
        align-items: center;
        gap: 40px;
    }
    .as-pillar {
        padding: 0;
        text-align: center;
        align-items: center;
        max-width: 400px;
        width: 100%;
    }
    .as-pillar-sep {
        width: 48px;
        height: 1px;
        align-self: auto;
    }
    .as-sub br { display: none; }
}

@media (max-width: 480px) {
    #about-store { padding: 80px 24px; }
    .as-heading { letter-spacing: 3px; }
}
</style>