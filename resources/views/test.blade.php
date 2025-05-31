@extends('layouts.app')
@section('content')
    <h2>Profil Penjahit</h2>
    <p><strong>Nama:</strong> {{ $tailor->nama ??  "" }}</p>
    <p><strong>Alamat:</strong> {{ $tailor->alamat ?? "" }}</p>
    <p><strong>No HP:</strong> {{ $tailor->no_hp ?? ""}}</p>
    <p><strong>Spesialisasi:</strong> {{ $tailor->skill ?? "" }}</p>
    <p><strong>Deskripsi:</strong> {{ $tailor->deskripsi ?? "" }}</p>
@endsection