<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarPurchaseRequest extends Model
{
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'user_id', 'product_id', 'full_name', 'phone',
        'message', 'payment_preference', 'request_status',
        'reviewed_by', 'reviewed_at', 'rejection_reason'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function reviewer() {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }

    public function appointment() {
        return $this->hasOne(CarAppointment::class, 'request_id', 'request_id');
    }

    public function carOrder() {
        return $this->hasOne(CarOrder::class, 'request_id', 'request_id');
    }
}