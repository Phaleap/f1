@extends('admin.layouts.admin')

@section('title', 'Admins')
@section('page-title', 'Admins')
@section('breadcrumb') › Admins @endsection

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Admins</div>
        <div class="page-sub">Manage admin accounts</div>
    </div>
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">+ Add Admin</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->full_name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone ?? '—' }}</td>
                    <td><span class="badge badge-green">{{ $admin->status }}</span></td>
                    <td>{{ $admin->created_at->format('d M Y') }}</td>
                    <td style="display:flex;gap:8px;">
                        <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}"
                            onsubmit="return confirm('Delete this admin?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($admins->hasPages())
    <div class="pagination-wrap">{{ $admins->links() }}</div>
    @endif
</div>
@endsection