<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarOrder extends Model
{
    protected $primaryKey = 'car_order_id';

    protected $fillable = [
        'request_id', 'user_id', 'address_id',
        'payment_method_id', 'transaction_code', 'final_price',
        'car_order_status', 'payment_preference',
        'payment_confirmed_by', 'payment_confirmed_at',
        'payment_notes', 'expected_delivery'
    ];

    public function request() {
        return $this->belongsTo(CarPurchaseRequest::class, 'request_id', 'request_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address() {
        return $this->belongsTo(UserAddress::class, 'address_id', 'address_id');
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function statusHistory() {
        return $this->hasMany(CarOrderStatusHistory::class, 'car_order_id', 'car_order_id');
    }

    public function confirmedBy() {
        return $this->belongsTo(User::class, 'payment_confirmed_by', 'id');
    }
}