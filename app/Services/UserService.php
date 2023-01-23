<?php

namespace App\Services;

use App\Events\UserLoggedIn;
use App\Mail\EmailConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function register(array $data): User
    {
        $user = new User($data);
        $user->save();

        Mail::to($user)->send(new EmailConfirmation($user));

        return $user;
    }

    public function login(array $credentials, string $guard, $request): ?User
    {
        $check = function ($user) {
            return $user->email_verified_at !== null;
        };

        if (Auth::guard($guard)->attemptWhen($credentials, $check)) {
            $user = auth($guard)->user();
            $ipAddress = $request->ip();

            $event = new UserLoggedIn($user, $ipAddress);
            event($event);

            return $user;
        }

        return null;
    }
}
