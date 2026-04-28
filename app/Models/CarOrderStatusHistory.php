<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarOrderStatusHistory extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'car_order_id', 'status',
        'changed_by', 'changed_at', 'remarks'
    ];

    public function carOrder() {
        return $this->belongsTo(CarOrder::class, 'car_order_id', 'car_order_id');
    }

    public function changedBy() {
        return $this->belongsTo(User::class, 'changed_by', 'id');
    }
}