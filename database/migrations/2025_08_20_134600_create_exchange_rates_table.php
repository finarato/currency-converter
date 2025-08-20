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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_from', 3);
            $table->string('currency_to', 3);
            $table->decimal('rate', 15, 8);
            $table->date('date');
            $table->timestamps();

            $table->index(['currency_from', 'currency_to']); // Rate fast search
            $table->index('date');                   // Date fast search
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
