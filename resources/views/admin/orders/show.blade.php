@extends('admin.layouts.admin')

@section('title', 'Order #' . $order->id)
@section('page-title', 'Orders')
@section('breadcrumb')
    <span>›</span> <a href="{{ route('admin.orders.index') }}">Orders</a>
    <span>›</span> <span>#{{ $order->id }}</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Order #{{ $order->id }}</div>
        <div class="page-sub">{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d M Y, H:i') : '' }}</div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back</a>
</div>

<div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

    {{-- Left Column --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Order Items --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Order Items</span></div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Variant</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td style="font-weight:500;">{{ $item->product->product_name ?? '—' }}</td>
                            <td style="color:var(--gray-400);">{{ $item->variant->variant_name ?? '—' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td style="font-weight:500;">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding:16px 20px; border-top:1px solid var(--gray-100);">
                <div style="display:flex; flex-direction:column; gap:6px; max-width:260px; margin-left:auto;">
                    <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                        <span style="color:var(--gray-500);">Subtotal</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                        <span style="color:var(--gray-500);">Discount</span>
                        <span style="color:#dc2626;">-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                        <span style="color:var(--gray-500);">Shipping</span>
                        <span>${{ number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; font-size:0.95rem; font-weight:600; padding-top:8px; border-top:1px solid var(--gray-200);">
                        <span>Total</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Update Status</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                    @csrf
                    <div class="form-group" style="flex:1; min-width:160px;">
                        <label>Status</label>
                        <select name="status">
                            <option value="pending"    {{ $order->order_status === 'pending'    ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped"    {{ $order->order_status === 'shipped'    ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered"  {{ $order->order_status === 'delivered'  ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled"  {{ $order->order_status === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex:2; min-width:200px;">
                        <label>Remarks <span>(optional)</span></label>
                        <input type="text" name="remarks" placeholder="Notes about this status change…">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        {{-- Add Shipment --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Shipment Info</span></div>
            <div class="card-body">
                @if($order->shipment)
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px;">
                    <div>
                        <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Courier</div>
                        <div style="font-weight:500;">{{ $order->shipment->courier_name }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Tracking Number</div>
                        <div style="font-weight:500;">{{ $order->shipment->tracking_number }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Shipped Date</div>
                        <div>{{ $order->shipment->shipped_date ? \Carbon\Carbon::parse($order->shipment->shipped_date)->format('d M Y') : '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Status</div>
                        <span class="badge badge-blue">{{ ucfirst($order->shipment->shipment_status) }}</span>
                    </div>
                </div>
                <hr style="border:none; border-top:1px solid var(--gray-100); margin-bottom:16px;">
                @endif
                <form method="POST" action="{{ route('admin.orders.shipment', $order->id) }}">
                    @csrf
                    <div class="form-grid form-grid-3" style="margin-bottom:12px;">
                        <div class="form-group">
                            <label>Tracking Number</label>
                            <input type="text" name="tracking_number" value="{{ $order->shipment->tracking_number ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label>Courier</label>
                            <input type="text" name="courier_name" value="{{ $order->shipment->courier_name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label>Shipping Cost <span>(optional)</span></label>
                            <input type="number" step="0.01" name="shipping_cost" value="{{ $order->shipment->shipping_cost ?? '' }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $order->shipment ? 'Update Shipment' : 'Add Shipment' }}</button>
                </form>
            </div>
        </div>

        {{-- Status History --}}
        @if($order->statusHistory && $order->statusHistory->count())
        <div class="card">
            <div class="card-header"><span class="card-title">Status History</span></div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Changed By</th>
                            <th>Date</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->statusHistory as $history)
                        <tr>
                            <td><span class="badge badge-gray">{{ ucfirst($history->status) }}</span></td>
                            <td>{{ $history->changedBy->full_name ?? '—' }}</td>
                            <td style="color:var(--gray-400);">{{ $history->changed_at ? \Carbon\Carbon::parse($history->changed_at)->format('d M Y, H:i') : '—' }}</td>
                            <td style="color:var(--gray-500);">{{ $history->remarks ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>

    {{-- Right Column --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Order Summary --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Order Summary</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                <div>
                    <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Status</div>
                    @php
                        $statusClass = match($order->order_status) {
                            'delivered'  => 'badge-green',
                            'cancelled'  => 'badge-red',
                            'pending'    => 'badge-yellow',
                            'processing','shipped' => 'badge-blue',
                            default      => 'badge-gray',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ ucfirst($order->order_status) }}</span>
                </div>
                @if($order->shippingMethod)
                <div>
                    <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Shipping Method</div>
                    <div style="font-size:0.83rem;">{{ $order->shippingMethod->method_name }}</div>
                </div>
                @endif
                @if($order->notes)
                <div>
                    <div style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:3px;">Notes</div>
                    <div style="font-size:0.83rem; color:var(--gray-500);">{{ $order->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Customer --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Customer</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:8px;">
                <div style="font-weight:500;">{{ $order->user->full_name ?? '—' }}</div>
                <div style="font-size:0.83rem; color:var(--gray-500);">{{ $order->user->email ?? '' }}</div>
                <div style="font-size:0.83rem; color:var(--gray-500);">{{ $order->user->phone ?? '' }}</div>
                @if($order->user)
                <a href="{{ route('admin.users.show', $order->user->id) }}" class="btn btn-secondary btn-sm" style="align-self:start; margin-top:4px;">View Profile</a>
                @endif
            </div>
        </div>

        {{-- Shipping Address --}}
        @if($order->address)
        <div class="card">
            <div class="card-header"><span class="card-title">Shipping Address</span></div>
            <div class="card-body" style="font-size:0.83rem; line-height:1.7; color:var(--gray-700);">
                <div style="font-weight:500;">{{ $order->address->receiver_name }}</div>
                <div>{{ $order->address->phone }}</div>
                <div>{{ $order->address->street_address }}</div>
                <div>{{ $order->address->city }}@if($order->address->province), {{ $order->address->province }}@endif</div>
                <div>{{ $order->address->postal_code }}</div>
                <div>{{ $order->address->country }}</div>
            </div>
        </div>
        @endif

        {{-- Payment --}}
        @if($order->payment)
        <div class="card">
            <div class="card-header"><span class="card-title">Payment</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:8px; font-size:0.83rem;">
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:var(--gray-500);">Method</span>
                    <span>{{ $order->payment->paymentMethod->method_name ?? '—' }}</span>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:var(--gray-500);">Amount</span>
                    <span style="font-weight:600;">${{ number_format($order->payment->amount, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:var(--gray-500);">Status</span>
                    @php
                        $payClass = match($order->payment->payment_status) {
                            'paid','completed' => 'badge-green',
                            'failed'           => 'badge-red',
                            default            => 'badge-yellow',
                        };
                    @endphp
                    <span class="badge {{ $payClass }}">{{ ucfirst($order->payment->payment_status) }}</span>
                </div>
                @if($order->payment->transaction_code)
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:var(--gray-500);">Transaction</span>
                    <span style="font-size:0.75rem; color:var(--gray-400);">{{ $order->payment->transaction_code }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

@endsection