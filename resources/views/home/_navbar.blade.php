{{-- ─── Navbar ────────────────────────────────────────────────────── --}}
<nav id="navbar">

    {{-- Logo --}}
    <a href="/" class="nav-logo">F1<span>·</span>Store</a>

    {{-- Desktop links --}}
    <ul class="nav-links">
        <li><a href="{{ route('shop') }}">Shop</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li class="nav-divider"></li>

        {{-- Cart with badge --}}
        <li>
            <a href="{{ route('cart.index') }}" class="nav-icon-link cart-link" title="Cart">
                <span class="cart-icon-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    @auth
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', Auth::id())
                                ->first()
                                ?->items()
                                ->sum('quantity') ?? 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge" id="cartBadge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                        @else
                            <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                        @endif
                    @else
                        <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                    @endauth
                </span>
                Cart
            </a>
        </li>

        @auth
            <li>
                <a href="{{ route('orders.index') }}" class="nav-icon-link" title="Orders">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" class="nav-btn-outline">
                    {{ Auth::user()->full_name ? explode(' ', Auth::user()->full_name)[0] : 'Account' }}
                </a>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="nav-btn-outline">Login</a></li>
            <li><a href="{{ route('register') }}" class="nav-btn-primary">Register</a></li>
        @endauth
    </ul>

    {{-- Hamburger --}}
    <button class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>

</nav>

{{-- Mobile nav --}}
<div class="nav-mobile" id="mobile-nav">

    <button class="nav-mobile-close" onclick="toggleMobileNav()" aria-label="Close">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>

    <div class="nav-mobile-logo">F1<span>·</span>Store</div>

    <div class="nav-mobile-links">
        <a href="{{ route('about') }}" onclick="toggleMobileNav()"><span class="nm-num">01</span>About Us</a>
        <a href="{{ route('contact') }}" onclick="toggleMobileNav()"><span class="nm-num">02</span>Contact</a>
        <a href="{{ route('shop') }}" onclick="toggleMobileNav()"><span class="nm-num">03</span>Shop</a>
        <a href="{{ route('cart.index') }}" onclick="toggleMobileNav()"><span class="nm-num">04</span>Cart</a>
        @auth
            <a href="{{ route('orders.index') }}" onclick="toggleMobileNav()"><span class="nm-num">05</span>Orders</a>
            <a href="{{ route('profile.edit') }}" onclick="toggleMobileNav()"><span class="nm-num">06</span>Account</a>
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileNav()"><span class="nm-num">07</span>Login</a>
            <a href="{{ route('register') }}" onclick="toggleMobileNav()"><span class="nm-num">08</span>Register</a>
        @endauth
    </div>

    <div class="nav-mobile-foot">Precision · Power · Performance</div>

</div>


<style>
nav#navbar {
    position: fixed;
    top: 28px; left: 0; right: 0;
    z-index: 1000;
    padding: 0 50px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: background 0.4s, border-color 0.4s, height 0.4s;
    border-bottom: 1px solid rgba(225,6,0,0.1);
    background: rgba(5,5,5,0.96);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
}
nav#navbar.scrolled {
    background: rgba(5,5,5,0.96);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-bottom-color: rgba(225,6,0,0.1);
    height: 56px;
}
.nav-logo { font-family: 'Bebas Neue', cursive; font-size: 1.5rem; letter-spacing: 6px; color: var(--off-white); text-decoration: none; flex-shrink: 0; transition: color 0.3s; }
.nav-logo span { color: var(--red); }
.nav-logo:hover { color: rgba(240,237,232,0.7); }
.nav-links { display: flex; align-items: center; gap: 8px; list-style: none; }
.nav-links li a { color: rgba(240,237,232,0.6); text-decoration: none; font-size: 0.7rem; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; padding: 8px 14px; transition: color 0.3s; position: relative; display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.nav-links li a::after { content: ''; position: absolute; bottom: 2px; left: 14px; right: 14px; height: 1px; background: var(--red); transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease; }
.nav-links li a:hover { color: var(--off-white); }
.nav-links li a:hover::after { transform: scaleX(1); }
.nav-icon-link svg { opacity: 0.5; transition: opacity 0.3s; }
.nav-icon-link:hover svg { opacity: 1; }

/* ── Cart badge ── */
.cart-icon-wrap { position: relative; display: inline-flex; align-items: center; }
.cart-badge {
    position: absolute;
    top: -8px; right: -10px;
    background: var(--red);
    color: #fff;
    font-family: 'Barlow', sans-serif;
    font-size: 0.5rem;
    font-weight: 700;
    letter-spacing: 0;
    min-width: 16px; height: 16px;
    border-radius: 999px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 4px;
    line-height: 1;
    pointer-events: none;
    transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1), opacity 0.2s;
}
.cart-badge.bump { transform: scale(1.4); }

