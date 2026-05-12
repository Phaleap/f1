@extends('admin.layouts.admin')

@section('title', 'Edit Admin')
@section('page-title', 'Edit Admin')
@section('breadcrumb') › <a href="{{ route('admin.admins.index') }}">Admins</a> › Edit @endsection

@section('content')
<div class="card">
    <div class="card-header"><div class="card-title">Edit Admin</div></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
            @csrf @method('PATCH')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $admin->full_name) }}" required>
                    @error('full_name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>New Password <span>(leave blank to keep current)</span></label>
                    <input type="password" name="password">
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label>Phone <span>(optional)</span></label>
                    <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}">
                </div>
            </div>
            <div style="margin-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection