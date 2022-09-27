@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-users me-1"></i>
                            {{ __('Manage Users') }}
                        </div>
                        <div>
                            <a href="{{ route('admin.manage-users.add-user') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-user-plus me-1"></i>
                                {{ __('Add User') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <form method="get">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="search" name="search" id="search" value="{{ request()->search ?? '' }}" placeholder="Search users by name, email or roles ..." class="form-control" aria-label="" aria-describedby="inputGroup-sizing-sm">
                                <button class="btn btn-outline-secondary" type="submit">
                                    {{ __('Search') }}
                                </button>
                                <a href="{{ route('admin.manage-users.index') }}" class="btn btn-outline-secondary">
                                    {{ __('Clear') }}
                                </a>
                            </div>
                        </form>

                        <table class="table table-bordered table-responsive table-hover table-striped m-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Roles') }}</th>
                                    <th>{{ __('Created') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($allUsers->count())
                                    @foreach ($allUsers as $user)
                                        <tr>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                @if (count($user->roles))
                                                    @foreach ($user->roles as $role)
                                                        <span class="badge bg-primary">{{ $role }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-secondary">{{ __('Guest') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->created_at->toDateTimeString() }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.manage-users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-muted text-center">
                                            {{ __('No users were found in the system') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('search').addEventListener('input', (e) => {
            if (!e.currentTarget.value || !e.currentTarget.value.length) {
                location.href = '{{ route('admin.manage-users.index') }}';
            }
        });
    </script>
@endpush
