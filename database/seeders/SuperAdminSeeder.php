<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'username' => 'superadmin',
            ],
            [
                'login_id'      => 'SA001',
                'email'         => 'superadmin@example.com',
                'password'      => bcrypt('password'),
                'status'        => true,
                'last_login_at' => null,
            ]
        );

        if (! $user->hasRole('Super Admin')) {
            $user->assignRole('Super Admin');
        }
    }
}