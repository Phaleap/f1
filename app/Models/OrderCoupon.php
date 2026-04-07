<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderCoupon extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_id', 'coupon_id', 'discount_amount'];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'coupon_id');
    }
}