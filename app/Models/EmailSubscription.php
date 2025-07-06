<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Scope for active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for unsubscribed
     */
    public function scopeUnsubscribed($query)
    {
        return $query->where('status', 'unsubscribed');
    }

    /**
     * Subscribe an email
     */
    public static function subscribe(string $email): self
    {
        return self::updateOrCreate(
            ['email' => $email],
            [
                'status' => 'active',
                'subscribed_at' => Carbon::now(),
                'unsubscribed_at' => null,
            ]
        );
    }

    /**
     * Unsubscribe an email
     */
    public function unsubscribe(): bool
    {
        $this->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => Carbon::now(),
        ]);

        return true;
    }

    /**
     * Resubscribe an email
     */
    public function resubscribe(): bool
    {
        $this->update([
            'status' => 'active',
            'subscribed_at' => Carbon::now(),
            'unsubscribed_at' => null,
        ]);

        return true;
    }

    /**
     * Check if email is subscribed
     */
    public static function isSubscribed(string $email): bool
    {
        return self::where('email', $email)
            ->where('status', 'active')
            ->exists();
    }
}
