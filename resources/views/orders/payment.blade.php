@extends('layouts.cust')

@section('content')
<div class="container text-center">
    <h3>Pembayaran untuk: <strong>{{ $order->nama }}</strong></h3>
    <p>Total: <strong>Rp {{ number_format($order->harga, 0, ',', '.') }}</strong></p>
    <button id="pay-button" class="btn btn-success mt-3">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ 'SB-Mid-client-7ypMSMje1czj1F2L' }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            alert("Pembayaran berhasil!");
            window.location.href = "/orders";
        },
        onPending: function(result){
            alert("Menunggu pembayaran...");
            window.location.href = "/orders";
        },
        onError: function(result){
            alert("Pembayaran gagal.");
        }
    });
};
</script>
@endsection
