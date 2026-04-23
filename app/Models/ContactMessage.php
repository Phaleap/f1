<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $primaryKey = 'message_id';
    protected $fillable = ['name', 'email', 'subject', 'message', 'status'];
}