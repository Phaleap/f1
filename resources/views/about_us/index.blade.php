


@extends('layouts.app')

@section('content')
@include('home._navbar')

{{-- ─────────────────────────────────────
   SECTION 1: CINEMATIC STATEMENT
───────────────────────────────────── --}}
<section class="about-hero">
    <div class="about-hero__bg">
        {{-- Replace with real F1 race image --}}
        <div class="about-hero__bg-placeholder"></div>
        <div class="about-hero__noise"></div>
        <div class="about-hero__vignette"></div>
    </div>

    <div class="about-hero__content">
        <p class="about-hero__eyebrow">
            <span class="eyebrow-line"></span>
            Our Story
        </p>

        <h1 class="about-hero__headline">
            <span class="headline-line" data-line="1">WE DON'T</span>
            <span class="headline-line" data-line="2">JUST <em>WATCH</em></span>
            <span class="headline-line" data-line="3">THE RACE.</span>
        </h1>

        <div class="about-hero__body">
            <p>Born from a genuine obsession with Formula One — the speed, the engineering, the drama. We built this store because we couldn't find a place that treated F1 merchandise the way it deserves to be treated.</p>
            <p>Every product here is chosen by people who wake up at 3AM for race day. Not by algorithms.</p>
        </div>

        <div class="about-hero__stats">
            <div class="stat-item">
                <span class="stat-num">2024</span>
                <span class="stat-label">Founded</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-num">10</span>
                <span class="stat-label">Teams Covered</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-num">24</span>
                <span class="stat-label">Race Weekends</span>
            </div>
        </div>
    </div>

    <div class="about-hero__scroll-hint">
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ─────────────────────────────────────
   SECTION 2: DRIVER INSPIRATIONS
   Cards stack → slide left → detail right
───────────────────────────────────── --}}
<section class="drivers-section" id="drivers-section">
    <div class="drivers-sticky">

        {{-- Left: stacking cards --}}
        <div class="drivers-cards-wrap" id="driversCardsWrap">
            <div class="drivers-label">
                <span class="eyebrow-line"></span>
                The Drivers That Inspire Us
            </div>

            <div class="driver-card" data-driver="0" id="driverCard0">
                <div class="driver-card__inner">
                    <div class="driver-card__img">
                        <img src="https://placehold.co/400x560/0a0a0a/333?text=MAX+33" alt="Max Verstappen" loading="lazy">
                        <div class="driver-card__img-gradient"></div>
                    </div>
                    <div class="driver-card__num">01</div>
                </div>
            </div>

            <div class="driver-card" data-driver="1" id="driverCard1">
                <div class="driver-card__inner">
                    <div class="driver-card__img">
                        <img src="https://placehold.co/400x560/0a0a0a/333?text=LANDO+4" alt="Lando Norris" loading="lazy">
                        <div class="driver-card__img-gradient"></div>
                    </div>
                    <div class="driver-card__num">02</div>
                </div>
            </div>

            <div class="driver-card" data-driver="2" id="driverCard2">
                <div class="driver-card__inner">
                    <div class="driver-card__img">
                        <img src="https://placehold.co/400x560/0a0a0a/333?text=CHARLES+16" alt="Charles Leclerc" loading="lazy">
                        <div class="driver-card__img-gradient"></div>
                    </div>
                    <div class="driver-card__num">03</div>
                </div>
            </div>
        </div>

        {{-- Right: driver detail panel --}}
        <div class="driver-detail" id="driverDetail">
            <div class="driver-detail__inner" id="driverDetailInner">

                {{-- Driver 0: Max --}}
                <div class="driver-info" data-for="0" id="driverInfo0">
                    <p class="driver-info__team" style="color:#3671C6;">Red Bull Racing</p>
                    <h2 class="driver-info__name">MAX<br><span>VERSTAPPEN</span></h2>
                    <div class="driver-info__number">#1</div>
                    <p class="driver-info__quote">"The way he sees the race before it happens. Pure instinct wrapped in cold calculation."</p>
                    <div class="driver-info__facts">
                        <div class="fact"><span class="fact-label">Championships</span><span class="fact-val">4</span></div>
                        <div class="fact"><span class="fact-label">Race Wins</span><span class="fact-val">61+</span></div>
                        <div class="fact"><span class="fact-label">Why He Inspires</span><span class="fact-val">Relentless</span></div>
                    </div>
                </div>

                {{-- Driver 1: Lando --}}
                <div class="driver-info" data-for="1" id="driverInfo1">
                    <p class="driver-info__team" style="color:#FF8000;">McLaren</p>
                    <h2 class="driver-info__name">LANDO<br><span>NORRIS</span></h2>
                    <div class="driver-info__number">#4</div>
                    <p class="driver-info__quote">"Genuine. Raw talent with zero pretence. He races because he loves it — you can feel it."</p>
                    <div class="driver-info__facts">
                        <div class="fact"><span class="fact-label">Team</span><span class="fact-val">McLaren</span></div>
                        <div class="fact"><span class="fact-label">Race Wins</span><span class="fact-val">4+</span></div>
                        <div class="fact"><span class="fact-label">Why He Inspires</span><span class="fact-val">Authentic</span></div>
                    </div>
                </div>

                {{-- Driver 2: Charles --}}
                <div class="driver-info" data-for="2" id="driverInfo2">
                    <p class="driver-info__team" style="color:#E8002D;">Scuderia Ferrari</p>
                    <h2 class="driver-info__name">CHARLES<br><span>LECLERC</span></h2>
                    <div class="driver-info__number">#16</div>
                    <p class="driver-info__quote">"The emotion he brings to every lap. When he drives Ferrari, you feel the weight of history."</p>
                    <div class="driver-info__facts">
                        <div class="fact"><span class="fact-label">Team</span><span class="fact-val">Ferrari</span></div>
                        <div class="fact"><span class="fact-label">Pole Positions</span><span class="fact-val">24+</span></div>
                        <div class="fact"><span class="fact-label">Why He Inspires</span><span class="fact-val">Passion</span></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ─────────────────────────────────────
   SECTION 3 & 4: TEAM MEMBERS
   Scroll-driven 3D tilt card + descriptions
