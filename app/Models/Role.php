<?php
namespace App\Models;

// app/Models/Role.php

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'role_id';
    protected $fillable = ['role_name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
