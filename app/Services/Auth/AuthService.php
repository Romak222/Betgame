<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Authenticate user using Login ID or Username.
     *
     * @param array $credentials
     * @return array
     */
    public function login(array $credentials): array
    {
        $login = trim($credentials['login']);
        $password = $credentials['password'];
        $remember = $credentials['remember'] ?? false;

        $user = User::where('username', $login)
            ->orWhere('login_id', $login)
            ->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Invalid Login ID / Username or Password.',
            ];
        }

        if (!$user->status) {
            return [
                'success' => false,
                'message' => 'Your account has been deactivated. Please contact the administrator.',
            ];
        }

        if (!Hash::check($password, $user->password)) {
            return [
                'success' => false,
                'message' => 'Invalid Login ID / Username or Password.',
            ];
        }

        DB::transaction(function () use ($user, $remember) {

            Auth::login($user, $remember);

            $user->update([
                'last_login_at' => now(),
            ]);
        });

        request()->session()->regenerate();

        return [
            'success' => true,
            'message' => 'Login successful.',
            'user' => $user,
        ];
    }

    /**
     * Logout current user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}