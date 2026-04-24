    {{-- ── HERO ── --}}
    <section id="hero">
        <video autoplay muted loop playsinline id="hero-video" poster="/images/fallback.jpg">
            <source src="{{ asset('F1.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-red-bar"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">Formula One — 2024 Collection</p>
            <h1 class="hero-title">
                <span class="line-1">Own The</span>
                <span class="line-2">Race</span>
            </h1>
            <p class="hero-speed">
                Top Speed <strong id="hero-speed-val">0</strong> <strong>km/h</strong>
                &nbsp;·&nbsp; 0–100 in <strong>2.6s</strong>
            </p>
            <div class="hero-cta">
                <a href="#products-preview" class="btn-primary">Shop Now</a>
                <a href="{{ route('shop') }}" class="btn-secondary">Explore Cars</a>
            </div>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-hp">0<span>HP</span></div>
                <div class="hero-stat-label">Power Output</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-rpm">0<span>k</span></div>
                <div class="hero-stat-label">Max RPM</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-value" id="stat-g">0<span>G</span></div>
                <div class="hero-stat-label">Lateral Force</div>
            </div>
        </div>

        <div class="scroll-hint">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>
