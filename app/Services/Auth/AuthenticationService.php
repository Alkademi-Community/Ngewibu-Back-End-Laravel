<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\ApiService;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    public function __construct(
        private UserService $userService, 
        private ApiService $apiService,
    ){}

    /**
     * Authenticates a user with the given username or email and password.
     *
     * @param string|null $usernameOrEmail The username or email of the user to authenticate.
     * @param string|null $password The password of the user to authenticate.
     *
     * @return mixed The API response data.
     *
     * @throws \App\Exceptions\UserNotFoundException If the user is not found.
     * @throws \App\Exceptions\InvalidPasswordException If the password is invalid.
     */
    public function authenticate(?string $usernameOrEmail, ?string $password)
    {
        $user = $this->userService->findOne(usernameOrEmail: $usernameOrEmail);

        $this->checkIfUserIsExists($user, $usernameOrEmail);
        $this->validatePassword($user, $password);

        return $this->apiService
                    ->setResponseData([
                        'username'  => $user->username,
                        'email'     => $user->email,
                        'full_name' => $user->userProfile->full_name,
                        'role'      => $user->role->name,
                        'token'     => $this->generateToken($user),
                    ])
                    ->getApiResponse()
                    ->throwResponse();
    }

    /**
     * Generates a bearer token for the given user.
     *
     * @param User $user The user to generate the token for.
     * @return string The generated bearer token.
     */
    private function generateToken(User $user): string
    {
        
        $token = $user->createToken('bearer')->plainTextToken;
        
        return "Bearer {$token}";
    }

    /**
     * Check if user exists in the database.
     *
     * @param User|null $user The user object to check.
     * @param string $usernameOrEmail The username or email of the user to check.
     * @return void
     */
    private function checkIfUserIsExists(?User $user, string $usernameOrEmail)
    {
        if(is_null($user))
        {
            return $this->apiService
                        ->setStatus('error')
                        ->setStatusCode(Response::HTTP_NOT_FOUND)
                        ->setResponseMessage("User with username or email {$usernameOrEmail} not found.")
                        ->getApiResponse()
                        ->throwResponse();
        }

    }

    /**
     * Validates the given password against the user's hashed password.
     *
     * @param User $user The user object to validate the password against.
     * @param string $password The password to validate.
     * @return void
     */
    private function validatePassword(User $user, string $password)
    {
        $passwordIsNotValid = !Hash::check($password, $user->password);
        if($passwordIsNotValid)
        {
            return $this->apiService
                        ->setStatus('error')
                        ->setStatusCode(Response::HTTP_UNAUTHORIZED)
                        ->setResponseMessage('Password is not valid.')
                        ->getApiResponse()
                        ->throwResponse();
        }
    }
}