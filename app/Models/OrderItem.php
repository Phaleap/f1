<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'product_id', 'variant_id',
        'quantity', 'unit_price', 'discount_amount', 'subtotal'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
    public function return()
    {
        return $this->hasOne(OrderReturn::class, 'order_item_id', 'id');
    }
}