{{-- ─── Navbar ────────────────────────────────────────────────────── --}}

@php
    $cartCount = 0;
    if (Auth::check()) {
        $cartCount = \App\Models\Cart::where('user_id', Auth::id())
            ->first()
            ?->items()
            ->sum('quantity') ?? 0;
    }
@endphp

<nav id="navbar">

    <a href="/" class="nav-logo">F1<span>·</span>Store</a>

    {{-- Desktop links --}}
    <ul class="nav-links">
        <li><a href="{{ route('shop') }}">Shop</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li class="nav-divider"></li>

        <li>
            <a href="{{ route('cart.index') }}" class="nav-icon-link cart-link" title="Cart">
                <span class="cart-icon-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="cart-badge" id="cartBadge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                    @else
                        <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                    @endif
                </span>
                Cart
            </a>
        </li>

        @auth
            <li>
                <a href="{{ route('wishlist.index') }}" class="nav-icon-link" title="Wishlist">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                    Wishlist
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}" class="nav-icon-link" title="Orders">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('shop.car-request.my-requests') }}" class="nav-icon-link" title="My Cars">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                    My Cars
                </a>
            </li>
            <li class="nav-divider"></li>
            @if(Auth::user()->role?->role_name === 'admin')
                <li><a href="{{ url('/admin') }}" class="nav-btn-outline">Admin</a></li>
            @endif
            <li>
                <a href="{{ route('profile.edit') }}" class="nav-btn-outline">
                    {{ Auth::user()->full_name ? explode(' ', Auth::user()->full_name)[0] : 'Account' }}
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="nav-btn-outline nav-btn-logout">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="nav-btn-outline">Login</a></li>
            <li><a href="{{ route('register') }}" class="nav-btn-primary">Register</a></li>
        @endauth
    </ul>

    {{-- Hamburger — mobile only --}}
    <button class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>

</nav>

{{-- ── Mobile fullscreen overlay ─────────────────────── --}}
<div class="nav-mobile" id="mobile-nav">

    <button class="nav-mobile-close" onclick="toggleMobileNav()" aria-label="Close">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>

    <div class="nav-mobile-logo">F1<span>·</span>Store</div>

    <div class="nav-mobile-links">
        @php $i = 1; @endphp

        <a href="{{ route('shop') }}" onclick="toggleMobileNav()">
            <span class="nm-num">0{{ $i++ }}</span>Shop
        </a>
        <a href="{{ route('about') }}" onclick="toggleMobileNav()">
            <span class="nm-num">0{{ $i++ }}</span>About Us
        </a>
        <a href="{{ route('contact') }}" onclick="toggleMobileNav()">
            <span class="nm-num">0{{ $i++ }}</span>Contact
        </a>
        <a href="{{ route('cart.index') }}" onclick="toggleMobileNav()">
            <span class="nm-num">0{{ $i++ }}</span>Cart
            @if($cartCount > 0)
                <span class="nm-badge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
            @endif
        </a>

        @auth
            <a href="{{ route('wishlist.index') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>Wishlist
            </a>
            <a href="{{ route('orders.index') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>Orders
            </a>
            <a href="{{ route('shop.car-request.my-requests') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>My Cars
            </a>
            <a href="{{ route('profile.edit') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>{{ Auth::user()->full_name ? explode(' ', Auth::user()->full_name)[0] : 'Account' }}
            </a>
            @if(Auth::user()->role?->role_name === 'admin')
                <a href="{{ url('/admin') }}" onclick="toggleMobileNav()">
                    <span class="nm-num">0{{ $i++ }}</span>Admin
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>Login
            </a>
            <a href="{{ route('register') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>Register
            </a>
        @endauth
    </div>

    @auth
        <form method="POST" action="{{ route('logout') }}" class="nm-logout-form">
            @csrf
            <button type="submit" class="nm-logout-btn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Logout
            </button>
        </form>
    @endauth

    <div class="nav-mobile-foot">Precision · Power · Performance</div>

