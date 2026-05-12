@extends('admin.layouts.admin')

@section('title', 'Add Admin')
@section('page-title', 'Add Admin')
@section('breadcrumb') › <a href="{{ route('admin.admins.index') }}">Admins</a> › Add @endsection

@section('content')
<div class="card">
    <div class="card-header"><div class="card-title">New Admin</div></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.admins.store') }}">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                    @error('full_name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label>Phone <span>(optional)</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}">
                </div>
            </div>
            <div style="margin-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Create Admin</button>
                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection