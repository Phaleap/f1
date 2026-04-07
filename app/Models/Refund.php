<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Refund extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'refund_id';
    protected $fillable = [
        'return_id', 'amount', 'refund_method', 'refund_status', 'refunded_at'
    ];
    public function return()
    {
        return $this->belongsTo(OrderReturn::class, 'return_id', 'return_id');
    }
}