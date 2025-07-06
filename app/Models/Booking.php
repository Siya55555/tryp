<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\TravelPackage;

class Booking extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tier_bookings';

    protected $fillable = [
        'user_id',
        'package_type',
        'package_name',
        'package_price',
        'quantity',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'payment_method',
        'card_last_four',
        'status',
        'notes'
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the travel package associated with the booking.
     */
    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class, 'package_type', 'type');
    }

    /**
     * Get the full name of the customer.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}