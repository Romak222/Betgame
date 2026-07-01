<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('retailer_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('balance',12,2)->default(0);

            $table->decimal('hold_balance',12,2)->default(0);

            $table->decimal('total_credit',12,2)->default(0);

            $table->decimal('total_debit',12,2)->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};