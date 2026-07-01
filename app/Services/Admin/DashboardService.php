<?php

namespace App\Services\Admin;

use App\Models\Retailer;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DashboardService
{
    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    public function getDashboardData(): array
    {
        return [
            'total_users' => User::count(),

            'total_retailers' => Retailer::count(),

            // Modules not yet created
            'total_games' => $this->getCountIfTableExists('games'),

            'total_game_types' => $this->getCountIfTableExists('game_types'),

            'total_rounds' => $this->getCountIfTableExists('rounds'),

            'today_users' => User::whereDate('created_at', today())->count(),

            'today_retailers' => Retailer::whereDate('created_at', today())->count(),
        ];
    }

    /**
     * Get row count only if the table exists.
     *
     * @param string $table
     * @return int
     */
    private function getCountIfTableExists(string $table): int
    {
        if (! Schema::hasTable($table)) {
            return 0;
        }

        return \DB::table($table)->count();
    }
}