@extends('admin.layouts.admin')

@section('title', 'Low Stock')
@section('page-title', 'Inventory')
@section('breadcrumb')
    <span>›</span> <a href="{{ route('admin.inventory.index') }}">Inventory</a>
    <span>›</span> <span>Low Stock</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Low Stock Items</div>
        <div class="page-sub">Products at or below minimum stock level</div>
    </div>
    <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">← All Inventory</a>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Needs Restocking</span>
        <span style="font-size:0.78rem; color:var(--gray-400);">{{ $inventory->count() }} items</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Variant</th>
                    <th>Location</th>
                    <th>Min Stock</th>
                    <th>Current Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                <tr>
                    <td>
                        <div style="font-weight:500; color:var(--gray-900);">{{ $item->product->product_name ?? '—' }}</div>
                        <div style="font-size:0.75rem; color:var(--gray-400);">{{ $item->product->sku ?? '' }}</div>
                    </td>
                    <td>{{ $item->variant->variant_name ?? '—' }}</td>
                    <td>{{ $item->warehouse_location ?? '—' }}</td>
                    <td>{{ $item->minimum_stock }}</td>
                    <td>
                        <span style="font-weight:600; color:{{ $item->stock_quantity <= 0 ? '#dc2626' : '#ca8a04' }};">
                            {{ $item->stock_quantity }}
                        </span>
                    </td>
                    <td>
                        @if($item->stock_quantity <= 0)
                            <span class="badge badge-red">Out of Stock</span>
                        @else
                            <span class="badge badge-yellow">Low Stock</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:var(--gray-400); padding:40px;">All stock levels are healthy!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection