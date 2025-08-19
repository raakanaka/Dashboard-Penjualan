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
        Schema::table('products', function (Blueprint $table) {
            // Rename columns to match new naming convention
            $table->renameColumn('price', 'selling_price');
            $table->renameColumn('stock', 'stock_quantity');
            $table->renameColumn('min_stock', 'reorder_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverse the column renames
            $table->renameColumn('selling_price', 'price');
            $table->renameColumn('stock_quantity', 'stock');
            $table->renameColumn('reorder_level', 'min_stock');
        });
    }
};
