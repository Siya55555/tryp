<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    
    // Specify that the table doesn't use an auto-incrementing ID
    public $incrementing = false;
    
    // Set the primary key
    protected $primaryKey = 'email';
    
    // The table doesn't use updated_at
    public $timestamps = false;
}