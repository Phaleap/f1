<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    // NO $primaryKey needed — it's just 'id'
    public $timestamps = false;

    protected $fillable = ['category_name', 'description', 'parent_category_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}