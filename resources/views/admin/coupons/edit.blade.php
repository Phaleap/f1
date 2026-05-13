@extends('admin.layouts.admin')
@section('page-title', 'Edit Coupon')
@section('breadcrumb') / <a href="{{ route('admin.coupons.index') }}">Coupons</a> / Edit @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Edit Coupon — {{ $coupon->code }}</div></div>
    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 560px;">
    <div class="card-header">
        <span class="card-title">Coupon Details</span>
        <span style="font-size:0.65rem; letter-spacing:2px; color:var(--gray-400);">
            Used {{ $coupon->used_count }} time(s)
        </span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label>Code *</label>
                    <input type="text" name="code" value="{{ old('code', $coupon->code) }}"
                           required style="text-transform:uppercase;">
                    @error('code')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="2">{{ old('description', $coupon->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Discount Type *</label>
                    <select name="discount_type" required>
                        <option value="percentage" {{ old('discount_type', $coupon->discount_type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                        <option value="fixed" {{ old('discount_type', $coupon->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed ($)</option>
                    </select>
                    @error('discount_type')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Discount Value *</label>
                    <input type="number" name="discount_value"
                           value="{{ old('discount_value', $coupon->discount_value) }}"
                           step="0.01" min="0" required>
                    @error('discount_value')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Minimum Order Amount</label>
                    <input type="number" name="min_order_amount"
                           value="{{ old('min_order_amount', $coupon->min_order_amount) }}"
                           step="0.01" min="0">
                    @error('min_order_amount')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Usage Limit</label>
                    <input type="number" name="usage_limit"
                           value="{{ old('usage_limit', $coupon->usage_limit) }}"
                           min="1" placeholder="Leave blank for unlimited">
                    @error('usage_limit')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date"
                           value="{{ old('start_date', $coupon->start_date ? \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') : '') }}">
                    @error('start_date')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date"
                           value="{{ old('end_date', $coupon->end_date ? \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d') : '') }}">
                    @error('end_date')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" required>
                        <option value="active" {{ old('status', $coupon->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $coupon->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection