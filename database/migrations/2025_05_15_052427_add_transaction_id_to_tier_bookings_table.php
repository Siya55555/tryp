<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToTierBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tier_bookings', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('card_last_four');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tier_bookings', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });
    }
}
