{{-- ─────────────────────────────────────────
   CINEMATIC HERO
───────────────────────────────────────── --}}
<section id="hero">

    <video autoplay muted loop playsinline id="hero-video">
        <source src="{{ asset('build/assets/F1.mp4') }}" type="video/mp4">
    </video>

    {{-- overlays --}}
    <div class="hero-overlay"></div>
    <div class="hero-noise"></div>
    <div class="hero-gradient"></div>

    {{-- floating label --}}
    <div class="hero-top-label">
        Formula One Inspired Apparel — 2026 Collection
    </div>

    {{-- cinematic content --}}
    <div class="hero-content">

        <div class="hero-line"></div>

        <p class="hero-eyebrow">
            PERFORMANCE / PRECISION / LEGACY
        </p>

        <h1 class="hero-title">
            BUILT FOR
            <span>SPEED</span>
        </h1>

        <p class="hero-subtitle">
            Discover premium Formula One inspired fashion,
            collectibles, and racing culture designed for the next generation.
        </p>

        <div class="hero-actions">

            <a href="{{ route('shop') }}" class="btn-primary">
                Explore Collection
            </a>

        </div>

    </div>

    {{-- bottom cinematic strip --}}
    <div class="hero-bottom-bar">

        <div class="bottom-item">
            <span>NEW ERA</span>
            <strong>2026 DROP</strong>
        </div>

        <div class="bottom-divider"></div>

        <div class="bottom-item">
            <span>LIMITED</span>
            <strong>RACE COLLECTION</strong>
        </div>

        <div class="bottom-divider"></div>

        <div class="bottom-item">
            <span>INSPIRED BY</span>
            <strong>FORMULA ONE</strong>
        </div>

    </div>

</section>