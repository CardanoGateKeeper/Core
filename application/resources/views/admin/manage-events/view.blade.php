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
                            <a href="{{ route('manage-events.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i>
                                {{ __('List Events') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="card text-center mx-2">
                                <div class="card-body">
                                    <p class="lead mb-0">{{$tickets['total']}}</p>
                                    <h4 class="card-title">Total Tickets</h4>
                                </div>

                            </div>
                            <div class="card text-center mx-2">
                                <div class="card-body">
                                    <p class="lead mb-0">{{$tickets['checked_in']}}</p>
                                    <h4 class="card-title">Checked In</h4>
                                </div>

                            </div>
                        </div>
                        <table class="table" id="ticketTable">
                            <thead>
                            <tr>
                                <th>Policy</th>
                                <th>Asset</th>
                                <th>Checked In</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets['event_tickets'] as $ticket)
                                <tr>
                                    <td>{{$ticket->policyId}}</td>
                                    <td>{{hex2bin($ticket->assetId)}}</td>
                                    <td>{{$ticket->isCheckedIn}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer.scripts')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#ticketTable');
    </script>
@endsection
