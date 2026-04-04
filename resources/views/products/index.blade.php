@extends('layouts.app')

@section('title', 'Products - F1 Store')

@section('content')
    <section class="products-page">
        <div class="section-header">
            <p class="section-label">All Products</p>
            <h1>Explore Our Collection</h1>
            <p class="section-description">
                Discover premium Formula 1 merchandise, racing-inspired apparel,
                and exclusive team collections.
            </p>
        </div>

        <div class="products-grid">
            @for ($i = 1; $i <= 6; $i++)
                <div class="product-card">
                    <div class="product-image"></div>

                    <div class="product-info">
                        <p class="product-category">Team Apparel</p>
                        <h3>Ferrari Racing Jacket</h3>
                        <p class="product-price">$120.00</p>

                        <a href="{{ route('products.show', $i) }}" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            @endfor
        </div>
    </section>
@endsection