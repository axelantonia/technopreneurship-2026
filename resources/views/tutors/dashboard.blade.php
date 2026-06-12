@extends('tutors.layouts.app')
@section('title', 'Dashboard')

@section('content')

{{-- Page heading --}}
<div class="mb-6">
    <h1 class="text-xl font-bold text-ink">Dashboard</h1>
    <p class="text-sm text-muted mt-0.5">Selamat datang kembali, Budi. Pantau aktivitas mengajarmu.</p>
</div>

{{-- ═══ BANNER PENGINGAT KELAS ════════════════════════════════════════════ --}}
<div id="reminder-banner"
     class="mb-6 bg-sidebar border border-sidebar-border border-l-4 border-l-emerald rounded-lg px-5 py-4 flex flex-col sm:flex-row sm:items-center gap-4">
    <div class="flex items-center gap-3 flex-1 min-w-0">
        <div class="w-9 h-9 rounded-md bg-emerald/15 border border-emerald/30 flex items-center justify-center shrink-0">
            <i class="bi bi-alarm-fill text-emerald"></i>
        </div>
        <div class="min-w-0">
            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest mb-0.5">Kelas Berikutnya</p>
            <p class="text-white text-sm font-medium leading-snug">
                Jam 14:00 &mdash; 
                {{-- <span class="text-gold font-semibold" id="countdown-text">15 menit lagi</span> --}}
                 <strong class="text-white">Randi</strong>
                <span class="text-slate-400">(Laravel Advanced)</span>
            </p>
        </div>
    </div>
    <div class="flex items-center gap-2 shrink-0">
        <button onclick="window.open('https://meet.google.com','_blank')"
                class="inline-flex items-center gap-1.5 bg-emerald hover:bg-emerald/90 text-white text-xs font-semibold px-3.5 py-2 rounded-md transition shadow-sm">
            <i class="bi bi-camera-video-fill text-sm"></i> Mulai Kelas
        </button>
        <button onclick="confirmDone()"
                class="inline-flex items-center gap-1.5 bg-sidebar-active hover:bg-sidebar-hover border border-sidebar-border text-slate-300 text-xs font-semibold px-3.5 py-2 rounded-md transition">
            <i class="bi bi-check2-circle text-sm"></i> Konfirmasi Selesai
        </button>
    </div>
</div>

