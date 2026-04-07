<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'movement_id';
    protected $fillable = [
        'inventory_id', 'movement_type', 'quantity',
        'reference_type', 'reference_id', 'notes'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
}
