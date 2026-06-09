@extends('student.layouts.app')
@section('title', 'Riwayat Belajar')
@section('meta_description', 'Riwayat sesi belajar mahasiswa di platform tutor Tutorium.')

@section('content')

{{-- ── Page Heading ──────────────────────────────────────────────────────────── --}}
<div class="mb-6">
    <h1 class="text-xl font-bold" style="color:#283044;">Riwayat Belajar</h1>
    <p class="text-sm mt-0.5" style="color:#64748b;">Semua sesi belajar yang telah kamu selesaikan bersama tutor.</p>
</div>

{{-- ── Summary Strip ────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['bi-check2-all',     '24',   'Sesi Selesai',    '#4D81EE', '#EEF4FF', '#c0d3f0'],
        ['bi-clock-history',  '68',   'Jam Belajar',     '#283044', '#e8eef7', '#b0c4df'],
        ['bi-cash-coin',      '3.2jt','Total Spent',     '#22c55e', '#f0fdf4', '#bbf7d0'],
        ['bi-star-fill',      '4.8',  'Avg. Rating',     '#f59e0b', '#fffbeb', '#fde68a'],
    ] as [$ic, $val, $lbl, $clr, $bg, $bd])
    <div class="rounded-xl p-4 text-center lift" style="background:#fff; border:1.5px solid {{ $bd }}; box-shadow:0 2px 12px rgba(59,91,138,.08);">
        <div class="w-9 h-9 rounded-xl mx-auto mb-2 flex items-center justify-center" style="background:{{ $clr }};">
            <i class="bi {{ $ic }} text-white text-sm"></i>
        </div>
        <p class="text-xl font-extrabold" style="color:#283044;">{{ $val }}</p>
        <p class="text-[11px] font-semibold mt-0.5" style="color:#64748b;">{{ $lbl }}</p>
    </div>
    @endforeach
</div>

{{-- ── History Table Card ───────────────────────────────────────────────────── --}}
@php
$sessions = [
    [
        'tutor'    => 'Budi Santoso',
        'topik'    => 'Laravel Advanced — Relasi & Eloquent ORM',
        'matkul'   => 'Web Development',
        'tanggal'  => 'Rabu, 4 Jun 2026',
        'jam'      => '14:00 – 16:00 WIB',
        'durasi'   => '2 Jam',
        'harga'    => 130000,
        'metode'   => 'Online',
        'status'   => 'Selesai',
        'rated'    => true,
        'rating'   => 5,
    ],
    [
        'tutor'    => 'Sari Dewi',
        'topik'    => 'Normalisasi Basis Data & Query Kompleks',
        'matkul'   => 'Basis Data MySQL',
        'tanggal'  => 'Jumat, 30 Mei 2026',
        'jam'      => '09:00 – 11:00 WIB',
        'durasi'   => '2 Jam',
        'harga'    => 110000,
        'metode'   => 'Online',
        'status'   => 'Selesai',
        'rated'    => true,
        'rating'   => 5,
    ],
    [
        'tutor'    => 'Reza Mahendra',
        'topik'    => 'Sorting Algorithms & Complexity Analysis',
        'matkul'   => 'Algoritma & Pemrograman',
        'tanggal'  => 'Selasa, 20 Mei 2026',
        'jam'      => '15:00 – 16:30 WIB',
        'durasi'   => '1.5 Jam',
        'harga'    => 85000,
        'metode'   => 'Offline',
        'status'   => 'Selesai',
        'rated'    => false,
        'rating'   => 0,
    ],
    [
        'tutor'    => 'Budi Santoso',
        'topik'    => 'Figma Wireframing & Prototyping Dasar',
        'matkul'   => 'UI/UX Design',
        'tanggal'  => 'Sabtu, 10 Mei 2026',
        'jam'      => '10:00 – 12:00 WIB',
        'durasi'   => '2 Jam',
        'harga'    => 130000,
        'metode'   => 'Online',
        'status'   => 'Dibatalkan',
        'rated'    => false,
        'rating'   => 0,
    ],
];
@endphp

