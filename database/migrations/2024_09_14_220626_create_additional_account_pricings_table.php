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
        Schema::create('additional_account_pricings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('price_id');
            $table->uuid('plan_id');  // Foreign key to the plans table
            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade');

            $table->decimal('price_per_account', 8, 2);  // Price for each additional account
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_account_pricings');
    }
};
