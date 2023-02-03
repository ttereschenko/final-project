<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function login(LoginRequest $request): UserResource|Response
    {
        $credentials = $request->validated();

        $user = $this->userService->login($credentials, 'api', $request);

        if ($user) {
            return new UserResource($user);
        }

        $data = [
            'message' => 'The provided credentials are incorrect',
        ];

        return response($data, 401);
    }
}
