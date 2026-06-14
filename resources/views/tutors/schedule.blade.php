@extends('tutors.layouts.app')
@section('title', 'Jadwal & Riwayat')

@section('content')

{{-- ═══ HEADER ═══════════════════════════════════════════════════════════════ --}}
<div class="mb-6">
    <h1 class="text-xl font-bold text-ink flex items-center gap-2">
        <i class="bi bi-calendar2-week-fill text-accent"></i> Jadwal & Riwayat
    </h1>
    <p class="text-sm text-muted mt-0.5">Kelola slot mengajar aktif dan pantau riwayat sesi sebelumnya.</p>
</div>

{{-- ═══ TAB SWITCHER ═════════════════════════════════════════════════════════ --}}
<div class="flex gap-1 bg-slate-100 rounded-lg p-1 mb-6 w-fit">
    <button id="tab-jadwal" onclick="switchTab('jadwal')"
            class="tab-btn px-4 py-2 rounded-md text-sm font-semibold transition bg-white text-ink shadow-sm">
        <i class="bi bi-calendar-week mr-1.5"></i>Jadwal Mengajar
    </button>
    <button id="tab-riwayat" onclick="switchTab('riwayat')"
            class="tab-btn px-4 py-2 rounded-md text-sm font-semibold transition text-muted hover:text-ink">
        <i class="bi bi-clock-history mr-1.5"></i>Riwayat Mengajar
    </button>
</div>

{{-- ═════════════════════════════════════════════════════════════════════════ --}}
{{-- PANEL: JADWAL --}}
{{-- ═════════════════════════════════════════════════════════════════════════ --}}
<div id="panel-jadwal">

    {{-- ── Form Buka Slot ────────────────────────────────────────────────────── --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 mb-6">
        <h2 class="text-xs font-semibold text-muted uppercase tracking-widest mb-4">
            <i class="bi bi-calendar-plus text-accent mr-1.5"></i>Buka Slot Jadwal Baru
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Tanggal <span class="text-red-400">*</span></label>
                <input id="slot-date" type="date"
                       class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Jam Mulai <span class="text-red-400">*</span></label>
                <input id="slot-time" type="time"
                       class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Durasi</label>
                <select id="slot-dur"
                        class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                    <option>1 Jam</option><option>1.5 Jam</option>
                    <option>2 Jam</option><option>3 Jam</option>
                </select>
            </div>
            <div class="flex items-end">
                <button onclick="addSlot()"
                        class="w-full bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-4 py-2.5 rounded-md transition shadow-sm">
                    <i class="bi bi-plus-lg mr-1"></i> Buka Slot
                </button>
            </div>
        </div>
    </div>

    {{-- ── Tabel Jadwal ──────────────────────────────────────────────────────── --}}
    <div class="bg-white border border-border-ui rounded-lg overflow-hidden">
        <div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">
            <h2 class="text-sm font-semibold text-ink">Daftar Slot Jadwal</h2>
            <div class="flex items-center gap-4 text-[11px] text-muted">
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded bg-emerald/20 border border-emerald/40 inline-block"></span>
                    Tersedia
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded bg-red-100 border border-red-300 inline-block"></span>
                    Terisi / Booked
                </span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-border-ui">
                    <tr class="text-[11px] font-semibold text-muted uppercase tracking-wide">
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-left">Jam</th>
                        <th class="px-5 py-3 text-left">Durasi</th>
                        <th class="px-5 py-3 text-left">Mahasiswa</th>
                        <th class="px-5 py-3 text-left">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody id="schedule-body" class="divide-y divide-border-ui">

                    {{-- Booked rows --}}
                    <tr class="bg-red-50/40 hover:bg-red-50/70 transition">
                        <td class="px-5 py-3.5 font-semibold text-ink text-sm">Rabu, 16 Jul 2025</td>
                        <td class="px-5 py-3.5 text-muted">14:00 WIB</td>
                        <td class="px-5 py-3.5 text-muted">1 Jam</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Randi&size=28&background=fee2e2&color=dc2626"
                                     class="w-6 h-6 rounded" alt="">
                                <span class="font-semibold text-ink">Randi</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-muted">Laravel Advanced</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 bg-red-100 border border-red-200 text-red-600 text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-lock-fill text-[9px]"></i> Terisi
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-muted text-xs">&mdash;</td>
                    </tr>
                    <tr class="bg-red-50/40 hover:bg-red-50/70 transition">
                        <td class="px-5 py-3.5 font-semibold text-ink text-sm">Kamis, 17 Jul 2025</td>
                        <td class="px-5 py-3.5 text-muted">09:00 WIB</td>
                        <td class="px-5 py-3.5 text-muted">1.5 Jam</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Livi&size=28&background=fee2e2&color=dc2626"
                                     class="w-6 h-6 rounded" alt="">
                                <span class="font-semibold text-ink">Livi</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-muted">Web Development</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 bg-red-100 border border-red-200 text-red-600 text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-lock-fill text-[9px]"></i> Terisi
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-muted text-xs">&mdash;</td>
                    </tr>

                    {{-- Available rows --}}
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-5 py-3.5 font-semibold text-ink text-sm">Jumat, 18 Jul 2025</td>
                        <td class="px-5 py-3.5 text-muted">14:00 WIB</td>
                        <td class="px-5 py-3.5 text-muted">1 Jam</td>
                        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
                        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-unlock text-[9px]"></i> Tersedia
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <button onclick="removeSlot(this)" class="text-xs font-semibold text-red-400 hover:text-red-600 transition">Hapus</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-5 py-3.5 font-semibold text-ink text-sm">Sabtu, 19 Jul 2025</td>
                        <td class="px-5 py-3.5 text-muted">10:00 WIB</td>
                        <td class="px-5 py-3.5 text-muted">2 Jam</td>
                        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
                        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded">
                                <i class="bi bi-unlock text-[9px]"></i> Tersedia
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <button onclick="removeSlot(this)" class="text-xs font-semibold text-red-400 hover:text-red-600 transition">Hapus</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>{{-- /panel-jadwal --}}

{{-- ═════════════════════════════════════════════════════════════════════════ --}}
{{-- PANEL: RIWAYAT (hidden by default) --}}
{{-- ═════════════════════════════════════════════════════════════════════════ --}}
<div id="panel-riwayat" class="hidden">

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
                            $timestamp = strtotime($row['datetime']);
                            $bulanAngka = (int)date('m', $timestamp);
                            $namaBulan = $daftarBulan[$bulanAngka];
                            $formattedDate = date('d', $timestamp) . ' ' . $namaBulan . ' ' . date('Y', $timestamp);
                            $formattedTime = date('H:i', $timestamp) . ' WIB';
                        @endphp

                        <tr class="hover:bg-slate-50/60 transition history-row" 
                            data-month="{{ $namaBulan }}" 
                            data-status="{{ $row['status'] }}">
                            
                            <td class="px-5 py-3.5">
                                <div class="font-semibold text-ink text-sm">{{ $formattedDate }}</div>
                                <div class="text-muted text-xs mt-0.5">{{ $formattedTime }}</div>
                            </td>
                            
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
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
                    
                    <tr id="empty-state" style="display: none;">
                        <td colspan="6" class="px-5 py-8 text-center text-muted text-sm">
                            Tidak ada data yang sesuai dengan filter.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>{{-- /panel-riwayat --}}

@push('scripts')
<script>
// ── Tab Switcher ─────────────────────────────────────────────────────────
function switchTab(tab) {
    document.getElementById('panel-jadwal').classList.toggle('hidden', tab !== 'jadwal');
    document.getElementById('panel-riwayat').classList.toggle('hidden', tab !== 'riwayat');

    const btnJadwal  = document.getElementById('tab-jadwal');
    const btnRiwayat = document.getElementById('tab-riwayat');
    const activeClass   = ['bg-white','text-ink','shadow-sm'];
    const inactiveClass = ['text-muted','hover:text-ink'];

    if (tab === 'jadwal') {
        btnJadwal.classList.add(...activeClass);    btnJadwal.classList.remove(...inactiveClass);
        btnRiwayat.classList.remove(...activeClass); btnRiwayat.classList.add(...inactiveClass);
    } else {
        btnRiwayat.classList.add(...activeClass);   btnRiwayat.classList.remove(...inactiveClass);
        btnJadwal.classList.remove(...activeClass);  btnJadwal.classList.add(...inactiveClass);
    }
}

// ── Slot functions ───────────────────────────────────────────────────────
function formatTgl(str) {
    const d = new Date(str + 'T00:00:00');
    return d.toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'short',year:'numeric'});
}

