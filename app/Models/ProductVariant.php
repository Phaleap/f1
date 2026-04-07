<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductVariant extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'variant_id';
    protected $fillable = [
        'product_id', 'variant_name', 'size', 'color',
        'edition', 'extra_price', 'sku', 'status'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'variant_id', 'variant_id');
    }
}