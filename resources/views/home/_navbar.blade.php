{{-- ─── Navbar ────────────────────────────────────────────────────── --}}
<nav id="navbar">

    {{-- Logo --}}
    <a href="/" class="nav-logo">F1<span>·</span>Store</a>

    {{-- Links — hidden by default, shown when hamburger clicked --}}
    <ul class="nav-links" id="nav-links">
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
                    <button type="submit" class="nav-btn-outline" style="cursor:pointer;background:transparent;border:1px solid rgba(240,237,232,0.15);color:rgba(240,237,232,0.6);font-family:'Barlow',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:7px 18px;">
                        Logout
                    </button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="nav-btn-outline">Login</a></li>
            <li><a href="{{ route('register') }}" class="nav-btn-primary">Register</a></li>
        @endauth
    </ul>

    {{-- Hamburger — always visible --}}
    <button class="nav-hamburger" id="hamburger" onclick="toggleNav()" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>

</nav>

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
    gap: 16px;
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

/* Links hidden by default */
.nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
    list-style: none;
    flex: 1;
    justify-content: flex-end;
    overflow: hidden;
    max-width: 0;
    opacity: 0;
    pointer-events: none;
    transition: max-width 0.5s ease, opacity 0.35s ease;
    white-space: nowrap;
}
.nav-links.open {
    max-width: 1400px;
    opacity: 1;
    pointer-events: all;
}

.nav-links li a {
    color: rgba(240,237,232,0.6);
    text-decoration: none;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 8px 12px;
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
    bottom: 2px; left: 12px; right: 12px;
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
    margin: 0 6px;
    pointer-events: none;
    flex-shrink: 0;
}

.nav-btn-outline {
    border: 1px solid rgba(240,237,232,0.15) !important;
    border-radius: 0 !important;
    padding: 7px 16px !important;
    color: rgba(240,237,232,0.7) !important;
    font-size: 0.68rem !important;
    white-space: nowrap;
    transition: border-color 0.3s, color 0.3s !important;
}
.nav-btn-outline:hover { border-color: rgba(225,6,0,0.5) !important; color: var(--off-white) !important; }
.nav-btn-outline::after { display: none !important; }

.nav-btn-primary {
    background: var(--red) !important;
    color: #fff !important;
    padding: 8px 18px !important;
    font-size: 0.68rem !important;
    letter-spacing: 3px !important;
    border: 1px solid var(--red) !important;
    white-space: nowrap;
    transition: box-shadow 0.3s !important;
}
.nav-btn-primary:hover { box-shadow: 0 0 20px rgba(225,6,0,0.3) !important; color: #fff !important; }
.nav-btn-primary::after { display: none !important; }

/* Hamburger — always visible */
.nav-hamburger {
    display: flex;
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

@media (max-width: 1024px) { nav#navbar { padding: 0 32px; } }
@media (max-width: 768px) { nav#navbar { padding: 0 24px; } }
</style>

<script>
function toggleNav() {
    document.getElementById('nav-links').classList.toggle('open');
    document.getElementById('hamburger').classList.toggle('open');
}

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