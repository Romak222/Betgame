<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('wallet_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('retailer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type',[
                'CREDIT',
                'DEBIT'
            ]);

            $table->enum('purpose',[
                'BET',
                'WIN',
                'DEPOSIT',
                'WITHDRAW',
                'REFUND',
                'ADJUSTMENT'
            ]);

            $table->decimal('amount',12,2);

            $table->decimal('balance_before',12,2);

            $table->decimal('balance_after',12,2);

            $table->string('reference_type')->nullable();

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};