<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Store — Own The Race</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #e10600;
            --dark: #050505;
            --off-white: #f0ede8;
        }

        *, *::before, *::after {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            background: var(--dark);
            color: var(--off-white);
            font-family: 'Barlow Condensed', sans-serif;
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 24px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.4s;
        }
        nav.scrolled {
            background: rgba(5,5,5,0.9);
            backdrop-filter: blur(16px);
        }
        .nav-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            letter-spacing: 6px;
            color: var(--off-white);
        }
        .nav-logo span { color: var(--red); }
        .nav-links {
            display: flex; gap: 36px; list-style: none;
        }
        .nav-links a {
            color: rgba(240,237,232,0.5);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            transition: color 0.3s;
        }
        .nav-links a:hover { color: var(--off-white); }

        /* ── HERO ── */
        #hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Small text above frame */
        .hero-label {
            font-size: 0.7rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.3);
            text-transform: uppercase;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeUp 1s ease 0.5s forwards;
        }

        /* THE FRAME — starts as rounded pill */
        #car-frame {
            width: 75vw;
            height: 52vh;
            border-radius: 999px; /* full pill */
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(225,6,0,0.25);
            box-shadow:
                0 0 60px rgba(225,6,0,0.08),
                inset 0 0 40px rgba(0,0,0,0.6);
        }

        #car-canvas {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }

        /* Title below frame */
        .hero-title-block {
            margin-top: 28px;
            text-align: center;
            opacity: 0;
            animation: fadeUp 1s ease 0.8s forwards;
        }
        .hero-title-block h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 7vw, 6rem);
            letter-spacing: 8px;
            line-height: 1;
        }
        .hero-title-block h1 span { color: var(--red); }
        .hero-title-block p {
            font-size: 0.75rem;
            letter-spacing: 4px;
            color: rgba(240,237,232,0.3);
            text-transform: uppercase;
            margin-top: 8px;
        }

        /* Scroll hint */
        .scroll-hint {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            font-size: 0.6rem;
            letter-spacing: 5px;
            color: rgba(240,237,232,0.2);
            text-transform: uppercase;
            opacity: 0;
            animation: fadeUp 1s ease 1.2s forwards;
        }
        .scroll-hint-line {
            width: 1px; height: 40px;
            background: linear-gradient(to bottom, var(--red), transparent);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%,100% { opacity: 0.3; }
            50%      { opacity: 1; }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── SCROLL SECTION ── */
        #scroll-spacer {
            height: 250vh;
            position: relative;
        }
        #sticky-car {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }
        #car-fullscreen-canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            opacity: 0;
        }

        /* HUD specs */
        .hud {
            position: absolute;
            inset: 0;
            z-index: 10;
            pointer-events: none;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hud-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .hud-panel {
            opacity: 0;
            transform: translateY(16px);
        }
        .hud-label {
            font-size: 0.6rem;
            letter-spacing: 5px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .hud-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.8rem;
            letter-spacing: 3px;
            line-height: 1;
        }
        .hud-unit {
            font-size: 0.8rem;
            color: rgba(240,237,232,0.3);
            letter-spacing: 2px;
            margin-left: 4px;
        }
        .hud-center {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            opacity: 0;
            white-space: nowrap;
        }
        .hud-center .team {
            font-size: 0.65rem;
            letter-spacing: 8px;
            color: rgba(240,237,232,0.4);
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .hud-center .model {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 6vw, 5.5rem);
            letter-spacing: 6px;
        }
        .hud-center .model span { color: var(--red); }

        /* Red glow floor */
        .hud-glow {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 200px;
            background: radial-gradient(ellipse at bottom, rgba(225,6,0,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── PRODUCTS ── */
        #products-preview {
            padding: 120px 60px;
            background: var(--dark);
        }
        .section-eyebrow {
            font-size: 0.65rem;
            letter-spacing: 8px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 14px;
        }
        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(3rem, 6vw, 5rem);
            letter-spacing: 3px;
            margin-bottom: 60px;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2px;
            max-width: 1200px;
        }
        .product-card {
            background: #0d0d0d;
            overflow: hidden;
            opacity: 0;
            transform: translateY(40px);
            transition: transform 0.4s;
            cursor: pointer;
        }
        .product-card:hover { transform: translateY(-4px); }
        .product-card-img {
            width: 100%; height: 200px;
            background: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .product-card-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .product-card:hover .product-card-img img { transform: scale(1.05); }
        .product-card-body {
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.04);
        }
        .product-card-name {
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .product-card-price {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            color: var(--red);
        }

        /* ── FOOTER ── */
        footer {
            padding: 40px 60px;
            border-top: 1px solid rgba(225,6,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.3rem;
            letter-spacing: 6px;
            color: rgba(240,237,232,0.2);
        }
        .footer-logo span { color: var(--red); }
        .footer-copy {
            font-size: 0.65rem;
            letter-spacing: 3px;
            color: rgba(240,237,232,0.12);
            text-transform: uppercase;
        }
        #glass-overlay {
    position: absolute;
    inset: 0;
    pointer-events: none;

    background: radial-gradient(circle at center,
        transparent 20%,
        rgba(0,0,0,0.6) 70%,
        rgba(0,0,0,0.9) 100%
    );

    opacity: 0;
    transition: opacity 0.4s;
}
body::after {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;

    background: radial-gradient(circle,
        transparent 60%,
        rgba(0,0,0,0.4) 100%
    );
}
.cockpit-ui {
    position: absolute;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    opacity: 0;
    transform: scale(0.85);
    transition: all 0.6s ease;
}

.cockpit-ui.active {
    opacity: 1;
    transform: scale(1);
}

.speed {
    font-size: 7rem;
    font-family: 'Bebas Neue';
    text-shadow: 0 0 20px rgba(225,6,0,0.5);
}

.rpm {
    width: 300px;
    height: 6px;
    background: rgba(255,255,255,0.1);
    margin-top: 20px;
    overflow: hidden;
}

.rpm-fill {
    width: 0%;
    height: 100%;
    background: linear-gradient(to right, #e10600, yellow);
}
.unit {
    font-size: 1rem;
    letter-spacing: 6px;
    color: rgba(255,255,255,0.3);
}
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav id="navbar">
        <div class="nav-logo">F1<span>·</span>Store</div>
        <ul class="nav-links">
            <li><a href="{{ route('products.cars') }}">Cars</a></li>
            <li><a href="{{ route('products.merchandise') }}">Merchandise</a></li>
            <li><a href="{{ route('cart.index') }}">Cart</a></li>
            @auth
                <li><a href="{{ route('orders.index') }}">Orders</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
        </ul>
    </nav>
    <div id="glass-overlay"></div>
    {{-- HERO --}}
    <section id="hero">
        <p class="hero-label">Formula One — 2024 Collection</p>

        {{-- THE PILL FRAME --}}
        <div id="car-frame">
            <canvas id="car-canvas"></canvas>
        </div>

        <div class="hero-title-block">
            <h1>Own The <span>Race</span></h1>
            <p>Official F1 Cars & Merchandise</p>
        </div>

        <div class="scroll-hint">
            <div class="scroll-hint-line"></div>
            <span>Scroll</span>
        </div>
    </section>


    {{-- SCROLL REVEAL --}}
    <div id="scroll-spacer">
        <div id="sticky-car">
            <canvas id="car-fullscreen-canvas"></canvas>

            <div class="hud-glow"></div>

            <div class="hud">
                <div class="hud-row">
                    <div class="hud-panel" id="spec-1">
                        <div class="hud-label">Power Output</div>
                        <div class="hud-value">1000<span class="hud-unit">HP</span></div>
                    </div>
                 
                </div>
                <div class="hud-row">
                    <div class="hud-panel" id="spec-3">
                        <div class="hud-label">Constructor</div>
                        <div class="hud-value" style="font-size:2rem">Red Bull Racing</div>
                    </div>
                    <div class="hud-panel" id="spec-4" style="text-align:right">
                        <div class="hud-label">Engine</div>
                        <div class="hud-value" style="font-size:2rem">Honda RBPTH002</div>
                    </div>
                </div>
            </div>
              <div class="cockpit-ui" id="cockpit-ui">
    <div class="speed" id="speed">120</div>
    <div class="unit">KM/H</div>

    <div class="gear">8</div>

    <div class="rpm">
        <div class="rpm-fill" id="rpm-fill"></div>
    </div>
</div>

            <div class="hud-center" id="car-name">
                <div class="team">Oracle Red Bull Racing</div>
                <div class="model">RB<span>20</span></div>
            </div>
        </div>
    </div>

    {{-- PRODUCTS --}}
    <section id="products-preview">
        <p class="section-eyebrow">Shop Now</p>
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            @foreach($products ?? [] as $product)
                <div class="product-card">
                    <div class="product-card-img">
                        @if($product->mainImage)
                            <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                 alt="{{ $product->product_name }}">
                        @else
                            <span style="font-size:0.65rem;letter-spacing:3px;color:rgba(255,255,255,0.1);text-transform:uppercase">No Image</span>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-name">{{ $product->product_name }}</div>
                        <div class="product-card-price">${{ number_format($product->base_price, 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer>
        <div class="footer-logo">F1<span>·</span>Store</div>
        <div class="footer-copy">© 2024 Formula One Store — All rights reserved</div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script type="importmap">
    {
        "imports": {
            "three": "https://cdn.jsdelivr.net/npm/three@0.161.0/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.161.0/examples/jsm/"
        }
    }
    </script>

    <script>
        // Navbar
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>

    <script type="module">
        import * as THREE from 'three';
        import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

        gsap.registerPlugin(ScrollTrigger);

        // ══ SCENE 1 — Hero pill frame ══
        const heroCanvas   = document.getElementById('car-canvas');
        const frame        = document.getElementById('car-frame');
        const heroRenderer = new THREE.WebGLRenderer({ canvas: heroCanvas, antialias: true, alpha: true });
        heroRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        heroRenderer.setSize(frame.clientWidth, frame.clientHeight);
        heroRenderer.outputColorSpace = THREE.SRGBColorSpace;
        heroRenderer.toneMapping      = THREE.ACESFilmicToneMapping;
        heroRenderer.toneMappingExposure = 1.3;

        const heroScene  = new THREE.Scene();
        const heroCamera = new THREE.PerspectiveCamera(38, frame.clientWidth / frame.clientHeight, 0.1, 100);
        heroCamera.position.set(0, 0.8, 6);

        // Lighting — cinematic side lit
        heroScene.add(new THREE.AmbientLight(0xffffff, 0.3));
        const keyLight = new THREE.DirectionalLight(0xffffff, 2);
        keyLight.position.set(-5, 4, 3);
        heroScene.add(keyLight);
        const fillLight = new THREE.DirectionalLight(0xffffff, 0.4);
        fillLight.position.set(5, 2, 3);
        heroScene.add(fillLight);
        const redGlow = new THREE.PointLight(0xe10600, 6, 12);
        redGlow.position.set(0, -1, -3);
        heroScene.add(redGlow);
        const rimLight = new THREE.PointLight(0xe10600, 3, 8);
        rimLight.position.set(-4, 1, -2);
        heroScene.add(rimLight);

        let heroCar = null;
        const loader = new GLTFLoader();

        loader.load('/models/f1-car.glb', gltf => {
            heroCar = gltf.scene;
            const box    = new THREE.Box3().setFromObject(heroCar);
            const center = box.getCenter(new THREE.Vector3());
            const size   = box.getSize(new THREE.Vector3());
            const scale  = 2.8 / Math.max(size.x, size.y, size.z);
            heroCar.scale.setScalar(scale);
            heroCar.position.sub(center.multiplyScalar(scale));
            // Side profile — no rotation (y=0 faces front, PI/2 faces side)
            heroCar.rotation.y = Math.PI / 2;
            heroScene.add(heroCar);
        });

        // Subtle float only — no rotation
        let t = 0;
        function animateHero() {
            requestAnimationFrame(animateHero);
            t += 0.008;
            if (heroCar) {
                heroCar.position.y = Math.sin(t) * 0.03;
            }
            heroRenderer.render(heroScene, heroCamera);
        }
        animateHero();

        // ══ SCENE 2 — Fullscreen ══
        const fsCanvas   = document.getElementById('car-fullscreen-canvas');
        const fsRenderer = new THREE.WebGLRenderer({ canvas: fsCanvas, antialias: true, alpha: true });
        fsRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        fsRenderer.setSize(window.innerWidth, window.innerHeight);
        fsRenderer.outputColorSpace = THREE.SRGBColorSpace;
        fsRenderer.toneMapping      = THREE.ACESFilmicToneMapping;
        
        fsRenderer.toneMappingExposure = 1.5;

        const fsScene  = new THREE.Scene();
        const fsCamera = new THREE.PerspectiveCamera(38, window.innerWidth / window.innerHeight, 0.1, 100);
        fsCamera.position.set(0, 0.8, 7);

        fsScene.add(new THREE.AmbientLight(0xffffff, 0.25));
        fsScene.fog = new THREE.Fog(0x000000, 6, 12);
        const fsKey = new THREE.DirectionalLight(0xffffff, 1.8);
        fsKey.position.set(-5, 4, 3);
        fsScene.add(fsKey);
        const fsFill = new THREE.DirectionalLight(0xffffff, 0.3);
        fsFill.position.set(5, 2, 3);
        fsScene.add(fsFill);
        const fsRed1 = new THREE.PointLight(0xe10600, 8, 16);
        fsRed1.position.set(0, -1, -4);
        fsScene.add(fsRed1);
        const fsRed2 = new THREE.PointLight(0xe10600, 4, 10);
        fsRed2.position.set(-5, 1, -2);
        fsScene.add(fsRed2);

        let fsCar = null;

        loader.load('/models/f1-car.glb', gltf => {
            fsCar = gltf.scene;
            const box    = new THREE.Box3().setFromObject(fsCar);
            const center = box.getCenter(new THREE.Vector3());
            const size   = box.getSize(new THREE.Vector3());
            const scale  = 4.5 / Math.max(size.x, size.y, size.z);
            fsCar.scale.setScalar(scale);
            fsCar.position.sub(center.multiplyScalar(scale));
            fsCar.rotation.y = Math.PI / 2; // side profile
            fsCar.traverse(child => {
                if (child.isMesh && child.material) {
                    child.material.transparent = true;
                    child.material.opacity = 0;
                }
            });
            fsScene.add(fsCar);
        });

        let fsT = 0;
        function animateFS() {
            requestAnimationFrame(animateFS);
            fsT += 0.006;
            if (fsCar) fsCar.position.y = Math.sin(fsT) * 0.025;
            fsRenderer.render(fsScene, fsCamera);
        }
        animateFS();

        // ══ GSAP SCROLL ══

        // 1. Pill frame expands to fullscreen
        gsap.to(frame, {
            width:        '100vw',
            height:       '100vh',
            borderRadius: '0px',
            borderColor:  'transparent',
            top:          0,
            left:         0,
            scrollTrigger: {
                trigger: '#scroll-spacer',
                start:   'top bottom',
                end:     'top top',
                scrub:   1.2,
                onLeave: () => {
                    // Swap to fullscreen canvas
                    frame.style.opacity = '0';
                    gsap.to(fsCanvas, { opacity: 1, duration: 0.4 });

                    // Fade in car
                    if (fsCar) {
                        fsCar.traverse(child => {
                            if (child.isMesh && child.material) {
                                gsap.to(child.material, { opacity: 1, duration: 1.2 });
                            }
                        });
                    }

                    // Animate HUD in
                    gsap.to(['#spec-1','#spec-2','#spec-3','#spec-4'], {
                        opacity: 1, y: 0,
                        duration: 0.9,
                        stagger: 0.15,
                        delay: 0.3,
                        ease: 'power3.out'
                    });
                    gsap.to('#car-name', {
                        opacity: 1, duration: 1, delay: 0.8
                    });
                }
            }
        });

        // 2. Hero text + label fade on scroll
        gsap.to(['.hero-label', '.hero-title-block', '.scroll-hint'], {
            opacity: 0,
            y: -30,
            scrollTrigger: {
                trigger: '#scroll-spacer',
                start: 'top 90%',
                end:   'top 55%',
                scrub: 1,
            }
        });

        const camStart = new THREE.Vector3(0, 0.8, 7);
const camMid   = new THREE.Vector3(1.2, 0.9, 5);
const camEnd   = new THREE.Vector3(0.35, 0.85, 2.2);

const lookStart = new THREE.Vector3(0, 0.6, 0);
const lookMid   = new THREE.Vector3(1.0, 0.7, 0);
const lookEnd   = new THREE.Vector3(0.35, 0.75, 0);

ScrollTrigger.create({
    trigger: '#scroll-spacer',
    start: 'top top',
    end: 'bottom bottom',
    scrub: 3,
    onUpdate: self => {

        const p = self.progress;
        const ease = gsap.parseEase("power3.inOut")(p);

        let pos = new THREE.Vector3();
        let look = new THREE.Vector3();

        if (p < 0.5) {
            const t = ease / 0.5;
            pos.lerpVectors(camStart, camMid, t);
            look.lerpVectors(lookStart, lookMid, t);
        } else {
            const t = (ease - 0.5) / 0.5;
            pos.lerpVectors(camMid, camEnd, t);
            look.lerpVectors(lookMid, lookEnd, t);
        }

        fsCamera.position.copy(pos);
        fsCamera.lookAt(look);
    }
});
ScrollTrigger.create({
    trigger: '#scroll-spacer',
    start: 'top 55%',
    end: 'top 35%',
    scrub: true,
    onUpdate: self => {
        document.getElementById('glass-overlay').style.opacity = self.progress;
    }
});
ScrollTrigger.create({
    trigger: '#scroll-spacer',
    start: 'top 15%',
    onEnter: () => {
        document.getElementById('cockpit-ui').classList.add('active');
    },
    onLeaveBack: () => {
        document.getElementById('cockpit-ui').classList.remove('active');
    }
});
gsap.to("#speed", {
    innerText: 340,
    duration: 3,
    snap: { innerText: 1 },
    scrollTrigger: {
        trigger: '#scroll-spacer',
        start: 'top top',
        end: 'bottom bottom',
        scrub: 2
    }
});

gsap.to("#rpm-fill", {
    width: "100%",
    scrollTrigger: {
        trigger: '#scroll-spacer',
        start: 'top top',
        end: 'bottom bottom',
        scrub: 2
    }
});
        // 4. Product cards
        gsap.to('.product-card', {
            opacity: 1, y: 0,
            duration: 0.8,
            stagger: 0.12,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '#products-preview',
                start:   'top 80%',
            }
        });
        gsap.to(fsCamera, {
    fov: 28,
    scrollTrigger: {
        trigger: '#scroll-spacer',
        start: 'top top',
        end: 'bottom bottom',
        scrub: 2
    },
    onUpdate: () => fsCamera.updateProjectionMatrix()
});
        ScrollTrigger.create({
    trigger: '#scroll-spacer',
    start: 'top top',
    end: 'bottom bottom',
    scrub: true,
    onUpdate: self => {
        const p = self.progress;

        fsKey.intensity = 1.8 - p * 1.2;
        fsFill.intensity = 0.3 - p * 0.2;
        fsRed1.intensity = 8 + p * 6;
    }
});

        // Resize
        window.addEventListener('resize', () => {
            heroCamera.aspect = frame.clientWidth / frame.clientHeight;
            heroCamera.updateProjectionMatrix();
            heroRenderer.setSize(frame.clientWidth, frame.clientHeight);

            fsCamera.aspect = window.innerWidth / window.innerHeight;
            fsCamera.updateProjectionMatrix();
            fsRenderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>
</html>
