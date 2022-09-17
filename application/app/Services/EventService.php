<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Collection;

class EventService
{
    public function getEventList(): Collection
    {
        return Event::all([
            'uuid',
            'name',
            'policyIds'
        ]);
    }

    public function findByUUID(string $uuid): ?Event
    {
        return Event::where('uuid', $uuid)
            ->first();
    }
}
