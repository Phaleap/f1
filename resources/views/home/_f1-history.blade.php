{{-- ═══════════════════════════════════════════════════════════════
     F1 HISTORY — GSAP Pinned Horizontal Scroll
     Each era = full-viewport panel: image LEFT, text RIGHT
     Drop into: @include('home._f1-history')
═══════════════════════════════════════════════════════════════ --}}

<section id="fh-pin-wrap">
    <div id="fh-panels">

        {{-- ══ INTRO PANEL ══ --}}
        <div class="fh-panel fh-panel--intro">
            <div class="fh-intro-content">
                <p class="section-eyebrow">Since 1950</p>
                <h2 class="fh-big-title">THE<br><span>HISTORY</span><br>OF F1</h2>
                <p class="fh-intro-sub">Seven decades. Thirty-four champions.<br>One obsession. Scroll to relive it.</p>
                <div class="fh-intro-arrow">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <div class="fh-intro-watermark">F1</div>
        </div>

        {{-- ══ 1950s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://www.goodwood.com/globalassets/.road--racing/race/historic/2021/4-april/list-best-f1-cars-1950s/best-f1-cars-of-the-1950s-1-alfa-romeo-158-alfetta-giuseppe-farina-silverstone-1950-mi-goodwood-30042021.jpg?rxy=0.5,0.5" alt="1950s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">SILVERSTONE · 1950</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 01 / 08</div>
                    <h3 class="fh-era-decade">1950<span>s</span></h3>
                    <p class="fh-era-subtitle">THE BIRTH</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Formula One roared to life on May 13, 1950 at Silverstone. Giuseppe Farina claimed the inaugural World Championship for Alfa Romeo. The sport was raw, dangerous, and utterly electrifying — a cocktail of courage and mechanical fury.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">7</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">295</span><span class="fh-s-key">km/h top</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">3</span><span class="fh-s-key">Champions</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">GIUSEPPE FARINA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 1960s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://motorsportmagazine.b-cdn.net/wp-content/uploads/2014/07/Moss-1960-Monaco-GP.jpg" alt="1960s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">MONACO · 1963</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 02 / 08</div>
                    <h3 class="fh-era-decade">1960<span>s</span></h3>
                    <p class="fh-era-subtitle">THE REVOLUTION</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">British teams rewrote engineering. Mid-engine layouts replaced front-engines forever. Jim Clark — one of the purest talents the sport ever produced — ruled Lotus with breathtaking precision and an almost supernatural connection with his machine.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">10</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">310</span><span class="fh-s-key">km/h top</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">5</span><span class="fh-s-key">Champions</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">JIM CLARK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 1970s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://macsmotorcitygarage.com/wp-content/uploads/2014/04/Stewart-Hill-Nurburgring-1966-.jpg" alt="1970s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">NÜRBURGRING · 1976</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 03 / 08</div>
                    <h3 class="fh-era-decade">1970<span>s</span></h3>
                    <p class="fh-era-subtitle">THE DANGER ZONE</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">The most dramatic decade in F1 history. Niki Lauda's fiery inferno at Nürburgring and miraculous return 42 days later defined an age where bravery was the baseline. Death was a passenger on every grid.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">16</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">325</span><span class="fh-s-key">km/h top</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">6</span><span class="fh-s-key">Champions</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">NIKI LAUDA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 1980s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://mediapool.bmwgroup.com/cache/P9/202509/P90619984/P90619984-nelson-piquet-circuito-estoril-2025-600px.jpg" alt="1980s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">ESTORIL · 1984</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 04 / 08</div>
                    <h3 class="fh-era-decade">1980<span>s</span></h3>
                    <p class="fh-era-subtitle">THE TURBO WAR</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Turbocharged engines producing over 1,400 hp in qualifying trim. The Senna–Prost war at McLaren became the greatest rivalry in motorsport history — genius against genius, wheel to wheel, lap after immortal lap.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">16</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">1400</span><span class="fh-s-key">HP turbo</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">5</span><span class="fh-s-key">Champions</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">AYRTON SENNA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 1990s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://s3-newsifier.ams3.digitaloceanspaces.com/grandprix247.com/images/2025-11/senna-wreck-getty-001.jpg" alt="1990s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">IMOLA · 1994</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 05 / 08</div>
                    <h3 class="fh-era-decade">1990<span>s</span></h3>
                    <p class="fh-era-subtitle">TRAGEDY & RISE</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Senna's death at Imola 1994 shook the world and transformed safety forever. From the ashes rose Michael Schumacher — clinical, relentless, unstoppable. The Scuderia Ferrari empire was about to begin its reign.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">17</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">340</span><span class="fh-s-key">km/h top</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">6</span><span class="fh-s-key">Champions</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">MICHAEL SCHUMACHER</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 2000s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://motorsport.ie/wp-content/uploads/2017/12/2004-Japanese-Grand-Prix.-Suzuka-Japan-8th-10th-October-2004-Michael-Schumacher-Ferrari-F2004.-Action.-World-Copyright-LAT-Photographic-.jpg" alt="2000s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">SUZUKA · 2004</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 06 / 08</div>
                    <h3 class="fh-era-decade">2000<span>s</span></h3>
                    <p class="fh-era-subtitle">THE DOMINATION</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Schumacher and Ferrari rewrote every record — five consecutive titles, 72 race wins, pure surgical dominance. Then a young Lewis Hamilton arrived in 2007 and dismantled everything the sport thought it knew.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">19</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">72</span><span class="fh-s-key">Schumi wins</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">5</span><span class="fh-s-key">Consecutive</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">MICHAEL SCHUMACHER</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 2010s ══ --}}
        <div class="fh-panel fh-panel--era">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://content.api.news/v3/images/bin/7488089281329bb62c02182ef5c3bc9b" alt="2010s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">SPA · 2017</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag">ERA 07 / 08</div>
                    <h3 class="fh-era-decade">2010<span>s</span></h3>
                    <p class="fh-era-subtitle">THE HYBRID ERA</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Mercedes hybrid power units became the most dominant force in F1 history. Lewis Hamilton matched then surpassed Schumacher's 7 titles. Technology replaced raw bravery as the ultimate weapon on track.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">21</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">1000</span><span class="fh-s-key">HP hybrid</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">6</span><span class="fh-s-key">Hamilton WC</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">LEWIS HAMILTON</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 2020s ══ --}}
        <div class="fh-panel fh-panel--era fh-panel--current">
            <div class="fh-img-side">
                <div class="fh-img-wrap">
                    <img src="https://media.formula1.com/image/upload/c_lfill,w_3392/q_auto/v1740000001/content/dam/fom-website/2018-redesign-assets/Racehub%20header%20images%2016x9/Abu%20Dhabi.webp" alt="2020s F1" class="fh-img" />
                    <div class="fh-img-overlay"></div>
                </div>
                <div class="fh-img-label">ABU DHABI · 2021</div>
            </div>
            <div class="fh-text-side">
                <div class="fh-text-inner">
                    <div class="fh-era-tag fh-era-tag--live">ERA 08 / 08 &nbsp;·&nbsp; NOW LIVE</div>
                    <h3 class="fh-era-decade">2020<span>s</span></h3>
                    <p class="fh-era-subtitle">THE NEW ORDER</p>
                    <div class="fh-text-line"></div>
                    <p class="fh-era-body">Abu Dhabi 2021 — the most controversial finale in F1 history. Max Verstappen seized power and never looked back. Red Bull dominated 2022–23 like no team before. A new generation now writes the legend.</p>
                    <div class="fh-era-stats">
                        <div class="fh-s"><span class="fh-s-val">24</span><span class="fh-s-key">Rounds</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">372</span><span class="fh-s-key">km/h top</span></div>
                        <div class="fh-s-div"></div>
                        <div class="fh-s"><span class="fh-s-val">4</span><span class="fh-s-key">VER titles</span></div>
                    </div>
                    <div class="fh-driver">
                        <div class="fh-driver-line"></div>
                        <div>
                            <p class="fh-driver-role">LEGEND OF THE ERA</p>
                            <p class="fh-driver-name">MAX VERSTAPPEN</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ OUTRO PANEL ══ --}}
        <div class="fh-panel fh-panel--outro">
            <div class="fh-outro-inner">
                <p class="fh-outro-eyebrow">75 Years of Racing</p>
                <h2 class="fh-outro-title">THE LEGEND<br><span>CONTINUES</span></h2>
                <div class="fh-outro-stats">
                    <div class="fh-os"><span class="fh-os-val">1,100<span>+</span></span><span class="fh-os-key">Races</span></div>
                    <div class="fh-os"><span class="fh-os-val">34</span><span class="fh-os-key">Champions</span></div>
                    <div class="fh-os"><span class="fh-os-val">20</span><span class="fh-os-key">Teams</span></div>
                    <div class="fh-os"><span class="fh-os-val">∞</span><span class="fh-os-key">Passion</span></div>
                </div>
                <a href="#" class="btn-primary" style="display:inline-block;margin-top:48px;">SHOP THE COLLECTION</a>
            </div>
            <div class="fh-outro-watermark">F1</div>
        </div>

    </div>{{-- /#fh-panels --}}

    {{-- HUD bar --}}
    <div class="fh-hud-bar">
        <div class="fh-hud-era" id="fh-hud-era">1950s</div>
        <div class="fh-hud-track"><div class="fh-hud-fill" id="fh-hud-fill"></div></div>
        <div class="fh-hud-count" id="fh-hud-count">01 / 08</div>
    </div>

</section>


{{-- ══════════════════════════════════════════════════════════════ STYLES --}}
<style>
#fh-pin-wrap {
    position: relative;
    background: var(--dark);
    overflow: hidden;
}
#fh-panels {
    display: flex;
    flex-wrap: nowrap;
    width: max-content;
    will-change: transform;
}

