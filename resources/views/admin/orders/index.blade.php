@extends('layouts.tailor')

@section('content')
<div class="container">
    <h2>Manajemen Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Nama Pakaian</th>
                <th>Harga</th>
                <th>Tambahan</th>
                <th>Status</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->nama }}</td>
                    <td>Rp {{ number_format($order->harga) }}</td>
                    <td>{{ $order->tambahan ?? '-' }}</td>
                    <td><span class="badge bg-{{ $order->status === 'selesai' ? 'success' : ($order->status === 'diproses' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($order->status) }}
                    </span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="form-select">
                                <option {{ $order->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                <option {{ $order->status == 'diproses' ? 'selected' : '' }} value="diproses">Diproses</option>
                                <option {{ $order->status == 'selesai' ? 'selected' : '' }} value="selesai">Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}"><button class="btn btn-primary">Detail</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
