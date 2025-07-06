<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;
    
    protected $table = 'why_choose_us';
    
    protected $fillable = [
        'title',
        'description',
        'icon',
        'color',
        'sort_order',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}