/* Every panel = full viewport */
.fh-panel {
    width: 100vw;
    height: 100vh;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    display: flex;
}

/* ── INTRO ── */
.fh-panel--intro {
    align-items: center;
    background: var(--dark);
}
.fh-intro-content {
    padding: 0 10vw;
    position: relative;
    z-index: 2;
}
.fh-intro-content .section-eyebrow { margin-bottom: 24px; }
.fh-big-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(6rem, 14vw, 14rem);
    letter-spacing: 6px;
    line-height: 0.88;
    color: #fff;
    margin-bottom: 32px;
}
.fh-big-title span {
    color: var(--red);
    text-shadow: 0 0 80px rgba(225,6,0,0.5);
    display: block;
}
.fh-intro-sub {
    font-size: 0.9rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.38);
    line-height: 2;
    text-transform: uppercase;
    margin-bottom: 48px;
}
.fh-intro-arrow { display: flex; gap: 6px; align-items: center; }
.fh-intro-arrow span {
    display: block;
    width: 10px; height: 10px;
    border-right: 2px solid var(--red);
    border-bottom: 2px solid var(--red);
    transform: rotate(-45deg);
    animation: arrowSeq 1.5s ease infinite;
}
.fh-intro-arrow span:nth-child(1) { animation-delay: 0s; }
.fh-intro-arrow span:nth-child(2) { animation-delay: 0.18s; }
.fh-intro-arrow span:nth-child(3) { animation-delay: 0.36s; }
@keyframes arrowSeq {
    0%,100% { opacity: 0.2; }
    50%      { opacity: 1; }
}
.fh-intro-watermark {
    position: absolute;
    right: -4vw; bottom: -12vh;
    font-family: 'Bebas Neue', cursive;
    font-size: 40vw;
    color: rgba(255,255,255,0.016);
    line-height: 1;
    pointer-events: none;
    user-select: none;
    letter-spacing: -8px;
}

