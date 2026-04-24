<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Team;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('team')->latest()->paginate(20);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        $teams = Team::orderBy('team_name')->get();
        return view('admin.drivers.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id'       => 'nullable|exists:teams,id',
            'driver_name'   => 'required|string|max:255',
            'nationality'   => 'nullable|string|max:100',
            'car_number'    => 'nullable|integer',
            'date_of_birth' => 'nullable|date',
            'championships' => 'nullable|integer|min:0',
            'photo_url'     => 'nullable|string|max:500',
        ]);

        Driver::create($data);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver created.');
    }

    public function edit(Driver $driver)
    {
        $teams = Team::orderBy('team_name')->get();
        return view('admin.drivers.edit', compact('driver', 'teams'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'team_id'       => 'nullable|exists:teams,id',
            'driver_name'   => 'required|string|max:255',
            'nationality'   => 'nullable|string|max:100',
            'car_number'    => 'nullable|integer',
            'date_of_birth' => 'nullable|date',
            'championships' => 'nullable|integer|min:0',
            'photo_url'     => 'nullable|string|max:500',
        ]);

        $driver->update($data);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted.');
    }
}
