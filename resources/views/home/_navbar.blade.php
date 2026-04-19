    {{-- ── NAVBAR ── --}}
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
        <div class="nav-hamburger" id="hamburger" onclick="toggleMobileNav()">
            <span></span><span></span><span></span>
        </div>
    </nav>
    {{-- ── MOBILE NAV ── --}}
    <div class="nav-mobile" id="mobile-nav">
        <a href="{{ route('products.cars') }}" onclick="toggleMobileNav()">Cars</a>
        <a href="{{ route('products.merchandise') }}" onclick="toggleMobileNav()">Merch</a>
        <a href="{{ route('cart.index') }}" onclick="toggleMobileNav()">Cart</a>
        @auth
            <a href="{{ route('orders.index') }}" onclick="toggleMobileNav()">Orders</a>
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileNav()">Login</a>
        @endauth
    </div>
