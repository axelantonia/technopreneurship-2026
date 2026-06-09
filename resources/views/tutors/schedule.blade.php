@extends('tutors.layouts.app')
@section('title', 'Jadwal Mengajar')

@section('content')

<div class="mb-6">
    <h1 class="text-xl font-bold text-ink">Jadwal Mengajar</h1>
    <p class="text-sm text-muted mt-0.5">Buka slot waktu mengajar dan kelola pemesanan dari mahasiswa.</p>
</div>

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
                    <td class="px-5 py-3.5 text-muted text-xs">—</td>
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
                    <td class="px-5 py-3.5 text-muted text-xs">—</td>
                </tr>

                {{-- Available rows --}}
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="px-5 py-3.5 font-semibold text-ink text-sm">Jumat, 18 Jul 2025</td>
                    <td class="px-5 py-3.5 text-muted">14:00 WIB</td>
                    <td class="px-5 py-3.5 text-muted">1 Jam</td>
                    <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
                    <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
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
                    <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
                    <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
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

@push('scripts')
<script>
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
        <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
        <td class="px-5 py-3.5 text-slate-300 text-xs italic">—</td>
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
</script>
@endpush
@endsection
