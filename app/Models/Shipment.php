<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Shipment extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'shipment_id';
    protected $fillable = [
        'order_id', 'tracking_number', 'courier_name',
        'shipped_date', 'delivered_date', 'shipment_status',
        'shipping_cost', 'notes'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}