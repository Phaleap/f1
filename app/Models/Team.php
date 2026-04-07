<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Team extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'team_id';
    protected $fillable = [
        'team_name', 'country', 'founded_year', 'team_principal'
    ];
    public function drivers()
    {
        return $this->hasMany(Driver::class, 'team_id', 'team_id');
    }
    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'team_id', 'team_id');
    }
}