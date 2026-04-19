
    {{-- ── FOOTER ── --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">F1<span>·</span>Store</span>
                <div class="footer-tagline">Precision · Power · Performance</div>
            </div>
            <div class="footer-links-group">
                <div class="footer-col">
                    <div class="footer-col-title">Shop</div>
                    <ul>
                        <li><a href="{{ route('products.cars') }}">Race Cars</a></li>
                        <li><a href="{{ route('products.merchandise') }}">Merchandise</a></li>
                        <li><a href="#">Helmets</a></li>
                        <li><a href="#">Accessories</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="footer-col-title">Account</div>
                    <ul>
                        @auth
                            <li><a href="{{ route('orders.index') }}">My Orders</a></li>
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
                        <li><a href="#">About</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copy">© 2024 Formula One Store — All rights reserved</div>
            <div class="footer-badges">
                <span class="footer-badge">Secure Checkout</span>
                <span class="footer-badge">Official Merch</span>
                <span class="footer-badge">Worldwide Shipping</span>
            </div>
        </div>
    </footer>

    
    <!-- AUDIO -->
    <audio id="bg-music" loop>
        <source src="{{ asset('music/hans-zimmer.mp3') }}" type="audio/mp3">
    </audio>

    <!-- MUSIC CARD -->
    <div id="music-card">
        <div id="music-card-inner">
            <img id="hans-img" src="{{ asset('image/hans-zimmer.png') }}" alt="Hans Zimmer">
            <div id="music-info">
                <span id="music-label">Now Playing</span>
                <span id="music-name">Hans Zimmer</span>
                <span id="music-track">Two Steps From Hell</span>
            </div>
        </div>
        <button id="mute-btn" onclick="toggleMute()" title="Toggle Audio">
            <svg id="icon-unmute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
                <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
            </svg>
            <svg id="icon-mute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <line x1="23" y1="9" x2="17" y2="15"/>
                <line x1="17" y1="9" x2="23" y2="15"/>
            </svg>
        </button>
    </div>