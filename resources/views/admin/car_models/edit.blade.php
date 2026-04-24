@extends('admin.layouts.admin')
@section('page-title', 'Edit Car Model')
@section('breadcrumb') / <a href="{{ route('admin.car-models.index') }}">Car Models</a> / Edit @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Edit Car Model — {{ $carModel->model_name }}</div></div>
    <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-header"><span class="card-title">Car Model Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.car-models.update', $carModel) }}">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Model Name *</label>
                    <input type="text" name="model_name" value="{{ old('model_name', $carModel->model_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Season Year *</label>
                    <input type="number" name="season_year" value="{{ old('season_year', $carModel->season_year) }}" required>
                </div>
                <div class="form-group">
                    <label>Team</label>
                    <select name="team_id">
                        <option value="">— Select team —</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id', $carModel->team_id) == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Driver</label>
                    <select name="driver_id">
                        <option value="">— Select driver —</option>
                        @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id', $carModel->driver_id) == $driver->id ? 'selected' : '' }}>
                            {{ $driver->driver_name }} {{ $driver->team ? '(' . $driver->team->team_name . ')' : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Engine</label>
                    <input type="text" name="engine" value="{{ old('engine', $carModel->engine) }}">
                </div>
                <div class="form-group">
                    <label>Horsepower</label>
                    <input type="number" name="horsepower" value="{{ old('horsepower', $carModel->horsepower) }}">
                </div>
                <div class="form-group">
                    <label>Top Speed (km/h)</label>
                    <input type="number" name="top_speed" value="{{ old('top_speed', $carModel->top_speed) }}" step="0.01">
                </div>
                <div class="form-group">
                    <label>Livery Color</label>
                    <input type="text" name="color" value="{{ old('color', $carModel->color) }}">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $carModel->description) }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
