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
        <form method="POST" action="{{ route('admin.drivers.store') }}" enctype="multipart/form-data">
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
                        <option value="{{ $team->team_id }}" {{ old('team_id') == $team->team_id ? 'selected' : '' }}>
                            {{ $team->team_name }}
                        </option>
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

                {{-- Photo upload --}}
                <div class="form-group full">
                    <label>Driver Photo <span>(portrait/headshot · shown on shop showcase)</span></label>

                    {{-- Live preview before submit --}}
                    <div id="photo-preview-wrap" style="display:none; margin-bottom:10px;">
                        <img id="photo-preview"
                             style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--gray-200);">
                    </div>

                    <input type="file"
                           name="photo"
                           id="photo-input"
                           accept="image/jpeg,image/png,image/webp"
                           onchange="previewPhoto(this)">

                    <span class="form-hint" style="margin-top:6px;display:block;">
                        JPG, PNG or WebP · max 2 MB
                    </span>
                    @error('photo')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Create Driver</button>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewPhoto(input) {
    const wrap = document.getElementById('photo-preview-wrap');
    const img  = document.getElementById('photo-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection