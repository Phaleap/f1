@extends('admin.layouts.admin')
@section('page-title', 'Brands')
@section('breadcrumb') / Brands @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Brands</div><div class="page-sub">Product brands</div></div>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Brand
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Brand</th><th>Country</th><th>Description</th><th>Products</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($brands as $brand)
            <tr>
                <td><strong>{{ $brand->brand_name }}</strong></td>
                <td>{{ $brand->country ?? '—' }}</td>
                <td style="color:var(--gray-400); font-size:0.78rem;">{{ Str::limit($brand->description, 60) ?? '—' }}</td>
                <td>{{ $brand->products_count }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}" onsubmit="return confirm('Delete this brand?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; padding:48px; color:var(--gray-400);">No brands yet. <a href="{{ route('admin.brands.create') }}" style="color:var(--red);">Add one</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($brands->hasPages())
    <div class="pagination-wrap">{{ $brands->links() }}</div>
    @endif
</div>
@endsection
