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
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('product_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('slug')->nullable();
            $table->text('features')->nullable();
            $table->text('description')->nullable();
            $table->decimal('monthly_price', 8, 2)->nullable();  // Monthly subscription price
            $table->string('monthly_price_id')->nullable();  // Paddle or payment provider ID for monthly pricing
            $table->decimal('annual_price', 8, 2)->nullable();   // Annual subscription price
            $table->string('annual_price_id')->nullable();   // Paddle or payment provider ID for annual pricing
            $table->decimal('one_time_price', 8, 2)->nullable();  // One-time payment price (for lifetime plans)
            $table->tinyInteger('role_id')->default(1);
            $table->boolean('is_free')->default(0);
            $table->boolean('is_trial')->default(0);
            $table->boolean('is_active')->default(1);
            $table->integer('trial_days')->default(0);
            $table->integer('max_accounts')->nullable();
            $table->enum('billing_cycle', ['monthly', 'annual', 'lifetime'])->nullable();
            $table->boolean('is_one_time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
