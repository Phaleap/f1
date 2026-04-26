@extends('admin.layouts.admin')
@section('title', 'Add Product')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Add Product</h1>
        <p class="page-subtitle">Create a new product</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0;padding-left:16px;">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

    {{-- LEFT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Basic Info --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Basic Info</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">SKU *</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Base Price *</label>
                        <input type="number" name="base_price" class="form-control" step="0.01" min="0" value="{{ old('base_price') }}" required>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Product Type *</label>
                        <select name="product_type" class="form-control" id="productType" required>
                            <option value="">Select type</option>
                            <option value="car" {{ old('product_type')=='car'?'selected':'' }}>Car</option>
                            <option value="merchandise" {{ old('product_type')=='merchandise'?'selected':'' }}>Merchandise</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status','active')=='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Car-specific --}}
        <div class="card" id="carSection" style="display:none;">
            <div class="card-header"><h3 class="card-title">Car Details</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Car Model</label>
                    <select name="car_model_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($carModels as $cm)
                            <option value="{{ $cm->id }}" {{ old('car_model_id')==$cm->id?'selected':'' }}>
                                {{ $cm->model_name }} ({{ $cm->season_year }}) — {{ $cm->team?->team_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Scale</label>
                        <input type="text" name="scale" class="form-control" placeholder="e.g. 1:18" value="{{ old('scale') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Material</label>
                        <input type="text" name="material" class="form-control" placeholder="e.g. Diecast" value="{{ old('material') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
    <label class="form-label">Featured in Hero</label>
    <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
        <input type="checkbox" name="is_featured" id="is_featured" value="1"
               {{ old('is_featured') ? 'checked' : '' }}
               style="width:16px;height:16px;cursor:pointer;">
        <label for="is_featured" style="cursor:pointer;margin:0;color:#6b7280;font-size:0.875rem;">
            Show this car in the hero showcase
        </label>
    </div>
</div>
        </div>

        {{-- Variants --}}
        <div class="card">
            <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
                <h3 class="card-title">Variants & Stock</h3>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addVariant()">+ Add Variant</button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Stock (no variants)</label>
                    <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', 0) }}">
                    <small style="color:#9ca3af;">Only used if no variants are added below.</small>
                </div>
                <div id="variantsList"></div>
            </div>
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Images --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Images</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Product Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small style="color:#9ca3af;">First image will be the main image.</small>
                </div>
            </div>
        </div>

        {{-- Organisation --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Organisation</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id?'selected':'' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" {{ old('supplier_id')==$s->id?'selected':'' }}>{{ $s->supplier_name ?? $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Warranty</label>
                    <select name="warranty_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($warranties as $w)
                            <option value="{{ $w->id }}" {{ old('warranty_id')==$w->id?'selected':'' }}>{{ $w->warranty_name ?? $w->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Pricing extras --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Pricing</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Sale Price</label>
                    <input type="number" name="sale_price" class="form-control" step="0.01" min="0" value="{{ old('sale_price') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" class="form-control" step="0.01" min="0" value="{{ old('weight') }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;">Create Product</button>
    </div>

</div>
</form>

<script>
// Show/hide car section
document.getElementById('productType').addEventListener('change', function() {
    document.getElementById('carSection').style.display = this.value === 'car' ? 'block' : 'none';
});
@if(old('product_type') === 'car')
    document.getElementById('carSection').style.display = 'block';
@endif

// Variants
let variantCount = 0;
function addVariant() {
    variantCount++;
    const div = document.createElement('div');
    div.style.cssText = 'border:1px solid #e5e7eb;border-radius:8px;padding:12px;margin-bottom:12px;position:relative;';
    div.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" style="position:absolute;top:8px;right:8px;background:none;border:none;cursor:pointer;color:#9ca3af;font-size:16px;">✕</button>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
            <div class="form-group">
                <label class="form-label">Variant Name</label>
                <input type="text" name="variants[${variantCount}][name]" class="form-control" placeholder="e.g. Red / XL">
            </div>
            <div class="form-group">
                <label class="form-label">SKU</label>
                <input type="text" name="variants[${variantCount}][sku]" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Size</label>
                <input type="text" name="variants[${variantCount}][size]" class="form-control" placeholder="S / M / L / XL">
            </div>
            <div class="form-group">
                <label class="form-label">Color</label>
                <input type="text" name="variants[${variantCount}][color]" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Extra Price</label>
                <input type="number" name="variants[${variantCount}][extra_price]" class="form-control" step="0.01" value="0">
            </div>
            <div class="form-group">
                <label class="form-label">Stock</label>
                <input type="number" name="variants[${variantCount}][stock]" class="form-control" value="0">
            </div>
        </div>`;
    document.getElementById('variantsList').appendChild(div);
}
</script>
@endsection
