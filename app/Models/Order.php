<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'shipping_method_id',
        'subtotal',
        'discount_amount',
        'shipping_fee',
        'total_amount',
        'order_status',
        'order_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id', 'address_id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'shipping_method_id');
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
}