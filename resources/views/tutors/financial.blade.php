@extends('tutors.layouts.app')
@section('title', 'Keuangan & Saldo')

@section('content')

<div class="mb-6">
    <h1 class="text-xl font-bold text-ink">Keuangan & Tarik Saldo</h1>
    <p class="text-sm text-muted mt-0.5">Pantau pendapatan dan cairkan saldo ke rekening kamu.</p>
</div>

{{-- ── Summary ───────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">

    {{-- Saldo utama --}}
    <div class="bg-sidebar border border-sidebar-border rounded-lg p-5">
        <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Saldo Dompet Utama</p>
        <p class="text-3xl font-extrabold text-white tracking-tight">
            Rp&nbsp;<span id="saldo-display">350.000</span>
        </p>
        <p class="text-xs text-slate-500 mt-2 flex items-center gap-1">
            <i class="bi bi-arrow-up-right-circle text-emerald"></i>
            Siap untuk dicairkan
        </p>
    </div>

    <div class="bg-white border border-border-ui rounded-lg p-5">
        <p class="text-[11px] font-semibold text-muted uppercase tracking-widest mb-2">Total Pendapatan Bulan Ini</p>
        <p class="text-2xl font-extrabold text-ink">Rp 1.450.000</p>
        <p class="text-xs text-emerald font-semibold mt-2 flex items-center gap-1">
            <i class="bi bi-arrow-up-right-circle-fill"></i> +12% dari bulan lalu
        </p>
    </div>

    <div class="bg-white border border-border-ui rounded-lg p-5">
        <p class="text-[11px] font-semibold text-muted uppercase tracking-widest mb-2">Total Sesi Selesai</p>
        <p class="text-2xl font-extrabold text-ink">19 <span class="text-base font-normal text-muted">Sesi</span></p>
        <p class="text-xs text-muted mt-2">Bulan Juli 2025</p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── Tabel Riwayat ─────────────────────────────────────────────────── --}}
    <div class="lg:col-span-2 bg-white border border-border-ui rounded-lg overflow-hidden">
        <div class="px-5 py-4 border-b border-border-ui">
            <h2 class="text-sm font-semibold text-ink">Riwayat Transaksi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">
                    <tr>
                        <th class="px-5 py-3 text-left">Keterangan</th>
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody id="tx-body" class="divide-y divide-border-ui">
                    @foreach([
                        ['Sesi: Randi — Laravel Advanced',  '10 Jul 2025', 65000,  'in'],
                        ['Sesi: Livi — Web Development',    '8 Jul 2025',  65000,  'in'],
                        ['Sesi: Ivy — Basis Data MySQL',    '5 Jul 2025',  65000,  'in'],
                        ['Sesi: Andi — Struktur Data',      '3 Jul 2025',  65000,  'in'],
                        ['Sesi: Kevin — Algoritma',         '1 Jul 2025',  65000,  'in'],
                        ['Sesi: Monica — Pemrograman Web',  '28 Jun 2025', 65000,  'in'],
                    ] as [$label, $tgl, $nom, $dir])
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded bg-emerald/10 border border-emerald/20 flex items-center justify-center shrink-0">
                                    <i class="bi bi-arrow-down-left text-emerald text-xs"></i>
                                </div>
                                <span class="text-ink text-sm font-medium">{{ $label }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-muted text-xs">{{ $tgl }}</td>
                        <td class="px-5 py-3.5 text-right font-bold text-emerald text-sm">
                            + Rp {{ number_format($nom, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Form Tarik Saldo ──────────────────────────────────────────────── --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 h-fit">
        <h2 class="text-xs font-semibold text-muted uppercase tracking-widest mb-4">
            <i class="bi bi-send text-accent mr-1.5"></i>Tarik Saldo
        </h2>
        <div class="space-y-3.5">
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Bank / E-Wallet <span class="text-red-400">*</span></label>
                <select id="w-bank" class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                    <option value="">— Pilih tujuan —</option>
                    <option>Bank BCA</option><option>Bank Mandiri</option>
                    <option>Bank BNI</option><option>Bank BRI</option>
                    <option>GoPay</option><option>OVO</option>
                    <option>Dana</option><option>ShopeePay</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Nomor Rekening / Akun <span class="text-red-400">*</span></label>
                <input id="w-account" type="text" placeholder="cth: 1234567890"
                       class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink mb-1.5">Jumlah Penarikan (Rp) <span class="text-red-400">*</span></label>
                <input id="w-amount" type="number" placeholder="Minimal 50.000"
                       class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
            </div>
        </div>
        <div class="mt-4 p-3 bg-accent/5 border border-accent/15 rounded-md text-xs text-accent/80 leading-relaxed">
            <i class="bi bi-info-circle mr-1"></i>
            Dana akan masuk ke rekening dalam <strong>1×24 jam</strong> hari kerja setelah diproses.
        </div>
        <button onclick="processWithdraw()"
                class="w-full mt-4 bg-accent hover:bg-accent-dark text-white text-sm font-semibold py-3 rounded-md transition shadow-sm">
            <i class="bi bi-send mr-2"></i>Kirim Penarikan
        </button>
    </div>

</div>

@push('scripts')
<script>
let saldo = 350000;

function processWithdraw() {
    const bank    = document.getElementById('w-bank').value;
    const account = document.getElementById('w-account').value.trim();
    const amount  = parseInt(document.getElementById('w-amount').value) || 0;

    if (!bank)           { showToast('Pilih bank atau e-wallet tujuan.', 'warning');           return; }
    if (!account)        { showToast('Nomor rekening wajib diisi.', 'warning');                return; }
    if (amount < 50000)  { showToast('Jumlah penarikan minimal Rp 50.000.', 'warning');        return; }
    if (amount > saldo)  { showToast('Saldo tidak mencukupi.', 'error');                       return; }

    saldo -= amount;
    document.getElementById('saldo-display').textContent = saldo.toLocaleString('id-ID');

    const today = new Date().toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'});
    const tbody = document.getElementById('tx-body');
    const tr    = document.createElement('tr');
    tr.className = 'hover:bg-red-50/30 transition';
    tr.innerHTML = `
        <td class="px-5 py-3.5">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded bg-red-100 border border-red-200 flex items-center justify-center shrink-0">
                    <i class="bi bi-arrow-up-right text-red-500 text-xs"></i>
                </div>
                <span class="text-ink text-sm font-medium">Penarikan → ${bank} (${account})</span>
            </div>
        </td>
        <td class="px-5 py-3.5 text-muted text-xs">${today}</td>
        <td class="px-5 py-3.5 text-right font-bold text-red-500 text-sm">
            − Rp ${amount.toLocaleString('id-ID')}
        </td>`;
    tbody.insertBefore(tr, tbody.firstChild);

    document.getElementById('w-bank').value    = '';
    document.getElementById('w-account').value = '';
    document.getElementById('w-amount').value  = '';

    showToast('Penarikan berhasil diproses! Dana akan masuk ke rekening dalam 1×24 jam.', 'success');
}
</script>
@endpush
@endsection
