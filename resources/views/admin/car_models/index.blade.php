@extends('admin.layouts.admin')
@section('page-title', 'Car Models')
@section('breadcrumb') / Car Models @endsection

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Car Models</div>
        <div class="page-sub">F1 scale model specs — link to products</div>
    </div>
    <a href="{{ route('admin.car-models.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Car Model
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr>
                <th>Model</th><th>Team</th><th>Driver</th><th>Year</th><th>Engine</th><th>HP</th><th>Top Speed</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($carModels as $cm)
            <tr>
                <td><strong>{{ $cm->model_name }}</strong></td>
                <td>
                    @if($cm->team)
                    <div style="display:flex;align-items:center;gap:6px;">
                        @if($cm->team->color)<span class="color-dot" style="background:{{ $cm->team->color }};"></span>@endif
                        {{ $cm->team->team_name }}
                    </div>
                    @else —
                    @endif
                </td>
                <td>{{ $cm->driver?->driver_name ?? '—' }}</td>
                <td>{{ $cm->season_year }}</td>
                <td style="font-size:0.78rem; color:var(--gray-400);">{{ $cm->engine ?? '—' }}</td>
                <td>{{ $cm->horsepower ? $cm->horsepower . ' hp' : '—' }}</td>
                <td>{{ $cm->top_speed ? $cm->top_speed . ' km/h' : '—' }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.car-models.edit', $cm) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.car-models.destroy', $cm) }}" onsubmit="return confirm('Delete this car model?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; padding:48px; color:var(--gray-400);">No car models yet. <a href="{{ route('admin.car-models.create') }}" style="color:var(--red);">Add one</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($carModels->hasPages())
    <div class="pagination-wrap">{{ $carModels->links() }}</div>
    @endif
</div>
@endsection
