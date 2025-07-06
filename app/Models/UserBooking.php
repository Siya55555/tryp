<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBooking extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id', 
        'bundle_id', 
        'booking_date', 
        'status', 
        'notes',
        'number_of_people'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'booking_date' => 'date',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bundle associated with the booking.
     */
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }
    
    /**
     * Get the next available ID for a new booking.
     *
     * @return int
     */
    public static function getNextId()
    {
        $lastId = self::max('id');
        return $lastId ? $lastId + 1 : 1;
    }
}