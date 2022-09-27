@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-ticket"></i>
                            {{ __('Event Details') }}
                        </div>
                        <div>
                            <a href="{{ route('events.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i>
                                {{ __('List Events') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
