<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inventory extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'inventory_id';
    protected $table = 'inventory';
    protected $fillable = [
        'product_id', 'variant_id', 'stock_quantity',
        'minimum_stock', 'maximum_stock', 'warehouse_location', 'last_updated'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'inventory_id', 'inventory_id');
    }
}