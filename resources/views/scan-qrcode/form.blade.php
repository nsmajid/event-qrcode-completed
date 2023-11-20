@extends('layouts.bootstrap')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h3 class="mt-5">Scan QR Code Participant</h3>
            <div class="card text-center">
                <div class="card-body">
                    <div id="reader" width="600px"></div>
                    <div id="form-checkin"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText != '') {
                html5QrcodeScanner.clear();
                $.get("/scan-qrcode/check?code=" + decodedText, function(data) {
                    $("#form-checkin").html(data);
                });
            }

        }

        function onScanFailure(error) {
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