/* ── ERA PANEL ── */
.fh-panel--era { flex-direction: row; }

.fh-img-side {
    width: 55%;
    height: 100%;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}
.fh-img-wrap { width: 100%; height: 100%; position: relative; }
.fh-img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    filter: grayscale(40%) brightness(0.65) contrast(1.1);
    transform: scale(1.06);
    transition: transform 1.2s cubic-bezier(0.25,0.46,0.45,0.94),
                filter 0.8s ease;
}
.fh-panel--era.fh-is-active .fh-img {
    transform: scale(1);
    filter: grayscale(5%) brightness(0.82) contrast(1.1);
}
.fh-img-overlay {
    position: absolute; inset: 0;
    background:
        linear-gradient(to right, transparent 55%, var(--dark) 100%),
        linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, transparent 35%, rgba(0,0,0,0.5) 100%);
    pointer-events: none;
}
.fh-img-side::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 3px; height: 100%;
    background: linear-gradient(to bottom, transparent, var(--red) 25%, var(--red) 75%, transparent);
    z-index: 3;
}
.fh-img-label {
    position: absolute;
    bottom: 36px; left: 36px;
    font-size: 0.58rem;
    letter-spacing: 7px;
    color: rgba(240,237,232,0.35);
    text-transform: uppercase;
    z-index: 2;
}

