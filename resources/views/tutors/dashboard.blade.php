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

    {{-- Card 3: Rating (clickable -> buka modal reviews) --}}
    <button onclick="toggleReviewsModal()"
            class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3 text-left hover:border-accent/40 hover:shadow-md transition-all group cursor-pointer w-full">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Rating Ulasan</p>
                <p class="text-2xl font-extrabold text-ink mt-1">4.9
                    <span class="text-base font-normal text-muted">/ 5.0</span>
                </p>
            </div>
            <div class="flex flex-col items-end gap-1.5">
                <div class="w-9 h-9 rounded-md bg-gold/10 border border-gold/20 flex items-center justify-center">
                    <i class="bi bi-star-fill text-gold text-lg"></i>
                </div>
                <span class="text-[10px] font-semibold text-accent flex items-center gap-1 group-hover:gap-1.5 transition-all">
                    Lihat Ulasan <i class="bi bi-arrow-right text-[10px]"></i>
                </span>
            </div>
        </div>
        <div class="flex items-center gap-0.5">
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-fill text-gold text-sm"></i>
            <i class="bi bi-star-half text-gold text-sm"></i>
            <span class="ml-2 text-xs font-semibold text-ink">4.9</span>
            <span class="ml-1 text-xs text-muted">(8)</span>
        </div>
    </button>
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

