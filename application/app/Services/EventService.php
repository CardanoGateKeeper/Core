<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class EventService {

    public function getEventList($fullInfo = false): Collection {
        if ($fullInfo) {
            return Event::all([
                                  'id',
                                  'uuid',
                                  'name',
                                  'policyIds',
                                  'nonceValidForMinutes',
                                  'hodlAsset',
                                  'startDateTime',
                                  'endDateTime',
                              ]);
        }

        return Event::all([
                              'uuid',
                              'name',
                              'policyIds',
                          ]);
    }

    /**
     * @throws AppException
     */
    public function save(array $payload): void {
        $event = null;
        if (!empty($payload['event_id']) && !$event = $this->findById($payload['event_id'])) {
            throw new AppException('Event not found');
        }

        $payload['policyIds'] = explode("\r\n", $payload['policyIds']);

        $validationRules = [
            'name'          => [
                'required',
                'min:3',
            ],
            'policyIds'     => ['required', 'array'],
            'endDateTime'   => ['required', 'date'],
            'startDateTime' => ['date'],
            'hodlAsset'     => ['integer'],
            'nonceValidForMinutes' => ['required', 'integer', 'min:5']
        ];

        $validator = Validator::make($payload, $validationRules);

        if ($validator->fails()) {
            throw new AppException(sprintf('%s: %s', trans('validation errors'), implode(' ', $validator->errors()
                                                                                                        ->all())));
        }

        if (!$event) {
            $event = new Event;
        }

        $validPayload = $validator->validated();

        error_log(print_r($validPayload, true));

        if (empty($validPayload['hodlAsset'])) {
            $validPayload['hodlAsset'] = 0;
        }

        $event->fill($validPayload);
        $event->save();
    }

    public function findById(int $eventId): ?Event {
        return Event::where('id', $eventId)
                    ->first();
    }

    public function findByUUID(string $uuid): ?Event {
        return Event::where('uuid', $uuid)
                    ->first();
    }
}