.fh-text-side {
    width: 45%;
    height: 100%;
    display: flex;
    align-items: center;
    padding: 0 5vw;
    background: var(--dark);
    position: relative;
}
.fh-text-inner { max-width: 480px; }

.fh-era-tag {
    font-size: 0.58rem;
    letter-spacing: 6px;
    color: rgba(225,6,0,0.65);
    text-transform: uppercase;
    margin-bottom: 16px;
}
.fh-era-tag--live {
    color: var(--red);
    animation: livePulse 2s ease infinite;
}
@keyframes livePulse { 0%,100%{opacity:.6} 50%{opacity:1} }

.fh-era-decade {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(5rem, 8vw, 9rem);
    letter-spacing: 4px;
    line-height: 0.9;
    color: #fff;
    margin-bottom: 10px;
}
.fh-era-decade span { color: var(--red); font-size: 58%; }

.fh-era-subtitle {
    font-size: 0.65rem;
    letter-spacing: 8px;
    color: rgba(240,237,232,0.32);
    text-transform: uppercase;
    margin-bottom: 28px;
}
.fh-text-line {
    width: 56px; height: 1px;
    background: linear-gradient(to right, var(--red), transparent);
    margin-bottom: 26px;
}
.fh-era-body {
    font-size: 0.9rem;
    letter-spacing: 0.6px;
    color: rgba(240,237,232,0.52);
    line-height: 1.95;
    margin-bottom: 32px;
}
.fh-era-stats {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-top: 1px solid rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    margin-bottom: 30px;
}
.fh-s { flex: 1; text-align: center; }
.fh-s-val {
    display: block;
    font-family: 'Bebas Neue', cursive;
    font-size: 2.2rem;
    letter-spacing: 2px;
    color: #fff;
    line-height: 1;
}
.fh-s-key {
    display: block;
    font-size: 0.48rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.28);
    text-transform: uppercase;
    margin-top: 5px;
}
.fh-s-div { width: 1px; height: 32px; background: rgba(255,255,255,0.06); flex-shrink: 0; }

.fh-driver { display: flex; align-items: center; gap: 16px; }
.fh-driver-line { width: 2px; height: 38px; background: var(--red); flex-shrink: 0; }
.fh-driver-role { font-size: 0.48rem; letter-spacing: 5px; color: rgba(225,6,0,0.6); text-transform: uppercase; margin-bottom: 5px; }
.fh-driver-name { font-family: 'Bebas Neue', cursive; font-size: 1.35rem; letter-spacing: 4px; color: rgba(240,237,232,0.88); }

.fh-panel--current .fh-text-side::before {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0; height: 280px;
    background: radial-gradient(ellipse at bottom, rgba(225,6,0,0.07) 0%, transparent 70%);
    pointer-events: none;
}

