<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'bio',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(UserBooking::class);
    }

    public function tierBookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check if the user is an administrator
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * Check if user has any bookings (bundle or tier bookings)
     *
     * @return bool
     */
    public function hasBookings(): bool
    {
        $bundleBookingsCount = $this->bookings()->count();
        
        // Check if tier bookings exist (safeguard for missing model/table)
        $tierBookingsCount = 0;
        try {
            if (class_exists('\\App\\Models\\Booking') && \Illuminate\Support\Facades\Schema::hasTable('tier_bookings')) {
                $tierBookingsCount = $this->tierBookings()->count();
            }
        } catch (\Exception $e) {
            // Either class doesn't exist or table doesn't exist, just continue
        }
        
        return $bundleBookingsCount > 0 || $tierBookingsCount > 0;
    }

    /**
     * Get booking counts for the user
     *
     * @return array
     */
    public function getBookingCounts(): array
    {
        $bundleBookingsCount = $this->bookings()->count();
        
        // Check if tier bookings exist (safeguard for missing model/table)
        $tierBookingsCount = 0;
        try {
            if (class_exists('\\App\\Models\\Booking') && \Illuminate\Support\Facades\Schema::hasTable('tier_bookings')) {
                $tierBookingsCount = $this->tierBookings()->count();
            }
        } catch (\Exception $e) {
            // Either class doesn't exist or table doesn't exist, just continue
        }
        
        return [
            'bundle_bookings' => $bundleBookingsCount,
            'tier_bookings' => $tierBookingsCount,
            'total' => $bundleBookingsCount + $tierBookingsCount
        ];
    }
}