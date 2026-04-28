<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    // ← REMOVE $primaryKey, $keyType, $incrementing (PK is just 'id')

    protected $fillable = [
        'category_id', 'brand_id', 'supplier_id', 'car_model_id',
        'product_name', 'sku', 'description', 'base_price', 'cost_price',
        'product_type', 'material', 'weight', 'warranty_id', 'status',
        'is_featured',
        'requires_approval',
        'is_purchasable_online',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'car_model_id');
    }
    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id', 'warranty_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id')->where('is_main', true);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'product_discounts', 'product_id', 'discount_id');
    }
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotions', 'product_id', 'promotion_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    // Add helper method:
public function isCarProduct(): bool
{
    return $this->product_type === 'car';
}

// Add relationship:
public function carPurchaseRequests() {
    return $this->hasMany(CarPurchaseRequest::class, 'product_id');
}
}