<div class="rounded-2xl overflow-hidden" style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 6px 32px rgba(59,91,138,.10);">

    {{-- Table Header --}}
    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid #dce9f5;">
        <div>
            <h2 class="text-sm font-bold" style="color:#283044;">Daftar Sesi Belajar</h2>
            <p class="text-xs mt-0.5" style="color:#64748b;">{{ count($sessions) }} sesi tercatat</p>
        </div>
        <button onclick="sToast('Filter sedang dikembangkan', 'info')"
                class="flex items-center gap-1.5 text-xs font-semibold px-3 py-2 rounded-lg transition"
                style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;"
                onmouseover="this.style.background='#4D81EE';this.style.color='#fff';"
                onmouseout="this.style.background='#EEF4FF';this.style.color='#4D81EE';">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    {{-- Desktop Table --}}
    <div class="overflow-x-auto hidden sm:block">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-[11px] font-semibold uppercase tracking-widest"
                    style="background:#f0f7ff; color:#64748b; border-bottom:1px solid #dce9f5;">
                    <th class="px-5 py-3.5 text-left">Tutor</th>
                    <th class="px-5 py-3.5 text-left">Topik / Mata Kuliah</th>
                    <th class="px-5 py-3.5 text-left">Tanggal & Jam</th>
                    <th class="px-5 py-3.5 text-left">Durasi</th>
                    <th class="px-5 py-3.5 text-left">Harga</th>
                    <th class="px-5 py-3.5 text-left">Status</th>
                    <th class="px-5 py-3.5 text-left">Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $s)
                <tr class="transition-colors" style="border-bottom:1px solid #dce9f5;"
                    onmouseover="this.style.background='#f7fbff'" onmouseout="this.style.background='transparent'">

                    {{-- Tutor --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2.5">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($s['tutor']) }}&size=36&background=334060&color=7ba7f5"
                                 class="w-8 h-8 rounded-lg shrink-0" alt="{{ $s['tutor'] }}">
                            <span class="font-semibold text-sm" style="color:#283044;">{{ $s['tutor'] }}</span>
                        </div>
                    </td>

                    {{-- Topik --}}
                    <td class="px-5 py-4">
                        <p class="font-semibold text-sm leading-snug" style="color:#283044;">{{ $s['topik'] }}</p>
                        <p class="text-xs mt-0.5" style="color:#64748b;">{{ $s['matkul'] }}</p>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-5 py-4">
                        <p class="font-semibold text-sm" style="color:#283044;">{{ $s['tanggal'] }}</p>
                        <p class="text-xs mt-0.5" style="color:#64748b;">{{ $s['jam'] }}</p>
                    </td>

                    {{-- Durasi --}}
                    <td class="px-5 py-4">
                        <span class="text-sm font-semibold" style="color:#283044;">{{ $s['durasi'] }}</span>
                    </td>

                    {{-- Harga --}}
                    <td class="px-5 py-4">
                        <span class="text-sm font-semibold" style="color:#283044;">
                            Rp{{ number_format($s['harga'], 0, ',', '.') }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-4">
                        @if($s['status'] === 'Selesai')
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-3 py-1.5 rounded-full"
                                  style="background:rgba(77,129,238,.12); color:#4D81EE; border:1px solid rgba(77,129,238,.3);">
                                <i class="bi bi-check-circle-fill text-[9px]"></i> Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-3 py-1.5 rounded-full"
                                  style="background:#fef2f2; color:#ef4444; border:1px solid #fecaca;">
                                <i class="bi bi-x-circle-fill text-[9px]"></i> Dibatalkan
                            </span>
                        @endif
                    </td>

                    {{-- Rating --}}
                    <td class="px-5 py-4">
                        @if($s['rated'])
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $s['rating'] ? '-fill' : '' }} text-xs star-{{ $i <= $s['rating'] ? 'filled' : 'empty' }}"></i>
                                @endfor
                            </div>
                        @elseif($s['status'] === 'Selesai')
                            <button onclick="sToast('Arahkan ke halaman Rating untuk memberi ulasan!', 'info')"
                                    class="text-[11px] font-bold px-2.5 py-1 rounded-lg transition"
                                    style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">
                                + Beri Rating
                            </button>
                        @else
                            <span class="text-xs" style="color:#94a3b8;">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards (visible on xs only) --}}
    <div class="sm:hidden divide-y" style="border-color:#dce9f5;">
        @foreach($sessions as $s)
        <div class="p-4 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($s['tutor']) }}&size=36&background=334060&color=7ba7f5"
                         class="w-8 h-8 rounded-lg" alt="">
                    <div>
                        <p class="font-bold text-sm" style="color:#283044;">{{ $s['tutor'] }}</p>
                        <p class="text-xs" style="color:#64748b;">{{ $s['matkul'] }}</p>
                    </div>
                </div>
                @if($s['status'] === 'Selesai')
                    <span class="text-[10px] font-bold px-2 py-1 rounded-full"
                          style="background:rgba(77,129,238,.12); color:#4D81EE; border:1px solid rgba(77,129,238,.3);">Selesai</span>
                @else
                    <span class="text-[10px] font-bold px-2 py-1 rounded-full"
                          style="background:#fef2f2; color:#ef4444; border:1px solid #fecaca;">Dibatalkan</span>
                @endif
            </div>
            <p class="text-sm font-semibold leading-snug" style="color:#283044;">{{ $s['topik'] }}</p>
            <div class="flex flex-wrap gap-3 text-xs" style="color:#64748b;">
                <span><i class="bi bi-calendar3 mr-1"></i>{{ $s['tanggal'] }}</span>
                <span><i class="bi bi-clock mr-1"></i>{{ $s['durasi'] }}</span>
                <span><i class="bi bi-cash mr-1"></i>Rp{{ number_format($s['harga'],0,',','.') }}</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination hint --}}
    <div class="px-5 py-3.5 flex items-center justify-between" style="border-top:1px solid #dce9f5; background:#f7fbff;">
        <p class="text-xs" style="color:#64748b;">Menampilkan {{ count($sessions) }} dari 24 sesi</p>
        <div class="flex gap-1.5">
            <button class="text-xs font-semibold px-3 py-1.5 rounded-lg" style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">&lt;</button>
            <button class="text-xs font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#4D81EE;">1</button>
            <button class="text-xs font-semibold px-3 py-1.5 rounded-lg" style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">2</button>
            <button class="text-xs font-semibold px-3 py-1.5 rounded-lg" style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">&gt;</button>
        </div>
    </div>
</div>

@endsection
