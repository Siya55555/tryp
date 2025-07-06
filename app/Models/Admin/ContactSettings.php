<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ContactSettings extends Model
{
    protected $table = 'contact_settings';

    protected $fillable = [
        'service_number',
        'sales_office_number',
        'po_box_address',
        'work_hours_weekday',
        'work_hours_weekend',
        'contact_email',
        'contact_recipient_email',
        // New SMTP mail configuration fields
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'mail_password',
    ];

    /**
     * Get the first or create a new contact settings record
     * 
     * @return self
     */
    public static function getSettings()
    {
        return self::first() ?? new self();
    }

    /**
     * Apply these settings to the current mail configuration
     * 
     * @return void
     */
    public function applyMailConfig()
    {
        // Make sure we have a valid mailer type - default to 'smtp' if not set
        if (!empty($this->mail_mailer)) {
            config(['mail.mailer' => $this->mail_mailer]);
        } else {
            config(['mail.mailer' => 'smtp']); // Default to SMTP if not set
        }
        
        if (!empty($this->mail_host)) {
            config(['mail.host' => $this->mail_host]);
        }
        
        if (!empty($this->mail_port)) {
            config(['mail.port' => $this->mail_port]);
        }
        
        if (!empty($this->mail_username)) {
            config(['mail.username' => $this->mail_username]);
        }
        
        if (!empty($this->mail_password)) {
            config(['mail.password' => $this->mail_password]);
        }
        
        if (!empty($this->mail_encryption)) {
            config(['mail.encryption' => $this->mail_encryption]);
        }
        
        if (!empty($this->mail_from_address)) {
            config(['mail.from.address' => $this->mail_from_address]);
        }
        
        if (!empty($this->mail_from_name)) {
            config(['mail.from.name' => $this->mail_from_name]);
        }
        
        // Set SMTP mailer configuration
        if ($this->mail_mailer === 'smtp' || empty($this->mail_mailer)) {
            config(['mail.mailers.smtp.host' => $this->mail_host ?? env('MAIL_HOST', 'smtp.hostinger.com')]);
            config(['mail.mailers.smtp.port' => $this->mail_port ?? env('MAIL_PORT', 465)]);
            config(['mail.mailers.smtp.encryption' => $this->mail_encryption ?? env('MAIL_ENCRYPTION', 'tls')]);
            config(['mail.mailers.smtp.username' => $this->mail_username ?? env('MAIL_USERNAME', 'noreply@freelancerhasib.com')]);
            config(['mail.mailers.smtp.password' => $this->mail_password ?? env('MAIL_PASSWORD', '')]);
        }
    }
}