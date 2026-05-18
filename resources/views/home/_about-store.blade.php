{{-- ─── What Our Store Is All About ────────────────────────────────── --}}

<div class="as-section">

    <div class="as-header">
        <p class="as-eyebrow">What We're About</p>
        <h2 class="as-heading">Built for Those Who <span>Live</span> the Sport.</h2>
    </div>

    <div class="as-panels" id="as-panels">

        {{-- Panel 01 --}}
        <div class="as-panel is-active" id="as-panel-0">
            <div class="as-panel-bgnum">01</div>
            <div class="as-panel-vert-label">The Machines</div>

            <div class="as-panel-collapsed">
                <span class="as-panel-num">01</span>
                <div class="as-panel-line"></div>
                <h3 class="as-panel-title-small">The Machines</h3>
                <button class="as-read-more">Read More &#x2192;</button>
            </div>

            <div class="as-panel-expanded">
                <div class="as-exp-left">
                    <span class="as-exp-num">01</span>
                    <div class="as-exp-line"></div>
                    <h3 class="as-exp-title">The<br>Machines</h3>
                    <p class="as-exp-text">
                        Precision die-cast replicas of the cars that defined eras —
                        every livery, every detail, obsessively accurate.
                        From championship-winning RB19s to legendary Ferraris.
                    </p>
                    <div class="as-exp-tag">Scale Models · Die-Cast · Replicas</div>
                    <button class="as-close-btn">&#x2715; Close</button>
                </div>
                <div class="as-exp-right">
                    {{-- Place your image here --}}
                    <div class="as-exp-img" style="background-image: url('https://static0.carbuzzimages.com/wordpress/wp-content/uploads/2024/12/mercedes-f1-v6-being-worked-on.jpg');"></div>
                    <div class="as-exp-img-overlay"></div>
                </div>
            </div>
        </div>

        {{-- Panel 02 --}}
        <div class="as-panel" id="as-panel-1">
            <div class="as-panel-bgnum">02</div>
            <div class="as-panel-vert-label">The Culture</div>

            <div class="as-panel-collapsed">
                <span class="as-panel-num">02</span>
                <div class="as-panel-line"></div>
                <h3 class="as-panel-title-small">The Culture</h3>
                <button class="as-read-more">Read More &#x2192;</button>
            </div>

            <div class="as-panel-expanded">
                <div class="as-exp-left">
                    <span class="as-exp-num">02</span>
                    <div class="as-exp-line"></div>
                    <h3 class="as-exp-title">The<br>Culture</h3>
                    <p class="as-exp-text">
                        Apparel and gear that carry the identity of the paddock —
                        worn by fans who know the difference between a fan
                        and a follower. Rep your team, own your lane.
                    </p>
                    <div class="as-exp-tag">Apparel · Gear · Paddock Style</div>
                    <button class="as-close-btn">&#x2715; Close</button>
                </div>
                <div class="as-exp-right">
                    {{-- Place your image here --}}
                    <div class="as-exp-img" style="background-image: url('https://cdn-cs-images.racer.com/v3/assets/blte77f57883ea46be1/blte9b6e11c14fcfd4e/67d41b2d6d271552d240b5e2/1019700814-LAT-20230618-GP2309_143841_77A0214.jpg?environment=live');"></div>
                    <div class="as-exp-img-overlay"></div>
                </div>
            </div>
        </div>

        {{-- Panel 03 --}}
        <div class="as-panel" id="as-panel-2">
            <div class="as-panel-bgnum">03</div>
            <div class="as-panel-vert-label">The Standard</div>

            <div class="as-panel-collapsed">
                <span class="as-panel-num">03</span>
                <div class="as-panel-line"></div>
                <h3 class="as-panel-title-small">The Standard</h3>
                <button class="as-read-more">Read More &#x2192;</button>
            </div>

            <div class="as-panel-expanded">
                <div class="as-exp-left">
                    <span class="as-exp-num">03</span>
                    <div class="as-exp-line"></div>
                    <h3 class="as-exp-title">The<br>Standard</h3>
                    <p class="as-exp-text">
                        Every order handled with the same relentless focus that
                        goes into building an F1 car — fast, precise, no excuses.
                        Race-speed delivery, podium-grade packaging.
                    </p>
                    <div class="as-exp-tag">Fast Shipping · Quality First · No Excuses</div>
                    <button class="as-close-btn">&#x2715; Close</button>
                </div>
                <div class="as-exp-right">
                    {{-- Place your image here --}}
                    <div class="as-exp-img" style="background-image: url('https://upload.wikimedia.org/wikipedia/en/5/55/F1_24_cover_art.jpg');"></div>
                    <div class="as-exp-img-overlay"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