───────────────────────────────────── --}}
<section class="team-section" id="teamSection">
    <div class="team-header">
        <p class="section-eyebrow"><span class="eyebrow-line"></span>The Team</p>
        <h2 class="section-title">TWO PEOPLE.<br><span>ONE OBSESSION.</span></h2>
    </div>

    {{-- Team Member 1 --}}
    <div class="team-member" id="teamMember1">
        <div class="team-member__sticky">
            <div class="team-member__card-wrap" id="memberCard1Wrap">
                <div class="team-member__card" id="memberCard1">
                    <div class="team-member__card-img">
                        <img src="https://placehold.co/380x520/0f0f0f/222?text=FOUNDER" alt="Team Member 1" loading="lazy">
                        <div class="team-member__card-overlay"></div>
                    </div>
                    <div class="team-member__card-footer">
                        <span class="member-role">Founder</span>
                        <span class="member-name">Your Name</span>
                    </div>
                    <div class="team-member__card-shine" id="memberShine1"></div>
                </div>
            </div>

            <div class="team-member__descriptions" id="memberDescs1">
                <div class="member-desc" data-index="0">
                    <span class="desc-tag">01 / Origin</span>
                    <p>Started watching F1 at age 8. By 16, could name every car on the grid by sound alone. Some obsessions never leave you.</p>
                </div>
                <div class="member-desc" data-index="1">
                    <span class="desc-tag">02 / Mission</span>
                    <p>Built this store because the merchandise deserved better. Official quality, editorial presentation. The F1 shop for real fans.</p>
                </div>
                <div class="member-desc" data-index="2">
                    <span class="desc-tag">03 / Favourite Race</span>
                    <p>Monaco 2022. No explanation needed. If you know, you know.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Team Member 2 --}}
    <div class="team-member team-member--alt" id="teamMember2">
        <div class="team-member__sticky">
            <div class="team-member__card-wrap" id="memberCard2Wrap">
                <div class="team-member__card" id="memberCard2">
                    <div class="team-member__card-img">
                        <img src="https://placehold.co/380x520/0f0f0f/222?text=CO-FOUNDER" alt="Team Member 2" loading="lazy">
                        <div class="team-member__card-overlay"></div>
                    </div>
                    <div class="team-member__card-footer">
                        <span class="member-role">Co-Founder</span>
                        <span class="member-name">Partner Name</span>
                    </div>
                    <div class="team-member__card-shine" id="memberShine2"></div>
                </div>
            </div>

            <div class="team-member__descriptions" id="memberDescs2">
                <div class="member-desc" data-index="0">
                    <span class="desc-tag">01 / Origin</span>
                    <p>The engineering side of the team. Understands the cars better than the drivers. Claims he could have gone pro.</p>
                </div>
                <div class="member-desc" data-index="1">
                    <span class="desc-tag">02 / Role</span>
                    <p>Handles every product detail. If it's in the store, he's verified it's worthy. Zero compromises on quality.</p>
                </div>
                <div class="member-desc" data-index="2">
                    <span class="desc-tag">03 / Favourite Team</span>
                    <p>Red Bull. Don't argue with him about it. You won't win.</p>
                </div>
            </div>
        </div>
    </div>

