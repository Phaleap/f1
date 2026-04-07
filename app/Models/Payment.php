<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'order_id', 'payment_method_id', 'transaction_code',
        'amount', 'payment_status', 'payment_date', 'notes'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }
}
