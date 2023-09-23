<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class ManageEventsController extends Controller {

    private EventService $eventService;

    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
    }

    public function index(): Renderable {
        $allEvents = $this->eventService->getEventList(true);

        return view('admin.manage-events.index', compact('allEvents'),);
    }

    public function create(): Renderable {
        $event = null;

        return view('admin.manage-events.form', compact('event'),);
    }

    public function store(Request $request): RedirectResponse {
        try {

            $payload = $request->only([
                'event_id',
                'name',
                'location',
                'eventDate',
                'eventStart',
                'eventEnd',
                'startDateTime',
                'endDateTime',
                'hodlAsset',
                'policyIds',
                'nonceValidForMinutes',
            ]);

            if ($request->file('image')) {
                $payload['image'] = $request->file('image')->store('public');
            }


            $this->eventService->save($payload);

            return redirect()
                ->route('manage-events.index')
                ->with('status', !empty($request->event_id) ? trans('Event updated') : trans('Event created'));

        } catch (Throwable $exception) {

            return redirectBackWithError(trans('Failed to save event'), $exception,);

        }
    }

    public function show(Event $event): Renderable {
        $event_tickets = $event->tickets;
        $tickets       = [
            'total'         => count($event_tickets),
            'checked_in'    => 0,
            'event_tickets' => $event_tickets,
        ];

        foreach ($event_tickets as $ticket) {
            if ($ticket->isCheckedIn) {
                $tickets['checked_in']++;
            }
        }

//        $tickets = $event->tickets;
        return view('admin.manage-events.view', compact('event', 'tickets'),);
    }

    public function edit(Event $event): Renderable {
        return view('admin.manage-events.form', compact('event'),);
    }

    public function destroy(Event $event): void {
        dd('TODO');
    }
}