</section>
@include('home._footer')
@endsection



<style>
/* ═══════════════════════════════════════
   ABOUT PAGE — GLOBAL
═══════════════════════════════════════ */
:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(255,255,255,0.35);
}

.eyebrow-line {
    display: inline-block;
    width: 32px; height: 1px;
    background: var(--red);
    flex-shrink: 0;
    vertical-align: middle;
    margin-right: 12px;
}

/* ═══════════════════════════════════════
   SECTION 1 — CINEMATIC HERO
═══════════════════════════════════════ */
.about-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--dark);
}

.about-hero__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}
.about-hero__bg-placeholder {
    width: 100%; height: 100%;
    background:
        radial-gradient(ellipse 80% 60% at 70% 50%, rgba(225,6,0,0.07) 0%, transparent 60%),
        linear-gradient(180deg, #080808 0%, #0d0d0d 100%);
    /* Replace with: background-image: url('/your-f1-race-image.jpg'); background-size: cover; */
}
.about-hero__noise {
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    opacity: 0.4;
    pointer-events: none;
}
.about-hero__vignette {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 100% 100% at 50% 50%, transparent 40%, rgba(0,0,0,0.7) 100%);
}

.about-hero__content {
    position: relative;
    z-index: 2;
    padding: 120px 80px;
    max-width: 900px;
}

.about-hero__eyebrow {
    display: flex;
    align-items: center;
    font-size: 0.52rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 28px;
}

.about-hero__headline {
    display: flex;
    flex-direction: column;
    gap: 0;
    margin: 0 0 48px 0;
    overflow: hidden;
}
.headline-line {
    display: block;
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(5rem, 11vw, 10rem);
    letter-spacing: 4px;
    line-height: 0.92;
    color: var(--off-white);
    opacity: 0;
    transform: translateY(60px);
    transition: opacity 0.9s ease, transform 0.9s ease;
}
.headline-line em {
    font-style: normal;
    color: var(--red);
    -webkit-text-stroke: 0px;
}
.headline-line.visible {
    opacity: 1;
    transform: translateY(0);
}
.headline-line[data-line="2"] { transition-delay: 0.1s; }
.headline-line[data-line="3"] { transition-delay: 0.2s; }

.about-hero__body {
    max-width: 520px;
    margin-bottom: 56px;
}
.about-hero__body p {
    font-size: 0.95rem;
    line-height: 1.8;
    color: rgba(255,255,255,0.5);
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}
.about-hero__body p:last-child { margin-bottom: 0; }

/* Stats row */
.about-hero__stats {
    display: flex;
    align-items: center;
    gap: 0;
}
.stat-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 0 40px 0 0;
}
.stat-item:first-child { padding-left: 0; }
.stat-num {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 2px;
    color: var(--off-white);
    line-height: 1;
}
.stat-label {
    font-size: 0.45rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
}
.stat-divider {
    width: 1px;
    height: 48px;
    background: rgba(255,255,255,0.1);
    margin-right: 40px;
    flex-shrink: 0;
}

/* Scroll hint */
.about-hero__scroll-hint {
    position: absolute;
    bottom: 48px;
    right: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    z-index: 2;
}
.scroll-line {
    width: 1px;
    height: 60px;
    background: linear-gradient(to bottom, var(--red), transparent);
    animation: scroll-pulse 2s ease-in-out infinite;
}
@keyframes scroll-pulse {
    0%, 100% { opacity: 0.3; transform: scaleY(0.6); transform-origin: top; }
    50% { opacity: 1; transform: scaleY(1); }
}
.about-hero__scroll-hint span {
    font-size: 0.4rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    writing-mode: vertical-rl;
}

