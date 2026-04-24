@extends('admin.layouts.admin')
@section('title', 'Products')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Products</h1>
        <p class="page-subtitle">Manage all F1 store products</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body" style="padding:0">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->mainImage)
                            <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                 style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:48px;height:48px;background:#f3f4f6;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:18px;">🏎</div>
                        @endif
                    </td>
                    <td><strong>{{ $product->product_name }}</strong></td>
                    <td><code style="font-size:0.75rem;background:#f3f4f6;padding:2px 6px;border-radius:4px;">{{ $product->sku }}</code></td>
                    <td>
                        @if($product->product_type === 'car')
                            <span class="badge badge-blue">Car</span>
                        @else
                            <span class="badge badge-gray">Merch</span>
                        @endif
                    </td>
                    <td>{{ $product->category?->category_name ?? '—' }}</td>
                    <td>{{ $product->brand?->brand_name ?? '—' }}</td>
                    <td><strong>${{ number_format($product->base_price, 2) }}</strong></td>
                    <td>
                        @if($product->status === 'active')
                            <span class="badge badge-green">Active</span>
                        @else
                            <span class="badge badge-red">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Del</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:#9ca3af;padding:40px;">No products yet. <a href="{{ route('admin.products.create') }}">Add one</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($products->hasPages())
    <div style="margin-top:16px;">{{ $products->links() }}</div>
@endif
@endsection
