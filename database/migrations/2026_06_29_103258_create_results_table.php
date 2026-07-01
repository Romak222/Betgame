<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {

            $table->id();

            $table->foreignId('game_round_id')
                ->constrained('game_rounds')
                ->cascadeOnDelete();

            $table->string('winning_value');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};