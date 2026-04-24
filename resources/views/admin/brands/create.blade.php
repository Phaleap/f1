@extends('admin.layouts.admin')
@section('page-title', 'Add Brand')
@section('breadcrumb') / <a href="{{ route('admin.brands.index') }}">Brands</a> / Add @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Add Brand</div></div>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 560px;">
    <div class="card-header"><span class="card-title">Brand Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.brands.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Brand Name *</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" required>
                    @error('brand_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ old('country') }}" placeholder="e.g. Germany">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description') }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
