@extends('admin.layouts.admin')
@section('page-title', 'Edit Brand')
@section('breadcrumb') / <a href="{{ route('admin.brands.index') }}">Brands</a> / Edit @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Edit Brand — {{ $brand->brand_name }}</div></div>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 560px;">
    <div class="card-header"><span class="card-title">Brand Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.brands.update', $brand) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label>Brand Name *</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name', $brand->brand_name) }}" required>
                    @error('brand_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ old('country', $brand->country) }}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description', $brand->description) }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
