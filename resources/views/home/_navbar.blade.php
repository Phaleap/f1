{{-- ─── Navbar ────────────────────────────────────────────────────── --}}
@php
    $notifCount = 0;
    $notifications = collect();
    if (Auth::check()) {
        $notifications = \App\Models\CarPurchaseRequest::where('user_id', Auth::id())
            ->whereIn('request_status', ['approved', 'rejected'])
            ->where('seen_by_user', false)
            ->with('product')
            ->latest()
            ->get();
        $notifCount = $notifications->count();
    }
@endphp
@php
    $cartCount = 0;
    if (Auth::check()) {
        $cartCount = \App\Models\Cart::where('user_id', Auth::id())
            ->first()
            ?->items()
            ->sum('quantity') ?? 0;
    }
@endphp

{{-- ── Top wrapper that centers the pill ── --}}
<div id="navbar-wrap">
    <nav id="navbar">

        {{-- Logo --}}
        <a href="/" class="nav-logo">F1<span>·</span>Store</a>

        <div class="nav-divider-v"></div>

        {{-- Page links --}}
        <ul class="nav-links">
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>

        <div class="nav-spacer"></div>

        {{-- ── Right cluster ── --}}

        {{-- Cart --}}
        <a href="{{ route('cart.index') }}" class="nav-icon-btn" title="Cart" aria-label="Cart">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 01-8 0"/>
            </svg>
            @if($cartCount > 0)
                <span class="nav-badge" id="cartBadge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
            @else
                <span class="nav-badge" id="cartBadge" style="display:none;">0</span>
            @endif
        </a>

        @auth
            {{-- Notifications --}}
            <div class="nav-notif-wrap" id="notifWrap">
                <button class="nav-icon-btn" onclick="toggleNotif(event)" title="Notifications" aria-label="Notifications">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    @if($notifCount > 0)
                        <span class="nav-badge" id="notifBadge">{{ $notifCount }}</span>
                    @endif
                </button>

                {{-- Notification dropdown --}}
                <div class="glass-dropdown" id="notifDropdown">
                    <div class="dd-header">
                        <span class="dd-header-title">Notifications</span>
                        @if($notifCount > 0)
                            <a href="{{ route('shop.car-request.my-requests') }}" class="dd-header-action">View all</a>
                        @endif
                    </div>

                    @if($notifications->isEmpty())
                        <div class="dd-empty">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" style="opacity:0.3;margin-bottom:6px;">
                                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                <path d="M13.73 21a2 2 0 01-3.46 0"/>
                            </svg>
                            No new notifications
                        </div>
                    @else
                        @foreach($notifications as $notif)
                            <a href="{{ route('shop.car-request.my-requests') }}" class="dd-notif-item">
                                <div class="dd-notif-icon {{ $notif->request_status === 'approved' ? 'dd-icon-green' : 'dd-icon-red' }}">
                                    @if($notif->request_status === 'approved')
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    @else
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    @endif
                                </div>
                                <div class="dd-notif-content">
                                    <div class="dd-notif-msg">
                                        Request for <strong>{{ $notif->product->product_name ?? 'a car' }}</strong>
                                        was <span class="{{ $notif->request_status === 'approved' ? 'text-green' : 'text-red' }}">{{ $notif->request_status }}</span>
                                    </div>
                                    <div class="dd-notif-time">{{ $notif->updated_at->diffForHumans() }}</div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- Profile avatar → opens profile dropdown --}}
            <div class="nav-profile-wrap" id="profileWrap">
                <button class="nav-avatar" onclick="toggleProfile(event)" title="Account" aria-label="Account menu">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </button>

                {{-- Profile dropdown --}}
                <div class="glass-dropdown glass-dropdown-right" id="profileDropdown">
                    {{-- User header --}}
                    <div class="dd-user-header">
                        <div class="dd-user-avatar">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="dd-user-name">{{ Auth::user()->full_name ?? 'Account' }}</div>
                            <div class="dd-user-role">Member</div>
                        </div>
                    </div>

                    <div class="dd-section">
                        <a href="{{ route('profile.edit') }}" class="dd-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profile
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="dd-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                            Wishlist
                        </a>
                        <a href="{{ route('orders.index') }}" class="dd-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            Orders
                        </a>
                        <a href="{{ route('shop.car-request.my-requests') }}" class="dd-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                            My Cars
                        </a>
                    </div>

                    <div class="dd-divider"></div>

                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="dd-item dd-item-logout" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        @else
            {{-- Guest --}}
            <a href="{{ route('login') }}" class="nav-pill-btn nav-pill-btn-outline">Login</a>
            <a href="{{ route('register') }}" class="nav-pill-btn nav-pill-btn-primary">Register</a>
        @endauth

        {{-- Hamburger — mobile only --}}
        <button class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

    </nav>
