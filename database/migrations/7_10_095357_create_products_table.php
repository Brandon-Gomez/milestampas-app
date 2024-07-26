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
        Schema::drop('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 50)->nullable();
            $table->string('name', 100);
            $table->foreignId('category_id')->constrained('categories');
            $table->float('price');
            $table->float('weight')->nullable();
            $table->text('short_desc', 250);
            $table->text('long_desc')->nullable();
            $table->string('image', 100);
            $table->string('image2', 100)->nullable();
            $table->string('image3', 100)->nullable();
            $table->float('stock')->nullable();
            $table->boolean('unlimited');
            $table->timestamps();
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
