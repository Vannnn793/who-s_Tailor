@extends('layouts.tailor')
@section('content')
<div class="container">
    <h2>Edit Profil</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
        @csrf
        <label type="text" for="pp">pp</label>
        <input type="file" name="pp"> 
        <label type="text" for="name">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $tailor->nama ?? '') }}" placeholder="Nama">
        <label type="text" for="umur">umur</label>
        <input type="text" name="umur" value="{{ old('umur',$tailor->umur ?? '') }}" placeholder="umur">
        <label type="text"for="alamat">alamat</label>
        <textarea name="alamat">{{ old('alamat', $tailor->alamat ?? '') }}</textarea>
        <label type="text"for="no_hp">no_hp</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $tailor->no_hp ?? '') }}" placeholder="Nomor HP">
       
        <label>Spesialisasi:</label>
        <input type="text" name="skill" value="{{ old('skill', $tailor->skill ?? '') }}" placeholder="Skill">

         <label>Deskripsi:</label>
          <textarea name="deskripsi">{{ old('deskripsi', $tailor->deskripsi ?? '') }}</textarea>
        <input type="file" name="photo" multiple>
        <label type="text" for="harga">harga</label>
        <input type="text" name="harga" value="{{ old('harga',$tailor->harga ?? '') }}" placeholder="harga">
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection