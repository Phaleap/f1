@extends('admin.layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')
@section('breadcrumb')
    <span>›</span> <span>Users</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Users</div>
        <div class="page-sub">Manage registered customers</div>
    </div>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.users.index') }}" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
            <div class="form-group" style="flex:1; min-width:200px;">
                <label>Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email…">
            </div>
            <div class="form-group" style="min-width:150px;">
                <label>Status</label>
                <select name="status">
                    <option value="">All</option>
                    <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">All Users</span>
        <span style="font-size:0.78rem; color:var(--gray-400);">{{ $users->total() }} total</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--gray-400);">{{ $user->id }}</td>
                    <td>
                        <div style="font-weight:500; color:var(--gray-900);">{{ $user->full_name }}</div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '—' }}</td>
                    <td>
                        @if($user->role)
                            <span class="badge badge-blue">{{ $user->role->role_name }}</span>
                        @else
                            <span class="badge badge-gray">No role</span>
                        @endif
                    </td>
                    <td>
                        @if($user->status === 'active')
                            <span class="badge badge-green">Active</span>
                        @else
                            <span class="badge badge-red">Inactive</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-400);">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary btn-sm">View</a>
                            <form method="POST" action="{{ route('admin.users.toggle-status', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-secondary' }}">
                                    {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:var(--gray-400); padding:40px;">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="pagination-wrap">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection