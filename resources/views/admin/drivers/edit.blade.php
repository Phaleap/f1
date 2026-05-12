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
        <form method="POST" action="{{ route('admin.drivers.update', $driver) }}" enctype="multipart/form-data">
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
                        <option value="{{ $team->team_id }}" {{ old('team_id', $driver->team_id) == $team->team_id ? 'selected' : '' }}>
                            {{ $team->team_name }}
                        </option>
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

                {{-- Photo upload --}}
                <div class="form-group full">
                    <label>Driver Photo</label>

                    {{-- Current photo preview --}}
                    <div id="photo-preview-wrap" style="{{ $driver->photo_url ? '' : 'display:none;' }} margin-bottom:10px;">
                        <img id="photo-preview"
                             src="{{ $driver->photo_url ? asset('storage/' . $driver->photo_url) : '' }}"
                             style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--gray-200);"
                             onerror="this.parentElement.style.display='none'">
                    </div>

                    <input type="file"
                           name="photo"
                           id="photo-input"
                           accept="image/jpeg,image/png,image/webp"
                           onchange="previewPhoto(this)">

                    {{-- Preserve existing path when no new file is chosen --}}
                    <input type="hidden" name="photo_url" value="{{ old('photo_url', $driver->photo_url) }}">

                    <span class="form-hint" style="margin-top:6px;display:block;">
                        JPG, PNG or WebP · max 2 MB · leave blank to keep current photo
                    </span>
                    @error('photo')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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