/* ═══════════════════════════════════════
   SECTION 2 — DRIVER INSPIRATIONS
═══════════════════════════════════════ */
.drivers-section {
    position: relative;
    /* Height creates the scroll distance for the sticky animation */
    height: 350vh;
    background: var(--dark);
}

.drivers-sticky {
    position: sticky;
    top: 0;
    height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
    background: #070707;
}

/* ── Left: Cards ── */
.drivers-cards-wrap {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px;
}

.drivers-label {
    position: absolute;
    top: 48px;
    left: 60px;
    font-size: 0.48rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    display: flex;
    align-items: center;
    gap: 12px;
}

.driver-card {
    position: absolute;
    width: 240px;
    height: 340px;
    border-radius: 2px;
    overflow: hidden;
    cursor: pointer;
    transform-origin: center center;
    transition: transform 0.1s linear, box-shadow 0.3s;
    will-change: transform;
}

/* Initial fan spread */
#driverCard0 { transform: translateX(0px) translateY(-10px) rotate(-4deg); z-index: 3; }
#driverCard1 { transform: translateX(20px) translateY(10px) rotate(2deg); z-index: 2; }
#driverCard2 { transform: translateX(-20px) translateY(20px) rotate(6deg); z-index: 1; }

.driver-card__inner {
    position: relative;
    width: 100%; height: 100%;
}
.driver-card__img {
    position: absolute; inset: 0;
}
.driver-card__img img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: brightness(0.7) grayscale(20%);
}
.driver-card__img-gradient {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 50%);
}
.driver-card__num {
    position: absolute;
    top: 12px; right: 14px;
    font-family: 'Bebas Neue', cursive;
    font-size: 2rem;
    color: rgba(255,255,255,0.12);
    letter-spacing: 2px;
    z-index: 2;
}

/* ── Right: Detail Panel ── */
.driver-detail {
    position: relative;
    display: flex;
    align-items: center;
    padding: 60px;
    overflow: hidden;
    border-left: 1px solid rgba(255,255,255,0.05);
}

.driver-detail__inner {
    position: relative;
    width: 100%;
}

.driver-info {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    opacity: 0;
    transform: translateX(30px);
    transition: opacity 0.5s ease, transform 0.5s ease;
    pointer-events: none;
}
.driver-info.active {
    opacity: 1;
    transform: translateX(0);
    pointer-events: all;
    position: relative;
}

.driver-info__team {
    font-size: 0.5rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.driver-info__team::before {
    content: '';
    display: inline-block;
    width: 24px; height: 1px;
    background: currentColor;
}

.driver-info__name {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 5vw, 5rem);
    letter-spacing: 4px;
    line-height: 0.9;
    color: var(--off-white);
    margin: 0 0 24px 0;
}
.driver-info__name span { color: var(--red); }

.driver-info__number {
    font-family: 'Bebas Neue', cursive;
    font-size: 7rem;
    color: rgba(255,255,255,0.04);
    position: absolute;
    top: -20px;
    right: 0;
    line-height: 1;
    pointer-events: none;
}

.driver-info__quote {
    font-size: 0.9rem;
    line-height: 1.75;
    color: rgba(255,255,255,0.45);
    font-style: italic;
    max-width: 400px;
    margin-bottom: 36px;
    border-left: 2px solid var(--red);
    padding-left: 20px;
}

.driver-info__facts {
    display: flex;
    flex-direction: column;
    gap: 0;
    border-top: 1px solid rgba(255,255,255,0.07);
}
.fact {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.fact-label {
    font-size: 0.45rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
}
.fact-val {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 2px;
    color: var(--off-white);
}

/* ═══════════════════════════════════════
   SECTION 3 & 4 — TEAM MEMBERS
═══════════════════════════════════════ */
.team-section {
    background: var(--dark);
    padding: 140px 0 0 0;
}

.team-header {
    padding: 0 80px;
    margin-bottom: 100px;
}
.team-header .section-eyebrow {
    display: flex;
    align-items: center;
    font-size: 0.5rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 20px;
}
.team-header .section-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(3rem, 6vw, 5.5rem);
    letter-spacing: 4px;
    line-height: 0.95;
    color: var(--off-white);
    margin: 0;
}
.team-header .section-title span { color: var(--red); }

/* ── Member scroll container ── */
.team-member {
    position: relative;
    height: 280vh;
}

