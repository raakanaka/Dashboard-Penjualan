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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertiser_id')->constrained('advertisers')->onDelete('cascade');
            $table->string('campaign_name');
            $table->decimal('budget_amount', 15, 2);
            $table->decimal('spent_amount', 15, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'paused', 'completed', 'cancelled'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
