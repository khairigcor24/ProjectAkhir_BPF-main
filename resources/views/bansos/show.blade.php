@extends('layouts/app', ['activePage' => 'bansos', 'title' => $bansos->nama_bantuan])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                @if($bansos->gambar)
                <img src="{{ asset('storage/' . $bansos->gambar) }}" class="card-img-top" alt="{{ $bansos->nama_bantuan }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $bansos->nama_bantuan }}</h1>
                    <p class="card-text">{{ $bansos->deskripsi }}</p>
                    <p><strong>Kuota:</strong> {{ $bansos->kuota }}</p>
                    <p><strong>Status:</strong> {{ $bansos->status }}</p>
                    <a href="{{ route('donasi.public') }}" class="btn btn-primary">Donasi Sekarang</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection