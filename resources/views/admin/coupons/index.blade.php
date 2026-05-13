@extends('admin.layouts.admin')
@section('page-title', 'Coupons')
@section('breadcrumb') / Coupons @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Coupons</div><div class="page-sub">Manage discount codes</div></div>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Coupon
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Min Order</th>
                    <th>Usage</th>
                    <th>Expires</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($coupons as $coupon)
            <tr>
                <td><strong style="letter-spacing:2px;">{{ $coupon->code }}</strong></td>
                <td>{{ ucfirst($coupon->discount_type) }}</td>
                <td>
                    @if($coupon->discount_type === 'percentage')
                        {{ $coupon->discount_value }}%
                    @else
                        ${{ number_format($coupon->discount_value, 2) }}
                    @endif
                </td>
                <td>${{ number_format($coupon->min_order_amount, 2) }}</td>
                <td>
                    {{ $coupon->used_count }}
                    @if($coupon->usage_limit)
                        / {{ $coupon->usage_limit }}
                    @else
                        / ∞
                    @endif
                </td>
                <td style="color:var(--gray-400); font-size:0.78rem;">
                    {{ $coupon->end_date ? \Carbon\Carbon::parse($coupon->end_date)->format('d M Y') : '—' }}
                </td>
                <td>
                    <span style="
                        font-size:0.6rem; letter-spacing:2px; text-transform:uppercase;
                        padding:3px 10px;
                        background: {{ $coupon->status === 'active' ? 'rgba(74,222,128,0.1)' : 'rgba(255,255,255,0.05)' }};
                        color: {{ $coupon->status === 'active' ? '#4ade80' : 'var(--gray-400)' }};
                    ">
                        {{ ucfirst($coupon->status) }}
                    </span>
                </td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}" onsubmit="return confirm('Delete this coupon?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:48px; color:var(--gray-400);">
                    No coupons yet. <a href="{{ route('admin.coupons.create') }}" style="color:var(--red);">Add one</a>
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($coupons->hasPages())
    <div class="pagination-wrap">{{ $coupons->links() }}</div>
    @endif
</div>
@endsection