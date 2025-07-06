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
        if (!Schema::hasTable('navigation_items')) {
            // Create the navigation_items table

        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('position')->default(0)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->string('target')->default('_self')->nullable();
            $table->timestamps();
            
            $table->foreign('parent_id', 'fk_navigation_items_parent')
                  ->references('id')
                  ->on('navigation_items')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('navigation_items');
    }
};