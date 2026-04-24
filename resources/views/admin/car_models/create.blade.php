@extends('admin.layouts.admin')
@section('page-title', 'Add Car Model')
@section('breadcrumb') / <a href="{{ route('admin.car-models.index') }}">Car Models</a> / Add @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Add Car Model</div></div>
    <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-header"><span class="card-title">Car Model Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.car-models.store') }}">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Model Name * <span>(e.g. RB20, SF-25)</span></label>
                    <input type="text" name="model_name" value="{{ old('model_name') }}" required placeholder="e.g. RB20">
                    @error('model_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Season Year *</label>
                    <input type="number" name="season_year" value="{{ old('season_year', date('Y')) }}" required min="1950" max="2099">
                </div>
                <div class="form-group">
                    <label>Team</label>
                    <select name="team_id">
                        <option value="">— Select team —</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Driver</label>
                    <select name="driver_id">
                        <option value="">— Select driver —</option>
                        @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->driver_name }} {{ $driver->team ? '(' . $driver->team->team_name . ')' : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Engine</label>
                    <input type="text" name="engine" value="{{ old('engine') }}" placeholder="e.g. Honda RBPTH001 V6 Hybrid">
                </div>
                <div class="form-group">
                    <label>Horsepower</label>
                    <input type="number" name="horsepower" value="{{ old('horsepower') }}" placeholder="e.g. 1000">
                </div>
                <div class="form-group">
                    <label>Top Speed <span>(km/h)</span></label>
                    <input type="number" name="top_speed" value="{{ old('top_speed') }}" step="0.01" placeholder="e.g. 372">
                </div>
                <div class="form-group">
                    <label>Livery Color</label>
                    <input type="text" name="color" value="{{ old('color') }}" placeholder="e.g. Blue & Red">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Car Model</button>
                <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
