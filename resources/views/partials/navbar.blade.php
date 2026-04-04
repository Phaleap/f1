<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <a href="{{ route('home') }}">F1 Store</a>
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</nav>