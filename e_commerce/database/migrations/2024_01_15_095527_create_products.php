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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->json('list_images')->nullable();
            $table->string('description', 500)->nullable();
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('discount_id')->default(0);
            $table->unsignedBigInteger('inventory_id')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('inventory_id')->references('id')->on('inventorys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
