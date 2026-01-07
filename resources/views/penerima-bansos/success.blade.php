@extends('layouts.public', ['title' => 'Pendaftaran Berhasil'])

@section('content')
<div class="full-page section-image" data-color="black" style="padding-top: 100px; min-height: 100vh;">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center bg-success text-white">
                            <i class="fa fa-check-circle fa-3x mb-2"></i>
                            <h3 class="mb-0">Pendaftaran Berhasil!</h3>
                        </div>
                        <div class="card-body text-center">
                            <p class="lead">Terima kasih telah mendaftar sebagai penerima bansos.</p>
                            <p>Pendaftaran Anda sedang dalam proses verifikasi. Tim kami akan menghubungi Anda melalui kontak yang telah Anda berikan.</p>
                            
                            <div class="alert alert-info mt-4">
                                <h5><i class="fa fa-info-circle"></i> Informasi Penting:</h5>
                                <ul class="text-left" style="display: inline-block;">
                                    <li>Status pendaftaran Anda akan diupdate melalui email atau telepon</li>
                                    <li>Pastikan data yang Anda berikan sudah benar</li>
                                    <li>Simpan nomor pendaftaran untuk tracking</li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <a href="/" class="btn btn-primary">
                                    <i class="fa fa-home"></i> Kembali ke Beranda
                                </a>
                                <a href="{{ route('guest.program-bansos.index') }}" class="btn btn-info">
                                    <i class="fa fa-list"></i> Lihat Program Lainnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


