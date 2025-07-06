<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'gateway_type',
        'is_active',
        'is_default',
        'description',
        'instructions',
        'config',
        'icon',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'config' => 'array',
    ];

    /**
     * Get the configuration for a specific gateway
     *
     * @return array
     */
    public function getConfigArray(): array
    {
        return is_array($this->config) ? $this->config : json_decode($this->config, true) ?? [];
    }

    /**
     * Set a specific config value
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setConfigValue(string $key, $value): void
    {
        $config = $this->getConfigArray();
        $config[$key] = $value;
        $this->config = $config;
        $this->save();
    }
}
