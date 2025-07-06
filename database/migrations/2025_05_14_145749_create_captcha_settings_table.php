<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('captcha_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->boolean('enabled')->default(false);
            $table->boolean('enable_on_login')->default(true);
            $table->boolean('enable_on_register')->default(true);
            $table->boolean('enable_on_contact')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captcha_settings');
    }
};
