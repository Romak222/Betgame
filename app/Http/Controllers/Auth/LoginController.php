<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Authentication Service
     *
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     * Constructor
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Display Login Form
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Authenticate User
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $result = $this->authService->login(
            $request->validated()
        );

        if (!$result['success']) {

            return back()
                ->withInput($request->except('password'))
                ->withErrors([
                    'login' => $result['message']
                ]);
        }

        $user = $result['user'];

        /*
        |--------------------------------------------------------------------------
        | Role Based Redirection
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole('Super Admin')) {

            return redirect()
                ->route('admin.dashboard')
                ->with('success', $result['message']);
        }

        if ($user->hasRole('Admin')) {

            return redirect()
                ->route('admin.dashboard')
                ->with('success', $result['message']);
        }

        if ($user->hasRole('Retailer')) {

            return redirect()
                ->route('retailer.dashboard')
                ->with('success', $result['message']);
        }

        /*
        |--------------------------------------------------------------------------
        | Unknown Role
        |--------------------------------------------------------------------------
        */

        $this->authService->logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'login' => 'Your account does not have a valid role.'
            ]);
    }

    /**
     * Logout
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }
}