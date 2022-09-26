@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-id-card me-1"></i>
                        {{ __('Profile') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('account.profile.update') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email address') }}</label>
                                        <input id="email" value="{{ $user->email }}" type="email" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="mb-3">
                                        <label for="roles" class="form-label">{{ __('Account roles') }}</label>
                                        <input id="roles" value="{{ count($user->roles) ? implode(', ', $user->roles) : __('None') }}" type="text" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Account name') }}</label>
                                        <input id="name" name="name" value="{{ old('name', $user->name) }}" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">{{ __('Current password') }}</label>
                                <input id="current_password" name="current_password" type="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">{{ __('New password') }}</label>
                                <input id="new_password" name="new_password" type="password" class="form-control">
                                <div class="form-text">Leave this blank, if you are not changing your account password</div>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle me-1"></i>
                                    Update
                                </button>

                                <button type="reset" class="btn btn-secondary">
                                    <i class="fa fa-refresh me-1"></i>
                                    Reset
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
