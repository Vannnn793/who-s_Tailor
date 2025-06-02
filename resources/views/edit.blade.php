@extends('layouts.tailor')
@section('content')
<div class="container">
    <h2>Edit Profil</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
        <label type="text" for="pp" class="form-label">pp</label>
        <input type="file" name="pp" class="form-control">
        </div>
        <div class="mb-3"> 
        <label type="text" for="name" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $tailor->nama ?? '') }}" placeholder="Nama">
        </div>
        <div class="mb-3">
        <label type="text" for="umur" class="form-label">umur</label>
        <input type="text" name="umur" class="form-control" value="{{ old('umur',$tailor->umur ?? '') }}" placeholder="umur">
        </div>
        <div class="mb-3">
        <label type="text"for="alamat" class="form-label">alamat</label>
        <textarea name="alamat" class="form-control">{{ old('alamat', $tailor->alamat ?? '') }}</textarea>
        </div>
        <div class="mb-3">
        <label type="text"for="no_hp" class="form-label">no_hp</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $tailor->no_hp ?? '') }}" placeholder="Nomor HP">
        </div>
        <div class="mb-3">
        <label class="form-label">Spesialisasi:</label>
        <input type="text" class="form-control" name="skill" value="{{ old('skill', $tailor->skill ?? '') }}" placeholder="Skill">
        </div>
        <div class="mb-3">
        <label class="form-label">Deskripsi:</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $tailor->deskripsi ?? '') }}</textarea>
        </div>
        <div class="mb-3">
        <label for="photo" class="form-label">karya</label>
        <input type="file" name="photo" class="form-control" multiple>
        </div>
        <div class="mb-3">
        <label type="text" for="harga" class="form-label">harga</label>
        <input type="text" name="harga" class="form-control" value="{{ old('harga',$tailor->harga ?? '') }}" placeholder="harga">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection