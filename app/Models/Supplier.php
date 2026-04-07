<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'supplier_name', 'contact_person', 'email',
        'phone', 'address', 'country', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'supplier_id');
    }
}
