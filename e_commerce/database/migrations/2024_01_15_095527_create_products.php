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
            $table->unsignedBigInteger('category_id')->default(0);
            $table->string('name', 255)->nullable();
            $table->string('sku', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->json('list_images', 400)->nullable();
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
            $table->foreign('category_id')->references('id')->on('categories');
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
