{{-- ─── Footer ─────────────────────────────────────────────────────── --}}
<footer id="footer">

    {{-- Top accent line --}}
    <div class="footer-top-line"></div>

    {{-- Main content --}}
    <div class="footer-main">

        {{-- Brand col --}}
        <div class="footer-brand">
            <a href="/" class="footer-logo">F1<span>·</span>Store</a>
            <p class="footer-tagline">Precision · Power · Performance</p>
            <p class="footer-desc">
                The official destination for Formula One cars and merchandise.
                Built for racers. Designed for champions.
            </p>
            {{-- Social icons --}}
            <div class="footer-socials">
                <a href="#" class="footer-social" title="Instagram" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>
                <a href="#" class="footer-social" title="Twitter / X" aria-label="Twitter">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                    </svg>
                </a>
                <a href="#" class="footer-social" title="YouTube" aria-label="YouTube">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Links --}}
        <div class="footer-links-group">

            <div class="footer-col">
                <div class="footer-col-title">Shop</div>
                <ul>
                    <li><a href="{{ route('shop') }}">Race Cars</a></li>
                    <li><a href="{{ route('shop') }}">Merchandise</a></li>
                    <li><a href="{{ route('shop') }}">Helmets</a></li>
                    <li><a href="{{ route('shop') }}">Accessories</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col-title">Account</div>
                <ul>
                    @auth
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col-title">Info</div>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

        </div>

        {{-- Newsletter col --}}
        <div class="footer-newsletter">
            <div class="footer-col-title">Race Updates</div>
            <p class="footer-newsletter-desc">
                Get notified on new drops, race-weekend deals, and limited editions.
            </p>
            <form class="footer-form" onsubmit="return false;">
                <input type="email" placeholder="YOUR EMAIL" class="footer-input" />
                <button type="submit" class="footer-submit">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 7h12M7 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
                    </svg>
                </button>
            </form>
            <p class="footer-form-note">No spam. Unsubscribe anytime.</p>
        </div>

    </div>

    {{-- Divider --}}
    <div class="footer-divider"></div>

    {{-- Bottom bar --}}
    <div class="footer-bottom">
        <div class="footer-copy">© {{ date('Y') }} Formula One Store — All rights reserved</div>
        <div class="footer-badges">
            <span class="footer-badge">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                Secure Checkout
            </span>
            <span class="footer-badge">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 12 20 22 4 22 4 12"/>
                    <rect x="2" y="7" width="20" height="5"/>
                    <line x1="12" y1="22" x2="12" y2="7"/>
                    <path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/>
                    <path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/>
                </svg>
                Official Merch
            </span>
            <span class="footer-badge">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="2" y1="12" x2="22" y2="12"/>
                    <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                </svg>
                Worldwide Shipping
            </span>
        </div>
    </div>

</footer>

<style>
/* ─────────────────────────────────────────
   FOOTER
───────────────────────────────────────── */
#footer {
    background: var(--dark-2);
    padding: 80px 60px 40px;
    position: relative;
}

.footer-top-line {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, transparent 0%, var(--red) 30%, var(--red) 70%, transparent 100%);
    opacity: 0.5;
}

/* ── Main grid ── */
.footer-main {
    display: grid;
    grid-template-columns: 1.4fr 1.6fr 1fr;
    gap: 60px;
    margin-bottom: 60px;
    align-items: start;
}

/* ── Brand ── */
.footer-brand {}
.footer-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.2rem;
    letter-spacing: 6px;
    color: var(--off-white);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 10px;
    transition: color 0.3s;
}
.footer-logo:hover { color: rgba(240,237,232,0.7); }
.footer-logo span { color: var(--red); }

.footer-tagline {
    font-size: 0.55rem;
    letter-spacing: 5px;
    color: rgba(240,237,232,0.3);
    text-transform: uppercase;
    margin-bottom: 20px;
}

