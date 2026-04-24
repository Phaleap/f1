@extends('admin.layouts.admin')
@section('page-title', 'Drivers')
@section('breadcrumb') / Drivers @endsection

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Drivers</div>
        <div class="page-sub">Manage F1 drivers</div>
    </div>
    <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Driver
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr>
                <th>#</th><th>Driver</th><th>Team</th><th>Nationality</th><th>Car No.</th><th>Championships</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($drivers as $driver)
            <tr>
                <td style="color:var(--gray-400); font-size:0.75rem;">{{ $loop->iteration }}</td>
                <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                        @if($driver->photo_url)
                        <img src="{{ $driver->photo_url }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;background:var(--gray-100);">
                        @else
                        <div style="width:32px;height:32px;border-radius:50%;background:var(--gray-100);display:flex;align-items:center;justify-content:center;font-size:0.7rem;color:var(--gray-400);font-weight:600;">{{ strtoupper(substr($driver->driver_name,0,1)) }}</div>
                        @endif
                        <strong>{{ $driver->driver_name }}</strong>
                    </div>
                </td>
                <td>{{ $driver->team?->team_name ?? '—' }}</td>
                <td>{{ $driver->nationality ?? '—' }}</td>
                <td>
                    @if($driver->car_number)
                    <span class="badge badge-gray">#{{ $driver->car_number }}</span>
                    @else —
                    @endif
                </td>
                <td>{{ $driver->championships ?? 0 }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.drivers.destroy', $driver) }}" onsubmit="return confirm('Delete this driver?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; padding:48px; color:var(--gray-400);">No drivers yet. <a href="{{ route('admin.drivers.create') }}" style="color:var(--red);">Add one</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($drivers->hasPages())
    <div class="pagination-wrap">{{ $drivers->links() }}</div>
    @endif
</div>
@endsection
