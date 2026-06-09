@extends('student.layouts.app')
@section('title', 'Profil Mahasiswa')
@section('meta_description', 'Halaman profil mahasiswa di platform tutor Tutorium.')

@section('content')

{{-- ── Page Heading ──────────────────────────────────────────────────────────── --}}
<div class="mb-6">
    <h1 class="text-xl font-bold" style="color:#283044;">Profil Mahasiswa</h1>
    <p class="text-sm mt-0.5" style="color:#64748b;">Informasi lengkap akun belajarmu di Tutorium.</p>
</div>

{{-- ── Main Profile Card ──────────────────────────────────────────────────────── --}}
<div class="lift rounded-2xl p-7 mb-6" style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.10);">

    {{-- Top: avatar + info + badge --}}
    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 mb-8">

        {{-- Avatar --}}
        <div class="relative shrink-0">
            <div class="w-28 h-28 rounded-2xl overflow-hidden ring-4" style="ring-color:#D0E2F2; box-shadow:0 0 0 4px #D0E2F2, 0 0 0 6px #4D81EE;">
                <img src="https://ui-avatars.com/api/?name=Jeremy+Axel+Susanto&background=334060&color=7ba7f5&size=200&bold=true"
                     class="w-full h-full object-cover" alt="Avatar Jeremy">
            </div>
            {{-- Online dot --}}
            <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white"
                  style="background:#22c55e;"></span>
        </div>

        {{-- Info --}}
        <div class="flex-1 text-center sm:text-left">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                <h2 class="text-2xl font-extrabold" style="color:#283044;">Jeremy Axel Susanto</h2>
                {{-- Status Badge --}}
                <span class="badge-active inline-flex items-center gap-1.5 text-white text-[11px] font-extrabold px-3 py-1.5 rounded-full tracking-wide shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-white opacity-80 inline-block"></span>
                    Status Aktif
                </span>
            </div>
            <p class="font-semibold text-sm mb-0.5" style="color:#4D81EE;">Teknik Informatika · Angkatan 2023</p>
            <p class="text-sm" style="color:#64748b;">
                <i class="bi bi-building mr-1"></i>Universitas Kristen Petra, Surabaya
            </p>
            <p class="text-sm mt-0.5" style="color:#64748b;">
                <i class="bi bi-envelope mr-1"></i>jeremy.axel23@student.ukpetramk.ac.id
            </p>

            {{-- Quick badges --}}
            <div class="flex flex-wrap gap-2 mt-3 justify-center sm:justify-start">
                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg" style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">
                    <i class="bi bi-mortarboard mr-1"></i>Semester 5
                </span>
                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg" style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">
                    <i class="bi bi-geo-alt mr-1"></i>Surabaya
                </span>
                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg" style="background:#f0fdf4; color:#16a34a; border:1px solid #bbf7d0;">
                    <i class="bi bi-patch-check mr-1"></i>Terverifikasi
                </span>
            </div>
        </div>

        {{-- Edit button --}}
        <div class="shrink-0">
            <button onclick="sToast('Fitur edit profil segera hadir!', 'info')"
                    class="flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl transition"
                    style="background:#EEF4FF; color:#4D81EE; border:1.5px solid #c0d3f0;"
                    onmouseover="this.style.background='#4D81EE';this.style.color='#fff';"
                    onmouseout="this.style.background='#EEF4FF';this.style.color='#4D81EE';">
                <i class="bi bi-pencil-square"></i> Edit Profil
            </button>
        </div>
    </div>

    {{-- Divider --}}
    <div class="my-6 h-px" style="background:linear-gradient(90deg,transparent,#3B5B8A,transparent);opacity:.25;"></div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

        {{-- Mata Kuliah --}}
        <div class="rounded-xl p-4 text-center lift" style="background:#EEF4FF; border:1px solid #c0d3f0;">
            <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center"
                 style="background:#4D81EE;">
                <i class="bi bi-journal-text text-white text-base"></i>
            </div>
            <p class="text-2xl font-extrabold" style="color:#283044;">12</p>
            <p class="text-[11px] font-semibold mt-0.5" style="color:#64748b;">Mata Kuliah Dikuasai</p>
        </div>

        {{-- Total Jam --}}
        <div class="rounded-xl p-4 text-center lift" style="background:#EEF4FF; border:1px solid #c0d3f0;">
            <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center"
                 style="background:#4D81EE;">
                <i class="bi bi-clock-history text-white text-base"></i>
            </div>
            <p class="text-2xl font-extrabold" style="color:#283044;">68</p>
            <p class="text-[11px] font-semibold mt-0.5" style="color:#64748b;">Total Jam Belajar</p>
        </div>

        {{-- Sesi Selesai --}}
        <div class="rounded-xl p-4 text-center lift" style="background:#f0fdf4; border:1px solid #bbf7d0;">
            <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center"
                 style="background:#22c55e;">
                <i class="bi bi-check2-all text-white text-base"></i>
            </div>
            <p class="text-2xl font-extrabold" style="color:#283044;">24</p>
            <p class="text-[11px] font-semibold mt-0.5" style="color:#64748b;">Sesi Selesai</p>
        </div>

        {{-- Rating Rata-rata --}}
        <div class="rounded-xl p-4 text-center lift" style="background:#fffbeb; border:1px solid #fde68a;">
            <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center"
                 style="background:#f59e0b;">
                <i class="bi bi-star-fill text-white text-base"></i>
            </div>
            <p class="text-2xl font-extrabold" style="color:#283044;">4.8</p>
            <p class="text-[11px] font-semibold mt-0.5" style="color:#64748b;">Rating Diberikan</p>
        </div>
    </div>
