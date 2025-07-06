<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResendEmailVerificationOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;
    public $verifyUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $otp, $verifyUrl = null)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->verifyUrl = $verifyUrl ?? route('verification.verify');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Email Verification - MyTravel')
                    ->view('emails.verify-email');
    }
}