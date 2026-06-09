@extends('tutors.layouts.app')

@section('content')

@php $page = request()->query('page', 'dashboard'); @endphp

{{-- ── Route ke sub-halaman ────────────────────────────────────────────── --}}
@if($page === 'packages')
    @include('tutors.packages')
@elseif($page === 'reviews')
    @include('tutors.reviews')
@else

{{-- ══════════════════════════════════════════════════════════════════════
     HALAMAN UTAMA DASHBOARD
══════════════════════════════════════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    {{-- ── Greeting + PRO badge ── --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-dark flex items-center gap-3">
                Halo, Kak Budi! 👋
                <span class="pro-badge inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold text-white shadow-md">
                    <i class="bi bi-gem"></i> PRO
                </span>
            </h1>
            <p class="text-gray-500 mt-1 text-sm">Selamat datang di ruang mengajarmu. Mari buat dampak positif hari ini!</p>
        </div>
        <a href="/tutors/dashboard?page=packages"
           class="btn-primary-custom inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm shadow-md hover:opacity-90 transition-all">
            <i class="bi bi-plus-lg"></i> Buat Paket Baru
        </a>
    </div>

    {{-- ── PRO Banner ── --}}
    <div class="relative overflow-hidden rounded-3xl p-6 md:p-8 shadow-lg"
         style="background: linear-gradient(135deg, #1e3a5f 0%, #2d5da6 50%, #4D81EE 100%);">
        {{-- Decorative circles --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full opacity-10 bg-white"></div>
        <div class="absolute -bottom-8 -left-8 w-36 h-36 rounded-full opacity-10 bg-white"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="pro-badge inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-extrabold text-white">
                        <i class="bi bi-gem"></i> Tutorium PRO
                    </span>
                    <span class="text-white/70 text-xs font-medium">Aktif hingga Des 2026</span>
                </div>
                <h2 class="text-white font-extrabold text-xl mb-2">Akun Kamu Sudah Premium! 🎉</h2>
                <p class="text-white/80 text-sm leading-relaxed max-w-lg">
                    Profil kamu <strong class="text-white">diprioritaskan</strong> di halaman utama pencarian mahasiswa.
                    Kamu juga mendapatkan akses analitik, badge verifikasi emas, dan tampilan profil eksklusif.
                </p>
                <div class="mt-4 flex flex-wrap gap-3">
                    <span class="inline-flex items-center gap-1.5 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-xl">
                        <i class="bi bi-rocket-takeoff"></i> Profil Diprioritaskan
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-xl">
                        <i class="bi bi-bar-chart-line"></i> Analitik Lanjutan
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-xl">
                        <i class="bi bi-shield-check"></i> Badge Emas Terverifikasi
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-xl">
                        <i class="bi bi-chat-dots"></i> Prioritas Support
                    </span>
                </div>
            </div>
            <div class="text-center flex-shrink-0">
                <div class="w-20 h-20 rounded-full bg-white/15 border-2 border-white/30 flex items-center justify-center mx-auto mb-2">
                    <i class="bi bi-gem text-4xl text-yellow-300"></i>
                </div>
                <p class="text-white/70 text-xs">Status: <span class="text-yellow-300 font-bold">PREMIUM</span></p>
            </div>
        </div>
    </div>

    {{-- ── Stats cards ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-primary flex-shrink-0">
                <i class="bi bi-people-fill text-2xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Murid Belajar</p>
                <h3 class="text-2xl font-extrabold text-dark">24 <span class="text-sm font-normal text-gray-400">Mahasiswa</span></h3>
            </div>
        </div>
        <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-primary flex-shrink-0">
                <i class="bi bi-clock-fill text-2xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Jam Mengajar</p>
                <h3 class="text-2xl font-extrabold text-dark">48 <span class="text-sm font-normal text-gray-400">Jam</span></h3>
            </div>
        </div>
        <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-primary flex-shrink-0">
                <i class="bi bi-wallet2 text-2xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Estimasi Pendapatan</p>
                <h3 class="text-2xl font-extrabold text-dark">Rp 1.250k</h3>
            </div>
        </div>
    </div>

    {{-- ── Jadwal Terdekat ── --}}
    <div class="bg-white border border-secondary rounded-3xl p-6 md:p-8 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-dark">Jadwal Terdekat</h2>
            <span class="text-xs text-gray-400 bg-surface border border-secondary px-3 py-1 rounded-full font-semibold">Minggu ini</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
                ['name'=>'Livi', 'matkul'=>'Web Development (Laravel)', 'jadwal'=>'Rabu, 16:00 WIB (Besok)', 'status'=>'Menunggu Kelas', 'color'=>'yellow'],
                ['name'=>'Ivy',  'matkul'=>'Data & Statistics (R)',     'jadwal'=>'Jumat, 10:00 WIB',        'status'=>'Menunggu Kelas', 'color'=>'yellow'],
                ['name'=>'Andi', 'matkul'=>'Struktur Data',              'jadwal'=>'Sabtu, 09:00 WIB',        'status'=>'Dikonfirmasi',   'color'=>'green'],
                ['name'=>'Reza', 'matkul'=>'Basis Data MySQL',           'jadwal'=>'Sabtu, 13:00 WIB',        'status'=>'Dikonfirmasi',   'color'=>'green'],
            ] as $s)
            <div class="bg-surface border border-secondary rounded-2xl p-5 flex flex-col gap-4">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-3">
                        <img class="w-10 h-10 rounded-full object-cover border border-secondary"
                             src="https://ui-avatars.com/api/?name={{ $s['name'] }}&background=random" alt="{{ $s['name'] }}">
                        <div>
                            <h4 class="font-bold text-dark text-sm">{{ $s['name'] }}</h4>
                            <p class="text-xs text-gray-500">{{ $s['matkul'] }}</p>
                        </div>
                    </div>
                    @if($s['color'] === 'green')
                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full border border-green-200">{{ $s['status'] }}</span>
                    @else
                        <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded-full border border-yellow-200">{{ $s['status'] }}</span>
                    @endif
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-dark bg-white p-3 rounded-xl border border-secondary">
                    <i class="bi bi-calendar2-check text-primary"></i>
                    {{ $s['jadwal'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ── Quick links ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <a href="/tutors/dashboard?page=packages"
           class="bg-white border border-secondary hover:border-primary rounded-3xl p-6 shadow-sm flex items-center gap-5 group transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all flex-shrink-0">
                <i class="bi bi-box-seam text-2xl"></i>
            </div>
            <div>
                <h3 class="font-bold text-dark text-sm">Kelola Paket Kursus</h3>
                <p class="text-xs text-gray-500 mt-0.5">Lihat dan buat paket harga kamu</p>
            </div>
            <i class="bi bi-chevron-right ml-auto text-gray-400 group-hover:text-primary transition-colors"></i>
        </a>
        <a href="/tutors/dashboard?page=reviews"
           class="bg-white border border-secondary hover:border-primary rounded-3xl p-6 shadow-sm flex items-center gap-5 group transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all flex-shrink-0">
                <i class="bi bi-star text-2xl"></i>
            </div>
            <div>
                <h3 class="font-bold text-dark text-sm">Ulasan dari Murid</h3>
                <p class="text-xs text-gray-500 mt-0.5">18 ulasan • Rating 4.9 ⭐</p>
            </div>
            <i class="bi bi-chevron-right ml-auto text-gray-400 group-hover:text-primary transition-colors"></i>
        </a>
    </div>

</div>

@endif
@endsection
