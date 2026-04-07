<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderReturn extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'return_id';
    protected $table = 'returns';
    protected $fillable = [
        'order_item_id', 'return_reason', 'return_status',
        'requested_at', 'approved_at'
    ];
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id');
    }
    public function refund()
    {
        return $this->hasOne(Refund::class, 'return_id', 'return_id');
    }
}