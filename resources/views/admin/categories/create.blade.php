@extends('admin.layouts.admin')
@section('page-title', 'Add Category')
@section('breadcrumb') / <a href="{{ route('admin.categories.index') }}">Categories</a> / Add @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Add Category</div></div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 560px;">
    <div class="card-header"><span class="card-title">Category Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Category Name *</label>
                    <input type="text" name="category_name" value="{{ old('category_name') }}" required placeholder="e.g. Apparel">
                    @error('category_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Parent Category <span>(leave empty for top-level)</span></label>
                    <select name="parent_category_id">
                        <option value="">— Top level —</option>
                        @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_category_id') == $parent->id ? 'selected' : '' }}>{{ $parent->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description') }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
