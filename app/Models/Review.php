<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Review extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'user_id', 'product_id', 'rating', 'comment', 'review_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}