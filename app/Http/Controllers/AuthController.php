<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthenticationService;

class AuthController extends Controller
{

    public function __construct(
        protected AuthenticationService $authenticationService
    ) {}

    /**
     * Authenticates a user with the given credentials.
     *
     * @param LoginRequest $request The login request object.
     *
     * @return void
     */
    public function authenticate(LoginRequest $request)
    {
        $usernameOrEmail = $request->input('username_or_email');
        $password        = $request->input('password');

        $this->authenticationService->authenticate($usernameOrEmail, $password);
    }
}
