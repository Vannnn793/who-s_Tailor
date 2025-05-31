@extends('layouts.cust')

@section('content')
<div class="container">
    <h2 class="mb-4">Buat Pemesanan Baru</h2>

    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pakaian</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <input type="hidden" name="product_id" value="{{ $tailor->id }}">

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <select name="ukuran" id="ukuran" class="form-select" required>
                <option value="">-- Pilih Ukuran --</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Tambahan</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="design" class="form-label">Upload Desain</label>
            <input type="file" name="design" id="design" class="form-control" accept="image/*,.pdf" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tambahan (opsional)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="extras[]" value="bordir|10000" id="bordir">
                <label class="form-check-label" for="bordir">Bordir (+Rp 10.000)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="extras[]" value="payet|15000" id="payet">
                <label class="form-check-label" for="payet">Payet (+Rp 15.000)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="extras[]" value="kancing_mewah|5000" id="kancing">
                <label class="form-check-label" for="kancing">Kancing Mewah (+Rp 5.000)</label>
            </div>
            <div class="mb-3">
                <input type="hidden" name="harga" id="harga" value="{{ $harga }}">
                <input type="hidden" name="product_id" value="{{ $tailor->id ?? '' }}">
                <p><strong>Harga dasar:</strong> Rp <span id="base-price">{{ number_format($harga) }}</span></p>
                <p><strong>Total sementara:</strong> Rp <span id="total-price">{{ number_format($harga) }}</span></p>
            </div>

        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Lanjutkan ke Pembayaran</button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="extras[]"]');
        const basePrice = parseInt(document.getElementById('harga').value);
        const totalDisplay = document.getElementById('total-price');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateTotal);
        });

        function updateTotal() {
            let total = basePrice;

            checkboxes.forEach(function (cb) {
                if (cb.checked) {
                    const [, price] = cb.value.split('|');
                    total += parseInt(price);
                }
            });

            totalDisplay.textContent = total.toLocaleString('id-ID');
        }
    });
</script>
@endpush

@endsection
