<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CarModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'car_model_id';
    protected $fillable = [
        'team_id', 'driver_id', 'model_name', 'season_year',
        'engine', 'horsepower', 'top_speed', 'color', 'description'
    ];
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'car_model_id', 'car_model_id');
    }
}