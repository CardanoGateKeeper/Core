<?php

namespace App\Services;

use App\Models\Event;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class EventService
{
    public function getEventList($fullInfo = false): Collection
    {
        $selectColumns = [
            'uuid',
            'name',
            'policyIds',
        ];

        if ($fullInfo) {
            $selectColumns = array_merge(
                $selectColumns,
                [
                    'id',
                    'nonceValidForMinutes',
                    'hodlAsset',
                    'startDateTime',
                    'endDateTime',
                ]
            );
        }

        return Event::all($selectColumns);
    }

    /**
     * @throws AppException|ValidationException
     */
    public function save(array $payload): void
    {
        $event = null;
        if (!empty($payload['event_id']) && !$event = $this->findById($payload['event_id'])) {
            throw new AppException(trans('Event not found'));
        }

        $payload['policyIds'] = array_filter(preg_split("/\r\n|\n|\r/", $payload['policyIds']));

        $validationRules = [
            'name' => ['required', 'min:3'],
            'policyIds' => ['required', 'array', 'min:1'],
            'endDateTime' => ['required', 'date'],
            'startDateTime' => ['date'],
            'hodlAsset' => ['integer'],
            'nonceValidForMinutes' => ['required', 'integer', 'min:5']
        ];

        $validator = Validator::make($payload, $validationRules);

        if ($validator->fails()) {
            throw new AppException(sprintf(
                '%s: %s',
                trans('validation errors'), implode(' ', $validator->errors()->all())
            ));
        }

        if (!$event) {
            $event = new Event;
        }

        $validPayload = $validator->validated();

        if (empty($validPayload['hodlAsset'])) {
            $validPayload['hodlAsset'] = false;
        }

        $event->fill($validPayload);
        $event->save();
    }

    public function findById(int $eventId): ?Event
    {
        return Event::where('id', $eventId)
            ->first();
    }

    public function findByUUID(string $uuid): ?Event
    {
        return Event::where('uuid', $uuid)
            ->first();
    }
}
