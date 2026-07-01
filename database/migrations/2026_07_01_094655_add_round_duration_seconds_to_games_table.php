<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            if (!Schema::hasColumn('games', 'round_duration_seconds')) {
                $table->integer('round_duration_seconds')
                    ->default(90)
                    ->after('round_duration');
            }
        });

        DB::table('games')->where('code', 'SPINNER')->update([
            'round_duration_seconds' => 90
        ]);
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            if (Schema::hasColumn('games', 'round_duration_seconds')) {
                $table->dropColumn('round_duration_seconds');
            }
        });
    }
};