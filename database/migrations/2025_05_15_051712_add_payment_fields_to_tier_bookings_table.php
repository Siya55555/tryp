<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToTierBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tier_bookings', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->after('package_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tier_bookings', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
