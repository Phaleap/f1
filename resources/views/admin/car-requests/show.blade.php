@extends('admin.layouts.admin')

@section('title', 'Request #' . $carRequest->request_id)
@section('page-title', 'Car Request Detail')
@section('breadcrumb')
    <span>›</span> <a href="{{ route('admin.car-requests.index') }}">Car Requests</a>
    <span>›</span> <span>#{{ $carRequest->request_id }}</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Request #{{ $carRequest->request_id }}</div>
        <div class="page-sub">Submitted {{ $carRequest->created_at->format('d M Y, H:i') }}</div>
    </div>
    <a href="{{ route('admin.car-requests.index') }}" class="btn btn-secondary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back
    </a>
</div>

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

    {{-- LEFT --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Customer Info --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Customer Details</div></div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.05em;">Full Name</div>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $carRequest->full_name }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.05em;">Phone</div>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $carRequest->phone }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.05em;">Email</div>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $carRequest->user?->email }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.05em;">Payment Preference</div>
                        <span class="badge {{ $carRequest->payment_preference === 'online' ? 'badge-blue' : 'badge-gray' }}">
                            {{ $carRequest->payment_preference === 'online' ? 'Online Payment' : 'Walk-in Showroom' }}
                        </span>
                    </div>
                </div>

                @if($carRequest->message)
                <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--gray-200);">
                    <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Message</div>
                    <div style="font-size:0.85rem;color:var(--gray-700);line-height:1.6;">{{ $carRequest->message }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Product Info --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Requested Product</div></div>
            <div class="card-body" style="display:grid;grid-template-columns:120px 1fr;gap:16px;align-items:start;">
                @php $mainImg = $carRequest->product?->images?->where('is_main',true)->first() ?? $carRequest->product?->images?->first(); @endphp
                <div style="border:1px solid var(--gray-200);overflow:hidden;aspect-ratio:4/3;background:var(--gray-50);">
                    @if($mainImg)
                        <img src="{{ asset('storage/' . $mainImg->image_url) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color:var(--gray-300)"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                        </div>
                    @endif
                </div>
                <div>
                    <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:2px;">{{ $carRequest->product?->carModel?->team?->team_name }}</div>
                    <div style="font-weight:600;font-size:0.95rem;color:var(--gray-900);margin-bottom:12px;">{{ $carRequest->product?->product_name }}</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div>
                            <div style="font-size:0.7rem;color:var(--gray-400);margin-bottom:2px;">Base Price</div>
                            <div style="font-weight:600;color:var(--gray-900);">${{ number_format($carRequest->product?->base_price ?? 0, 2) }}</div>
                        </div>
                        <div>
                            <div style="font-size:0.7rem;color:var(--gray-400);margin-bottom:2px;">SKU</div>
                            <div style="font-size:0.82rem;color:var(--gray-700);">{{ $carRequest->product?->sku }}</div>
                        </div>
                        @if($carRequest->product?->carModel?->season_year)
                        <div>
                            <div style="font-size:0.7rem;color:var(--gray-400);margin-bottom:2px;">Season</div>
                            <div style="font-size:0.82rem;color:var(--gray-700);">{{ $carRequest->product->carModel->season_year }}</div>
                        </div>
                        @endif
                        @if($carRequest->product?->carModel?->driver)
                        <div>
                            <div style="font-size:0.7rem;color:var(--gray-400);margin-bottom:2px;">Driver</div>
                            <div style="font-size:0.82rem;color:var(--gray-700);">{{ $carRequest->product->carModel->driver->driver_name }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Car Order (if exists) --}}
        @if($carRequest->carOrder)
        <div class="card" style="border-color:#bbf7d0;">
            <div class="card-header" style="background:#f0fdf4;">
                <div class="card-title" style="color:#16a34a;">Car Order Created</div>
                <a href="{{ route('admin.car-orders.show', $carRequest->carOrder->car_order_id) }}" class="btn btn-sm" style="background:#16a34a;color:white;border-color:#16a34a;">View Order</a>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Order ID</div>
                        <div style="font-weight:600;">#{{ $carRequest->carOrder->car_order_id }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Status</div>
                        <span class="badge badge-green">{{ ucfirst(str_replace('_',' ',$carRequest->carOrder->car_order_status)) }}</span>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;color:var(--gray-400);margin-bottom:4px;">Final Price</div>
                        <div style="font-weight:600;">${{ number_format($carRequest->carOrder->final_price, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- RIGHT: Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Status Card --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Request Status</div></div>
            <div class="card-body">
                @php
                    $badgeClass = match($carRequest->request_status) {
                        'pending'   => 'badge-yellow',
                        'approved'  => 'badge-green',
                        'rejected'  => 'badge-red',
                        default     => 'badge-gray',
                    };
                @endphp
                <span class="badge {{ $badgeClass }}" style="font-size:0.8rem;padding:6px 14px;">
                    {{ ucfirst($carRequest->request_status) }}
                </span>

                @if($carRequest->reviewed_at)
                <div style="margin-top:12px;font-size:0.78rem;color:var(--gray-400);">
                    Reviewed by <strong>{{ $carRequest->reviewer?->full_name ?? 'Admin' }}</strong><br>
                    {{ \Carbon\Carbon::parse($carRequest->reviewed_at)->format('d M Y, H:i') }}
                </div>
                @endif

                @if($carRequest->rejection_reason)
                <div style="margin-top:12px;padding:10px 12px;background:#fef2f2;border:1px solid #fecaca;border-radius:4px;">
                    <div style="font-size:0.7rem;color:#dc2626;margin-bottom:4px;font-weight:600;">Rejection Reason</div>
                    <div style="font-size:0.8rem;color:#7f1d1d;">{{ $carRequest->rejection_reason }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Approve / Reject (only if pending) --}}
        @if($carRequest->request_status === 'pending')
        <div class="card">
            <div class="card-header"><div class="card-title">Take Action</div></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:12px;">

                {{-- Approve --}}
                <form method="POST" action="{{ route('admin.car-requests.approve', $carRequest->request_id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"
                            onclick="return confirm('Approve this request and create a car order?')">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                        Approve Request
                    </button>
                </form>

                {{-- Reject --}}
                <div>
                    <button class="btn btn-danger" style="width:100%;justify-content:center;"
                            onclick="document.getElementById('rejectForm').classList.toggle('hidden')">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Reject Request
                    </button>

                    <div id="rejectForm" class="hidden" style="margin-top:12px;">
                        <form method="POST" action="{{ route('admin.car-requests.reject', $carRequest->request_id) }}">
                            @csrf
                            <div class="form-group" style="margin-bottom:10px;">
                                <label>Rejection Reason <span style="color:#dc2626;">*</span></label>
                                <textarea name="rejection_reason" rows="3" placeholder="Explain why this request is being rejected..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                                Confirm Rejection
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>

<style>
.hidden { display: none; }
</style>
@endsection