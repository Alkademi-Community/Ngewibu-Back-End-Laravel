<?php

namespace App\Traits;

use App\Services\ApiService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Response;

trait WithApiValidationError
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(ValidationValidator $validator): void
    {
        $apiService = new ApiService();

        $response = $apiService->setStatusCode(Response::HTTP_BAD_REQUEST)
                                ->setErrorData($validator->errors())
                                ->setStatus('error')
                                ->setResponseMessage('Validation Error. Please check your input.')
                                ->getApiResponse();

        throw new HttpResponseException($response, Response::HTTP_BAD_REQUEST);
    }
}