/* ─────────────────────────────────────────
   ABOUT STORE — Accordion Panel Layout
───────────────────────────────────────── */

.as-section {
    background: #0a0a0a;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

.as-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(225,6,0,0.3), transparent);
}

/* Header */
.as-header {
    text-align: center;
    margin-bottom: 56px;
}

.as-eyebrow {
    font-size: 0.65rem;
    letter-spacing: 8px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
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
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    letter-spacing: 6px;
    color: #fff;
    line-height: 1;
    margin: 0;
}
.as-heading span {
    color: var(--red);
    font-style: italic;
}

/* Panels container */
.as-panels {
    display: flex;
    width: 100%;
    max-width: 1360px;
    height: 660px;
    gap: 2px;
    padding: 0 40px;
    box-sizing: border-box;
}

/* Individual panel */
.as-panel {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.06);
    border-top: 2px solid rgba(225,6,0,0);
    cursor: pointer;
    transition:
        flex 0.75s cubic-bezier(0.22,1,0.36,1),
        border-top-color 0.4s ease;
    flex: 1;
    min-width: 0;
    background: #0f0f0f;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.as-panel.is-active {
    flex: 5;
    border-top-color: var(--red);
    cursor: default;
}

.as-panel:not(.is-active):hover {
    border-top-color: rgba(225,6,0,0.4);
}

/* Big background number */
.as-panel-bgnum {
    position: absolute;
    right: -12px;
    top: -10px;
    font-family: 'Bebas Neue', cursive;
    font-size: 14rem;
    letter-spacing: -8px;
    color: rgba(255,255,255,0.025);
    line-height: 1;
    pointer-events: none;
    user-select: none;
    transition: opacity 0.5s;
}
.as-panel.is-active .as-panel-bgnum { opacity: 0.5; }

/* Vertical ghost label on collapsed panels */
.as-panel-vert-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-90deg);
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 8px;
    color: rgba(255,255,255,0.12);
    white-space: nowrap;
    pointer-events: none;
    transition: opacity 0.3s;
    user-select: none;
}
.as-panel.is-active .as-panel-vert-label { opacity: 0; }

/* ── Collapsed state ── */
.as-panel-collapsed {
    padding: 32px 24px;
    position: relative;
    z-index: 2;
    transition: opacity 0.3s ease;
}
.as-panel.is-active .as-panel-collapsed {
    opacity: 0;
    pointer-events: none;
    position: absolute;
}
.as-panel:not(.is-active) .as-panel-collapsed {
    display: block;
}

.as-panel-num {
    font-size: 0.58rem;
    letter-spacing: 5px;
    color: var(--red);
    font-weight: 700;
    display: block;
    margin-bottom: 12px;
}

.as-panel-line {
    width: 28px; height: 1px;
    background: rgba(225,6,0,0.35);
    margin-bottom: 14px;
}

.as-panel-title-small {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    letter-spacing: 4px;
    color: #fff;
    margin: 0 0 20px;
    line-height: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.as-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(225,6,0,0.8);
    border: 1px solid rgba(225,6,0,0.25);
    padding: 8px 14px;
    transition: all 0.25s;
    background: transparent;
    cursor: pointer;
    font-family: 'Barlow Condensed', sans-serif;
}
.as-panel:hover .as-read-more {
    background: rgba(225,6,0,0.08);
    border-color: rgba(225,6,0,0.5);
    color: var(--red);
}

