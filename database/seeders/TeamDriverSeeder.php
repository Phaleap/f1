<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Driver;
use App\Models\CarModel;

class TeamDriverSeeder extends Seeder
{
    public function run(): void
    {
        $ferrari = Team::create([
            'team_name'       => 'Scuderia Ferrari',
            'country'         => 'Italy',
            'founded_year'    => 1950,
            'team_principal'  => 'Frederic Vasseur',
            'created_at'      => now(),
        ]);

        $mercedes = Team::create([
            'team_name'       => 'Mercedes-AMG Petronas',
            'country'         => 'Germany',
            'founded_year'    => 2010,
            'team_principal'  => 'Toto Wolff',
            'created_at'      => now(),
        ]);

        $redbull = Team::create([
            'team_name'       => 'Red Bull Racing',
            'country'         => 'Austria',
            'founded_year'    => 2005,
            'team_principal'  => 'Christian Horner',
            'created_at'      => now(),
        ]);

        // Drivers
        $leclerc = Driver::create([
            'team_id'      => $ferrari->team_id,
            'driver_name'  => 'Charles Leclerc',
            'nationality'  => 'Monegasque',
            'car_number'   => 16,
            'championships'=> 0,
            'created_at'   => now(),
        ]);

        $hamilton = Driver::create([
            'team_id'      => $mercedes->team_id,
            'driver_name'  => 'Lewis Hamilton',
            'nationality'  => 'British',
            'car_number'   => 44,
            'championships'=> 7,
            'created_at'   => now(),
        ]);

        $verstappen = Driver::create([
            'team_id'      => $redbull->team_id,
            'driver_name'  => 'Max Verstappen',
            'nationality'  => 'Dutch',
            'car_number'   => 1,
            'championships'=> 4,
            'created_at'   => now(),
        ]);

        // Car Models
        CarModel::insert([
            [
                'team_id'     => $ferrari->team_id,
                'driver_id'   => $leclerc->driver_id,
                'model_name'  => 'Ferrari SF-24',
                'season_year' => 2024,
                'engine'      => 'Ferrari 066/12',
                'horsepower'  => 1000,
                'top_speed'   => 372.50,
                'color'       => 'Red',
                'created_at'  => now(),
            ],
            [
                'team_id'     => $mercedes->team_id,
                'driver_id'   => $hamilton->driver_id,
                'model_name'  => 'Mercedes W15',
                'season_year' => 2024,
                'engine'      => 'Mercedes M15 E Performance',
                'horsepower'  => 1000,
                'top_speed'   => 368.00,
                'color'       => 'Silver',
                'created_at'  => now(),
            ],
            [
                'team_id'     => $redbull->team_id,
                'driver_id'   => $verstappen->driver_id,
                'model_name'  => 'Red Bull RB20',
                'season_year' => 2024,
                'engine'      => 'Honda RBPTH002',
                'horsepower'  => 1000,
                'top_speed'   => 375.00,
                'color'       => 'Blue/Red',
                'created_at'  => now(),
            ],
        ]);
    }
}
