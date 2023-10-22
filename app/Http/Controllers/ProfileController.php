<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\ApiService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private UserService $userService) {}

    /**
     * Display the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $this->userService->getLoggedUserProfile($request->user());
    }

    /**
     * Update the user's profile.
     *
     * @param  UpdateProfileRequest  $request
     * @return void
     */
    public function update(UpdateProfileRequest $request)
    {
        $data         = $request->validated();
        $user         = $request->user()->load('userProfile', 'userProfileAttachment');
        $data['host'] = $request->getSchemeAndHttpHost();

        $this->userService->update($user, $data);
    }
}
