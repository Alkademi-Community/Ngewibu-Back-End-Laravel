<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private ApiService $apiService) {}

    /**
     * Display the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user()
                        ->load(['userProfile', 'role'])
                        ->setHidden(['password']);
        
        return $this->apiService
                    ->setResponseData(compact('user'))
                    ->getApiResponse();
    }
}
