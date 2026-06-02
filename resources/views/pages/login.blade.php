@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0 rounded-4 p-4 p-md-5 mt-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary-custom">Selamat Datang Kembali!</h3>
                    <p class="text-muted">Silakan masuk ke akun LesAja kamu.</p>
                </div>
                
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan email kamu" required>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Kata Sandi</label>
                            <a href="#" class="text-decoration-none small text-primary-custom">Lupa sandi?</a>
                        </div>
                        <input type="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    </div>
                    
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label text-muted small" for="rememberMe">Ingat saya di perangkat ini</label>
                    </div>
                    
                    <button type="button" class="btn btn-primary-custom w-100 py-2 fw-bold mb-3">Masuk</button>
                    
                    <div class="text-center mt-3">
                        <span class="text-muted small">Belum punya akun? <a href="{{ route('signup') }}" class="text-primary-custom text-decoration-none fw-semibold">Daftar di sini</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection