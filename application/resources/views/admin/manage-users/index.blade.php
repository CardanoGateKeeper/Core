@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-users"></i>
                            {{ __('Manage Users') }}
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa fa-user-plus"></i>
                                {{ __('Add User') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-responsive table-hover table-striped m-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Created</th>
                                    <th>Action</th>
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
                                                    <span class="badge bg-secondary">Guest</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->created_at->toDateTimeString() }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.manage-users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-muted text-center">
                                            No users were found in the system
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
