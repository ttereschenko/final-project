<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function registerForm(): View
    {
        return view('register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->userService->register($data);

        session()->flash('success', 'Successfully Sign Up! Don\'t forget to verify your email!');

        return redirect()->route('main');
    }

    public function verifyEmail(int $id, string $hash, Request $request): RedirectResponse
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        $user = User::query()->findOrFail($id);

        $user->email_verified_at = new DateTime();

        if (!hash_equals($hash, sha1($user->email))) {
            abort(403);
        }

        $user->save();

        session()->flash('success', 'Successfully Verified Email!');

        return redirect()->route('login.form');
    }
}