/* ── OUTRO ── */
.fh-panel--outro {
    align-items: center;
    background: var(--dark);
}
.fh-outro-inner {
    padding: 0 10vw;
    position: relative;
    z-index: 2;
}
.fh-outro-eyebrow {
    font-size: 0.68rem;
    letter-spacing: 8px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.fh-outro-eyebrow::before { content: ''; display: block; width: 24px; height: 1px; background: var(--red); }
.fh-outro-title {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(4rem, 9vw, 10rem);
    letter-spacing: 5px;
    line-height: 0.9;
    color: #fff;
    margin-bottom: 60px;
}
.fh-outro-title span {
    color: var(--red);
    text-shadow: 0 0 80px rgba(225,6,0,0.45);
    display: block;
}
.fh-outro-stats { display: flex; gap: 60px; align-items: flex-end; }
.fh-os { display: flex; flex-direction: column; }
.fh-os-val { font-family: 'Bebas Neue', cursive; font-size: clamp(3rem, 5vw, 5.5rem); letter-spacing: 3px; color: #fff; line-height: 1; }
.fh-os-val span { color: var(--red); }
.fh-os-key { font-size: 0.55rem; letter-spacing: 5px; color: rgba(240,237,232,0.28); text-transform: uppercase; margin-top: 7px; }
.fh-outro-watermark {
    position: absolute; right: -4vw; bottom: -10vh;
    font-family: 'Bebas Neue', cursive;
    font-size: 45vw;
    color: rgba(255,255,255,0.014);
    line-height: 1; pointer-events: none; user-select: none; letter-spacing: -10px;
}

/* ── HUD BAR ── */
.fh-hud-bar {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 46px;
    background: rgba(5,5,5,0.92);
    backdrop-filter: blur(16px);
    border-top: 1px solid rgba(225,6,0,0.12);
    display: flex;
    align-items: center;
    gap: 22px;
    padding: 0 70px;
    z-index: 100;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s;
}
.fh-hud-bar.fh-hud-visible { opacity: 1; }
.fh-hud-era { font-family: 'Bebas Neue', cursive; font-size: 1rem; letter-spacing: 5px; color: var(--red); width: 72px; flex-shrink: 0; }
.fh-hud-track { flex: 1; height: 1px; background: rgba(255,255,255,0.07); position: relative; }
.fh-hud-fill {
    position: absolute; left: 0; top: 0; bottom: 0; width: 0%;
    background: linear-gradient(to right, var(--red), #ff4400);
    box-shadow: 0 0 8px rgba(225,6,0,0.8);
}
.fh-hud-count { font-size: 0.58rem; letter-spacing: 4px; color: rgba(240,237,232,0.28); width: 56px; text-align: right; flex-shrink: 0; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .fh-panel--era { flex-direction: column; }
    .fh-img-side   { width: 100%; height: 42vh; }
    .fh-text-side  { width: 100%; height: 58vh; padding: 28px 24px; overflow-y: auto; align-items: flex-start; }
    .fh-text-inner { max-width: 100%; }
    .fh-era-decade { font-size: 4rem; }
    .fh-era-body   { font-size: 0.8rem; margin-bottom: 20px; }
    .fh-big-title  { font-size: clamp(3.5rem, 16vw, 7rem); }
    .fh-hud-bar    { padding: 0 24px; }
    .fh-outro-stats { gap: 24px; flex-wrap: wrap; }
    .fh-outro-inner { padding: 0 6vw; }
    .fh-img-side::after { display: none; }
}
</style>


{{-- ══════════════════════════════════════════════════════════════ SCRIPTS --}}
<script>
(function () {
    function initFH() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            return setTimeout(initFH, 80);
        }
        gsap.registerPlugin(ScrollTrigger);

        const panels    = document.getElementById('fh-panels');
        const wrap      = document.getElementById('fh-pin-wrap');
        const fill      = document.getElementById('fh-hud-fill');
        const hudEra    = document.getElementById('fh-hud-era');
        const hudCount  = document.getElementById('fh-hud-count');
        const hudBar    = document.querySelector('.fh-hud-bar');
        const allPanels = document.querySelectorAll('.fh-panel');
        const eraPanels = document.querySelectorAll('.fh-panel--era');
        const eraNames  = ['1950s','1960s','1970s','1980s','1990s','2000s','2010s','2020s'];
        const totalPanels = allPanels.length; // intro + 8 eras + outro = 10

        const getScrollDist = () => panels.scrollWidth - window.innerWidth;

        /* ── Main horizontal pin ── */
        gsap.timeline({
            scrollTrigger: {
                trigger: wrap,
                pin: true,
                scrub: 1.2,
                start: 'top top',
                end: () => `+=${getScrollDist()}`,
                invalidateOnRefresh: true,
                onUpdate(self) {
                    /* Progress fill */
                    fill.style.width = (self.progress * 100) + '%';

                    /* Era label */
                    const eraIndex = Math.min(
                        Math.floor(self.progress * (totalPanels - 1)) - 1,
                        eraNames.length - 1
                    );
                    const clampedEra = Math.max(eraIndex, 0);
                    hudEra.textContent   = eraNames[clampedEra];
                    hudCount.textContent = String(clampedEra + 1).padStart(2,'0') + ' / 08';

                    /* Show/hide HUD */
                    hudBar.classList.toggle('fh-hud-visible', self.progress > 0.05);

                    /* Active image per era */
                    eraPanels.forEach((p, i) => {
                        const start = (i + 1) / totalPanels;
                        const end   = (i + 2) / totalPanels;
                        p.classList.toggle('fh-is-active', self.progress >= start - 0.02 && self.progress < end + 0.02);
                    });
                }
            }
        }).to(panels, { x: () => -getScrollDist(), ease: 'none' });

        /* ── Per-era text reveal ── */
        eraPanels.forEach((panel, i) => {
            const els = panel.querySelectorAll(
                '.fh-era-tag, .fh-era-decade, .fh-era-subtitle, .fh-text-line, .fh-era-body, .fh-era-stats, .fh-driver'
            );
            gsap.set(els, { opacity: 0, y: 32 });

            const panelProgress = (i + 1) / totalPanels;

            ScrollTrigger.create({
                trigger: wrap,
                start: 'top top',
                end: () => `+=${getScrollDist()}`,
                onUpdate(self) {
                    const diff = self.progress - panelProgress;
                    if (diff >= -0.015 && diff < 1 / totalPanels + 0.01) {
                        gsap.to(els, { opacity: 1, y: 0, duration: 0.55, stagger: 0.065, ease: 'power2.out', overwrite: 'auto' });
                    } else if (diff < -0.015) {
                        gsap.to(els, { opacity: 0, y: 32, duration: 0.25, overwrite: 'auto' });
                    }
                }
            });
        });

        /* ── Intro reveal on load ── */
        gsap.from([
            '.fh-panel--intro .section-eyebrow',
            '.fh-big-title',
            '.fh-intro-sub',
            '.fh-intro-arrow'
        ], {
            scrollTrigger: { trigger: wrap, start: 'top 80%' },
            opacity: 0, y: 36, duration: 0.9, stagger: 0.13, ease: 'power2.out'
        });

        /* ── Outro reveal ── */
        const outroEls = document.querySelectorAll(
            '.fh-outro-eyebrow, .fh-outro-title, .fh-os, .fh-panel--outro .btn-primary'
        );
        gsap.set(outroEls, { opacity: 0, y: 32 });
        ScrollTrigger.create({
            trigger: wrap,
            start: 'top top',
            end: () => `+=${getScrollDist()}`,
            onUpdate(self) {
                if (self.progress > 0.91) {
                    gsap.to(outroEls, { opacity: 1, y: 0, duration: 0.7, stagger: 0.09, ease: 'power2.out', overwrite: 'auto' });
                } else {
                    gsap.to(outroEls, { opacity: 0, y: 32, duration: 0.3, overwrite: 'auto' });
                }
            }
        });

        window.addEventListener('resize', () => ScrollTrigger.refresh());
    }

    initFH();
})();
</script>