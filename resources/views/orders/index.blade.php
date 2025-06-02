@extends('layouts.cust')

@section('content')
<div class="container">
    <h2>Pesanan Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Ukuran</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Desain</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->nama }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>{{ $order->ukuran }}</td>
                <td>{{ $order->deskripsi }}</td>
                <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                <td>
                <p>Status: 
                    <span class="badge bg-{{ $order->status === 'selesai' ? 'success' : ($order->status === 'diproses' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p></td>
                
                <td>
                    <a href="{{ route('orders.payment', $order->id) }}"><button class="btn btn-primary">Bayar</button></a>
                    <a href="{{ asset('storage/'.$order->design) }}" target="_blank"><button class="btn btn-primary">Lihat Desain</button></a>
                    <a href="{{ route('rmv',["id" => $order -> id]) }}"><button class="btn btn-primary">Hapus</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