{{-- ═══ STAT CARDS ═════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">

    {{-- Card 1: Pendapatan --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Pendapatan Bulan Ini</p>
                <p class="text-2xl font-extrabold text-ink mt-1">
                    Rp&nbsp;<span id="stat-income">1.450.000</span>
                </p>
                <p class="text-xs text-emerald font-semibold mt-1 flex items-center gap-1">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> +12% dari bulan lalu
                </p>
            </div>
            <div class="w-9 h-9 rounded-md bg-accent/10 border border-accent/20 flex items-center justify-center shrink-0">
                <i class="bi bi-cash-coin text-accent text-lg"></i>
            </div>
        </div>
        {{-- Sparkline --}}
        <svg viewBox="0 0 120 32" class="w-full h-8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <polyline points="0,28 20,22 40,24 60,14 80,16 100,8 120,4"
                      stroke="#3b82f6" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>
            <polyline points="0,28 20,22 40,24 60,14 80,16 100,8 120,4 120,32 0,32"
                      fill="url(#spark-fill)" stroke="none"/>
            <defs>
                <linearGradient id="spark-fill" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.18"/>
                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0"/>
                </linearGradient>
            </defs>
        </svg>
    </div>

    {{-- Card 2: Jam Mengajar --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Total Jam Mengajar</p>
                <p class="text-2xl font-extrabold text-ink mt-1">
                    <span id="stat-hours">32</span>
                    <span class="text-base font-normal text-muted"> Jam</span>
                </p>
                <!-- <p class="text-xs text-muted mt-1">Target bulan ini: 40 Jam</p> -->
            </div>
            <div class="w-9 h-9 rounded-md bg-gold/10 border border-gold/20 flex items-center justify-center shrink-0">
                <i class="bi bi-clock-history text-gold text-lg"></i>
            </div>
        </div>
        <div>
            <div class="flex justify-between text-[10px] text-muted mb-1.5">
                <span>Progress</span><span id="progress-label">80%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-1.5">
                <div id="hours-bar" class="bg-gold h-1.5 rounded-full transition-all" style="width: 80%"></div>
            </div>
        </div>
    </div>

    {{-- Card 3: Rating --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Rating Ulasan</p>
                <p class="text-2xl font-extrabold text-ink mt-1">4.9
                    <span class="text-base font-normal text-muted">/ 5.0</span>
                </p>
                <!-- <p class="text-xs text-muted mt-1">Berdasarkan 18 ulasan mahasiswa</p> -->
            </div>
            <div class="w-9 h-9 rounded-md bg-gold/10 border border-gold/20 flex items-center justify-center shrink-0">
                <i class="bi bi-star-fill text-gold text-lg"></i>
            </div>
        </div>
        <div class="flex items-center gap-0.5">
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-half text-gold text-sm"></i>
            <span class="ml-2 text-xs font-semibold text-ink">4.9</span>
            <span class="ml-1 text-xs text-muted">(18)</span>
        </div>
    </div>
</div>

{{-- ═══ TABEL JADWAL ════════════════════════════════════════════════════════ --}}
<div class="bg-white border border-border-ui rounded-lg overflow-hidden">
    <div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-ink">Jadwal Aktif Minggu Ini</h2>
            <p class="text-xs text-muted mt-0.5">4 sesi terjadwal</p>
        </div>
        <a href="{{ route('tutor.schedule') }}"
           class="text-xs font-semibold text-accent hover:text-accent-dark transition flex items-center gap-1">
            Kelola Jadwal <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">
                    <th class="px-5 py-3 text-left">Mahasiswa</th>
                    <th class="px-5 py-3 text-left">Mata Kuliah</th>
                    <th class="px-5 py-3 text-left">Jadwal</th>
                    <th class="px-5 py-3 text-left">Metode</th>
                    <th class="px-5 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-ui">
                @foreach([
                    ['Randi',  'Laravel Advanced',  'Rabu, 14:00 WIB',  'Online',  'Terdekat',    'gold'],
                    ['Livi',   'Web Development',   'Kamis, 09:00 WIB', 'Online',  'Terkonfirmasi','green'],
                    ['Ivy',    'Basis Data MySQL',  'Jumat, 14:00 WIB', 'Offline', 'Terkonfirmasi','green'],
                    ['Kevin',  'Struktur Data',     'Sabtu, 10:00 WIB', 'Online',  'Menunggu',     'gray'],
                ] as [$name,$mk,$jadwal,$metode,$status,$color])
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&size=32&background=e2e8f0&color=1e293b"
                                 class="w-7 h-7 rounded-md shrink-0" alt="{{ $name }}">
                            <span class="font-semibold text-ink text-sm">{{ $name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-muted text-sm">{{ $mk }}</td>
                    <td class="px-5 py-3.5 text-muted text-sm">{{ $jadwal }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-1 rounded border
                            {{ $metode==='Online'
                               ? 'bg-accent/5 border-accent/20 text-accent'
                               : 'bg-slate-100 border-slate-200 text-muted' }}">
                            <i class="bi {{ $metode==='Online' ? 'bi-wifi' : 'bi-geo-alt-fill' }} text-[10px]"></i>
                            {{ $metode }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5">
                        @if($color==='gold')
                            <span class="inline-flex items-center gap-1 bg-gold/10 border border-gold/30 text-gold text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-alarm text-[10px]"></i> {{ $status }}
                            </span>
                        @elseif($color==='green')
                            <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-check-circle text-[10px]"></i> {{ $status }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-slate-100 border border-slate-200 text-muted text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-hourglass-split text-[10px]"></i> {{ $status }}
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
// ── Countdown ─────────────────────────────────────────────────────────────
let totalSec = 15 * 60;
const countdownEl = document.getElementById('countdown-text');
const timer = setInterval(() => {
    if (totalSec <= 0) { clearInterval(timer); countdownEl.textContent = 'SEKARANG!'; return; }
    totalSec--;
    const m = Math.floor(totalSec / 60);
    const s = totalSec % 60;
    countdownEl.textContent = m > 0
        ? `${m} menit ${s.toString().padStart(2,'0')} detik lagi`
        : `${s} detik lagi`;
}, 1000);

// ── Konfirmasi selesai ────────────────────────────────────────────────────
let incomeVal = 1450000;
let hoursVal  = 32;

function confirmDone() {
    clearInterval(timer);
    document.getElementById('reminder-banner').remove();

    // Update income
    incomeVal += 65000;
    document.getElementById('stat-income').textContent = incomeVal.toLocaleString('id-ID');

    // Update hours
    hoursVal = Math.min(hoursVal + 1, 40);
    document.getElementById('stat-hours').textContent = hoursVal;
    const pct = Math.round((hoursVal / 40) * 100);
    document.getElementById('hours-bar').style.width   = pct + '%';
    document.getElementById('progress-label').textContent = pct + '%';

    showToast('Kelas dengan Randi selesai! Rp 65.000 ditambahkan ke pendapatan.', 'success');
}
</script>
@endpush
@endsection
