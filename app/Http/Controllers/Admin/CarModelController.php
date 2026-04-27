<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\Team;
use App\Models\Driver;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $carModels = CarModel::with(['team', 'driver'])->latest()->paginate(20);
        return view('admin.car_models.index', compact('carModels'));
    }

    public function create()
    {
        $teams   = Team::orderBy('team_name')->get();
        $drivers = Driver::with('team')->orderBy('driver_name')->get();
        return view('admin.car_models.create', compact('teams', 'drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'team_id'     => 'nullable|exists:teams,team_id',     // ✅ fix this
        'driver_id'   => 'nullable|exists:drivers,driver_id', // ✅ fix this
        'model_name'  => 'required|string|max:255',
        'season_year' => 'required|integer|min:1950|max:2099',
        'engine'      => 'nullable|string|max:255',
        'horsepower'  => 'nullable|integer',
        'top_speed'   => 'nullable|numeric',
        'color'       => 'nullable|string|max:50',
        'description' => 'nullable|string',
    ]);

        CarModel::create($data);
        return redirect()->route('admin.car-models.index')->with('success', 'Car model created.');
    }

    public function edit(CarModel $carModel)
    {
        $teams   = Team::orderBy('team_name')->get();
        $drivers = Driver::with('team')->orderBy('driver_name')->get();
        return view('admin.car_models.edit', compact('carModel', 'teams', 'drivers'));
    }

    public function update(Request $request, CarModel $carModel)
    {
        $data = $request->validate([
    'team_id'     => 'nullable|exists:teams,team_id',      // ✅
    'driver_id'   => 'nullable|exists:drivers,driver_id',  // ✅
    'model_name'  => 'required|string|max:255',
    'season_year' => 'required|integer|min:1950|max:2099',
    'engine'      => 'nullable|string|max:255',
    'horsepower'  => 'nullable|integer',
    'top_speed'   => 'nullable|numeric',
    'color'       => 'nullable|string|max:50',
    'description' => 'nullable|string',
]);

        $carModel->update($data);
        return redirect()->route('admin.car-models.index')->with('success', 'Car model updated.');
    }

    public function destroy(CarModel $carModel)
    {
        $carModel->delete();
        return redirect()->route('admin.car-models.index')->with('success', 'Car model deleted.');
    }
}
