@extends('admin.layouts.admin')
@section('page-title', 'Teams')
@section('breadcrumb') / Teams @endsection

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Teams</div>
        <div class="page-sub">Manage F1 constructor teams</div>
    </div>
    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Team
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr>
                <th>Team</th><th>Country</th><th>Founded</th><th>Principal</th><th>Color</th><th>Drivers</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($teams as $team)
            <tr>
                <td><strong>{{ $team->team_name }}</strong></td>
                <td>{{ $team->country ?? '—' }}</td>
                <td>{{ $team->founded_year ?? '—' }}</td>
                <td>{{ $team->team_principal ?? '—' }}</td>
                <td>
                    @if($team->color)
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span class="color-dot" style="background: {{ $team->color }};"></span>
                        <code style="font-size:0.72rem; color:var(--gray-400);">{{ $team->color }}</code>
                    </div>
                    @else —
                    @endif
                </td>
                <td>{{ $team->drivers_count }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.teams.destroy', $team) }}" onsubmit="return confirm('Delete this team?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; padding:48px; color:var(--gray-400);">No teams yet. <a href="{{ route('admin.teams.create') }}" style="color:var(--red);">Add one</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($teams->hasPages())
    <div class="pagination-wrap">{{ $teams->links() }}</div>
    @endif
</div>
@endsection
