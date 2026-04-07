<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'discount_id';
    protected $fillable = [
        'discount_name', 'discount_type', 'discount_value',
        'start_date', 'end_date', 'min_quantity', 'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discounts', 'discount_id', 'product_id');
    }
}
