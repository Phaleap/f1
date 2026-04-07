<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'shipping_method_id';
    protected $fillable = ['method_name', 'description', 'fee', 'estimated_days', 'status'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_method_id', 'shipping_method_id');
    }
}
