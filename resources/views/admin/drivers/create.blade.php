@extends('admin.layouts.admin')
@section('page-title', 'Add Driver')
@section('breadcrumb') / <a href="{{ route('admin.drivers.index') }}">Drivers</a> / Add @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Add Driver</div></div>
    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 720px;">
    <div class="card-header"><span class="card-title">Driver Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.drivers.store') }}">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Driver Name *</label>
                    <input type="text" name="driver_name" value="{{ old('driver_name') }}" required>
                    @error('driver_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Team</label>
                    <select name="team_id">
                        <option value="">— No team —</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" placeholder="e.g. Dutch">
                </div>
                <div class="form-group">
                    <label>Car Number</label>
                    <input type="number" name="car_number" value="{{ old('car_number') }}" placeholder="e.g. 1">
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                </div>
                <div class="form-group">
                    <label>Championships</label>
                    <input type="number" name="championships" value="{{ old('championships', 0) }}" min="0">
                </div>
                <div class="form-group full">
                    <label>Photo URL <span>(full URL to driver photo — used on shop showcase)</span></label>
                    <input type="text" name="photo_url" value="{{ old('photo_url') }}" placeholder="https://...">
                    <span class="form-hint">Tip: use a portrait/headshot image URL. This shows on the shop hero alongside the car.</span>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Driver</button>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
