@extends('admin.layouts.admin')
@section('page-title', 'Add Team')
@section('breadcrumb') / <a href="{{ route('admin.teams.index') }}">Teams</a> / Add @endsection

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Add Team</div>
    </div>
    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-header"><span class="card-title">Team Details</span></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.teams.store') }}">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Team Name *</label>
                    <input type="text" name="team_name" value="{{ old('team_name') }}" required>
                    @error('team_name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ old('country') }}" placeholder="e.g. United Kingdom">
                </div>
                <div class="form-group">
                    <label>Founded Year</label>
                    <input type="number" name="founded_year" value="{{ old('founded_year') }}" min="1900" max="2099" placeholder="e.g. 1998">
                </div>
                <div class="form-group">
                    <label>Team Principal</label>
                    <input type="text" name="team_principal" value="{{ old('team_principal') }}" placeholder="e.g. Christian Horner">
                </div>
                <div class="form-group">
                    <label>Brand Color <span>(hex or rgb — used on shop page)</span></label>
                    <div style="display:flex; gap:8px; align-items:center;">
                        <input type="color" name="color_picker" value="{{ old('color', '#E10600') }}" style="width:48px; flex-shrink:0;" oninput="document.getElementById('colorText').value=this.value">
                        <input type="text" id="colorText" name="color" value="{{ old('color', '#E10600') }}" placeholder="#E10600" oninput="document.querySelector('input[type=color]').value=this.value">
                    </div>
                    <span class="form-hint">This color shows as team accent on the shop showcase</span>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Team</button>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
