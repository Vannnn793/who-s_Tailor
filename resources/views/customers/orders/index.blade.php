@foreach($orders as $order)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $order->nama }}</h5>
            <p>Harga: Rp {{ number_format($order->harga) }}</p>
            <p>Status: 
                <span class="badge bg-{{ $order->status === 'selesai' ? 'success' : ($order->status === 'diproses' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            @if($order->tambahan)
                <p>Tambahan: {{ $order->tambahan }}</p>
            @endif
        </div>
    </div>
@endforeach
    