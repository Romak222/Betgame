<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('game_round_id')
                ->constrained('game_rounds')
                ->cascadeOnDelete();

            $table->foreignId('retailer_id')
                ->constrained('retailers')
                ->cascadeOnDelete();

            $table->string('selection');

            $table->decimal('amount', 12, 2);

            $table->boolean('is_winner')->default(false);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bets');
    }
};