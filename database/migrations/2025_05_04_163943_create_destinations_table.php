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
        if (!Schema::hasTable('destinations')) {
            // Create the destinations table

        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bundle_id');
            $table->string('name');
            $table->string('location');
            $table->text('description');
            $table->string('main_image');
            $table->json('included_items');
            $table->text('restrictions')->nullable();
            $table->json('gallery');
            $table->string('destination_type')->default('domestic');
            $table->boolean('display_in_custom_bundles')->default(false);
            $table->timestamps();

            $table->foreign('bundle_id')->references('id')->on('bundles')->onDelete('cascade');
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
        Schema::dropIfExists('destinations');
    }
};