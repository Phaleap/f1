@extends('layouts.app')

@section('title', 'Cart - F1 Store')

@section('content')
    <section class="cart-page">
        <div class="section-header">
            <p class="section-label">Your Cart</p>
            <h1>Shopping Cart</h1>
            <p class="section-description">
                Review your selected items before moving to checkout.
            </p>
        </div>

        <div class="cart-layout">
            <div class="cart-items">
                @for ($i = 1; $i <= 2; $i++)
                    <div class="cart-item">
                        <div class="cart-item-image"></div>

                        <div class="cart-item-details">
                            <p class="cart-item-category">Team Apparel</p>
                            <h3>Ferrari Racing Jacket</h3>
                            <p class="cart-item-price">$120.00</p>
                        </div>

                        <div class="cart-item-quantity">
                            <label for="quantity-{{ $i }}">Qty</label>
                            <input type="number" id="quantity-{{ $i }}" value="1" min="1">
                        </div>

                        <div class="cart-item-action">
                            <a href="#" class="remove-btn">Remove</a>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="cart-summary">
                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$240.00</span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>$10.00</span>
                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>$250.00</span>
                </div>

                <a href="#" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
            </div>
        </div>
    </section>
@endsection