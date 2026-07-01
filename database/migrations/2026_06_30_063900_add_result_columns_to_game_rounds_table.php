<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('game_rounds', function (Blueprint $table) {
            if (!Schema::hasColumn('game_rounds', 'result')) {
                $table->unsignedTinyInteger('result')->nullable()->after('status');
            }

            if (!Schema::hasColumn('game_rounds', 'result_declared_at')) {
                $table->timestamp('result_declared_at')->nullable()->after('result');
            }

            if (!Schema::hasColumn('game_rounds', 'declared_by')) {
                $table->foreignId('declared_by')->nullable()->after('result_declared_at')
                    ->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('game_rounds', function (Blueprint $table) {
            if (Schema::hasColumn('game_rounds', 'declared_by')) {
                $table->dropConstrainedForeignId('declared_by');
            }

            if (Schema::hasColumn('game_rounds', 'result_declared_at')) {
                $table->dropColumn('result_declared_at');
            }

            if (Schema::hasColumn('game_rounds', 'result')) {
                $table->dropColumn('result');
            }
        });
    }
};