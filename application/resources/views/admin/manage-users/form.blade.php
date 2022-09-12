@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-users"></i>
                            {{ __('Manage Users') }}
                            /
                            @if ($user)
                                {{ __('Edit User') }}
                            @else
                                {{ __('Add User') }}
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('admin.manage-users.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i>
                                {{ __('List Users') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.manage-users.save') }}" method="post">
                            @csrf
                            @if ($user)
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('Account Name') }}
                                </label>
                                <input id="name" name="name" value="{{ old('name', ($user ? $user->name : '')) }}" type="text" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    {{ __('Account Email') }}
                                </label>
                                <input id="email" name="email" value="{{ old('email', ($user ? $user->email : '')) }}" type="email" class="form-control" required>
                                <div class="form-text">Account email address must be unique across the system</div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    {{ __('Account Password') }}
                                </label>
                                <input id="password" name="password" value="" type="password" class="form-control">
                                <div class="form-text">Leave blank, if you do not wish to change the account password</div>
                            </div>

                            <div class="mb-3">
                                <label for="roles" class="form-label">
                                    {{ __('Account Roles') }}
                                </label>
                                @foreach(validRoles() as $validRole)
                                    <div class="form-check">
                                        <input name="roles[]" id="role{{ $validRole }}" value="{{ $validRole }}" {{ in_array($validRole, old('roles', ($user ? $user->roles : [])), true) ? 'checked' : '' }} class="form-check-input" type="checkbox">
                                        <label for="role{{ $validRole }}" class="form-check-label">
                                            {{ $validRole }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @if ($user)
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Update User
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i>
                                    Create User
                                </button>
                            @endif

                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fa fa-refresh"></i>
                                Reset Form
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
