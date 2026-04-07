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
                <form class="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               placeholder="Enter your full name">
                        @error('name')
                            <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               placeholder="Enter your email">
                        @error('email')
                            <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone (optional)</label>
                        <input type="text" id="phone" name="phone"
                               value="{{ old('phone') }}"
                               placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="address">Street Address</label>
                        <input type="text" id="address" name="address"
                               value="{{ old('address') }}"
                               placeholder="Enter your address">
                        @error('address')
                            <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city') }}"
                                   placeholder="City">
                            @error('city')
                                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country"
                                   value="{{ old('country') }}"
                                   placeholder="Country">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" name="payment_method">
                            <option value="cod">Cash on Delivery</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="aba_pay">ABA Pay</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary place-order-btn">
                        Place Order — ${{ number_format($total + 10, 2) }}
                    </button>
                </form>
            </div>

            <div class="checkout-summary">
                <h2>Order Summary</h2>

                @foreach($items as $item)
                <div class="summary-row">
                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
                @endforeach

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>$10.00</span>
                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>${{ number_format($total + 10, 2) }}</span>
                </div>
            </div>
        </div>
    </section>
@endsection