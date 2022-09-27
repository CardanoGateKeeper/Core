<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    private EventService $eventService;

    public function __construct(
        EventService $eventService,
    )
    {
        $this->eventService = $eventService;
    }

    public function index(): RedirectResponse
    {
        /**
         * TODO: Let the user pick the event they want to generate tickets for
         * TODO: For now, we get the first event in the system
         */

        $eventList = $this->eventService->getEventList();

        if (!$eventList->count()) {
            abort(500, trans('Events missing'));
        }

        return redirect()
            ->route('event', $eventList->first()->uuid);
    }

    public function event(string $eventUUID): Renderable
    {
        $event = $this->eventService->findByUUID($eventUUID);

        if (!$event) {
            abort(404, trans('Event not found'));
        }

        return view(
            'event',
            compact('event'),
        );
    }
}
