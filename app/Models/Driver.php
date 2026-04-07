<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Driver extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'driver_id';
    protected $fillable = [
        'team_id', 'driver_name', 'nationality',
        'car_number', 'date_of_birth', 'championships'
    ];
    protected $casts = ['date_of_birth' => 'date'];
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'driver_id', 'driver_id');
    }
}