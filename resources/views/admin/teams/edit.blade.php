@extends('admin.layouts.admin')
@section('page-title', 'Edit Team')
@section('breadcrumb') / <a href="{{ route('admin.teams.index') }}">Teams</a> / Edit @endsection

@section('content')
<div class="page-header">
    <div><div class="page-title">Edit Team — {{ $team->team_name }}</div></div>
    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-header"><span class="card-title">Team Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.teams.update', $team) }}">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Team Name *</label>
                    <input type="text" name="team_name" value="{{ old('team_name', $team->team_name) }}" required>
                    @error('team_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ old('country', $team->country) }}">
                </div>
                <div class="form-group">
                    <label>Founded Year</label>
                    <input type="number" name="founded_year" value="{{ old('founded_year', $team->founded_year) }}" min="1900" max="2099">
                </div>
                <div class="form-group">
                    <label>Team Principal</label>
                    <input type="text" name="team_principal" value="{{ old('team_principal', $team->team_principal) }}">
                </div>
                <div class="form-group">
                    <label>Brand Color</label>
                    <div style="display:flex; gap:8px; align-items:center;">
                        <input type="color" name="color_picker" value="{{ old('color', $team->color ?? '#E10600') }}" style="width:48px; flex-shrink:0;" oninput="document.getElementById('colorText').value=this.value">
                        <input type="text" id="colorText" name="color" value="{{ old('color', $team->color) }}" placeholder="#E10600" oninput="document.querySelector('input[type=color]').value=this.value">
                    </div>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
