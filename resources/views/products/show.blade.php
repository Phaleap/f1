@extends('layouts.app')

@section('title', 'Product Detail - F1 Store')

@section('content')
    <section class="product-detail-page">
        <div class="product-detail-grid">
            <div class="product-detail-image">
                <div class="image-placeholder"></div>
            </div>

            <div class="product-detail-info">
                <p class="product-detail-category">Team Apparel</p>
                <h1>Ferrari Racing Jacket</h1>
                <p class="product-detail-price">$120.00</p>

                <p class="product-detail-description">
                    A premium racing-inspired jacket designed for Formula 1 fans who want
                    a bold and stylish look. Built for comfort, identity, and speed-driven fashion.
                </p>

                <div class="product-detail-actions">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" value="1" min="1">

                    <a href="{{ route('cart.index') }}" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
@endsection