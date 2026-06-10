@extends('tutors.layouts.app')
@section('title', 'Langganan Premium')

@section('content')

{{-- Page heading --}}
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-ink flex items-center gap-2">
            Langganan Premium <i class="bi bi-patch-check-fill text-accent"></i>
        </h1>
        <p class="text-sm text-muted mt-0.5">Tingkatkan visibilitas dan dapatkan lebih banyak mahasiswa dengan fitur premium.</p>
    </div>
</div>

{{-- ═══ CURRENT STATUS ═════════════════════════════════════════════════════════ --}}
<div class="bg-white border border-border-ui rounded-lg p-5 mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
            <i class="bi bi-person text-slate-400 text-xl"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-muted uppercase tracking-wide">Status Saat Ini</p>
            <div class="flex items-center gap-2 mt-0.5">
                <h2 class="text-lg font-bold text-ink">Akun Basic</h2>
                <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-0.5 rounded border border-slate-200">Gratis</span>
            </div>
            <p class="text-sm text-muted mt-1">Upgrade ke premium untuk membuka semua fitur eksklusif tutor.</p>
        </div>
    </div>
    <div class="shrink-0 w-full md:w-auto">
        <button class="w-full md:w-auto bg-gold hover:bg-gold/90 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-sm flex items-center justify-center gap-2">
            <i class="bi bi-star-fill"></i> Upgrade Sekarang
        </button>
    </div>
</div>

{{-- ═══ PRICING PLANS ═════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    
    {{-- Basic Plan --}}
    <div class="bg-white border border-border-ui rounded-xl p-6 flex flex-col relative opacity-80">
        <div class="mb-5">
            <h3 class="text-lg font-bold text-ink">Basic</h3>
            <p class="text-sm text-muted mt-1">Cocok untuk tutor baru yang ingin memulai</p>
        </div>
        <div class="mb-6">
            <span class="text-3xl font-extrabold text-ink">Rp 0</span>
            <span class="text-muted"> / bulan</span>
        </div>
        <ul class="flex flex-col gap-3 flex-1 mb-6">
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-slate-300 mt-0.5"></i>
                <span>Listing profil standar</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-slate-300 mt-0.5"></i>
                <span>Maksimal 5 jadwal kelas aktif</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-slate-300 mt-0.5"></i>
                <span>Potongan platform 15%</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-slate-400">
                <i class="bi bi-x-circle text-slate-200 mt-0.5"></i>
                <span>Tidak ada badge prioritas</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-slate-400">
                <i class="bi bi-x-circle text-slate-200 mt-0.5"></i>
                <span>Analitik dasar</span>
            </li>
        </ul>
        <button class="w-full bg-slate-100 text-slate-400 text-sm font-semibold px-4 py-2.5 rounded-lg cursor-not-allowed">
            Paket Saat Ini
        </button>
    </div>

    {{-- Premium Plan --}}
    <div class="bg-gradient-to-b from-white to-gold/5 border-2 border-gold rounded-xl p-6 flex flex-col relative shadow-md">
        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gold text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">
            Paling Populer
        </div>
        <div class="mb-5">
            <h3 class="text-lg font-bold text-ink flex items-center gap-2">Premium <i class="bi bi-star-fill text-gold text-sm"></i></h3>
            <p class="text-sm text-muted mt-1">Maksimalkan potensimu dan jangkau lebih banyak mahasiswa</p>
        </div>
        <div class="mb-6">
            <span class="text-3xl font-extrabold text-ink">Rp 49.000</span>
            <span class="text-muted"> / bulan</span>
        </div>
        <ul class="flex flex-col gap-3 flex-1 mb-6">
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-gold mt-0.5"></i>
                <span class="font-medium">Listing prioritas di hasil pencarian</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-gold mt-0.5"></i>
                <span class="font-medium">Jadwal kelas tanpa batas</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-gold mt-0.5"></i>
                <span class="font-medium">Potongan platform hanya 5%</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-gold mt-0.5"></i>
                <span class="font-medium">Badge Premium di profil</span>
            </li>
            <li class="flex items-start gap-2.5 text-sm text-ink">
                <i class="bi bi-check-circle-fill text-gold mt-0.5"></i>
                <span class="font-medium">Akses analitik mendalam & insight</span>
            </li>
        </ul>
        <button class="w-full bg-gold hover:bg-gold/90 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition shadow-sm">
            Pilih Premium
        </button>
    </div>
</div>

{{-- ═══ FAQ ═════════════════════════════════════════════════════════ --}}
<div class="bg-white border border-border-ui rounded-lg p-5">
    <h3 class="text-sm font-bold text-ink mb-4">Pertanyaan yang Sering Diajukan</h3>
    <div class="space-y-4">
        <div class="border-b border-border-ui pb-4 last:border-0 last:pb-0">
            <h4 class="text-sm font-semibold text-ink mb-1">Bagaimana cara pembayaran langganan premium?</h4>
            <p class="text-xs text-muted leading-relaxed">Pembayaran dapat dilakukan melalui transfer bank, e-wallet (GoPay, OVO, Dana), atau akan langsung dipotong dari saldo pendapatan tutor Anda jika mencukupi.</p>
        </div>
        <div class="border-b border-border-ui pb-4 last:border-0 last:pb-0">
            <h4 class="text-sm font-semibold text-ink mb-1">Apakah saya bisa membatalkan langganan kapan saja?</h4>
            <p class="text-xs text-muted leading-relaxed">Tentu saja. Anda dapat membatalkan perpanjangan otomatis kapan saja melalui halaman pengaturan akun. Status premium Anda akan tetap aktif hingga akhir periode penagihan berjalan.</p>
        </div>
    </div>
</div>

@endsection
