<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();
        $user = $this->userService->register($data);

        return new UserResource($user);
    }
}
