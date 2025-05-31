@extends('layouts.cust')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column align-items-left text-left">
        <img src="{{ asset('storage/' . $user->pp) }}" alt="Foto Profil" class="rounded-circle shadow" width="150" height="150">
        <h2 class="mt-3">{{ $tailor->nama ?? '' }}</h2>
        <p class="text-muted">{{ $tailor->skill ?? '' }}</p>
        <p><i class="bi bi-geo-alt"></i> {{ $tailor->alamat ?? '' }}</p>
        <p><strong>Umur:</strong> {{ $tailor->umur ?? '' }}</p>
        <p><strong>No HP:</strong> {{ $tailor->no_hp ?? '' }}</p>
        <p><strong>Harga Jasa:</strong> Rp {{ number_format($tailor->harga) }}</p>
        <p><strong>Deskripsi:</strong> {{ $tailor->deskripsi ?? '' }}</p>
    </div>
    <hr>
    <div class="d-flex flex-column align-items-right text-right">
        <a href="{{ route('orders.create', ['product_id' => $tailor->id]) }}" class="btn btn-primary">Beli</a>
    </div>
    <hr>

    <h3 class="text-center mt-4">Karya Saya</h3>
    <div class="row g-3 mt-2">
        @forelse($tailor_photos as $photo)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $photo->path) }}" alt="Karya" class="card-img-top" style="height: 200px; object-fit: cover;">
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada karya ditampilkan.</p>
        @endforelse
    </div>

    
</div>
@endsection