/* ── Expanded state ── */
.as-panel-expanded {
    position: absolute;
    inset: 0;
    display: flex;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s ease 0.3s;
    z-index: 3;
}
.as-panel.is-active .as-panel-expanded {
    opacity: 1;
    pointer-events: all;
}

.as-exp-left {
    flex: 0.3;
    padding: 44px 44px 44px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
}

.as-exp-num {
    font-size: 0.6rem;
    letter-spacing: 6px;
    color: var(--red);
    font-weight: 700;
    display: block;
    margin-bottom: 14px;
}

.as-exp-line {
    width: 36px; height: 1px;
    background: rgba(225,6,0,0.4);
    margin-bottom: 18px;
}

.as-exp-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2.4rem, 4vw, 3.8rem);
    letter-spacing: 5px;
    color: #fff;
    margin: 0 0 18px;
    line-height: 0.95;
}

.as-exp-text {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 1.05rem;
    letter-spacing: 0.8px;
    line-height: 1.85;
    color: rgba(240,237,232,0.78);
    margin-bottom: 28px;
    max-width: 360px;
}

.as-exp-tag {
    font-size: 0.52rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(225,6,0,0.6);
    padding: 6px 12px;
    border: 1px solid rgba(225,6,0,0.2);
    display: inline-block;
    margin-bottom: 28px;
}

.as-close-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.58rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(240,237,232,0.3);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 7px 14px;
    cursor: pointer;
    transition: all 0.2s;
    background: transparent;
    font-family: 'Barlow Condensed', sans-serif;
    width: fit-content;
}
.as-close-btn:hover {
    color: rgba(240,237,232,0.7);
    border-color: rgba(255,255,255,0.2);
}

/* Image slot */
.as-exp-right {
    flex: 1;
    position: relative;
    overflow: hidden;
    min-width: 0;
    background: #1a1a1a; /* placeholder bg — remove when image is set */
}

.as-exp-img {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    filter: brightness(0.55) saturate(0.7);
    transition: transform 0.8s cubic-bezier(0.22,1,0.36,1);
}
.as-panel.is-active .as-exp-img { transform: scale(1.04); }

.as-exp-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, #0f0f0f 0%, rgba(15,15,15,0.3) 50%, transparent 100%);
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .as-panels {
        flex-direction: column;
        height: auto;
        gap: 2px;
    }

    .as-panel {
        flex: none !important;
        height: 80px;
        transition: height 0.75s cubic-bezier(0.22,1,0.36,1), border-top-color 0.4s ease;
    }

    .as-panel.is-active {
        height: 480px;
    }

    .as-panel-vert-label { display: none; }

    .as-panel-collapsed {
        padding: 20px 24px;
        display: flex !important;
        align-items: center;
        gap: 16px;
    }
    .as-panel-line { display: none; }
    .as-panel-title-small { margin: 0; font-size: 1.4rem; }
    .as-panel-num { margin-bottom: 0; }

    .as-exp-right { display: none; }
    .as-exp-left { padding: 28px 28px; }
}
</style>

<script>
(function () {
    const panels = document.querySelectorAll('.as-panel');

    function expandPanel(index) {
        panels.forEach((p, i) => p.classList.toggle('is-active', i === index));
    }

    function collapseAll() {
        panels.forEach(p => p.classList.remove('is-active'));
    }

    panels.forEach((panel, i) => {
        // Click on collapsed panel or Read More button
        panel.addEventListener('click', function (e) {
            if (this.classList.contains('is-active')) return;
            expandPanel(i);
        });

        // Close button
        const closeBtn = panel.querySelector('.as-close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                collapseAll();
            });
        }
    });
})();
</script>
