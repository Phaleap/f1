<script type="importmap">
{
    "imports": {
        "three":         "https://cdn.jsdelivr.net/npm/three@0.161.0/build/three.module.js",
        "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.161.0/examples/jsm/"
    }
}
</script>

<script type="module">
    import * as THREE from 'three';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

    gsap.registerPlugin(ScrollTrigger);

    /* ══════════════════════════════════════
       SCENE SETUP
    ══════════════════════════════════════ */
    const fsCanvas   = document.getElementById('car-fullscreen-canvas');
    const fsRenderer = new THREE.WebGLRenderer({ canvas: fsCanvas, antialias: true, alpha: true });
    fsRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    fsRenderer.setSize(window.innerWidth, window.innerHeight);
    fsRenderer.outputColorSpace    = THREE.SRGBColorSpace;
    fsRenderer.toneMapping         = THREE.ACESFilmicToneMapping;
    fsRenderer.toneMappingExposure = 1.6;

    const fsScene  = new THREE.Scene();
    const fsCamera = new THREE.PerspectiveCamera(38, window.innerWidth / window.innerHeight, 0.1, 100);
    fsCamera.position.set(0, 1, 6);

    fsScene.fog = new THREE.FogExp2(0x000000, 0.06);

    /* ── Lighting ── */
    fsScene.add(new THREE.AmbientLight(0xffffff, 0.3));

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

    const fsRim = new THREE.DirectionalLight(0xff2200, 0.6);
    fsRim.position.set(0, -2, -5);
    fsScene.add(fsRim);

    /* ══════════════════════════════════════
       LOAD CAR
    ══════════════════════════════════════ */
    let fsCar = null;
    const loader = new GLTFLoader();

    loader.load(
        '/models/f1-car.glb',
        gltf => {
            fsCar = gltf.scene;

            const box    = new THREE.Box3().setFromObject(fsCar);
            const center = box.getCenter(new THREE.Vector3());
            const size   = box.getSize(new THREE.Vector3());
            const scale  = 4.5 / Math.max(size.x, size.y, size.z);

            fsCar.scale.setScalar(scale);
            fsCar.position.sub(center.multiplyScalar(scale));
            fsCar.rotation.y = Math.PI / 2;

            fsCar.traverse(child => {
                if (child.isMesh && child.material) {
                    child.material.transparent = false;
                    child.material.opacity      = 1;
                }
            });

            fsScene.add(fsCar);

            /* ── Show HUD after model loads ── */
            gsap.to(['#spec-1', '#spec-3', '#spec-4'], {
                opacity: 1, y: 0,
                duration: 0.9, stagger: 0.15, ease: 'power3.out'
            });
            gsap.to('#car-name',        { opacity: 1, duration: 1,   delay: 0.5 });
            gsap.to('#cam-label',       { opacity: 1, duration: 1,   delay: 0.8 });
            gsap.to('#hud-speed-wrap',  { opacity: 1, duration: 0.8, delay: 0.6 });
            gsap.to('#hud-rpm-wrap',    { opacity: 1, duration: 0.8, delay: 0.7 });
            gsap.to('#hud-gear',        { opacity: 1, duration: 0.8, delay: 0.9 });
            gsap.to(['.cb-tl', '.cb-tr', '.cb-bl', '.cb-br'], {
                opacity: 1, duration: 1, stagger: 0.1, delay: 1, ease: 'power2.out'
            });
            gsap.to('#why-1', { opacity: 1, y: 0, duration: 0.8, delay: 0.6 });
        },
        undefined,
        err => console.error('GLB load error:', err)
    );

    /* ══════════════════════════════════════
       RENDER LOOP
    ══════════════════════════════════════ */
    let fsT = 0;
    function animateFS() {
        requestAnimationFrame(animateFS);
        fsT += 0.005;
        if (fsCar) {
            fsCar.position.y = Math.sin(fsT) * 0.03;
            fsCar.rotation.y = (Math.PI / 2) + Math.sin(fsT * 0.4) * 0.008;
        }
        fsRed1.intensity = 8  + Math.sin(fsT * 2) * 1.5;
        fsRed2.intensity = 4  + Math.sin(fsT * 2 + 1) * 0.8;
        fsRenderer.render(fsScene, fsCamera);
    }
    animateFS();

    /* ══════════════════════════════════════
       CAMERA STEPS
    ══════════════════════════════════════ */
    const camLabels = ['Front Wing', 'Wheel & Sidepod', 'Cockpit & Halo', 'Rear Wing'];

    const steps = [
        {
            cam:  new THREE.Vector3(0,    1,    6),
            look: new THREE.Vector3(0,    0.5,  0),
            text: '#why-1', dot: 0,
            speed: 60,   rpm: 18, gear: 1,
            keyInt: 1.8, redInt: 8
        },
        {
            cam:  new THREE.Vector3(2.5,  1.2,  3),
            look: new THREE.Vector3(1.5,  0.5,  0),
            text: '#why-2', dot: 1,
            speed: 180,  rpm: 52, gear: 4,
            keyInt: 1.4, redInt: 10
        },
        {
            cam:  new THREE.Vector3(0,    2,    1.5),
            look: new THREE.Vector3(0,    0.8,  0),
            text: '#why-3', dot: 2,
            speed: 260,  rpm: 74, gear: 6,
            keyInt: 1.0, redInt: 12
        },
        {
            cam:  new THREE.Vector3(-3,   1.2,  -3),
            look: new THREE.Vector3(-1,   0.5,  0),
            text: '#why-4', dot: 3,
            speed: 340,  rpm: 95, gear: 8,
            keyInt: 0.8, redInt: 15
        }
    ];

    let displayedSpeed = 0;
    let targetSpeed    = steps[0].speed;

    function tickSpeed() {
        const diff = targetSpeed - displayedSpeed;
        displayedSpeed += diff * 0.06;
        const el = document.getElementById('hud-speed-num');
        if (el) el.textContent = Math.round(displayedSpeed);
    }

    let lastGear = 1;
    function setGear(g) {
        if (g === lastGear) return;
        lastGear = g;
        const el = document.getElementById('gear-val');
        if (!el) return;
        el.textContent = g;
        el.classList.add('shift');
        setTimeout(() => el.classList.remove('shift'), 300);
    }

    let activeIndex = -1;

    function showStep(i) {
        const cur = steps[i];
        steps.forEach(s => {
            gsap.to(s.text, { opacity: 0, y: 40, duration: 0.35, ease: 'power2.in' });
        });
        gsap.to(cur.text, { opacity: 1, y: 0, duration: 0.7, delay: 0.3, ease: 'power3.out' });

        steps.forEach((s, idx) => {
            document.getElementById('dot-' + idx)?.classList.toggle('active', idx === i);
        });

        const labelEl = document.getElementById('cam-label-name');
        if (labelEl) {
            gsap.to('#cam-label', { opacity: 0, duration: 0.2, onComplete: () => {
                labelEl.textContent = camLabels[i];
                gsap.to('#cam-label', { opacity: 1, duration: 0.4 });
            }});
        }

        fsKey.intensity  = cur.keyInt;
        fsRed1.intensity = cur.redInt;
        targetSpeed      = cur.speed;
        setGear(cur.gear);

        const rpmFill = document.getElementById('rpm-fill');
        if (rpmFill) rpmFill.style.width = cur.rpm + '%';
    }

    /* ── Scroll-driven camera ── */
    ScrollTrigger.create({
        trigger: '#scroll-spacer',
        start:   'top top',
        end:     'bottom bottom',
        scrub:   2,
        onUpdate: self => {
            const total = self.progress * (steps.length - 1);
            const i     = Math.min(Math.floor(total), steps.length - 2);
            const raw   = total - i;
            const t     = gsap.parseEase('power2.inOut')(raw);

            const cur  = steps[i];
            const next = steps[i + 1];

            const pos  = new THREE.Vector3().lerpVectors(cur.cam,  next.cam,  t);
            const look = new THREE.Vector3().lerpVectors(cur.look, next.look, t);
            fsCamera.position.copy(pos);
            fsCamera.lookAt(look);

            targetSpeed = cur.speed + (next.speed - cur.speed) * t;

            if (i !== activeIndex) {
                activeIndex = i;
                showStep(i);
            }

            tickSpeed();
        }
    });

    /* ── FOV zoom ── */
    ScrollTrigger.create({
        trigger: '#scroll-spacer',
        start:   'top top',
        end:     'bottom bottom',
        scrub:   2,
        onUpdate: self => {
            fsCamera.fov = 38 - self.progress * 8;
            fsCamera.updateProjectionMatrix();
        }
    });

    /* ── Hero fade on scroll ── */
    gsap.to('#hero', {
        opacity: 0,
        scrollTrigger: {
            trigger: '#scroll-spacer',
            start:   'top 80%',
            end:     'top 40%',
            scrub:   true
        }
    });

    /* ── Products reveal ── */
    gsap.to('.product-card', {
        opacity: 1, y: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '#products-preview',
            start:   'top 80%'
        }
    });

    /* ── Resize ── */
    window.addEventListener('resize', () => {
        fsCamera.aspect = window.innerWidth / window.innerHeight;
        fsCamera.updateProjectionMatrix();
        fsRenderer.setSize(window.innerWidth, window.innerHeight);
    });
</script>