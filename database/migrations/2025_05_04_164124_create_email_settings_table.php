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
        if (!Schema::hasTable('email_settings')) {
            // Create the email_settings table

        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('email_title');
            $table->text('welcome_message');
            $table->text('account_details')->nullable();
            $table->text('closing_message')->nullable();
            $table->string('button_text')->nullable();
            $table->string('signature')->nullable();
            $table->string('company_name')->nullable();
            $table->text('additional_footer')->nullable();
            $table->string('header_bg_color')->nullable();
            $table->string('header_text_color')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('button_bg_color')->nullable();
            $table->string('button_text_color')->nullable();
            $table->string('button_hover_color')->nullable();
            $table->string('footer_bg_color')->nullable();
            $table->string('footer_text_color')->nullable();
            $table->string('footer_link_color')->nullable();
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
        Schema::dropIfExists('email_settings');
    }
};