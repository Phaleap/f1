@extends('admin.layouts.admin')
@section('title', 'Edit Product')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Product</h1>
        <p class="page-subtitle">{{ $product->product_name }}</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0;padding-left:16px;">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

    {{-- LEFT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Basic Info --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Basic Info</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">SKU *</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Base Price *</label>
                        <input type="number" name="base_price" class="form-control" step="0.01" min="0" value="{{ old('base_price', $product->base_price) }}" required>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Product Type *</label>
                        <select name="product_type" class="form-control" id="productType" required>
                            <option value="car" {{ $product->product_type=='car'?'selected':'' }}>Car</option>
                            <option value="merchandise" {{ $product->product_type=='merchandise'?'selected':'' }}>Merchandise</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ $product->status=='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ $product->status=='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Car-specific --}}
        <div class="card" id="carSection" style="{{ $product->product_type === 'car' ? '' : 'display:none;' }}">
            <div class="card-header"><h3 class="card-title">Car Details</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Car Model</label>
                    <select name="car_model_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($carModels as $cm)
                            <option value="{{ $cm->id }}" {{ $product->car_model_id == $cm->id ? 'selected' : '' }}>
                                {{ $cm->model_name }} ({{ $cm->season_year }}) — {{ $cm->team?->team_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Scale</label>
                        <input type="text" name="scale" class="form-control" value="{{ old('scale', $product->scale) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Material</label>
                        <input type="text" name="material" class="form-control" value="{{ old('material', $product->material) }}">
                    </div>
                </div>
                {{-- ★ Featured in Hero --}}
                <div class="form-group" style="margin-top:16px;">
                    <label class="form-label">Featured in Hero</label>
                    <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                               {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                               style="width:16px;height:16px;cursor:pointer;">
                        <label for="is_featured" style="cursor:pointer;margin:0;color:#6b7280;font-size:0.875rem;">
                            Show this car in the hero showcase
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Existing Images --}}
        @if($product->images && $product->images->count())
        <div class="card">
            <div class="card-header"><h3 class="card-title">Current Images</h3></div>
            <div class="card-body">
                <div style="display:flex;flex-wrap:wrap;gap:12px;">
                    @foreach($product->images as $img)
                    <div style="position:relative;">
                        <img src="{{ asset('storage/' . $img->image_url) }}"
                             style="width:80px;height:80px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;">
                        @if($img->is_main)
                            <span style="position:absolute;top:2px;left:2px;background:#e10600;color:#fff;font-size:10px;padding:1px 4px;border-radius:3px;">Main</span>
                        @endif
                        <form method="POST" action="{{ route('admin.products.image.delete', $img) }}"
                              onsubmit="return confirm('Remove this image?')" style="margin-top:4px;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" style="width:100%;padding:2px 0;">Remove</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Variants --}}
        @if($product->variants && $product->variants->count())
        <div class="card">
            <div class="card-header"><h3 class="card-title">Variants</h3></div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th><th>Size</th><th>Color</th><th>Extra Price</th><th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->variants as $v)
                        <tr>
                            <td>{{ $v->variant_name }}</td>
                            <td>{{ $v->size ?? '—' }}</td>
                            <td>{{ $v->color ?? '—' }}</td>
                            <td>${{ number_format($v->extra_price, 2) }}</td>
                            <td>{{ $v->inventory->sum('stock_quantity') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <small style="color:#9ca3af;">To edit variants, use the Inventory section.</small>
            </div>
        </div>
        @endif

    </div>

    {{-- RIGHT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Add Images --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Add More Images</h3></div>
            <div class="card-body">
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                <small style="color:#9ca3af;">These will be added to existing images.</small>
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
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->supplier_name ?? $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Warranty</label>
                    <select name="warranty_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($warranties as $w)
                            <option value="{{ $w->id }}" {{ $product->warranty_id == $w->id ? 'selected' : '' }}>{{ $w->warranty_name ?? $w->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Pricing --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Pricing</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Sale Price</label>
                    <input type="number" name="sale_price" class="form-control" step="0.01" min="0" value="{{ old('sale_price', $product->sale_price) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" class="form-control" step="0.01" min="0" value="{{ old('weight', $product->weight) }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;">Save Changes</button>
    </div>

</div>
</form>

<form method="POST" action="{{ route('admin.products.destroy', $product) }}"
      onsubmit="return confirm('Permanently delete this product?')"
      style="margin-top:12px;">
    @csrf @method('DELETE')
    <button type="submit" class="btn btn-danger" style="width:100%;">Delete Product</button>
</form>

<script>
document.getElementById('productType').addEventListener('change', function() {
    document.getElementById('carSection').style.display = this.value === 'car' ? 'block' : 'none';
});
</script>
@endsection