@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-home"></i>
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    <p>{{ __('You are logged in!') }}</p>

                    <div class="d-flex justify-content-start align-items-center gap-3">

                        @if ($isAdmin)
                            @include('dashboard.admin-menu')
                        @endif

                        @if ($isStaff)
                            @include('dashboard.staff-menu')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
