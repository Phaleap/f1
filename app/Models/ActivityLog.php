<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ActivityLog extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'log_id';
    protected $fillable = [
        'user_id', 'action', 'table_name', 'record_id', 'description'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}