.team-member__sticky {
    position: sticky;
    top: 0;
    height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    padding: 0 80px;
    gap: 80px;
    overflow: hidden;
}

/* Alt: flip card to right side */
.team-member--alt .team-member__sticky {
    direction: rtl;
}
.team-member--alt .team-member__sticky > * {
    direction: ltr;
}

/* ── 3D Card ── */
.team-member__card-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 1200px;
}

.team-member__card {
    position: relative;
    width: 280px;
    height: 400px;
    border-radius: 2px;
    overflow: hidden;
    transform-style: preserve-3d;
    will-change: transform;
    box-shadow: 0 40px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.05);
    transition: box-shadow 0.3s;
}

.team-member__card-img {
    position: absolute; inset: 0;
}
.team-member__card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: brightness(0.65) grayscale(15%);
    transition: filter 0.5s;
}
.team-member__card:hover .team-member__card-img img {
    filter: brightness(0.8) grayscale(0%);
}

.team-member__card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 55%);
}

.team-member__card-footer {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 24px;
    z-index: 2;
}
.member-role {
    display: block;
    font-size: 0.42rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 6px;
}
.member-name {
    display: block;
    font-family: 'Bebas Neue', cursive;
    font-size: 1.6rem;
    letter-spacing: 3px;
    color: var(--off-white);
}

/* Shine/glare overlay for 3D effect */
.team-member__card-shine {
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.08) 0%, transparent 60%);
    pointer-events: none;
    z-index: 3;
    transition: background 0.1s;
}

/* Red top accent line */
.team-member__card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    z-index: 4;
}

