@extends('admin.layouts.admin')
@section('page-title', 'Edit Driver')
@section('breadcrumb') / <a href="{{ route('admin.drivers.index') }}">Drivers</a> / Edit @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Edit Driver — {{ $driver->driver_name }}</div></div>
    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 720px;">
    <div class="card-header"><span class="card-title">Driver Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.drivers.update', $driver) }}">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Driver Name *</label>
                    <input type="text" name="driver_name" value="{{ old('driver_name', $driver->driver_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Team</label>
                    <select name="team_id">
                        <option value="">— No team —</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id', $driver->team_id) == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $driver->nationality) }}">
                </div>
                <div class="form-group">
                    <label>Car Number</label>
                    <input type="number" name="car_number" value="{{ old('car_number', $driver->car_number) }}">
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $driver->date_of_birth) }}">
                </div>
                <div class="form-group">
                    <label>Championships</label>
                    <input type="number" name="championships" value="{{ old('championships', $driver->championships) }}" min="0">
                </div>
                <div class="form-group full">
                    <label>Photo URL</label>
                    <input type="text" name="photo_url" value="{{ old('photo_url', $driver->photo_url) }}" placeholder="https://...">
                    @if($driver->photo_url)
                    <img src="{{ $driver->photo_url }}" style="margin-top:8px;height:80px;border-radius:6px;object-fit:cover;" onerror="this.style.display='none'">
                    @endif
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
