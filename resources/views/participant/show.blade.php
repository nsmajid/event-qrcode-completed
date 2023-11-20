@extends('layouts.bootstrap')
@section('content')
    <div class="container col-lg-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 text-center">
                <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="d-block mx-lg-auto img-fluid"
                    alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                <strong class="mt-2">{{ $participant->uniq_code }}</strong>
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">{{ $participant->name }}</h1>
                <p class="lead">{{ $participant->address }}</p>
                <p class="text-muted">{{ $participant->email }}</p>
                <p class="text-muted">{{ $participant->phone }}</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="data:image/png;base64, {!! base64_encode($qrcode) !!}" download="{{ $participant->uniq_code }}"
                        type="button" class="btn btn-primary btn-lg px-4 me-md-2">Download</a>
                    <a href="/registration" type="button" class="btn btn-outline-secondary btn-lg px-4">Form Registration</a>
                </div>
            </div>
        </div>
    </div>
@endsection
