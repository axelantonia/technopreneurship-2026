@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="mb-8">
        <a href="{{ route('tutor.detail', $tutor['id']) }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-primary transition-colors mb-4 group">
            <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali
        </a>
        <h1 class="text-3xl font-extrabold text-dark">Checkout Booking</h1>
        <p class="text-gray-500 text-sm mt-1">Selesaikan pembayaran untuk mengkonfirmasi jadwal tutor kamu</p>
    </div>

    <form action="{{ route('checkout.confirm') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
        @csrf
        <input type="hidden" name="tutor_id" value="{{ $tutor['id'] }}">
        <input type="hidden" name="matkul"   value="{{ $matkul }}">
        <input type="hidden" name="jadwal"   value="{{ $jadwal }}">
        <input type="hidden" name="metode"   value="{{ $metode }}">
        <input type="hidden" name="total"    id="input-total" value="{{ $tutor['price'] }}">
        <input type="hidden" name="voucher"  id="input-voucher" value="">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ═══ LEFT: FORM ═══ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ── Data Kamu ── --}}
                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-dark mb-5 flex items-center gap-2">
                        <i class="bi bi-person-fill text-primary"></i> Data Kamu
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label for="field-nama" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                            <input type="text" id="field-nama" name="nama" placeholder="Masukkan nama lengkap" required
                                class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm font-medium text-dark focus:ring-2 focus:ring-primary focus:border-primary outline-none transition
                                valid:border-green-300" />
                        </div>
                        <div>
                            <label for="field-email" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Email</label>
                            <input type="email" id="field-email" name="email" placeholder="contoh@email.com" required
                                class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm font-medium text-dark focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" />
                        </div>
                    </div>
                </div>

                {{-- ── Detail Booking ── --}}
                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-dark mb-5 flex items-center gap-2">
                        <i class="bi bi-journal-text text-primary"></i> Detail Booking
                    </h2>
                    <div class="space-y-0 divide-y divide-secondary/50 text-sm text-gray-600">
                        <div class="flex justify-between items-center py-3">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/img/profil-' . $tutor['profil'] . '.jpg') }}"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor['name']) }}&background=4D81EE&color=fff&size=40'"
                                     class="w-8 h-8 rounded-full object-cover" alt="">
                                <span class="text-gray-500">Tutor</span>
                            </div>
                            <span class="font-bold text-dark">{{ $tutor['name'] }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-500">Jurusan</span>
                            <span class="font-bold text-dark">{{ $tutor['jurusan'] }}, {{ $tutor['kampus'] }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-500">Mata Kuliah</span>
                            <span class="font-bold text-dark">{{ $matkul }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-500">Jadwal</span>
                            <span class="font-bold text-dark">{{ $jadwal ?: '-' }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-500">Metode</span>
                            <span class="font-bold text-dark">{{ $metode }}</span>
                        </div>
                    </div>
                </div>

                {{-- ── Voucher Saya + Tukar Poin ── --}}
                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                        <i class="bi bi-ticket-perforated text-primary"></i> Voucher Saya
                    </h2>

                    <div class="flex items-center justify-between bg-surface rounded-xl px-4 py-3 border border-secondary mb-4">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-coin text-amber-500 text-lg"></i>
                            <span class="text-sm font-bold text-dark">Saldo Poin</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg font-extrabold text-amber-500" id="saldo-poin-display">2,450</span>
                            <button type="button" onclick="toggleRedeemPanel()"
                                    class="text-xs font-bold bg-primary text-white px-3 py-1.5 rounded-lg hover:bg-primary-hover transition">
                                Tukar Poin
                            </button>
                        </div>
                    </div>

                    {{-- Panel Tukar Poin (compact, collapsible) --}}
                    <div id="redeem-panel" class="hidden mb-4 border border-secondary rounded-2xl p-4 bg-surface">
                        @include('components.voucher-redeem', [
                            'compact' => true,
                            'subtotal' => $tutor['price'],
                            'onRedeem' => 'voucherRedeemed'
                        ])
                    </div>

                    <select id="voucherSelect" class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none text-sm font-medium">
                        <option value="">Pilih voucher</option>
                        <option value="NEWUSER" data-type="persen" data-val="10">NEWUSER - Diskon 10%</option>
                        <option value="HEMAT10" data-type="flat"   data-val="10000">HEMAT10 - Potongan Rp 10.000</option>
                        <option value="TUTOR5"  data-type="persen" data-val="5">TUTOR5 - Diskon 5%</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-2">Voucher akan otomatis dipotong dari total pembayaran</p>
                </div>

                {{-- ── Transfer Pembayaran ── --}}
                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                        <i class="bi bi-bank text-primary"></i> Transfer Pembayaran
                    </h2>

                    <div class="bg-surface border border-secondary rounded-2xl p-4 mb-5">
                        <p class="text-xs text-gray-400 mb-1">Transfer ke rekening</p>
                        <p class="text-lg font-extrabold text-dark">Tutorium Official</p>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <p>Bank BCA</p>
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-dark text-base">123-456-7890</p>
                                <button type="button" onclick="copyRekening()"
                                        class="inline-flex items-center gap-1 text-xs font-semibold bg-white border border-secondary px-2.5 py-1 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                            <p>a.n Tutorium Indonesia</p>
                        </div>
                    </div>

                    <label class="block text-sm font-bold text-dark mb-3">Upload Bukti Pembayaran</label>
                    <p id="file-validation-error" class="text-red-500 text-xs mb-2 hidden"></p>

                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" id="dropzone-label"
                            class="flex flex-col items-center justify-center w-full h-36 border-2 border-secondary border-dashed rounded-xl cursor-pointer bg-surface hover:border-primary transition-colors relative overflow-hidden group">

                            <div id="dropzone-empty" class="flex flex-col items-center justify-center">
                                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-dark">Klik untuk upload</span> gambar</p>
                                <p class="text-xs text-gray-400">PNG, JPG atau PDF (Maks. 2MB)</p>
                            </div>

                            <div id="file-preview" class="hidden absolute inset-0 flex items-center justify-center bg-surface/95 p-4">
                                <div class="flex items-center gap-3 max-w-full">
                                    <i class="bi bi-file-earmark-check text-2xl text-green-500 flex-shrink-0"></i>
                                    <div class="min-w-0">
                                        <p id="file-name-text" class="text-sm font-bold text-dark truncate"></p>
                                        <p id="file-size-text" class="text-xs text-gray-400"></p>
                                    </div>
                                    <button type="button" onclick="removeFile()"
                                            class="ml-auto text-red-400 hover:text-red-600 transition flex-shrink-0">
                                        <i class="bi bi-x-circle-fill text-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <input id="dropzone-file" name="bukti" type="file" class="hidden" accept=".png,.jpg,.jpeg,.pdf" />
                        </label>
                    </div>
                    <p id="file-error" class="text-red-500 text-xs mt-2 hidden">Harap upload bukti pembayaran.</p>
                </div>
            </div>

            {{-- ═══ RIGHT: RINGKASAN (sticky) ═══ --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-xl sticky top-24">
                    <h2 class="text-lg font-bold text-dark mb-5 flex items-center gap-2">
                        <i class="bi bi-receipt text-primary"></i> Ringkasan
                    </h2>

                    <div class="space-y-3 text-sm text-gray-600 border-b border-secondary pb-5">

                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span id="subtotal-amount" class="font-bold text-dark">Rp {{ number_format($tutor['price'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center" id="voucher-row">
                            <span>Voucher</span>
                            <span id="voucherAmount" class="text-green-600 font-bold">- Rp 0</span>
                        </div>

                        <div class="flex justify-between font-extrabold text-xl pt-4 border-t border-secondary text-dark">
                            <span>Total</span>
                            <span id="totalAmount" class="text-primary">Rp {{ number_format($tutor['price'], 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" id="confirmPaymentButton"
                            class="w-full mt-6 bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-xl shadow-lg active:scale-95 transition-all disabled:bg-gray-300 disabled:text-gray-500 disabled:shadow-none disabled:cursor-not-allowed"
                            disabled>
                        Konfirmasi Pembayaran
                    </button>

                    <p id="helper-disabled" class="text-[11px] text-red-400 text-center mt-2 leading-relaxed">
                        <i class="bi bi-info-circle-fill mr-1"></i>Isi Nama, Email, & upload bukti pembayaran
                    </p>
                    <p id="helper-enabled" class="text-[11px] text-gray-400 text-center mt-3 leading-relaxed hidden">
                        Pastikan bukti pembayaran jelas agar segera diverifikasi admin
                    </p>

                    {{-- Mobile sticky bottom bar (visible on small screens) --}}
                    <div id="mobile-sticky-bar" class="fixed bottom-0 left-0 right-0 bg-white border-t border-secondary p-4 shadow-2xl lg:hidden z-50 hidden">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm text-gray-500">Total</span>
                            <span id="mobile-total" class="text-xl font-extrabold text-primary">Rp {{ number_format($tutor['price'], 0, ',', '.') }}</span>
                        </div>
                        <button type="submit" id="mobileConfirmBtn"
                                class="w-full bg-primary text-white font-bold py-3.5 rounded-xl disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                                disabled>
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- Toast --}}
<div id="toast-container" class="fixed bottom-6 right-6 z-50 space-y-2"></div>

@push('scripts')
<script>
const subtotal = {{ $tutor['price'] }};

const formatRupiah = (n) =>
    new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 })
        .format(n).replace('Rp', 'Rp ').trim();

// ── VOUCHER LOGIC ─────────────────────────────────────────────────
const voucherSelect    = document.getElementById('voucherSelect');
const voucherAmountEl  = document.getElementById('voucherAmount');
const totalAmountEl    = document.getElementById('totalAmount');
const mobileTotalEl    = document.getElementById('mobile-total');
const inputTotal       = document.getElementById('input-total');
const inputVoucher     = document.getElementById('input-voucher');

let currentDiscount = 0;

function updateRingkasan() {
    const total = Math.max(0, subtotal - currentDiscount);
    voucherAmountEl.textContent = `- ${formatRupiah(currentDiscount)}`;
    totalAmountEl.textContent   = formatRupiah(total);
    if (mobileTotalEl) mobileTotalEl.textContent = formatRupiah(total);
    inputTotal.value            = total;
}

voucherSelect.addEventListener('change', function () {
    const opt      = this.options[this.selectedIndex];
    const type     = opt.dataset.type;
    const val      = parseFloat(opt.dataset.val || 0);
    let discount   = 0;

    if (type === 'persen') discount = Math.round(subtotal * val / 100);
    if (type === 'flat')   discount = val;

    currentDiscount = discount;
    inputVoucher.value = this.value || '';
    updateRingkasan();
});

// ── REDEEM CALLBACK ───────────────────────────────────────────────
function voucherRedeemed(data) {
    if (data.rewardType === 'PERSEN') {
        addVoucherToDropdown(data.rewardId, data.rewardName + ' (dari poin)', data.rewardType, data.rewardValue);
    } else if (data.rewardType === 'NOMINAL') {
        addVoucherToDropdown(data.rewardId, data.rewardName + ' (dari poin)', 'flat', data.rewardValue);
    }
    // Update saldo display
    const display = document.getElementById('saldo-poin-display');
    if (display) display.textContent = globalUserPoin.toLocaleString('id-ID');
}

function addVoucherToDropdown(code, label, type, value) {
    for (let opt of voucherSelect.options) {
        if (opt.value === 'redeem-' + code) return;
    }
    const opt = document.createElement('option');
    opt.value = 'redeem-' + code;
    opt.dataset.type = type;
    opt.dataset.val = value;
    opt.text = label;
    opt.selected = true;
    voucherSelect.appendChild(opt);
    voucherSelect.dispatchEvent(new Event('change'));
}

// ── TOGGLE REDEEM PANEL ──────────────────────────────────────────
function toggleRedeemPanel() {
    const panel = document.getElementById('redeem-panel');
    panel.classList.toggle('hidden');
    if (!panel.classList.contains('hidden')) {
        panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

// ── COPY REKENING ────────────────────────────────────────────────
function copyRekening() {
    const rek = '123-456-7890';
    navigator.clipboard.writeText(rek).then(() => {
        showToast('Nomor rekening berhasil disalin!', 'success');
    }).catch(() => {
        // Fallback
        const ta = document.createElement('textarea');
        ta.value = rek;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        ta.remove();
        showToast('Nomor rekening berhasil disalin!', 'success');
    });
}

// ── FILE UPLOAD ──────────────────────────────────────────────────
const fileInput       = document.getElementById('dropzone-file');
const fileEmpty       = document.getElementById('dropzone-empty');
const filePreview     = document.getElementById('file-preview');
const fileNameText    = document.getElementById('file-name-text');
const fileSizeText    = document.getElementById('file-size-text');
const fileError       = document.getElementById('file-error');
const fileValidation  = document.getElementById('file-validation-error');

function removeFile() {
    fileInput.value = '';
    fileEmpty.classList.remove('hidden');
    filePreview.classList.add('hidden');
    fileError.classList.add('hidden');
    fileValidation.classList.add('hidden');
    checkFormComplete();
}

fileInput.addEventListener('change', function () {
    fileValidation.classList.add('hidden');
    if (this.files && this.files.length > 0) {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB
        const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'application/pdf'];

        if (!validTypes.includes(file.type)) {
            fileValidation.textContent = 'Tipe file tidak didukung. Gunakan PNG, JPG, atau PDF.';
            fileValidation.classList.remove('hidden');
            removeFile();
            return;
        }
        if (file.size > maxSize) {
            fileValidation.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
            fileValidation.classList.remove('hidden');
            removeFile();
            return;
        }

        fileNameText.textContent = file.name;
        fileSizeText.textContent = (file.size / 1024).toFixed(1) + ' KB';
        fileEmpty.classList.add('hidden');
        filePreview.classList.remove('hidden');
        fileError.classList.add('hidden');
    } else {
        removeFile();
    }
    checkFormComplete();
});

// ── FORM VALIDATION ──────────────────────────────────────────────
const fieldNama  = document.getElementById('field-nama');
const fieldEmail = document.getElementById('field-email');
const confirmBtn = document.getElementById('confirmPaymentButton');
const mobileBtn  = document.getElementById('mobileConfirmBtn');
const helperDis  = document.getElementById('helper-disabled');
const helperEn   = document.getElementById('helper-enabled');
const mobileBar  = document.getElementById('mobile-sticky-bar');

function checkFormComplete() {
    const namaFilled  = fieldNama.value.trim().length > 0;
    const emailFilled = fieldEmail.value.trim().length > 0;
    const fileFilled  = fileInput.files && fileInput.files.length > 0;
    const ready       = namaFilled && emailFilled && fileFilled;

    confirmBtn.disabled = !ready;
    if (mobileBtn) mobileBtn.disabled = !ready;

    helperDis.classList.toggle('hidden', ready);
    helperEn.classList.toggle('hidden', !ready);

    if (mobileBar) {
        mobileBar.classList.toggle('hidden', ready);
    }
}

fieldNama.addEventListener('input', checkFormComplete);
fieldEmail.addEventListener('input', checkFormComplete);

document.getElementById('confirmPaymentButton').addEventListener('click', function (e) {
    if (!fileInput.files || fileInput.files.length === 0) {
        e.preventDefault();
        fileError.classList.remove('hidden');
        fileError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// ── TOAST ────────────────────────────────────────────────────────
function showToast(message, type = 'info') {
    const colors = {
        info:    { bg: '#4D81EE', icon: 'bi-info-circle-fill' },
        success: { bg: '#22c55e', icon: 'bi-check-circle-fill' },
        warning: { bg: '#f59e0b', icon: 'bi-exclamation-triangle-fill' },
        error:   { bg: '#ef4444', icon: 'bi-x-circle-fill' },
    };
    const c = colors[type] || colors.info;
    const toast = document.createElement('div');
    toast.style.cssText = `
        display: flex; align-items: center; gap: 10px;
        background: ${c.bg}; color: #fff;
        padding: 14px 20px; border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px; font-weight: 600;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        transform: translateY(20px); opacity: 0;
        transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
        max-width: 360px;
    `;
    toast.innerHTML = `<i class="bi ${c.icon}" style="font-size:18px;flex-shrink:0;"></i><span>${message}</span>`;
    document.getElementById('toast-container').appendChild(toast);
    requestAnimationFrame(() => {
        toast.style.transform = 'translateY(0)';
        toast.style.opacity = '1';
    });
    setTimeout(() => {
        toast.style.transform = 'translateY(20px)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 400);
    }, 3500);
}
</script>
@endpush
@endsection
