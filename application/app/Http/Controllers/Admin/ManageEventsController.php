<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;

class ManageEventsController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(): Renderable
    {
        $allEvents = $this->eventService->getEventList(true);

        return view(
            'admin.manage-events.index',
            compact('allEvents'),
        );
    }

    public function create(): Renderable
    {
        $event = null;

        return view(
            'admin.manage-events.form',
            compact('event'),
        );
    }

    public function store(Request $request): RedirectResponse
    {
        try {

            $payload = $request->only([
                'event_id',
                'name',
                'startDateTime',
                'endDateTime',
                'hodlAsset',
                'policyIds',
                'nonceValidForMinutes',
            ]);

            $this->eventService->save($payload);

            return redirect()
                ->route('manage-events.index')
                ->with('status', !empty($request->event_id)
                    ? trans('Event updated')
                    : trans('Event created')
                );

        } catch (Throwable $exception) {

            return redirectBackWithError(
                trans('Failed to save event'),
                $exception,
            );

        }
    }

    public function show(Event $event): Renderable
    {
        return view(
            'admin.manage-events.view',
            compact('event'),
        );
    }

    public function edit(Event $event): Renderable
    {
        return view(
            'admin.manage-events.form',
            compact('event'),
        );
    }

    public function destroy(Event $event): void
    {
        dd('TODO');
    }
}
