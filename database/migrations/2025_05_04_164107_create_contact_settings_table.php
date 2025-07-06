<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contact_settings')) {
            // Create the contact_settings table

        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('service_number', 20)->nullable();
            $table->string('sales_office_number', 20)->nullable();
            $table->string('po_box_address', 100)->nullable();
            $table->string('work_hours_weekday', 50)->nullable();
            $table->string('work_hours_weekend', 50)->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->string('contact_recipient_email', 100)->nullable();
            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_settings');
    }
};
