<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarAppointment extends Model
{
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'request_id', 'user_id', 'appointment_date',
        'location', 'appointment_status',
        'confirmed_by', 'confirmed_at', 'notes'
    ];

    public function request() {
        return $this->belongsTo(CarPurchaseRequest::class, 'request_id', 'request_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function confirmedBy() {
        return $this->belongsTo(User::class, 'confirmed_by', 'id');
    }
}