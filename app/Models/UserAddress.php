<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'user_id', 'receiver_name', 'phone', 'street_address',
        'city', 'province', 'postal_code', 'country',
        'address_type', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id', 'address_id');
    }
}
