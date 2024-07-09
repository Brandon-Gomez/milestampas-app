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
        Schema::disableForeignKeyConstraints();
        $this->down();
        Schema::enableForeignKeyConstraints();

        Schema::create('product_configurations', function (Blueprint $table) {
            $table->foreignId('product_item_id')->constrained();
            $table->foreignId('variation_option_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_configurations');
    }
};
