<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function loginForm(): View
    {
        return view('login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = $this->userService->login($credentials, 'web', $request);

        if ($user) {
            session()->flash('success', 'Sign In successfully');

            return redirect()->route('main');
        }

        session()->flash('error', 'The provided credentials are incorrect');

        return redirect()->route('login.form');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->flash('success', "You're signed out of your account!");

        return redirect()->route('login.form');
    }
}
