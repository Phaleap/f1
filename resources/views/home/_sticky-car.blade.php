    {{-- ── 3D SCROLL / STICKY ── --}}
    <div id="scroll-spacer">
        <div id="sticky-car">

            <canvas id="car-fullscreen-canvas"></canvas>
            <div class="hud-glow"></div>

            {{-- Corner brackets --}}
            <div class="corner-bracket cb-tl" id="cb-tl"></div>
            <div class="corner-bracket cb-tr" id="cb-tr"></div>
            <div class="corner-bracket cb-bl" id="cb-bl"></div>
            <div class="corner-bracket cb-br" id="cb-br"></div>

            {{-- HUD specs --}}
            <div class="hud">
                <div class="hud-row">
                    <div class="hud-panel" id="spec-1">
                        <div class="hud-label">Power Output</div>
                        
                    </div>
                </div>
                <div class="hud-row">
                    <div class="hud-panel" id="spec-3">
                        <div class="hud-label">Constructor</div>
                        <div class="hud-value" style="font-size:1.8rem">Red Bull Racing</div>
                    </div>
                    <div class="hud-panel" id="spec-4" style="text-align:right">
                        <div class="hud-label">Engine</div>
                        <div class="hud-value" style="font-size:1.8rem">Honda RBPTH002</div>
                    </div>
                </div>
            </div>

            {{-- Speed Counter --}}
            <div id="hud-speed-wrap">
                <div class="hud-speed-label">Speed</div>
                <div class="hud-speed-value"><span id="hud-speed-num">0</span></div>
                <div class="hud-speed-unit">km/h</div>
            </div>

            {{-- RPM bar --}}
            <div id="hud-rpm-wrap">
                <div class="hud-rpm-label">Engine RPM</div>
                <div class="rpm-bar-track">
                    <div class="rpm-bar-fill" id="rpm-fill"></div>
                </div>
                <div class="rpm-ticks">
                    <span class="rpm-tick">2k</span>
                    <span class="rpm-tick">5k</span>
                    <span class="rpm-tick">8k</span>
                    <span class="rpm-tick">11k</span>
                    <span class="rpm-tick">15k</span>
                </div>
            </div>

            {{-- Gear indicator --}}
            <div id="hud-gear">
                <div class="gear-label">Gear</div>
                <div class="gear-value" id="gear-val">1</div>
            </div>

            {{-- Car name --}}
            <div class="hud-center" id="car-name">
                <div class="team">Oracle Red Bull Racing</div>
                <div class="model">RB<span>20</span></div>
            </div>

            {{-- Camera label --}}
            <div class="cam-label" id="cam-label">
                <div class="cam-label-tag">Viewing</div>
                <div class="cam-label-name" id="cam-label-name">Front Wing</div>
            </div>

            {{-- Progress dots --}}
            <div class="why-progress">
                <div class="why-dot active" id="dot-0"></div>
                <div class="why-dot" id="dot-1"></div>
                <div class="why-dot" id="dot-2"></div>
                <div class="why-dot" id="dot-3"></div>
            </div>

            {{-- Why Choose Us panels --}}
            <div class="why-text">
                <div class="why-item" id="why-1">
                    <div class="why-number">01 — Aerodynamics</div>
                    <h2>Cutting Edge<br>Front Wing</h2>
                    <p>Over 20,000 aerodynamic simulations shape every element for maximum downforce and minimal drag at 300km/h.</p>
                </div>
                <div class="why-item" id="why-2">
                    <div class="why-number">02 — Grip</div>
                    <h2>Precision<br>Wheel Control</h2>
                    <p>Multi-element suspension geometry delivers 3G of lateral force through the fastest corners on any circuit.</p>
                </div>
                <div class="why-item" id="why-3">
                    <div class="why-number">03 — Driver</div>
                    <h2>Command<br>The Cockpit</h2>
                    <p>The halo-protected cockpit puts 150 data channels at the driver's fingertips. Every input, measured and perfected.</p>
                </div>
                <div class="why-item" id="why-4">
                    <div class="why-number">04 — Power</div>
                    <h2>1000HP<br>Rear Exit</h2>
                    <p>The Honda RBPTH002 hybrid unit delivers 1000 combined horsepower through a seamless electric-combustion symphony.</p>
                </div>
            </div>

        </div>
    </div>

{{-- MARQUEE 2 --}}
@include('home._marquee', ['direction' => 'reverse', 'duration' => '25s'])