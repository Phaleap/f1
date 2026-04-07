<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderStatusHistory extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'history_id';
    protected $fillable = ['order_id', 'status', 'changed_by', 'changed_at', 'remarks'];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by', 'id');
    }
}