@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div id="voucher-section" class="scroll-mt-20 mb-8">
    <div class="bg-white border border-border-ui rounded-lg overflow-hidden">
        <div class="px-5 py-4 border-b border-border-ui">
            <h2 class="text-sm font-bold text-ink flex items-center gap-2">
                <i class="bi bi-ticket-perforated-fill text-gold"></i>
                Manajemen Voucher & Kupon Promo
            </h2>
            <p class="text-xs text-muted mt-0.5">Buat dan kelola kode promo untuk pengguna.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0">
            {{-- KOLOM KIRI: Form --}}
            <div class="lg:col-span-2 p-5 border-r border-border-ui bg-slate-50/50">
                <h3 class="text-sm font-semibold text-ink mb-4">Buat Kode Voucher Baru</h3>
                <form id="voucher-form" onsubmit="return createVoucher(event)" class="space-y-4">
                    {{-- Kode Voucher --}}
                    <div>
                        <label class="block text-xs font-semibold text-muted mb-1.5">Kode Voucher</label>
                        <input type="text" id="v-code" required
                               placeholder="Contoh: DISKON50"
                               class="w-full border border-border-ui rounded-md px-3.5 py-2.5 text-sm text-ink placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition bg-white">
                    </div>
                    {{-- Jenis Potongan --}}
                    <div>
                        <label class="block text-xs font-semibold text-muted mb-1.5">Jenis Potongan</label>
                        <select id="v-type" required
                                class="w-full border border-border-ui rounded-md px-3.5 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition bg-white">
                            <option value="Persen">Persen (%)</option>
                            <option value="Nominal">Nominal (Rp)</option>
                        </select>
                    </div>
                    {{-- Besaran Diskon --}}
                    <div>
                        <label class="block text-xs font-semibold text-muted mb-1.5">Besaran Diskon</label>
                        <input type="number" id="v-amount" required min="1"
                               placeholder="Contoh: 20 atau 50000"
                               class="w-full border border-border-ui rounded-md px-3.5 py-2.5 text-sm text-ink placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition bg-white">
                    </div>
                    {{-- Kuota Pemakaian --}}
                    <div>
                        <label class="block text-xs font-semibold text-muted mb-1.5">Kuota Pemakaian</label>
                        <input type="number" id="v-quota" required min="1"
                               placeholder="Contoh: 100"
                               class="w-full border border-border-ui rounded-md px-3.5 py-2.5 text-sm text-ink placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition bg-white">
                    </div>
                    <button type="submit"
                            class="w-full bg-sidebar hover:bg-sidebar-active text-white text-sm font-bold py-2.5 rounded-md transition shadow-sm flex items-center justify-center gap-2">
                        <i class="bi bi-ticket-perforated"></i> Cetak Voucher Baru
                    </button>
                </form>
            </div>

            {{-- KOLOM KANAN: Tabel Voucher --}}
            <div class="lg:col-span-3 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-ink">Daftar Voucher Aktif</h3>
                    <span id="voucher-count-badge" class="inline-flex items-center gap-1 bg-accent/10 border border-accent/20 text-accent text-xs font-bold px-2.5 py-1 rounded-md">
                        <i class="bi bi-ticket-perforated"></i> <span id="voucher-count">3</span> aktif
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">
                                <th class="px-4 py-3 text-left">Kode</th>
                                <th class="px-4 py-3 text-left">Jenis</th>
                                <th class="px-4 py-3 text-left">Diskon</th>
                                <th class="px-4 py-3 text-left">Kuota</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-ui" id="voucher-tbody">
                            @php
                            $vouchers = [
                                ['code' => 'NEWUSER', 'type' => 'Persen', 'discount' => '20%', 'quota' => 50, 'active' => true],
                                ['code' => 'HEMAT10', 'type' => 'Nominal', 'discount' => 'Rp 10.000', 'quota' => 100, 'active' => true],
                                ['code' => 'TUTOR5', 'type' => 'Persen', 'discount' => '5%', 'quota' => 30, 'active' => true],
                            ];
                            @endphp
                            @foreach($vouchers as $v)
                            <tr class="hover:bg-slate-50/60 transition voucher-row">
                                <td class="px-4 py-3.5">
                                    <span class="font-mono font-bold text-sm text-ink bg-slate-100 border border-border-ui px-2.5 py-1 rounded-md">{{ $v['code'] }}</span>
                                </td>
                                <td class="px-4 py-3.5 text-muted text-sm">{{ $v['type'] }}</td>
                                <td class="px-4 py-3.5 font-semibold text-ink">{{ $v['discount'] }}</td>
                                <td class="px-4 py-3.5 text-muted text-sm">{{ $v['quota'] }}</td>
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded-md">
                                        <i class="bi bi-check-circle-fill text-[10px]"></i> Aktif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>>
function createVoucher(e) {
    e.preventDefault();
    const code   = document.getElementById('v-code').value.trim().toUpperCase();
    const type   = document.getElementById('v-type').value;
    const amount = document.getElementById('v-amount').value.trim();
    const quota  = document.getElementById('v-quota').value.trim();

    if (!code || !amount || !quota) {
        showToast('Harap isi semua field voucher!', 'warning');
        return false;
    }

    // Format discount display
    let discountDisplay = '';
    if (type === 'Persen') {
        discountDisplay = amount + '%';
    } else {
        discountDisplay = 'Rp ' + parseInt(amount).toLocaleString('id-ID');
    }

    // Build row
    const tbody = document.getElementById('voucher-tbody');
    const tr = document.createElement('tr');
    tr.className = 'hover:bg-slate-50/60 transition voucher-row';
    tr.innerHTML = `
        <td class="px-4 py-3.5">
            <span class="font-mono font-bold text-sm text-ink bg-slate-100 border border-border-ui px-2.5 py-1 rounded-md">${code}</span>
        </td>
        <td class="px-4 py-3.5 text-muted text-sm">${type}</td>
        <td class="px-4 py-3.5 font-semibold text-ink">${discountDisplay}</td>
        <td class="px-4 py-3.5 text-muted text-sm">${quota}</td>
        <td class="px-4 py-3.5">
            <span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded-md">
                <i class="bi bi-check-circle-fill text-[10px]"></i> Aktif
            </span>
        </td>
    `;
    // Animate in
    tr.style.opacity = '0';
    tbody.appendChild(tr);
    requestAnimationFrame(() => {
        tr.style.transition = 'opacity 0.3s ease';
        tr.style.opacity = '1';
    });

    // Clear form
    document.getElementById('voucher-form').reset();

    // Update count
    const countEl = document.getElementById('voucher-count');
    countEl.textContent = parseInt(countEl.textContent) + 1;

    showToast('Kode voucher ' + code + ' berhasil aktif!', 'success');
    return false;
}
</script>
@endpush