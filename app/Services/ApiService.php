<?php

namespace App\Services;
use Illuminate\Http\JsonResponse;

class ApiService
{
    /**
     * The status of the API response.
     *
     * @var string
     */
    public string $status = 'success';
    
    /**
     * The HTTP status code to be returned by the API.
     *
     * @var int
     */
    public int $statusCode = 200;

    /**
     * @var string $message The message property of the ApiService class.
     */
    public string $message = '';

    /**
     * @var string|array|object $errors This variable holds any errors that occur during API service execution.
     */
    public string | array | object $errors = [];

    /**
     * @var array|object $data The data to be returned by the API service.
     */
    public array | object $data = [];

    /**
     * Returns a JSON response with the API data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApiResponse(): JsonResponse
    {

        $response = [
            'status'  => $this->status,
            'code'    => $this->statusCode,
            'message' => $this->message,
            'data'    => $this->data,
        ];

        if(strtolower($this->status) === 'error')
        {
            $response['errors'] = $this->errors;
            unset($response['data']);
        }

        if(empty($this->errors))
        {
            unset($response['errors']);
        }

        return response()->json($response, $this->statusCode);
    }

    /**
     * Set the status of the ApiService instance.
     *
     * @param string $status The status to set.
     * @return ApiService The ApiService instance.
     */
    public function setStatus(string $status): ApiService
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set the status code for the API response.
     *
     * @param int $statusCode The status code to be set.
     * @return ApiService The ApiService instance.
     */
    public function setStatusCode(int $statusCode): ApiService
    {
        $this->statusCode = $statusCode;
        
        return $this;
    }

    /**
     * Set the response data for the API service.
     *
     * @param array|object $data The data to set as the response.
     *
     * @return ApiService The current instance of the API service.
     */
    public function setResponseData(array | object $data): ApiService
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set the response message for the API service.
     *
     * @param string $message The message to be set as the response message.
     * @return ApiService Returns the ApiService instance for method chaining.
     */
    public function setResponseMessage(string $message): ApiService
    {
        $this->message = $message;

        return $this;
    }   

    /**
     * Set the error data for the API service.
     *
     * @param string|array|object $errors The error data to set.
     *
     * @return ApiService The API service instance.
     */
    public function setErrorData(string | array | object $errors): ApiService
    {
        $this->errors = $errors;

        return $this;
    }
}