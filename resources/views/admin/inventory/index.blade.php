@extends('admin.layouts.admin')

@section('title', 'Inventory')
@section('page-title', 'Inventory')
@section('breadcrumb')
    <span>›</span> <span>Inventory</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Inventory</div>
        <div class="page-sub">Manage product stock levels</div>
    </div>
    <a href="{{ route('admin.inventory.low-stock') }}" class="btn btn-secondary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
        Low Stock
    </a>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">All Inventory</span>
        <span style="font-size:0.78rem; color:var(--gray-400);">{{ $inventory->total() }} records</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Variant</th>
                    <th>Location</th>
                    <th>Min Stock</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                @php
                    $isLow = $item->stock_quantity <= $item->minimum_stock;
                    $isOut = $item->stock_quantity <= 0;
                @endphp
                <tr>
                    <td>
                        <div style="font-weight:500; color:var(--gray-900);">
                            {{ $item->product->product_name ?? '—' }}
                        </div>
                        <div style="font-size:0.75rem; color:var(--gray-400);">
                            {{ $item->product->sku ?? '' }}
                        </div>
                    </td>
                    <td>{{ $item->variant->variant_name ?? '—' }}</td>
                    <td>{{ $item->warehouse_location ?? '—' }}</td>
                    <td>{{ $item->minimum_stock }}</td>
                    <td>
                        <span style="font-weight:600; color:{{ $isOut ? '#dc2626' : ($isLow ? '#ca8a04' : 'var(--gray-900)') }};">
                            {{ $item->stock_quantity }}
                        </span>
                    </td>
                    <td>
                        @if($isOut)
                            <span class="badge badge-red">Out of Stock</span>
                        @elseif($isLow)
                            <span class="badge badge-yellow">Low Stock</span>
                        @else
                            <span class="badge badge-green">In Stock</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-400);">
                        {{ $item->last_updated ? \Carbon\Carbon::parse($item->last_updated)->format('d M Y, H:i') : '—' }}
                    </td>
                    <td>
                        <button class="btn btn-secondary btn-sm"
                            onclick="openModal({{ $item->inventory_id }}, '{{ addslashes($item->product->product_name ?? '') }}', '{{ addslashes($item->variant->variant_name ?? '') }}', {{ $item->stock_quantity }})">
                            Adjust
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:var(--gray-400); padding:40px;">No inventory records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inventory->hasPages())
    <div class="pagination-wrap">
        {{ $inventory->links() }}
    </div>
    @endif
</div>

{{-- Adjust Modal --}}
<div id="adjustModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:200; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:10px; padding:28px; width:420px; max-width:90vw; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <div>
                <div style="font-weight:600; font-size:0.95rem; color:var(--gray-900);">Adjust Stock</div>
                <div id="modalSubtitle" style="font-size:0.78rem; color:var(--gray-400); margin-top:2px;"></div>
            </div>
            <button onclick="closeModal()" style="background:none; border:none; cursor:pointer; color:var(--gray-400); font-size:1.2rem;">✕</button>
        </div>

        <div style="background:var(--gray-50); border-radius:6px; padding:12px 16px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:0.78rem; color:var(--gray-500);">Current Stock</span>
            <span id="currentStock" style="font-weight:600; font-size:1.1rem; color:var(--gray-900);"></span>
        </div>

        <form id="adjustForm" method="POST">
            @csrf
            <div class="form-grid" style="gap:14px;">
                <div class="form-group">
                    <label>Movement Type</label>
                    <select name="movement_type" id="movementType" onchange="updateLabel()">
                        <option value="IN">IN — Add Stock</option>
                        <option value="OUT">OUT — Remove Stock</option>
                        <option value="RETURN">RETURN — Return to Stock</option>
                        <option value="DAMAGE">DAMAGE — Mark Damaged</option>
                        <option value="ADJUSTMENT">ADJUSTMENT — Manual Fix</option>
                    </select>
                </div>
                <div class="form-group">
                    <label id="qtyLabel">Quantity to Add</label>
                    <input type="number" name="quantity" min="1" value="1" required>
                </div>
                <div class="form-group">
                    <label>Notes <span>(optional)</span></label>
                    <textarea name="notes" rows="2" placeholder="Reason for adjustment…"></textarea>
                </div>
            </div>
            <div style="display:flex; gap:8px; margin-top:20px; justify-content:flex-end;">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id, product, variant, stock) {
    document.getElementById('modalSubtitle').textContent = product + (variant ? ' — ' + variant : '');
    document.getElementById('currentStock').textContent = stock;
    document.getElementById('adjustForm').action = '/admin/inventory/' + id + '/adjust';
    document.getElementById('adjustModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('adjustModal').style.display = 'none';
}
function updateLabel() {
    const type = document.getElementById('movementType').value;
    const labels = {
        IN: 'Quantity to Add',
        OUT: 'Quantity to Remove',
        RETURN: 'Quantity Returned',
        DAMAGE: 'Quantity Damaged',
        ADJUSTMENT: 'Adjusted Quantity',
    };
    document.getElementById('qtyLabel').textContent = labels[type] || 'Quantity';
}
document.getElementById('adjustModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

@endsection