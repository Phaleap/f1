<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'warranty_id';
    protected $fillable = [
        'warranty_name', 'warranty_type',
        'duration_months', 'terms', 'start_from'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'warranty_id', 'warranty_id');
    }
}
