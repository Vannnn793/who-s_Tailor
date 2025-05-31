@extends('layouts.tailor')

@section('content')
<div class="container">
    <h2>Detail Pesanan #{{ $order->id }}</h2>
    
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Pelanggan: {{ $order->user->name }}</h5>
            <p><strong>Nama Pakaian:</strong> {{ $order->nama }}</p>
            <p><strong>Jumlah:</strong> {{ $order->jumlah }}</p>
            <p><strong>Ukuran:</strong> {{ $order->ukuran }}</p>
            <p><strong>Deskripsi:</strong> {{ $order->deskripsi }}</p>
            <p><strong>Harga Total:</strong> Rp {{ number_format($order->harga) }}</p>
            <p><strong>Status:</strong>
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="form-select">
                                <option {{ $order->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                <option {{ $order->status == 'diproses' ? 'selected' : '' }} value="diproses">Diproses</option>
                                <option {{ $order->status == 'selesai' ? 'selected' : '' }} value="selesai">Selesai</option>
                            </select>
                        </form>
            </p>
            @if($order->tambahan)
                <p><strong>Tambahan:</strong> {{ $order->tambahan }}</p>
            @endif

            <p><strong>Desain:</strong><br>
                <a href="{{ asset('storage/' . $order->design) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    Lihat Desain
                </a>
            </p>
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Kembali ke Daftar Pesanan</a>
</div>
@endsection
