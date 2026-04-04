@extends('layouts.app')

@section('title', 'Checkout - F1 Store')

@section('content')
    <section class="checkout-page">
        <div class="section-header">
            <p class="section-label">Checkout</p>
            <h1>Complete Your Order</h1>
            <p class="section-description">
                Enter your details and review your order before placing it.
            </p>
        </div>

        <div class="checkout-layout">
            <div class="checkout-form-card">
                <form class="checkout-form">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label for="address">Street Address</label>
                        <input type="text" id="address" placeholder="Enter your address">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" placeholder="City">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" placeholder="Country">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method">
                            <option>Cash on Delivery</option>
                            <option>Credit Card</option>
                            <option>ABA Pay</option>
                        </select>
                    </div>

                    <a href="{{ route('order.success') }}" class="btn btn-primary place-order-btn">
                        Place Order
                    </a>
                </form>
            </div>

            <div class="checkout-summary">
                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Ferrari Racing Jacket x2</span>
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
            </div>
        </div>
    </section>
@endsection