{{-- ═══ MODAL REVIEWS ══════════════════════════════════════════════════════ --}}
<div id="reviews-modal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleReviewsModal()"></div>
    <div class="absolute right-0 top-0 h-full w-full max-w-2xl bg-white shadow-2xl overflow-y-auto flex flex-col">
        {{-- Header modal --}}
        <div class="sticky top-0 bg-white border-b border-border-ui px-6 py-4 flex items-center justify-between z-10 shrink-0">
            <div>
                <h2 class="text-base font-bold text-ink flex items-center gap-2">
                    <i class="bi bi-star-fill text-gold"></i> Ulasan dari Murid
                </h2>
                <p class="text-xs text-muted mt-0.5">Feedback jujur dari para mahasiswamu</p>
            </div>
            <button onclick="toggleReviewsModal()" class="w-8 h-8 rounded-md bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition">
                <i class="bi bi-x-lg text-sm text-muted"></i>
            </button>
        </div>
        {{-- Body modal: review cards --}}
        <div class="flex-1 p-6">
            @php
            $reviews = [
                ['name'=>'Farel',   'univ'=>'Universitas Kristen Petra',         'rating'=>5, 'matkul'=>'Web Development (Laravel)',   'tanggal'=>'12 Jun 2026', 'text'=>'Kak Budi penjelasannya enak banget, materi Laravel yang susah jadi gampang dipahami! Langsung bisa implementasi buat tugas akhir.'],
                ['name'=>'Jess',    'univ'=>'Universitas Negeri Surabaya',        'rating'=>5, 'matkul'=>'Struktur Data',                'tanggal'=>'10 Jun 2026', 'text'=>'Sangat membantu buat persiapan ujian. Recommended buat yang mau belajar ngebut tapi efektif!'],
                ['name'=>'Andi',    'univ'=>'Universitas Surabaya (UBAYA)',       'rating'=>5, 'matkul'=>'Basis Data MySQL',             'tanggal'=>'5 Jun 2026',  'text'=>'Sabar banget ngajarin dari nol. Langsung ngerti konsep JOIN dan normalisasi setelah 2 sesi!'],
                ['name'=>'Reva',    'univ'=>'Universitas Kristen Petra',         'rating'=>4, 'matkul'=>'Algoritma Pemrograman',        'tanggal'=>'1 Jun 2026',  'text'=>'Penjelasannya jelas dan sistematis. Cuma agak cepat di bagian rekursi, tapi overall oke banget!'],
                ['name'=>'Dita',    'univ'=>'Institut Teknologi Sepuluh Nopember','rating'=>5, 'matkul'=>'Web Development (Laravel)',   'tanggal'=>'28 Mei 2026', 'text'=>'Keren! Dari yang bingung routing Laravel sekarang udah bisa bikin CRUD sendiri. Makasih kak!'],
                ['name'=>'Kevin',   'univ'=>'Universitas Airlangga',              'rating'=>5, 'matkul'=>'Basis Data MySQL',             'tanggal'=>'22 Mei 2026', 'text'=>'Metode pengajaran kak Budi pakai analogi sehari-hari, jadi konsep database yang abstrak terasa nyata.'],
                ['name'=>'Monica',  'univ'=>'Universitas Surabaya (UBAYA)',       'rating'=>4, 'matkul'=>'Struktur Data',                'tanggal'=>'18 Mei 2026', 'text'=>'Ngejelasin BST dan Graph dengan contoh yang mudah dimengerti. Belajar jadi tidak stress!'],
                ['name'=>'Hendra',  'univ'=>'Universitas Kristen Petra',         'rating'=>5, 'matkul'=>'Algoritma Pemrograman',        'tanggal'=>'14 Mei 2026', 'text'=>'Berhasil lolos UTS dengan nilai A. Terima kasih banyak kak Budi sudah sabar mengajari!'],
            ];
            @endphp

            {{-- Summary --}}
            <div class="flex items-center gap-4 mb-6 p-4 bg-slate-50 border border-border-ui rounded-lg">
                <div class="text-center">
                    <p class="text-3xl font-extrabold text-ink">4.9</p>
                    <div class="flex justify-center gap-0.5 mt-1 text-gold">
                        <i class="bi bi-star-fill text-sm"></i>
                        <i class="bi bi-star-fill text-sm"></i>
                        <i class="bi bi-star-fill text-sm"></i>
                        <i class="bi bi-star-fill text-sm"></i>
                        <i class="bi bi-star-half text-sm"></i>
                    </div>
                    <p class="text-[10px] text-muted mt-1">dari {{ count($reviews) }} ulasan</p>
                </div>
                <div class="w-px h-12 bg-border-ui hidden sm:block"></div>
                <div class="flex-1 space-y-1.5 w-full">
                    @foreach([5,4,3,2,1] as $star)
                    @php $pct = count($reviews) > 0 ? round(collect($reviews)->where('rating',$star)->count() / count($reviews) * 100) : 0; @endphp
                    <div class="flex items-center gap-2 text-xs">
                        <span class="w-8 text-muted flex items-center gap-0.5">{{ $star }} <i class="bi bi-star-fill text-gold text-[9px]"></i></span>
                        <div class="flex-1 bg-slate-200 rounded-full h-2 overflow-hidden">
                            <div class="h-full rounded-full bg-gold transition-all" style="width: {{ $pct }}%"></div>
                        </div>
                        <span class="w-5 text-right text-muted text-[11px]">{{ collect($reviews)->where('rating',$star)->count() }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Filter buttons --}}
            <div class="flex flex-wrap gap-2 mb-5">
                <button class="filter-rev-btn bg-accent text-white border border-accent text-xs font-bold px-3 py-1.5 rounded-md transition" onclick="filterModalReviews('all',this)">Semua ({{ count($reviews) }})</button>
                @foreach([5,4] as $star)
                <button class="filter-rev-btn bg-white border border-border-ui text-muted hover:border-accent hover:text-accent text-xs font-bold px-3 py-1.5 rounded-md transition" onclick="filterModalReviews({{ $star }},this)">{{ $star }} ⭐ ({{ collect($reviews)->where('rating',$star)->count() }})</button>
                @endforeach
            </div>

            {{-- Grid review cards --}}
            <div class="space-y-4" id="modal-reviews-grid">
                @foreach($reviews as $r)
                <div class="rev-card bg-white border border-border-ui rounded-lg p-5" data-rating="{{ $r['rating'] }}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 border border-border-ui flex items-center justify-center font-extrabold text-accent text-sm shrink-0">
                                {{ strtoupper(substr($r['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-ink text-sm">{{ $r['name'] }}</h4>
                                <p class="text-[10px] text-muted">{{ $r['univ'] }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="flex gap-0.5 text-gold justify-end mb-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $r['rating'] ? 'bi-star-fill' : 'bi-star' }} text-xs"></i>
                                @endfor
                            </div>
                            <p class="text-[9px] text-muted">{{ $r['tanggal'] }}</p>
                        </div>
                    </div>
                    <span class="inline-block bg-slate-50 border border-border-ui text-xs font-semibold text-accent px-2.5 py-1 rounded mb-2.5">{{ $r['matkul'] }}</span>
                    <p class="text-sm text-subtle leading-relaxed italic">"{{ $r['text'] }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ── Reviews Modal ─────────────────────────────────────────────────────────
function toggleReviewsModal() {
    const modal = document.getElementById('reviews-modal');
    if (!modal) return;
    modal.classList.toggle('hidden');
    document.body.classList.toggle('overflow-hidden');
}

function filterModalReviews(star, btn) {
    document.querySelectorAll('.filter-rev-btn').forEach(b => {
        b.classList.remove('bg-accent', 'text-white', 'border-accent');
        b.classList.add('bg-white', 'text-muted', 'border-border-ui');
    });
    btn.classList.add('bg-accent', 'text-white', 'border-accent');
    btn.classList.remove('bg-white', 'text-muted', 'border-border-ui');

    document.querySelectorAll('.rev-card').forEach(card => {
        const show = star === 'all' || parseInt(card.dataset.rating) === star;
        card.style.display = show ? '' : 'none';
    });
}
</script>
<script>
// ── Countdown ─────────────────────────────────────────────────────────────
let totalSec = 15 * 60;
const countdownEl = document.getElementById('countdown-text');
const timer = countdownEl ? setInterval(() => {
    if (totalSec <= 0) { clearInterval(timer); countdownEl.textContent = 'SEKARANG!'; return; }
    totalSec--;
    const m = Math.floor(totalSec / 60);
    const s = totalSec % 60;
    countdownEl.textContent = m > 0
        ? `${m} menit ${s.toString().padStart(2,'0')} detik lagi`
        : `${s} detik lagi`;
}, 1000) : null;

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
