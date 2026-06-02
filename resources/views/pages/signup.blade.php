@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0 rounded-4 p-4 p-md-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary-custom">Daftar Akun Baru</h3>
                    <p class="text-muted">Bergabunglah untuk mencari tutor atau menjadi tutor.</p>
                </div>
                
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Kampus / Pribadi</label>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="Minimal 8 karakter">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Saya ingin mendaftar sebagai:</label>
                        <select class="form-select">
                            <option>Mahasiswa (Mencari Tutor)</option>
                            <option>Tutor (Asdos / Kakak Tingkat)</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary-custom w-100 py-2 fw-bold mb-3">Daftar Sekarang</button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Sudah punya akun? <a href="#" class="text-primary-custom text-decoration-none fw-semibold">Log in di sini</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection