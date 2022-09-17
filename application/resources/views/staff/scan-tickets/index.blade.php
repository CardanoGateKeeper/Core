@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fa fa-ticket"></i>
                            {{ __('Scan Tickets') }}
                        </div>
                        <div>
                            <a href="{{ route('staff.scan-tickets.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-refresh"></i>
                                {{ __('Restart Scanner') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center align-content-center" id="scanner-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.min.js" integrity="sha512-yc+tEbvC4kiy3J6e0aZogFVr8AZhMtJTof2z+fGPaJgjehpIPzguZxfRRTiQcXlSHbJsB3Bborvv++81TMLZ2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.min.css" integrity="sha512-doewDSLNwoD1ZCdA1D1LXbbdNlI4uZv7vICMrzxfshHmzzyFNhajLEgH/uigrbOi8ETIftUGBkyLnbyDOU5rpA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>

        // TODO: This should be selected by staff, i.e. which event they are registering tickets (hardcoded for now)
        const EVENT_UUID = '7fdc027f-d1c3-4385-bf1b-aa9e0e81b133'; // Example Event

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            const $scannerContainer = $('div#scanner-container');

            const setLoading = (reason) => {
                $scannerContainer.html(`
                    <div class="w-100 alert alert-primary m-0 d-flex justify-content-center align-items-center">
                        <i class="fa fa-cog fa-spin fa-2x fa-fw me-1"></i>
                        ${reason} ...
                    </div>
                `);
            };

            const showError = (message) => {
                Swal.fire({
                    icon: 'error',
                    html: `<span class="text-danger">${message}</span>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Okay',
                    allowOutsideClick: false,
                });
            };

            const showSuccess = (message) => {
                Swal.fire({
                    icon: 'success',
                    html: `<span class="text-success">${message}</span>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Okay',
                    allowOutsideClick: false,
                });
            };

            const html5QrCode = new Html5Qrcode('scanner-container');
            const cameraConfig = { fps: 10, qrbox: { width: 250, height: 250 } };

            const qrCodeSuccessCallback = (decodedText) => {
                stopCamera(() => {
                    Swal.fire({
                        title: `<i class="fa fa-cog fa-spin fa-fw me-1"></i>`,
                        html: `Registering ticket, please wait ...`,
                        showConfirmButton: false,
                        showCancelButton: false,
                        allowOutsideClick: false,
                    });
                    setTimeout(() => {
                        const ajaxRequest = {
                            eventUUID: EVENT_UUID,
                            qr: decodedText,
                        };
                        $.post('{{ route('staff.scan-tickets.ajax.register-ticket') }}', ajaxRequest, (response) => {
                            if (response.error) {
                                showError(response.error);
                            } else if (response.data && response.data.success) {
                                showSuccess(response.data.success);
                            }
                            startCamera();
                        }).catch((err) => {
                            showError(err.responseJSON.error
                                ? err.responseJSON.error
                                : `Failed to register ticket <hr> ${err.responseJSON.message}`
                            );
                            startCamera();
                        });
                    }, 500);
                });
            };

            const startCamera = () => {
                setLoading('Loading camera');
                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        html5QrCode
                            .start({ facingMode: 'environment' }, cameraConfig, qrCodeSuccessCallback)
                            .catch((err) => {
                                $scannerContainer.html(`
                                    <div class="w-100 alert alert-danger m-0 d-flex gap-1 justify-content-center align-items-center">
                                        <i class="fa fa-warning"></i>
                                        ${err}
                                    </div>
                                `);
                            });
                    } else {
                        showError('No cameras were detected');
                    }
                }).catch(err => showError(err));
            };

            const stopCamera = (callback) => {
                html5QrCode
                    .stop()
                    .then((ignore) => callback())
                    .catch(err => showError(err));
            };

            startCamera();

        });

    </script>
@endpush
