@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-ticket"></i>
                            {{ __('Manage Events') }}
                        </div>
                        <div>
                            <!-- Add "New Event" here eventually -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive table-hover table-striped m-0">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Start') }}</th>
                                <th>{{ __('End') }}</th>
                                <th>{{ __('Policy IDs') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($allEvents->count())
                                @foreach($allEvents as $event)
                                    <tr>
                                        <td>{{$event->name}}</td>
                                        <td>{{$event->startDateTime->toDateTimeString()}}<br /><small>({{$event->startDateTime->diffForHumans()}})</small></td>
                                        <td>{{$event->endDateTime->toDateTimeString()}}<br /><small>({{$event->endDateTime->diffForHumans()}})</small></td>
                                        <td>{!! implode("<br/>",$event->policyIds) !!}</td>
                                        <td class="text-end">
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-pencil"></i>
                                                {{ __('Edit') }}
                                            </a>
                                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-search"></i>
                                                {{ __('View') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