.nav-divider { width: 1px !important; height: 20px; background: rgba(255,255,255,0.08); margin: 0 8px; pointer-events: none; }
.nav-btn-outline { border: 1px solid rgba(240,237,232,0.15) !important; border-radius: 0 !important; padding: 7px 18px !important; color: rgba(240,237,232,0.7) !important; transition: border-color 0.3s, color 0.3s !important; font-size: 0.68rem !important; }
.nav-btn-outline:hover { border-color: rgba(225,6,0,0.5) !important; color: var(--off-white) !important; }
.nav-btn-outline::after { display: none !important; }
.nav-btn-primary { background: var(--red) !important; color: #fff !important; padding: 8px 20px !important; font-size: 0.68rem !important; letter-spacing: 3px !important; border: 1px solid var(--red) !important; transition: background 0.3s, box-shadow 0.3s !important; }
.nav-btn-primary:hover { box-shadow: 0 0 20px rgba(225,6,0,0.3) !important; color: #fff !important; }
.nav-btn-primary::after { display: none !important; }
.nav-hamburger { display: none; flex-direction: column; gap: 6px; cursor: pointer; padding: 8px; background: none; border: none; outline: none; }
.nav-hamburger span { display: block; width: 24px; height: 1.5px; background: var(--off-white); transition: all 0.35s; }
.nav-hamburger.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

.nav-mobile { display: none; position: fixed; inset: 0; background: rgba(5,5,5,0.98); backdrop-filter: blur(30px); z-index: 999; flex-direction: column; align-items: flex-start; justify-content: center; padding: 60px; opacity: 0; pointer-events: none; transition: opacity 0.4s ease; }
.nav-mobile.open { display: flex; opacity: 1; pointer-events: all; }
.nav-mobile-close { position: absolute; top: 40px; right: 40px; background: none; border: 1px solid rgba(255,255,255,0.1); color: rgba(240,237,232,0.4); padding: 10px; cursor: pointer; display: flex; transition: border-color 0.3s, color 0.3s; }
.nav-mobile-close:hover { border-color: var(--red); color: var(--off-white); }
.nav-mobile-logo { font-family: 'Bebas Neue', cursive; font-size: 1.2rem; letter-spacing: 6px; color: rgba(240,237,232,0.15); margin-bottom: 48px; }
.nav-mobile-logo span { color: rgba(225,6,0,0.4); }
.nav-mobile-links { display: flex; flex-direction: column; gap: 4px; width: 100%; }
.nav-mobile-links a { font-family: 'Bebas Neue', cursive; font-size: clamp(2.2rem, 7vw, 3.5rem); letter-spacing: 6px; color: rgba(240,237,232,0.25); text-decoration: none; display: flex; align-items: baseline; gap: 20px; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.03); transition: color 0.3s, padding-left 0.3s; }
.nav-mobile-links a:hover { color: var(--off-white); padding-left: 12px; }
.nav-mobile-links a:hover .nm-num { color: var(--red); }
.nm-num { font-family: 'Barlow Condensed', sans-serif; font-size: 0.55rem; letter-spacing: 4px; color: rgba(240,237,232,0.15); font-weight: 600; transition: color 0.3s; }
.nav-mobile-foot { position: absolute; bottom: 40px; left: 60px; font-size: 0.5rem; letter-spacing: 6px; color: rgba(240,237,232,0.08); text-transform: uppercase; }

@media (max-width: 1024px) { nav#navbar { padding: 0 32px; } }
@media (max-width: 768px) {
    nav#navbar { padding: 0 24px; }
    .nav-links { display: none; }
    .nav-hamburger { display: flex; }
    .nav-mobile-links a { font-size: clamp(2rem, 8vw, 3rem); }
    .nav-mobile { padding: 40px 32px; }
    .nav-mobile-foot { left: 32px; }
}
</style>

<script>
function toggleMobileNav() {
    document.getElementById('mobile-nav').classList.toggle('open');
    document.getElementById('hamburger').classList.toggle('open');
}

// Called from product page after successful AJAX add-to-cart
function updateCartBadge(newCount) {
    const badge = document.getElementById('cartBadge');
    if (!badge) return;
    badge.textContent = newCount > 99 ? '99+' : newCount;
    badge.style.display = newCount > 0 ? 'flex' : 'none';
    badge.classList.remove('bump');
    void badge.offsetWidth;
    badge.classList.add('bump');
    setTimeout(() => badge.classList.remove('bump'), 300);
}
</script>