/* ── Descriptions ── */
.team-member__descriptions {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.member-desc {
    padding: 32px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.member-desc:first-child {
    border-top: 1px solid rgba(255,255,255,0.06);
}
.member-desc.visible {
    opacity: 1;
    transform: translateY(0);
}

.desc-tag {
    display: block;
    font-size: 0.42rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 10px;
}
.member-desc p {
    font-size: 0.9rem;
    line-height: 1.75;
    color: rgba(255,255,255,0.45);
    margin: 0;
    max-width: 420px;
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .about-hero__content { padding: 80px 32px; }
    .about-hero__scroll-hint { right: 32px; }

    .drivers-sticky { grid-template-columns: 1fr; }
    .driver-detail { display: none; }
    .drivers-cards-wrap { height: 100vh; }

    .team-member__sticky {
        grid-template-columns: 1fr;
        padding: 0 24px;
        gap: 40px;
    }
    .team-member--alt .team-member__sticky { direction: ltr; }
    .team-member__card-wrap { justify-content: center; }
    .team-header { padding: 0 24px; }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ─────────────────────────────────
       HERO: Text line entrance
    ───────────────────────────────── */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                document.querySelectorAll('.headline-line').forEach(l => l.classList.add('visible'));
                observer.disconnect();
            }
        });
    }, { threshold: 0.3 });
    const hero = document.querySelector('.about-hero');
    if (hero) observer.observe(hero);

    /* ─────────────────────────────────
       DRIVER SECTION: Scroll-driven
       card stack + detail reveal
    ───────────────────────────────── */
    const driversSection = document.getElementById('drivers-section');
    const cards = [
        document.getElementById('driverCard0'),
        document.getElementById('driverCard1'),
        document.getElementById('driverCard2'),
    ];
    const infos = [
        document.getElementById('driverInfo0'),
        document.getElementById('driverInfo1'),
        document.getElementById('driverInfo2'),
    ];
    const cardsWrap = document.getElementById('driversCardsWrap');

    // Initial transforms (fan spread)
    const initialTransforms = [
        { x: 0,   y: -10, r: -4 },
        { x: 20,  y:  10, r:  2 },
        { x: -20, y:  20, r:  6 },
    ];

    let activeDriver = -1;

    function setActiveDriver(idx) {
        if (idx === activeDriver) return;
        activeDriver = idx;
        infos.forEach((info, i) => {
            if (i === idx) {
                info.classList.add('active');
            } else {
                info.classList.remove('active');
            }
        });
    }

    function onDriverScroll() {
        if (!driversSection) return;
        const rect = driversSection.getBoundingClientRect();
        const sectionH = driversSection.offsetHeight;
        const viewH = window.innerHeight;

        // Progress 0 → 1 through the sticky scroll
        const scrolled = -rect.top;
        const scrollable = sectionH - viewH;
        const progress = Math.max(0, Math.min(1, scrolled / scrollable));

        // 3 phases: 0–0.33 → show card 0, 0.33–0.66 → card 1, 0.66–1 → card 2
        const driverIndex = Math.min(2, Math.floor(progress * 3));
        const phaseProgress = (progress * 3) - driverIndex; // 0→1 within phase

        // Stack cards to left as we progress
        cards.forEach((card, i) => {
            const init = initialTransforms[i];

            if (i < driverIndex) {
                // Already passed — stack to left, flat
                card.style.transform = `translateX(-320px) translateY(0px) rotate(0deg) scale(0.85)`;
                card.style.zIndex = i + 1;
                card.style.opacity = '0.25';
                card.style.filter = 'grayscale(80%)';
            } else if (i === driverIndex) {
                // Active card — animate to center
                const x = init.x * (1 - phaseProgress);
                const y = init.y * (1 - phaseProgress);
                const r = init.r * (1 - phaseProgress);
                card.style.transform = `translateX(${x}px) translateY(${y}px) rotate(${r}deg) scale(1)`;
                card.style.zIndex = 10;
                card.style.opacity = '1';
                card.style.filter = 'grayscale(0%)';
            } else {
                // Upcoming — fan position
                card.style.transform = `translateX(${init.x}px) translateY(${init.y}px) rotate(${init.r}deg) scale(0.92)`;
                card.style.zIndex = i + 1;
                card.style.opacity = i === driverIndex + 1 ? '0.6' : '0.3';
                card.style.filter = 'grayscale(60%)';
            }
        });

        // Show detail panel when any card is focused
        setActiveDriver(progress > 0.05 ? driverIndex : -1);
    }

    /* ─────────────────────────────────
       TEAM MEMBERS: 3D tilt on scroll
       + staggered description reveals
    ───────────────────────────────── */
    function setupMember(memberId, cardId, descsId) {
        const section = document.getElementById(memberId);
        const card = document.getElementById(cardId);
        const descsEl = document.getElementById(descsId);
        if (!section || !card || !descsEl) return;

        const descs = descsEl.querySelectorAll('.member-desc');
        const shine = card.querySelector('.team-member__card-shine');

        function onMemberScroll() {
            const rect = section.getBoundingClientRect();
            const sectionH = section.offsetHeight;
            const viewH = window.innerHeight;
            const scrolled = -rect.top;
            const scrollable = sectionH - viewH;
            const progress = Math.max(0, Math.min(1, scrolled / scrollable));

            // 3D tilt: gentle oscillating tilt as you scroll
            const tiltX = Math.sin(progress * Math.PI * 1.5) * 12; // up/down
            const tiltY = Math.cos(progress * Math.PI) * 8;         // left/right
            const translateY = (progress - 0.5) * -20;
            card.style.transform = `rotateX(${tiltX}deg) rotateY(${tiltY}deg) translateY(${translateY}px)`;

            // Shine position follows tilt
            if (shine) {
                const sx = 50 + tiltY * 3;
                const sy = 50 - tiltX * 3;
                shine.style.background = `radial-gradient(circle at ${sx}% ${sy}%, rgba(255,255,255,0.1) 0%, transparent 60%)`;
            }

            // Box shadow depth
            const shadowDepth = 40 + Math.abs(tiltX) * 2;
            card.style.boxShadow = `0 ${shadowDepth}px ${shadowDepth * 2}px rgba(0,0,0,0.7), 0 0 0 1px rgba(255,255,255,0.05)`;

            // Reveal descriptions sequentially
            descs.forEach((desc, i) => {
                const threshold = (i + 1) / (descs.length + 1);
                if (progress > threshold) {
                    desc.classList.add('visible');
                } else {
                    desc.classList.remove('visible');
                }
            });
        }

        window.addEventListener('scroll', onMemberScroll, { passive: true });
        onMemberScroll();
    }

    setupMember('teamMember1', 'memberCard1', 'memberDescs1');
    setupMember('teamMember2', 'memberCard2', 'memberDescs2');

    /* Combined scroll listener */
    window.addEventListener('scroll', () => {
        onDriverScroll();
    }, { passive: true });

    // Initial calls
    onDriverScroll();
});
</script>
