<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Promotion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'promotion_id';
    protected $fillable = [
        'promotion_name', 'description', 'promotion_type',
        'start_date', 'end_date', 'status'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotions', 'promotion_id', 'product_id');
    }
}