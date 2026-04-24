@extends('admin.layouts.admin')
@section('page-title', 'Categories')
@section('breadcrumb') / Categories @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Categories</div><div class="page-sub">Product categories for merchandise</div></div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Category
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Parent</th><th>Description</th><th>Products</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($categories as $cat)
            <tr>
                <td><strong>{{ $cat->category_name }}</strong></td>
                <td>{!! $cat->parent?->category_name ?? '<span class="badge badge-blue">Top level</span>' !!}</td>
                <td style="color:var(--gray-400); font-size:0.78rem;">{{ Str::limit($cat->description, 60) ?? '—' }}</td>
                <td>{{ $cat->products_count }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; padding:48px; color:var(--gray-400);">No categories yet. <a href="{{ route('admin.categories.create') }}" style="color:var(--red);">Add one</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="pagination-wrap">{{ $categories->links() }}</div>
    @endif
</div>
@endsection
