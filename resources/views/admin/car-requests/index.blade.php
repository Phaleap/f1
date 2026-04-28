@extends('admin.layouts.admin')

@section('title', 'Car Requests')
@section('page-title', 'Car Requests')
@section('breadcrumb')
    <span>›</span> <span>Car Requests</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Car Purchase Requests</div>
        <div class="page-sub">Review and approve customer car purchase requests</div>
    </div>
</div>

{{-- Stats row --}}
@php
    $pending  = $requests->where('request_status', 'pending')->count();
    $approved = $requests->where('request_status', 'approved')->count();
    $rejected = $requests->where('request_status', 'rejected')->count();
@endphp
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon orange"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg></div>
        <div class="stat-label">Pending Review</div>
        <div class="stat-value">{{ $pending }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
        <div class="stat-label">Approved</div>
        <div class="stat-value">{{ $approved }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
        <div class="stat-label">Rejected</div>
        <div class="stat-value">{{ $rejected }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">All Requests</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td style="color:var(--gray-400);font-size:0.75rem;">{{ $req->request_id }}</td>
                    <td>
                        <div style="font-weight:500;color:var(--gray-900);">{{ $req->full_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">{{ $req->user?->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight:500;">{{ $req->product?->product_name }}</div>
                        <div style="font-size:0.75rem;color:var(--gray-400);">${{ number_format($req->product?->base_price ?? 0, 0) }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $req->payment_preference === 'online' ? 'badge-blue' : 'badge-gray' }}">
                            {{ $req->payment_preference === 'online' ? 'Online' : 'Walk-in' }}
                        </span>
                    </td>
                    <td>
                        @php
                            $badgeClass = match($req->request_status) {
                                'pending'   => 'badge-yellow',
                                'approved'  => 'badge-green',
                                'rejected'  => 'badge-red',
                                default     => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($req->request_status) }}</span>
                    </td>
                    <td style="font-size:0.78rem;color:var(--gray-400);">{{ $req->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.car-requests.show', $req->request_id) }}" class="btn btn-secondary btn-sm">
                            Review
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--gray-400);">No requests yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($requests->hasPages())
    <div class="pagination-wrap">{{ $requests->links() }}</div>
    @endif
</div>
@endsection