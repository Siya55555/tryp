<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'address',
        'description',
        'amenities',
        'photos',
        'status',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
} 