<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'coupon_id';
    protected $fillable = [
        'code', 'description', 'discount_type', 'discount_value',
        'min_order_amount', 'usage_limit', 'used_count',
        'start_date', 'end_date', 'status'
    ];
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_coupons', 'coupon_id', 'order_id')
                    ->withPivot('discount_amount');
    }
}