@if (session('status') || session('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check-circle"></i>
                        <strong>{{ __('Success') }}</strong>
                        {!! session('status') !!}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ __('Error') }}</strong>
                        {!! session('error') !!}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endif
