<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\EmailConfirmation;
use App\Models\User;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->userService->register($data);

        session()->flash('success', 'Successfully Sign Up! Don\'t forget to verify your email!');

        return redirect()->route('main');
    }

    public function verifyEmail(int $id, string $hash, Request $request)
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
