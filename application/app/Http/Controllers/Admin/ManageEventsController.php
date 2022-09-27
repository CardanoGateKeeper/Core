<?php

namespace App\Http\Controllers\Admin;

use App\Services\EventService;
use Throwable;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ManageEventsController extends Controller {

    private EventService $eventService;

    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
    }

    public function index(): Renderable {
        $allEvents = $this->eventService->getEventList(true);

        return view('admin.manage-events.index', compact('allEvents'));
    }

    public function create(): Renderable {
        $event = null;

        return view('admin.manage-events.form', compact('event'));
    }

    public function store(Request $request) {
        // Do stuff to save it here...

        try {
            $this->eventService->save($request->only([
                                                         'event_id',
                                                         'name',
                                                         'startDateTime',
                                                         'endDateTime',
                                                         'hodlAsset',
                                                         'policyIds',
                                                         'nonceValidForMinutes',
                                                     ]));

            return redirect()
                ->route('events.index')
                ->with('status', $request->event_id ? trans('Event updated') : trans('Event created'));
        } catch (Throwable $exception) {
            return redirectBackWithError(trans('Failed to save event'), $exception);
        }
//        return $request;
    }

    public function show(Event $event): Renderable {
//        return $event;
        return view('admin.manage-events.view', compact('event'));
    }

    public function edit(Event $event): Renderable {
        return view('admin.manage-events.form', compact('event'));
    }

    public function destroy(Event $event) {
        // Do stuff to delete it here...
    }
}