.footer-desc {
    font-size: 0.8rem;
    line-height: 1.75;
    color: rgba(240,237,232,0.35);
    letter-spacing: 0.5px;
    max-width: 280px;
    margin-bottom: 28px;
}

/* Socials */
.footer-socials {
    display: flex;
    gap: 10px;
}
.footer-social {
    width: 36px; height: 36px;
    border: 1px solid rgba(255,255,255,0.08);
    display: flex; align-items: center; justify-content: center;
    color: rgba(240,237,232,0.3);
    text-decoration: none;
    transition: border-color 0.3s, color 0.3s, background 0.3s;
}
.footer-social:hover {
    border-color: var(--red);
    color: var(--off-white);
    background: rgba(225,6,0,0.08);
}

/* ── Links group ── */
.footer-links-group {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.footer-col {}
.footer-col-title {
    font-size: 0.55rem;
    letter-spacing: 6px;
    color: var(--red);
    text-transform: uppercase;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.footer-col-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(225,6,0,0.15);
}

.footer-col ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.footer-col ul a {
    font-size: 0.78rem;
    letter-spacing: 2px;
    color: rgba(240,237,232,0.45);
    text-decoration: none;
    text-transform: uppercase;
    transition: color 0.3s, padding-left 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
    position: relative;
}
.footer-col ul a::before {
    content: '';
    width: 0; height: 1px;
    background: var(--red);
    transition: width 0.3s;
    flex-shrink: 0;
}
.footer-col ul a:hover {
    color: var(--off-white);
}
.footer-col ul a:hover::before { width: 12px; }

/* ── Newsletter ── */
.footer-newsletter {}
.footer-newsletter-desc {
    font-size: 0.75rem;
    line-height: 1.7;
    color: rgba(240,237,232,0.35);
    margin-bottom: 20px;
    letter-spacing: 0.5px;
}
.footer-form {
    display: flex;
    height: 44px;
    margin-bottom: 10px;
}
.footer-input {
    flex: 1;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-right: none;
    color: var(--off-white);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    padding: 0 16px;
    outline: none;
    transition: border-color 0.3s;
}
.footer-input::placeholder { color: rgba(240,237,232,0.2); }
.footer-input:focus { border-color: rgba(225,6,0,0.4); }

.footer-submit {
    width: 44px;
    background: var(--red);
    border: none;
    color: #fff;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background 0.3s;
}
.footer-submit:hover { background: var(--red-glow); }

.footer-form-note {
    font-size: 0.48rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.15);
    text-transform: uppercase;
}

/* ── Divider ── */
.footer-divider {
    height: 1px;
    background: rgba(255,255,255,0.04);
    margin-bottom: 28px;
}

/* ── Bottom bar ── */
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-copy {
    font-size: 0.58rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.2);
    text-transform: uppercase;
}

.footer-badges {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.footer-badge {
    font-size: 0.5rem;
    letter-spacing: 3px;
    color: rgba(240,237,232,0.25);
    text-transform: uppercase;
    border: 1px solid rgba(255,255,255,0.06);
    padding: 6px 12px;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: border-color 0.3s, color 0.3s;
}
.footer-badge:hover {
    border-color: rgba(225,6,0,0.2);
    color: rgba(240,237,232,0.45);
}
.footer-badge svg { opacity: 0.5; }

/* ── Responsive ── */
@media (max-width: 1100px) {
    .footer-main { grid-template-columns: 1fr 1fr; gap: 48px; }
    .footer-newsletter { grid-column: 1 / -1; }
}

@media (max-width: 768px) {
    #footer { padding: 60px 24px 32px; }
    .footer-main { grid-template-columns: 1fr; gap: 40px; }
    .footer-links-group { grid-template-columns: 1fr 1fr; gap: 28px; }
    .footer-newsletter { grid-column: auto; }
    .footer-bottom { flex-direction: column; align-items: flex-start; }
}
</style>