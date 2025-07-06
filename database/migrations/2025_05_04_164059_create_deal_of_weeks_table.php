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
        if (!Schema::hasTable('deal_of_weeks')) {

        // Check if the deal_of_weeks table already exists
        if (!Schema::hasTable('deal_of_weeks')) {
            Schema::create('deal_of_weeks', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->text('description')->nullable();
                $table->json('features')->nullable();
                $table->string('image')->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->decimal('discount_price', 10, 2)->nullable();
                $table->dateTime('expires_at')->nullable();
                $table->string('cta_text')->default('BOOK NOW');
                $table->string('cta_link')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_of_weeks');
    }
};