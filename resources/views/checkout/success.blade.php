@extends('layouts.app')

@section('title', 'Order Success - F1 Store')

@section('content')
    <section class="success-page">
        <div class="success-card">
            <p class="section-label">Order Confirmed</p>
            <h1>Your Order Has Been Placed</h1>
            <p class="success-text">
                Thank you for shopping with F1 Store. Your order has been received
                and will be processed soon.
            </p>

            <div class="success-actions">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </section>
@endsection