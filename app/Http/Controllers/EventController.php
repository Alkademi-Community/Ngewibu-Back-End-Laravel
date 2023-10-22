<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(private ApiService $apiService, private EventService $eventService) {}

    /**
     * Fetch all events
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = $this->eventService->getAllEvents();
        return $this->apiService
                    ->setResponseData(compact('events'))
                    ->getApiResponse();

    }
}