</div>


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
            <a href="{{ route('shop.car-request.my-requests') }}" onclick="toggleMobileNav()">
                <span class="nm-num">0{{ $i++ }}</span>Notifications
                @if($notifCount > 0)
                    <span class="nm-badge">{{ $notifCount }}</span>
                @endif
            </a>
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
   NAVBAR WRAPPER — centers the floating pill
══════════════════════════════════════════════════════ */
#navbar-wrap {
    position: fixed;
    top: 40px;
    left: 0; right: 0;
    z-index: 1000;
    display: flex;
    justify-content: center;
    padding: 0 24px;
    pointer-events: none; /* let clicks pass through the wrapper gap */
    transition: top 0.4s ease;
}
#navbar-wrap.scrolled { top: 14px; }

/* ── THE PILL ── */
nav#navbar {
    pointer-events: all;
    display: flex;
    align-items: center;
    gap: 4px;
    width: 100%;
    max-width: 960px;
    height: 52px;
    padding: 0 8px 0 20px;
    border-radius: 999px;
    background: rgba(8, 8, 8, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(28px) saturate(180%);
    -webkit-backdrop-filter: blur(28px) saturate(180%);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.04) inset,
        0 2px 40px rgba(0, 0, 0, 0.55),
        0 1px 0 rgba(255,255,255,0.07) inset;
    transition: height 0.35s ease, background 0.35s ease, box-shadow 0.35s ease;
}
#navbar-wrap.scrolled nav#navbar {
    height: 44px;
    background: rgba(5, 5, 5, 0.72);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.06) inset,
        0 4px 30px rgba(0, 0, 0, 0.7),
        0 1px 0 rgba(255,255,255,0.05) inset;
}

