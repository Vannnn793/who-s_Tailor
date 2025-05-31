@extends('layouts.cust')

@section('content')
<div class="container mt-4">
    <h2>Hallo</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($user as $usr)
            @if ($usr->tailor)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $usr->pp) }}" alt="" width="100%" height="150px" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $usr->nama }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $usr->tailor->nama }}</h6>
                        <p class="card-text">{{ $usr->tailor->deskripsi }}</p>
                        <p class="card-text">{{ $usr->tailor->skill }}</p>
                        <p class="card-text">Rp {{ $usr->tailor->harga }}</p>
                        <a href="{{ route('show', $usr->tailor->id) }}" class="btn btn-secondary">Lihat</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
