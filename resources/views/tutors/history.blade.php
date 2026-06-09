@extends('tutors.layouts.app')
@section('title', 'Riwayat Mengajar')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-ink">Riwayat Mengajar</h1>
    <p class="text-sm text-muted mt-0.5">Pantau pendapatan, detail sesi, dan riwayat mengajar kamu sebelumnya.</p>
</div>

{{-- ── Filter Section ────────────────────────────────────────────────────── --}}
<div class="bg-white border border-border-ui rounded-lg p-5 mb-6">
    <h2 class="text-xs font-semibold text-muted uppercase tracking-widest mb-4">
        <i class="bi bi-funnel text-accent mr-1.5"></i>Filter Riwayat
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Filter berdasarkan Bulan</label>
            <select id="filter-month" 
                    class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                <option value="">Semua Bulan</option>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Filter berdasarkan Status</label>
            <select id="filter-status" 
                    class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                <option value="">Semua Status</option>
                <option value="Selesai">Selesai</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
        </div>

        <div class="flex items-end">
            <button onclick="applyFilter()" 
                    class="w-full sm:w-auto bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-2.5 rounded-md transition shadow-sm">
                Terapkan Filter
            </button>
        </div>
    </div>
</div>

{{-- ── Data Preparation ──────────────────────────────────────────────────── --}}
@php
    $riwayatTutor = [
        [
            'datetime' => '2026-05-18 14:00',
            'student' => ['name' => 'Alya Ramadhani'],
            'course' => 'UI/UX Design',
            'package' => 'Sesi Kilat UTS',
            'income' => 210000,
            'status' => 'Selesai',
        ],
        [
            'datetime' => '2026-06-02 16:00',
            'student' => ['name' => 'Bagas Pratama'],
            'course' => 'Laravel Web',
            'package' => 'Paket Intensif',
            'income' => 250000,
            'status' => 'Dibatalkan',
        ],
        [
            'datetime' => '2026-04-10 10:00',
            'student' => ['name' => 'Citra Lestari'],
            'course' => 'Fundamental Programming',
            'package' => 'Paket Intensif',
            'income' => 140000,
            'status' => 'Selesai',
        ],
    ];

    $daftarBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp

{{-- ── Tabel Riwayat ─────────────────────────────────────────────────────── --}}
<div class="bg-white border border-border-ui rounded-lg overflow-hidden">
    <div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">
        <h2 class="text-sm font-semibold text-ink">Daftar Riwayat Mengajar</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-border-ui">
                <tr class="text-[11px] font-semibold text-muted uppercase tracking-wide">
                    <th class="px-5 py-3 text-left">Tanggal & Jam</th>
                    <th class="px-5 py-3 text-left">Mahasiswa</th>
                    <th class="px-5 py-3 text-left">Mata Kuliah</th>
                    <th class="px-5 py-3 text-left">Paket</th>
                    <th class="px-5 py-3 text-left">Pendapatan</th>
                    <th class="px-5 py-3 text-left">Status</th>
                </tr>
            </thead>
            
            <tbody id="history-body" class="divide-y divide-border-ui">
                @forelse ($riwayatTutor as $row)
                    @php
                        // Ekstrak bulan dan tanggal untuk filter dan display
                        $timestamp = strtotime($row['datetime']);
                        $bulanAngka = (int)date('m', $timestamp);
                        $namaBulan = $daftarBulan[$bulanAngka];
                        
                        // Format ke string: "18 Mei 2026, 14:00"
                        $formattedDate = date('d', $timestamp) . ' ' . $namaBulan . ' ' . date('Y', $timestamp);
                        $formattedTime = date('H:i', $timestamp) . ' WIB';
                    @endphp

                    {{-- Baris tabel ini memiliki class "history-row" dan data-attributes untuk kebutuhan JS --}}
                    <tr class="hover:bg-slate-50/60 transition history-row" 
                        data-month="{{ $namaBulan }}" 
                        data-status="{{ $row['status'] }}">
                        
                        <td class="px-5 py-3.5">
                            <div class="font-semibold text-ink text-sm">{{ $formattedDate }}</div>
                            <div class="text-muted text-xs mt-0.5">{{ $formattedTime }}</div>
                        </td>
                        
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2">
                                {{-- Avatar dummy bawaan template --}}
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($row['student']['name']) }}&size=28&background=f1f5f9&color=64748b"
                                     class="w-6 h-6 rounded" alt="">
                                <span class="font-semibold text-ink">{{ $row['student']['name'] }}</span>
                            </div>
                        </td>
                        
                        <td class="px-5 py-3.5 text-muted">{{ $row['course'] }}</td>
                        <td class="px-5 py-3.5 text-muted">{{ $row['package'] }}</td>
                        <td class="px-5 py-3.5 font-semibold text-ink">Rp{{ number_format($row['income'], 0, ',', '.') }}</td>
                        
                        <td class="px-5 py-3.5">
                            @if($row['status'] === 'Selesai')
                                <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded">
                                    <i class="bi bi-check-circle-fill text-[9px]"></i> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-red-100 border border-red-200 text-red-600 text-[11px] font-bold px-2.5 py-1 rounded">
                                    <i class="bi bi-x-circle-fill text-[9px]"></i> Dibatalkan
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-muted text-sm">
                            Belum ada riwayat mengajar.
                        </td>
                    </tr>
                @endforelse
                
                {{-- Baris kosong untuk handling hasil filter yang kosong via JS --}}
                <tr id="empty-state" style="display: none;">
                    <td colspan="6" class="px-5 py-8 text-center text-muted text-sm">
                        Tidak ada data yang sesuai dengan filter.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    function applyFilter() {
        const selectedMonth = document.getElementById('filter-month').value;
        const selectedStatus = document.getElementById('filter-status').value;
        const rows = document.querySelectorAll('.history-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowMonth = row.getAttribute('data-month');
            const rowStatus = row.getAttribute('data-status');
            
            // Cek kecocokan
            const matchMonth = (selectedMonth === "" || rowMonth === selectedMonth);
            const matchStatus = (selectedStatus === "" || rowStatus === selectedStatus);

            if (matchMonth && matchStatus) {
                row.style.display = ''; // Munculkan
                visibleCount++;
            } else {
                row.style.display = 'none'; // Sembunyikan
            }
        });

        // Tampilkan pesan jika filter tidak menemukan data
        const emptyState = document.getElementById('empty-state');
        if (visibleCount === 0) {
            emptyState.style.display = '';
        } else {
            emptyState.style.display = 'none';
        }
    }
</script>
@endpush
@endsection