<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::withCount('drivers')->latest()->paginate(20);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_name'       => 'required|string|max:255|unique:teams',
            'country'         => 'nullable|string|max:100',
            'founded_year'    => 'nullable|integer|min:1900|max:2099',
            'team_principal'  => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:20',
        ]);

        Team::create($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team created.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'team_name'       => 'required|string|max:255|unique:teams,team_name,' . $team->id,
            'country'         => 'nullable|string|max:100',
            'founded_year'    => 'nullable|integer|min:1900|max:2099',
            'team_principal'  => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:20',
        ]);

        $team->update($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team updated.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team deleted.');
    }
}
