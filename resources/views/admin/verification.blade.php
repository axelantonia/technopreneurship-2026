@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="bg-white border border-border-ui rounded-lg overflow-hidden">
    <div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-ink flex items-center gap-2">
                <i class="bi bi-shield-check text-accent"></i>
                Antrean Verifikasi Berkas Calon Tutor
            </h2>
            <p class="text-xs text-muted mt-0.5">Calon tutor menunggu persetujuan KYC</p>
        </div>
        <span id="kyc-count-badge" class="inline-flex items-center gap-1 bg-gold/10 border border-gold/30 text-gold text-xs font-bold px-2.5 py-1 rounded-md">
            <i class="bi bi-hourglass-split"></i> <span id="kyc-count">5</span> menunggu
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm" id="kyc-table">
            <thead>
                <tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">
                    <th class="px-5 py-3 text-left">Nama Lengkap</th>
                    <th class="px-5 py-3 text-left">Universitas</th>
                    <th class="px-5 py-3 text-left">Transkrip Nilai</th>
                    <th class="px-5 py-3 text-left">Foto KTM</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-ui" id="kyc-tbody">
                @php
                $kycData = [
                    ['name' => 'Amanda Putri',       'univ' => 'Universitas Kristen Petra',      'transkrip' => '#', 'ktm' => '#'],
                    ['name' => 'Dimas Ardiansyah',   'univ' => 'Universitas Airlangga',          'transkrip' => '#', 'ktm' => '#'],
                    ['name' => 'Felicia Tan',        'univ' => 'Universitas Surabaya (UBAYA)',   'transkrip' => '#', 'ktm' => '#'],
                    ['name' => 'Kevin Hartono',      'univ' => 'Institut Teknologi Sepuluh Nopember', 'transkrip' => '#', 'ktm' => '#'],
                    ['name' => 'Meliana Kusuma',     'univ' => 'Universitas Negeri Surabaya',    'transkrip' => '#', 'ktm' => '#'],
                ];
                @endphp
                @foreach($kycData as $i => $k)
                <tr class="kyc-row hover:bg-slate-50/60 transition" data-index="{{ $i }}">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-md bg-accent/10 border border-accent/20 flex items-center justify-center font-bold text-accent text-xs shrink-0">
                                {{ strtoupper(substr($k['name'], 0, 1)) }}
                            </div>
                            <span class="font-semibold text-ink text-sm">{{ $k['name'] }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-muted text-sm">{{ $k['univ'] }}</td>
                    <td class="px-5 py-3.5">
                        <a href="#" onclick="event.preventDefault()"
                           class="inline-flex items-center gap-1.5 text-xs font-semibold text-accent hover:text-accent-dark transition bg-accent/5 border border-accent/20 px-3 py-1.5 rounded-md">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Buka PDF
                        </a>
                    </td>
                    <td class="px-5 py-3.5">
                        <a href="#" onclick="event.preventDefault()"
                           class="inline-flex items-center gap-1.5 text-xs font-semibold text-accent hover:text-accent-dark transition bg-accent/5 border border-accent/20 px-3 py-1.5 rounded-md">
                            <i class="bi bi-image-fill"></i> Lihat KTM
                        </a>
                    </td>
                    <td class="px-5 py-3.5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="approveKYC(this)"
                                    class="inline-flex items-center gap-1 bg-emerald hover:bg-emerald/90 text-white text-xs font-bold px-3 py-1.5 rounded-md transition shadow-sm">
                                <i class="bi bi-check-lg"></i> Approve
                            </button>
                            <button onclick="rejectKYC(this)"
                                    class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-md transition shadow-sm">
                                <i class="bi bi-x-lg"></i> Reject
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t border-border-ui bg-slate-50 text-xs text-muted flex items-center justify-between">
        <span><i class="bi bi-info-circle text-accent mr-1"></i> Klik Approve untuk menyetujui, Reject untuk menolak.</span>
        <span id="kyc-footer-count">5 calon tutor tersisa</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
function approveKYC(btn) {
    const row = btn.closest('.kyc-row');
    if (!row) return;
    const name = row.querySelector('td:first-child .font-semibold')?.textContent?.trim() || 'Calon tutor';
    // Animate removal
    row.style.transition = 'all 0.3s ease';
    row.style.opacity = '0';
    row.style.transform = 'translateX(20px)';
    setTimeout(() => {
        row.remove();
        updateKYCCount();
    }, 300);
    showToast(name + ' resmi di-approve dan aktif di platform!', 'success');
}

function rejectKYC(btn) {
    const row = btn.closest('.kyc-row');
    if (!row) return;
    const name = row.querySelector('td:first-child .font-semibold')?.textContent?.trim() || 'Calon tutor';
    row.style.transition = 'all 0.3s ease';
    row.style.opacity = '0';
    row.style.transform = 'translateX(-20px)';
    setTimeout(() => {
        row.remove();
        updateKYCCount();
    }, 300);
    showToast(name + ' telah ditolak. Berkas dikembalikan.', 'error');
}

function updateKYCCount() {
    const rows = document.querySelectorAll('#kyc-tbody .kyc-row');
    const count = rows.length;
    document.getElementById('kyc-count').textContent = count;
    document.getElementById('kyc-footer-count').textContent = count + ' calon tutor tersisa';
}
</script>
@endpush