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
            $table->string('sku', 50)->nullable();
            $table->unsignedBigInteger('category_id')->default(0);
            $table->string('name', 255);
            $table->string('image', 255);
            $table->json('list_image');
            $table->text('description');
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('product_type')->default('default');
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->dateTime('time_sale')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

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
