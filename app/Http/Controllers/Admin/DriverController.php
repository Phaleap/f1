<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'team_id'       => 'nullable|exists:teams,team_id',
            'driver_name'   => 'required|string|max:255',
            'nationality'   => 'nullable|string|max:100',
            'car_number'    => 'nullable|integer',
            'date_of_birth' => 'nullable|date',
            'championships' => 'nullable|integer|min:0',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_url'] = $request->file('photo')->store('drivers', 'public');
        }

        unset($data['photo']);
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
            'team_id'       => 'nullable|exists:teams,team_id',
            'driver_name'   => 'required|string|max:255',
            'nationality'   => 'nullable|string|max:100',
            'car_number'    => 'nullable|integer',
            'date_of_birth' => 'nullable|date',
            'championships' => 'nullable|integer|min:0',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old file to avoid orphans in storage
            if ($driver->photo_url) {
                Storage::disk('public')->delete($driver->photo_url);
            }
            $data['photo_url'] = $request->file('photo')->store('drivers', 'public');
        } else {
            // No new file — keep the existing path from hidden input
            $data['photo_url'] = $request->input('photo_url');
        }

        unset($data['photo']);
        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated.');
    }

    public function destroy(Driver $driver)
    {
        // Clean up the photo file when deleting a driver
        if ($driver->photo_url) {
            Storage::disk('public')->delete($driver->photo_url);
        }

        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted.');
    }
}