</div>


<style>
/* ══════════════════════════════════════════════════════
   DESKTOP NAVBAR
══════════════════════════════════════════════════════ */
nav#navbar {
    position: fixed;
    top: 28px; left: 0; right: 0;
    z-index: 1000;
    padding: 0 50px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(225,6,0,0.1);
    background: rgba(5,5,5,0.96);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    transition: height 0.4s;
}
nav#navbar.scrolled { height: 56px; }

.nav-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.5rem;
    letter-spacing: 6px;
    color: var(--off-white);
    text-decoration: none;
    flex-shrink: 0;
    transition: color 0.3s;
}
.nav-logo span { color: var(--red); }
.nav-logo:hover { color: rgba(240,237,232,0.7); }

.nav-links {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
}
.nav-links li a {
    color: rgba(240,237,232,0.6);
    text-decoration: none;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 8px 14px;
    transition: color 0.3s;
    position: relative;
    display: flex;
    align-items: center;
    gap: 7px;
    white-space: nowrap;
}
.nav-links li a::after {
    content: '';
    position: absolute;
    bottom: 2px; left: 14px; right: 14px;
    height: 1px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}
.nav-links li a:hover { color: var(--off-white); }
.nav-links li a:hover::after { transform: scaleX(1); }
.nav-icon-link svg { opacity: 0.5; transition: opacity 0.3s; }
.nav-icon-link:hover svg { opacity: 1; }

.cart-icon-wrap { position: relative; display: inline-flex; align-items: center; }
.cart-badge {
    position: absolute;
    top: -8px; right: -10px;
    background: var(--red);
    color: #fff;
    font-family: 'Barlow', sans-serif;
    font-size: 0.5rem;
    font-weight: 700;
    min-width: 16px; height: 16px;
    border-radius: 999px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 4px;
    pointer-events: none;
    transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
}
.cart-badge.bump { transform: scale(1.4); }

.nav-divider {
    width: 1px !important;
    height: 20px;
    background: rgba(255,255,255,0.08);
    margin: 0 8px;
    pointer-events: none;
    flex-shrink: 0;
}

.nav-btn-outline {
    border: 1px solid rgba(240,237,232,0.15) !important;
    border-radius: 0 !important;
    padding: 7px 18px !important;
    color: rgba(240,237,232,0.7) !important;
    font-size: 0.68rem !important;
    white-space: nowrap;
    transition: border-color 0.3s, color 0.3s !important;
}
.nav-btn-outline:hover { border-color: rgba(225,6,0,0.5) !important; color: var(--off-white) !important; }
.nav-btn-outline::after { display: none !important; }
.nav-btn-logout {
    cursor: pointer;
    background: transparent;
    font-family: 'Barlow', sans-serif;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
}
.nav-btn-primary {
    background: var(--red) !important;
    color: #fff !important;
    padding: 8px 20px !important;
    font-size: 0.68rem !important;
    letter-spacing: 3px !important;
    border: 1px solid var(--red) !important;
    transition: box-shadow 0.3s !important;
}
.nav-btn-primary:hover { box-shadow: 0 0 20px rgba(225,6,0,0.3) !important; color: #fff !important; }
.nav-btn-primary::after { display: none !important; }

/* Hamburger — hidden on desktop */
.nav-hamburger {
    display: none;
    flex-direction: column;
    gap: 6px;
    cursor: pointer;
    padding: 8px;
    background: none;
    border: none;
    outline: none;
    flex-shrink: 0;
}
.nav-hamburger span {
    display: block;
    width: 24px;
    height: 1.5px;
    background: var(--off-white);
    transition: all 0.35s;
}
.nav-hamburger.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

/* ══════════════════════════════════════════════════════
   MOBILE FULLSCREEN OVERLAY
══════════════════════════════════════════════════════ */
.nav-mobile {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(5,5,5,0.98);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    z-index: 1100;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    padding: 60px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.35s ease;
}
.nav-mobile.open {
    display: flex;
    opacity: 1;
    pointer-events: all;
}

.nav-mobile-close {
    position: absolute;
    top: 36px; right: 28px;
    background: none;
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(240,237,232,0.4);
    padding: 10px;
    cursor: pointer;
    display: flex;
    transition: border-color 0.3s, color 0.3s;
    -webkit-tap-highlight-color: transparent;
}
.nav-mobile-close:hover { border-color: var(--red); color: var(--off-white); }

.nav-mobile-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.1rem;
    letter-spacing: 6px;
    color: rgba(240,237,232,0.12);
    margin-bottom: 40px;
}
.nav-mobile-logo span { color: rgba(225,6,0,0.35); }

