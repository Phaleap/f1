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

        @if(session('success'))
            <p style="color: green; text-align: center; margin-bottom: 1rem;">{{ session('success') }}</p>
        @endif

        @if($items->isEmpty())
            <p style="text-align: center; padding: 3rem 0;">
                Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping →</a>
            </p>
        @else
        <div class="cart-layout">
            <div class="cart-items">
                @foreach($items as $item)
                    <div class="cart-item">
                        <div class="cart-item-image">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     alt="{{ $item->product->name }}">
                            @endif
                        </div>

                        <div class="cart-item-details">
                            <p class="cart-item-category">{{ $item->product->category ?? 'F1 Gear' }}</p>
                            <h3>{{ $item->product->name }}</h3>
                            <p class="cart-item-price">${{ number_format($item->price, 2) }}</p>
                        </div>

                        <div class="cart-item-quantity">
                            <form action="{{ route('cart.update', $item) }}" method="POST"
                                  style="display: flex; align-items: center; gap: 0.5rem;">
                                @csrf
                                @method('PATCH')
                                <label for="quantity-{{ $item->id }}">Qty</label>
                                <input type="number" id="quantity-{{ $item->id }}"
                                       name="quantity" value="{{ $item->quantity }}" min="1"
                                       onchange="this.form.submit()">
                            </form>
                        </div>

                        <div class="cart-item-action">
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn"
                                        style="background: none; border: none; cursor: pointer;">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>$10.00</span>
                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>${{ number_format($total + 10, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn btn-primary checkout-btn">
                    Proceed to Checkout
                </a>
            </div>
        </div>
        @endif
    </section>
@endsection