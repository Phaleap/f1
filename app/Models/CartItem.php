<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CartItem extends Model
{
    public $timestamps = false;
    protected $fillable = ['cart_id', 'product_id', 'variant_id', 'quantity', 'unit_price', 'added_at'];
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}