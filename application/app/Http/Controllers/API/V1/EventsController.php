<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    use JsonResponseTrait;

    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function eventList(): JsonResponse
    {
        try {

            $eventList = Cache::remember('event-list', CACHE_ONE_DAY, function() {
                return $this->eventService->getEventList();
            });

            return $this->successResponse($eventList);

        } catch (Throwable $exception) {

            return $this->jsonException(trans('Failed to load event list'), $exception);

        }
    }

    public function eventInfo(string $uuid): JsonResponse
    {
        try {

            $event = $this->eventService->findByUUID($uuid);

            return $event
                ? $this->successResponse($event->only('name', 'policyIds'))
                : $this->errorResponse(trans('event not found'), Response::HTTP_NOT_FOUND);

        } catch (Throwable $exception) {

            return $this->jsonException(trans('Failed to load event info'), $exception);

        }
    }
}
