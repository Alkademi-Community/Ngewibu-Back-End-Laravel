<?php

namespace App\Http\Middleware;

use App\Services\ApiService;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an unauthenticated request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        $apiService = new ApiService();
        return $apiService->setResponseMessage('Please provide a valid token.')
                          ->setStatusCode(Response::HTTP_UNAUTHORIZED)
                          ->setStatus('error')
                          ->getApiResponse()
                          ->throwResponse();
    }
}