/* ── LOGO ── */
.nav-logo {
    font-family: 'Bebas Neue', cursive;
    font-size: 1.26rem;
    letter-spacing: 6px;
    color: var(--off-white, #f0ede8);
    text-decoration: none;
    flex-shrink: 0;
    transition: opacity 0.3s;
}
.nav-logo span { color: var(--red, #e10600); }
.nav-logo:hover { opacity: 0.7; }

/* ── VERTICAL DIVIDER ── */
.nav-divider-v {
    width: 1px;
    height: 16px;
    background: rgba(255, 255, 255, 0.1);
    flex-shrink: 0;
    margin: 0 6px;
}

/* ── PAGE LINKS ── */
.nav-links {
    display: flex;
    align-items: center;
    gap: 0;
    list-style: none;
    margin: 0; padding: 0;
}
.nav-links li a {
    display: block;
    color: rgba(240, 237, 232, 0.45);
    text-decoration: none;
    font-size: 0.70rem;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 7px 11px;
    border-radius: 999px;
    transition: background 0.2s, color 0.2s;
    white-space: nowrap;
}
.nav-links li a:hover {
    background: rgba(255, 255, 255, 0.07);
    color: var(--off-white, #f0ede8);
}

/* ── SPACER ── */
.nav-spacer { flex: 1; }

/* ── ICON BUTTONS (cart / notifications) ── */
.nav-icon-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(240, 237, 232, 0.45);
    transition: background 0.2s, color 0.2s;
    flex-shrink: 0;
    text-decoration: none;
}
.nav-icon-btn:hover {
    background: rgba(255, 255, 255, 0.08);
    color: var(--off-white, #f0ede8);
}
.nav-icon-btn svg { display: block; }

/* ── BADGE ── */
.nav-badge {
    position: absolute;
    top: 3px; right: 2px;
    background: var(--red, #e10600);
    color: #fff;
    font-family: 'Barlow', sans-serif;
    font-size: 8.5px;
    font-weight: 700;
    min-width: 14px; height: 14px;
    border-radius: 999px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 3px;
    pointer-events: none;
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.nav-badge.bump { transform: scale(1.45); }

/* ── PROFILE AVATAR BUTTON ── */
.nav-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(225, 6, 0, 0.12);
    border: 1.5px solid rgba(225, 6, 0, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    color: rgba(240, 237, 232, 0.65);
    transition: background 0.2s, border-color 0.2s, color 0.2s;
    margin-left: 4px;
}
.nav-avatar:hover {
    background: rgba(225, 6, 0, 0.22);
    border-color: rgba(225, 6, 0, 0.7);
    color: var(--off-white, #f0ede8);
}

/* ── GUEST PILL BUTTONS ── */
.nav-pill-btn {
    display: flex;
    align-items: center;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    text-decoration: none;
    padding: 7px 16px;
    border-radius: 999px;
    white-space: nowrap;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.nav-pill-btn-outline {
    color: rgba(240, 237, 232, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: none;
}
.nav-pill-btn-outline:hover {
    color: var(--off-white, #f0ede8);
    border-color: rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.05);
}
.nav-pill-btn-primary {
    color: #fff;
    background: var(--red, #e10600);
    border: 1px solid var(--red, #e10600);
    margin-left: 2px;
}
.nav-pill-btn-primary:hover {
    box-shadow: 0 0 18px rgba(225, 6, 0, 0.4);
}

/* ══════════════════════════════════════════════════════
   SHARED GLASS DROPDOWN
══════════════════════════════════════════════════════ */
.nav-notif-wrap,
.nav-profile-wrap {
    position: relative;
}

.glass-dropdown {
    position: absolute;
    top: calc(100% + 14px);
    left: 50%;
    transform: translateX(-50%) translateY(-6px);
    width: 300px;
    background: rgba(10, 10, 10, 0.82);
    border: 1px solid rgba(255, 255, 255, 0.09);
    border-radius: 20px;
    backdrop-filter: blur(32px) saturate(160%);
    -webkit-backdrop-filter: blur(32px) saturate(160%);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.04) inset,
        0 20px 60px rgba(0, 0, 0, 0.7);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease, transform 0.2s ease;
    z-index: 2000;
    padding: 8px;
    overflow: hidden;
}
.glass-dropdown-right {
    left: auto;
    right: 0;
    transform: translateY(-6px);
}
.glass-dropdown.open {
    opacity: 1;
    pointer-events: all;
    transform: translateX(-50%) translateY(0);
}
.glass-dropdown-right.open {
    transform: translateY(0);
}

/* ── Dropdown header (notifications) ── */
.dd-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 12px 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    margin-bottom: 4px;
}
.dd-header-title {
    font-size: 0.56rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(240, 236, 228, 0.4);
}
.dd-header-action {
    font-size: 0.54rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--red, #e10600);
    text-decoration: none;
    transition: opacity 0.2s;
}
.dd-header-action:hover { opacity: 0.7; }

/* ── Empty state ── */
.dd-empty {
    padding: 24px 16px;
    font-size: 0.6rem;
    letter-spacing: 2px;
    color: rgba(240, 236, 228, 0.2);
    text-align: center;
    text-transform: uppercase;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ── Notification items ── */
.dd-notif-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 10px 12px;
    border-radius: 12px;
    text-decoration: none;
    transition: background 0.15s;
}
.dd-notif-item:hover { background: rgba(255, 255, 255, 0.04); }

.dd-notif-icon {
    width: 26px; height: 26px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}
.dd-icon-green { background: rgba(74, 222, 128, 0.1); color: #4ade80; }
.dd-icon-red   { background: rgba(225, 6, 0, 0.12);   color: var(--red, #e10600); }

.dd-notif-content { flex: 1; min-width: 0; }
.dd-notif-msg {
    font-size: 0.7rem;
    color: rgba(240, 236, 228, 0.65);
    line-height: 1.45;
    letter-spacing: 0.2px;
}
.dd-notif-msg strong { color: var(--off-white, #f0ede8); }
.text-green { color: #4ade80; }
.text-red   { color: var(--red, #e10600); }
.dd-notif-time {
    font-size: 0.52rem;
    letter-spacing: 2px;
    color: rgba(240, 236, 228, 0.22);
    margin-top: 3px;
    text-transform: uppercase;
}

/* ── Profile dropdown: user header ── */
.dd-user-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px 12px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    margin-bottom: 6px;
}
.dd-user-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(225, 6, 0, 0.14);
    border: 1.5px solid rgba(225, 6, 0, 0.35);
    display: flex; align-items: center; justify-content: center;
    color: rgba(240, 237, 232, 0.7);
    flex-shrink: 0;
}
.dd-user-name {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--off-white, #f0ede8);
    letter-spacing: 0.3px;
}
.dd-user-role {
    font-size: 0.54rem;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(240, 237, 232, 0.28);
    margin-top: 1px;
}

.dd-section { display: flex; flex-direction: column; gap: 1px; }

/* ── Dropdown menu items ── */
.dd-item {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 9px 12px;
    border-radius: 12px;
    text-decoration: none;
    color: rgba(240, 237, 232, 0.5);
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    transition: background 0.15s, color 0.15s;
    cursor: pointer;
}
.dd-item:hover {
    background: rgba(255, 255, 255, 0.05);
    color: var(--off-white, #f0ede8);
}
.dd-item svg { opacity: 0.6; flex-shrink: 0; }
.dd-item:hover svg { opacity: 1; }

.dd-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.06);
    margin: 6px 0;
}

.dd-item-logout { color: rgba(225, 6, 0, 0.55) !important; }
.dd-item-logout:hover {
    background: rgba(225, 6, 0, 0.07) !important;
    color: var(--red, #e10600) !important;
}

/* ── Hamburger — mobile only ── */
.nav-hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 8px;
    background: none;
    border: none;
    outline: none;
    flex-shrink: 0;
    margin-left: 4px;
}
.nav-hamburger span {
    display: block;
    width: 22px;
    height: 1.5px;
    background: rgba(240, 237, 232, 0.7);
    transition: all 0.35s;
}
.nav-hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

/* ══════════════════════════════════════════════════════
   MOBILE FULLSCREEN OVERLAY  (unchanged from original)
══════════════════════════════════════════════════════ */
.nav-mobile {
    display: flex;
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
.nav-mobile.open { opacity: 1; pointer-events: all; }

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
@media (max-width: 768px) {
    .announcement-bar,
    .ticker-wrap { display: none; }

    #navbar-wrap {
        top: 12px;
        padding: 0 16px;
    }
    #navbar-wrap.scrolled { top: 8px; }

    nav#navbar {
        height: 48px;
        padding: 0 6px 0 16px;
    }

    .nav-links,
    .nav-divider-v { display: none; }

    /* show hamburger on mobile */
    .nav-hamburger { display: flex; }

    /* hide icon buttons on mobile (they're in the overlay instead) */
    .nav-icon-btn,
    .nav-notif-wrap,
    .nav-profile-wrap,
    .nav-pill-btn { display: none; }

    .nav-mobile      { padding: 40px 28px; }
    .nav-mobile-foot { left: 28px; }
    .nav-mobile-close { top: 16px; right: 16px; }
}
</style>


<script>
/* ── Mobile overlay ── */
function toggleMobileNav() {
    const overlay = document.getElementById('mobile-nav');
    const ham     = document.getElementById('hamburger');
    overlay.classList.toggle('open');
    ham.classList.toggle('open');
    document.body.style.overflow = overlay.classList.contains('open') ? 'hidden' : '';
}

/* ── Scroll: shrink pill ── */
window.addEventListener('scroll', function () {
    document.getElementById('navbar-wrap')
        .classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

/* ── Cart badge update (called from other scripts) ── */
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

/* ── Notification dropdown ── */
function toggleNotif(e) {
    e.stopPropagation();
    closeProfile();
    document.getElementById('notifDropdown').classList.toggle('open');
}

/* ── Profile dropdown ── */
function toggleProfile(e) {
    e.stopPropagation();
    closeNotif();
    document.getElementById('profileDropdown').classList.toggle('open');
}

function closeNotif() {
    document.getElementById('notifDropdown')?.classList.remove('open');
}
function closeProfile() {
    document.getElementById('profileDropdown')?.classList.remove('open');
}

/* ── Close both on outside click ── */
document.addEventListener('click', function (e) {
    const nw = document.getElementById('notifWrap');
    const pw = document.getElementById('profileWrap');
    if (nw && !nw.contains(e.target)) closeNotif();
    if (pw && !pw.contains(e.target)) closeProfile();
});
</script>

{{-- ── Don't forget to add the hamburger button inside nav#navbar for mobile.
       Paste this just before the closing </nav> tag if it's not rendered by the @auth block:
       <button class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
           <span></span><span></span><span></span>
       </button>
--}}