@extends('layouts.app')

@section('title', 'Home - F1 Store')

@section('content')
    <section class="hero">
        <div class="hero-content">
            <p class="hero-subtitle">Formula 1 Lifestyle Store</p>
            <h1>Driven by Speed. Styled by Racing.</h1>
            <p class="hero-text">
                Explore premium F1 merchandise, team collections, racing-inspired apparel,
                and exclusive products built for true motorsport fans.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Shop Now</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Join Now</a>
            </div>
        </div>
    </section>

    <section class="featured-section">
        <div class="section-header">
            <p class="section-label">Featured Collection</p>
            <h2>Race Day Essentials</h2>
        </div>

        <div class="featured-grid">
            <div class="featured-card">
                <h3>Team Jerseys</h3>
                <p>Support your favorite constructors with official-inspired apparel.</p>
            </div>

            <div class="featured-card">
                <h3>Driver Edition</h3>
                <p>Discover collections inspired by iconic drivers and their legacy.</p>
            </div>

            <div class="featured-card">
                <h3>F1 Accessories</h3>
                <p>Caps, gloves, model cars, and premium racing lifestyle items.</p>
            </div>
        </div>
    </section>
@endsection