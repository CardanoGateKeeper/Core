@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-ticket"></i>
                            @if ($event)
                                {{ __('Edit Event') }}
                            @else
                                {{ __('Add Event') }}
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('manage-events.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i>
                                {{ __('List Events') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('manage-events.store') }}" method="post">
                            @csrf
                            @if ($event)
                                <input type="hidden" name="event_id" value="{{ $event->id }}"/>
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('Event Name') }}
                                </label>
                                <input id="name" name="name" value="{{ old('name', ($event ? $event->name : '')) }}" type="text" class="form-control" required />
                            </div>

                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="startDateTime" class="form-label">
                                            {{ __('Ticketing Start Time (UTC)') }}
                                        </label>
                                        <input id="startDateTime" name="startDateTime" type="datetime-local" class="form-control datepicker" step="any" value="{{ old('startDateTime', ($event && $event->startDateTime ? $event->startDateTime->toDateTimeLocalString() : '')) }}" />
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <div class="mb-3">
                                        <label for="endDateTime" class="form-label">
                                            {{ __('Ticketing End Time (UTC)') }}
                                        </label>
                                        <input id="endDateTime" name="endDateTime" type="datetime-local" class="form-control datepicker" step="any" value="{{ old('endDateTime', ($event && $event->endDateTime ? $event->endDateTime->toDateTimeLocalString() : '')) }}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="hodlAsset" class="form-check-input" role="switch" {{ ($event && $event->hodlAsset ? 'checked' : '') }} id="hodlAsset" value="1" />
                                            <label class="form-check-label" for="hodlAsset">Users must hold asset at check-in</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="nonceValidForMinutes">
                                            Signature Expiration Period
                                        </label>
                                        <div class="input-group">
                                            <input type="number" name="nonceValidForMinutes" id="nonceValidForMinutes" step="1" min="5" class="form-control" aria-labelledby="timeoutHelp" value="{{ old('nonceValidForMinutes', ($event ? $event->nonceValidForMinutes : 15)) }}" required />
                                            <span class="input-group-text">minutes</span>
                                        </div>
                                        <div id="timeoutHelp" class="form-text">Default: 15 minutes</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="policyIds">Eligible Policy IDs</label>
                                <textarea id="policyIds" name="policyIds" class="form-control" rows="5" required aria-describedby="policyIdHelp">{{ old('policyIds', ($event ? implode("\r\n", $event->policyIds) : '')) }}</textarea>
                                <div id="policyIdHelp" class="form-text">Please list each eligible policy on a new line</div>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary">
                                    @if($event)
                                        <i class="fa fa-save"></i>
                                        Update Event
                                    @else
                                        <i class="fa fa-check-circle"></i>
                                        Create Event
                                    @endif
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-refresh"></i> Reset Form
                                </button>
                                <a href="{{ route('manage-events.index') }}" class="btn btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