.nav-mobile-links {
    display: flex;
    flex-direction: column;
    gap: 2px;
    width: 100%;
}
.nav-mobile-links a {
    font-family: 'Bebas Neue', cursive;
    font-size: clamp(2rem, 8vw, 3.2rem);
    letter-spacing: 5px;
    color: rgba(240,237,232,0.22);
    text-decoration: none;
    display: flex;
    align-items: baseline;
    gap: 18px;
    padding: 7px 0;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    transition: color 0.25s, padding-left 0.25s;
    -webkit-tap-highlight-color: transparent;
}
.nav-mobile-links a:hover,
.nav-mobile-links a:active { color: var(--off-white); padding-left: 10px; }
.nav-mobile-links a:hover .nm-num,
.nav-mobile-links a:active .nm-num { color: var(--red); }

.nm-num {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.52rem;
    letter-spacing: 4px;
    color: rgba(240,237,232,0.12);
    font-weight: 600;
    transition: color 0.25s;
    flex-shrink: 0;
}

.nm-badge {
    font-family: 'Barlow', sans-serif;
    font-size: 0.55rem;
    font-weight: 700;
    letter-spacing: 0;
    background: var(--red);
    color: #fff;
    padding: 2px 7px;
    border-radius: 999px;
    margin-left: 4px;
    vertical-align: middle;
    line-height: 1;
}

.nm-logout-form { margin-top: 28px; }
.nm-logout-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: none;
    border: 1px solid rgba(225,6,0,0.2);
    color: rgba(225,6,0,0.6);
    font-family: 'Barlow', sans-serif;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 10px 20px;
    cursor: pointer;
    transition: border-color 0.3s, color 0.3s;
    -webkit-tap-highlight-color: transparent;
}
.nm-logout-btn:hover,
.nm-logout-btn:active { border-color: var(--red); color: var(--red); }

.nav-mobile-foot {
    position: absolute;
    bottom: 32px; left: 60px;
    font-size: 0.45rem;
    letter-spacing: 6px;
    color: rgba(240,237,232,0.06);
    text-transform: uppercase;
}

/* ══════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════ */
@media (max-width: 1024px) { nav#navbar { padding: 0 32px; } }

@media (max-width: 768px) {
    nav#navbar {
        top: 0;
        padding: 0 24px;
        height: 56px;
    }
    nav#navbar.scrolled { height: 50px; }

    .nav-links     { display: none; }
    .nav-hamburger { display: flex; }

    .nav-mobile      { padding: 40px 28px; }
    .nav-mobile-foot { left: 28px; }
    .nav-mobile-close { top: 16px; right: 16px; }
}
</style>


<script>
function toggleMobileNav() {
    const overlay = document.getElementById('mobile-nav');
    const ham     = document.getElementById('hamburger');
    overlay.classList.toggle('open');
    ham.classList.toggle('open');
    document.body.style.overflow = overlay.classList.contains('open') ? 'hidden' : '';
}

window.addEventListener('scroll', function () {
    document.getElementById('navbar')
        .classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

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