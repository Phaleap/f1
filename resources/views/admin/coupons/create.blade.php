@extends('admin.layouts.admin')
@section('page-title', 'Add Coupon')
@section('breadcrumb') / <a href="{{ route('admin.coupons.index') }}">Coupons</a> / Add @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Add Coupon</div></div>
    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 560px;">
    <div class="card-header"><span class="card-title">Coupon Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Code *</label>
                    <input type="text" name="code" value="{{ old('code') }}"
                           placeholder="e.g. RACE10" required
                           style="text-transform:uppercase;">
                    @error('code')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="2">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Discount Type *</label>
                    <select name="discount_type" required>
                        <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                        <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>Fixed ($)</option>
                    </select>
                    @error('discount_type')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Discount Value *</label>
                    <input type="number" name="discount_value" value="{{ old('discount_value') }}"
                           step="0.01" min="0" required placeholder="e.g. 10">
                    @error('discount_value')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Minimum Order Amount</label>
                    <input type="number" name="min_order_amount" value="{{ old('min_order_amount', 0) }}"
                           step="0.01" min="0" placeholder="0">
                    @error('min_order_amount')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Usage Limit</label>
                    <input type="number" name="usage_limit" value="{{ old('usage_limit') }}"
                           min="1" placeholder="Leave blank for unlimited">
                    @error('usage_limit')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}">
                    @error('end_date')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" required>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection