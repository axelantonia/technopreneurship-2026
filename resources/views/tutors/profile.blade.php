@extends('tutors.layouts.app')
@section('title', 'Profil Tutor')

@section('content')

{{-- Page heading --}}
<div class="mb-6">
    <h1 class="text-xl font-bold text-ink">Profil Saya</h1>
    <p class="text-sm text-muted mt-0.5">Kelola informasi pribadi dan pengaturan akunmu.</p>
</div>

{{-- ═══ PROFILE FORM ════════════════════════════════════════════════════════ --}}
<div class="bg-white border border-border-ui rounded-lg">
    <div class="p-5 border-b border-border-ui flex items-center gap-4">
        <div class="relative">
            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&size=80&background=e2e8f0&color=1e293b" class="w-20 h-20 rounded-full border-4 border-white shadow-sm" alt="Avatar">
            <button class="absolute bottom-0 right-0 w-7 h-7 bg-white border border-border-ui rounded-full flex items-center justify-center text-muted hover:text-accent transition shadow-sm" title="Ubah Foto">
                <i class="bi bi-camera-fill text-xs"></i>
            </button>
        </div>
        <div>
            <h2 class="text-lg font-bold text-ink flex items-center gap-2">Budi Santoso <i class="bi bi-patch-check-fill text-gold" title="Akun Premium"></i></h2>
            <p class="text-sm text-muted">Tutor Web Development</p>
        </div>
    </div>
    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-semibold text-muted uppercase tracking-wide mb-1.5">Nama Lengkap</label>
            <input type="text" value="Budi Santoso" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-muted uppercase tracking-wide mb-1.5">Email</label>
            <input type="email" value="budi@example.com" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-muted uppercase tracking-wide mb-1.5">Keahlian (Mata Kuliah)</label>
            <input type="text" value="Laravel, React, Tailwind CSS" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-muted uppercase tracking-wide mb-1.5">Nomor Telepon</label>
            <input type="tel" value="081234567890" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition">
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-muted uppercase tracking-wide mb-1.5">Bio Singkat</label>
            <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition">Saya adalah seorang Full-Stack Developer dengan pengalaman lebih dari 4 tahun. Saya senang berbagi ilmu dan membantu mahasiswa menguasai teknologi terkini.</textarea>
        </div>
    </div>
    <div class="p-5 border-t border-border-ui bg-slate-50 flex justify-end">
        <button class="bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition shadow-sm">
            Simpan Perubahan
        </button>
    </div>
</div>

@endsection