</div>

{{-- ── Two-Column Detail Grid ──────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Mata Kuliah yang Dikuasai --}}
    <div class="rounded-2xl p-6" style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.08);">
        <div class="flex items-center gap-2 mb-5">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#4D81EE;">
                <i class="bi bi-journal-bookmark-fill text-white text-sm"></i>
            </div>
            <h3 class="font-bold text-sm" style="color:#283044;">Mata Kuliah yang Dikuasai</h3>
        </div>

        @php
        $courses = [
            ['name' => 'Algoritma & Pemrograman',  'level' => 'Mahir',      'pct' => 92],
            ['name' => 'Basis Data MySQL',          'level' => 'Mahir',      'pct' => 88],
            ['name' => 'Web Development (Laravel)', 'level' => 'Menengah',   'pct' => 74],
            ['name' => 'Struktur Data',             'level' => 'Menengah',   'pct' => 70],
            ['name' => 'UI/UX Design',              'level' => 'Pemula',     'pct' => 55],
            ['name' => 'Machine Learning Dasar',    'level' => 'Pemula',     'pct' => 42],
        ];
        $levelColor = ['Mahir' => ['#4D81EE','#EEF4FF','#c0d3f0'], 'Menengah' => ['#22c55e','#f0fdf4','#bbf7d0'], 'Pemula' => ['#f59e0b','#fffbeb','#fde68a']];
        @endphp

        <div class="space-y-3.5">
            @foreach($courses as $c)
            @php [$clr,$bg,$bd] = $levelColor[$c['level']]; @endphp
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-sm font-semibold" style="color:#283044;">{{ $c['name'] }}</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full"
                          style="background:{{ $bg }}; color:{{ $clr }}; border:1px solid {{ $bd }};">{{ $c['level'] }}</span>
                </div>
                <div class="w-full rounded-full h-1.5" style="background:#e2eefc;">
                    <div class="h-1.5 rounded-full transition-all" style="width:{{ $c['pct'] }}%; background:{{ $clr }};"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Informasi Tambahan + Aktivitas --}}
    <div class="space-y-5">

        {{-- Info Card --}}
        <div class="rounded-2xl p-6" style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.08);">
            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#283044;">
                    <i class="bi bi-person-lines-fill text-white text-sm"></i>
                </div>
                <h3 class="font-bold text-sm" style="color:#283044;">Informasi Akademik</h3>
            </div>
            <dl class="space-y-3 text-sm">
                @foreach([
                    ['bi-hash',          'NIM',          '22416255201001'],
                    ['bi-book-half',     'Jurusan',      'Teknik Informatika'],
                    ['bi-building',      'Universitas',  'Universitas Kristen Petra'],
                    ['bi-calendar3',     'Angkatan',     '2023'],
                    ['bi-layers',        'Semester',     '5 (Ganjil 2025/2026)'],
                    ['bi-bar-chart-line','IPK Kumulatif','3.87 / 4.00'],
                ] as [$ic, $label, $val])
                <div class="flex items-start gap-3">
                    <i class="bi {{ $ic }} text-sm shrink-0 mt-0.5" style="color:#4D81EE;"></i>
                    <span class="font-semibold shrink-0 w-32" style="color:#64748b;">{{ $label }}</span>
                    <span class="font-semibold" style="color:#283044;">{{ $val }}</span>
                </div>
                @endforeach
            </dl>
        </div>

        {{-- Target Belajar --}}
        <div class="rounded-2xl p-6" style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.08);">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#4D81EE;">
                    <i class="bi bi-bullseye text-white text-sm"></i>
                </div>
                <h3 class="font-bold text-sm" style="color:#283044;">Target Belajar Bulan Ini</h3>
            </div>
            <div class="space-y-2">
                @foreach([
                    ['Jam Belajar', 68, 100, '#4D81EE'],
                    ['Sesi Selesai', 24, 30, '#22c55e'],
                    ['Mata Kuliah Baru', 3, 5, '#f59e0b'],
                ] as [$label, $cur, $max, $color])
                <div>
                    <div class="flex justify-between text-xs mb-1" style="color:#64748b;">
                        <span class="font-semibold">{{ $label }}</span>
                        <span>{{ $cur }} / {{ $max }}</span>
                    </div>
                    <div class="w-full rounded-full h-2" style="background:#e2eefc;">
                        <div class="h-2 rounded-full" style="width:{{ round($cur/$max*100) }}%; background:{{ $color }};"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
