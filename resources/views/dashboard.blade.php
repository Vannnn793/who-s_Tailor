<h2>Dashboard</h2>

<p>Halo, {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
<h2>Dashboard Penjahit</h2>


@if($tailor)
    <p>Profil Penjahit: {{ $tailor->nama_toko ?? 'Nama Toko Tidak Ada' }}</p>

    <h4>Foto-foto yang Diunggah:</h4>
    @forelse($photos as $photo)
        <img src="{{ asset('storage/' . $photo->photo_path) }}" width="200" style="margin: 10px;">
    @empty
        <p>Belum ada foto yang diunggah.</p>
    @endforelse
@else
    <p>Belum punya data penjahit.</p>
@endif


<a href="{{ route('logout') }}">Logout</a>
