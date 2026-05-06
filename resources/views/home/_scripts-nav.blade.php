<script>
    /* ── Navbar scroll ── */
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
    });

    /* ── Mobile nav ── */
    function toggleMobileNav() {
        document.getElementById('mobile-nav').classList.toggle('open');
        document.getElementById('hamburger').classList.toggle('open');
        document.body.style.overflow = document.getElementById('mobile-nav').classList.contains('open') ? 'hidden' : '';
    }

    /* ── Hero stat counters ── */
    function animateCounter(el, target, suffix, duration, decimals) {
        let start = null;
        function step(ts) {
            if (!start) start = ts;
            const p   = Math.min((ts - start) / duration, 1);
            const val = p * target;
            el.textContent = decimals
                ? val.toFixed(1) + suffix
                : Math.round(val) + suffix;
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    window.addEventListener('load', () => {
        setTimeout(() => {
            animateCounter(document.getElementById('stat-hp'),  1000, '', 2200, false);
            animateCounter(document.getElementById('stat-rpm'), 15,   'k', 1800, false);
            animateCounter(document.getElementById('stat-g'),   5,    '', 2000, true);
            animateCounter(document.getElementById('hero-speed-val'), 372, '', 2500, false);
        }, 800);
    });

    /* ── Music ── */
let musicStarted = false;

function startMusic() {
    const music   = document.getElementById('bg-music');
    const hansImg = document.getElementById('hans-img');
    if (!musicStarted && music) {
        music.volume = 0.35;
        music.play().catch(() => {});
        musicStarted = true;
        hansImg.classList.add('playing');
    }
}

function togglePlayPause() {
    const music     = document.getElementById('bg-music');
    const card      = document.getElementById('music-card');
    const iconPlay  = document.getElementById('icon-play');
    const iconPause = document.getElementById('icon-pause');

    if (!musicStarted) {
        startMusic();
        return;
    }

    if (music.paused) {
        music.play().catch(() => {});
        card.classList.remove('paused');
        iconPlay.style.display  = 'none';
        iconPause.style.display = 'block';
    } else {
        music.pause();
        card.classList.add('paused');
        iconPlay.style.display  = 'block';
        iconPause.style.display = 'none';
    }
}

function toggleMute() {
    const music   = document.getElementById('bg-music');
    const card    = document.getElementById('music-card');
    const iconOn  = document.getElementById('icon-unmute');
    const iconOff = document.getElementById('icon-mute');
    startMusic();

    music.muted = !music.muted;
    iconOn.style.display  = music.muted ? 'none'  : 'block';
    iconOff.style.display = music.muted ? 'block' : 'none';
    music.muted
        ? card.classList.add('muted')
        : card.classList.remove('muted');
}

document.addEventListener('click',  startMusic, { once: true });
document.addEventListener('scroll', startMusic, { once: true });

/* ── Hide/show card on scroll direction ── */
let lastScrollY = window.scrollY;
let scrollTimer = null;

window.addEventListener('scroll', () => {
    const card = document.getElementById('music-card');
    const currentScrollY = window.scrollY;

    // Clear any pending timer
    clearTimeout(scrollTimer);

    if (currentScrollY > lastScrollY && currentScrollY > 80) {
        // Scrolling down → hide
        card.classList.add('hidden');
    } else {
        // Scrolling up OR near top → show
        card.classList.remove('hidden');
    }

    lastScrollY = currentScrollY;

    // Always show again after user stops scrolling for 1.5s
    scrollTimer = setTimeout(() => {
        card.classList.remove('hidden');
    }, 1500);
}, { passive: true 
});
</script>