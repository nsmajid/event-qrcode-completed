@if ($participant)
    @if ($participant->have_arrived)
        <div class="alert alert-warning" role="alert">
            Participant have checked in <a href="/scan-qrcode" class="alert-link">Scan for Othe</a>
        </div>
    @else
        <form action="/scan-qrcode" method="POST">
            @csrf
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name : {{ $participant->name }}</li>
                <li class="list-group-item">Phone : {{ $participant->phone }}</li>
                <li class="list-group-item">Email : {{ $participant->email }}</li>
                <li class="list-group-item">{{ $participant->address }}</li>
            </ul>
            <p class="card-text">Klik Check in untuk melanjutkan proses check in</p>

            <input type="hidden" name="participant_id" id="participant_id" value="{{ $participant->id }}">
            <button type="submit" class="btn btn-primary">Check In</button>
            <a href="/scan-qrcode" class="btn btn-secondary">Re-Scan</a>
        </form>
    @endif
@else
    <div class="alert alert-warning" role="alert">
        QR Code Not Registered!!! <a href="/scan-qrcode" class="alert-link">Re-scan</a>
    </div>
@endif
