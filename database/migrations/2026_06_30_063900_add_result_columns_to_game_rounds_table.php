<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('game_rounds', function (Blueprint $table) {

            $table->unsignedTinyInteger('result')
                ->nullable()
                ->after('status');

            $table->timestamp('result_declared_at')
                ->nullable()
                ->after('result');

            $table->foreignId('declared_by')
                ->nullable()
                ->after('result_declared_at')
                ->constrained('users')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('game_rounds', function (Blueprint $table) {

            $table->dropForeign(['declared_by']);

            $table->dropColumn([
                'result',
                'result_declared_at',
                'declared_by'
            ]);

        });
    }
};