function addSlot() {
    const date = document.getElementById('slot-date').value;
    const time = document.getElementById('slot-time').value;
    const dur  = document.getElementById('slot-dur').value;

    if (!date || !time) { showToast('Tanggal dan jam wajib diisi.', 'warning'); return; }

    const tbody = document.getElementById('schedule-body');
    const tr    = document.createElement('tr');
    tr.className = 'hover:bg-slate-50/60 transition';
    tr.innerHTML = `
        <td class="px-5 py-3.5 font-semibold text-ink text-sm">${formatTgl(date)}</td>
        <td class="px-5 py-3.5 text-muted">${time} WIB</td>
        <td class="px-5 py-3.5 text-muted">${dur}</td>
        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
        <td class="px-5 py-3.5 text-slate-300 text-xs italic">&mdash;</td>
        <td class="px-5 py-3.5">
            <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded">
                <i class="bi bi-unlock text-[9px]"></i> Tersedia
            </span>
        </td>
        <td class="px-5 py-3.5">
            <button onclick="removeSlot(this)" class="text-xs font-semibold text-red-400 hover:text-red-600 transition">Hapus</button>
        </td>`;
    tbody.appendChild(tr);

    document.getElementById('slot-date').value = '';
    document.getElementById('slot-time').value = '';
    showToast(`Slot ${formatTgl(date)} ${time} berhasil dibuka!`, 'success');
}

function removeSlot(btn) {
    if (!confirm('Hapus slot ini?')) return;
    btn.closest('tr').remove();
    showToast('Slot jadwal dihapus.', 'info');
}

// ── Filter Riwayat ───────────────────────────────────────────────────────
function applyFilter() {
    const selectedMonth = document.getElementById('filter-month').value;
    const selectedStatus = document.getElementById('filter-status').value;
    const rows = document.querySelectorAll('.history-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const rowMonth = row.getAttribute('data-month');
        const rowStatus = row.getAttribute('data-status');
        const matchMonth = (selectedMonth === "" || rowMonth === selectedMonth);
        const matchStatus = (selectedStatus === "" || rowStatus === selectedStatus);

        if (matchMonth && matchStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

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
