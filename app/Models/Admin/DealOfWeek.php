<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealOfWeek extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'features',
        'image',
        'price',
        'discount_price',
        'expires_at',
        'cta_text',
        'cta_link',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'expires_at' => 'datetime',
    ];
}

