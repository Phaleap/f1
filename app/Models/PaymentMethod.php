<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentMethod extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'payment_method_id';
    protected $fillable = ['method_name', 'provider', 'description', 'status'];
    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_method_id', 'payment_method_id');
    }
}