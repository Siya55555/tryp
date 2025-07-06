<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    
    // The table doesn't use updated_at
    public $timestamps = false;
}