@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="mb-8">
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

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold mb-5">Data Kamu</h2>
                    <div class="space-y-4">
                        <input type="text" name="nama" placeholder="Nama Lengkap"
                            class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                        <input type="email" name="email" placeholder="Email"
                            class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                    </div>
                </div>

                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold mb-5">Detail Booking</h2>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Tutor</span>
                            <span class="font-bold text-dark">{{ $tutor['name'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jurusan</span>
                            <span class="font-bold text-dark">{{ $tutor['jurusan'] }}, {{ $tutor['kampus'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Mata Kuliah</span>
                            <span class="font-bold text-dark">{{ $matkul }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jadwal</span>
                            <span class="font-bold text-dark">{{ $jadwal ?: '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Metode</span>
                            <span class="font-bold text-dark">{{ $metode }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold mb-4">Voucher Saya</h2>
                    <select id="voucherSelect" class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none text-sm font-medium">
                        <option value="">Pilih voucher</option>
                        <option value="NEWUSER" data-type="persen" data-val="10">NEWUSER - Diskon 10%</option>
                        <option value="HEMAT10" data-type="flat"   data-val="10000">HEMAT10 - Potongan Rp 10.000</option>
                        <option value="TUTOR5"  data-type="persen" data-val="5">TUTOR5 - Diskon 5%</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-2">Voucher akan otomatis dipotong dari total pembayaran</p>
                </div>

                <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold mb-4">Transfer Pembayaran</h2>

                    <div class="bg-surface border border-secondary rounded-2xl p-4 mb-5">
                        <p class="text-xs text-gray-400 mb-1">Transfer ke rekening</p>
                        <p class="text-lg font-extrabold text-dark">Tutorium Official</p>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <p>Bank BCA</p>
                            <p class="font-bold text-dark">123-456-7890</p>
                            <p>a.n Tutorium Indonesia</p>
                        </div>
                    </div>

                    <label class="block text-sm font-bold mb-3 text-dark">Upload Bukti Pembayaran</label>

                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" id="dropzone-label"
                            class="flex flex-col items-center justify-center w-full h-36 border-2 border-secondary border-dashed rounded-xl cursor-pointer bg-surface hover:border-primary transition-colors relative overflow-hidden group">

                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-dark">Klik untuk upload</span> gambar</p>
                                <p class="text-xs text-gray-400">PNG, JPG atau PDF (Maks. 2MB)</p>
                            </div>

                            <div id="file-name-display" class="absolute inset-0 flex items-center justify-center bg-surface border-2 border-primary rounded-xl hidden">
                                <svg class="w-6 h-6 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-bold text-primary truncate max-w-[80%]"></span>
                            </div>

                            <input id="dropzone-file" name="bukti" type="file" class="hidden" accept=".png,.jpg,.jpeg,.pdf" />
                        </label>
                    </div>
                    <p id="file-error" class="text-red-500 text-xs mt-2 hidden">Harap upload bukti pembayaran.</p>
                </div>
            </div>

            {{-- ── Ringkasan ── --}}
            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-xl sticky top-10 h-fit">
                <h2 class="text-lg font-bold mb-5">Ringkasan</h2>

                <div class="space-y-3 text-sm text-gray-600 border-b pb-5">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="subtotalDisplay">Rp {{ number_format($tutor['price'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Voucher</span>
                        <span id="voucherAmount" class="text-green-500 font-bold">- Rp 0</span>
                    </div>
                    <div class="flex justify-between font-extrabold text-lg pt-3 border-t text-dark">
                        <span>Total</span>
                        <span id="totalAmount" class="text-primary">Rp {{ number_format($tutor['price'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" id="confirmPaymentButton"
                    class="w-full mt-6 bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-xl shadow-lg active:scale-95 transition-all">
                    Konfirmasi Pembayaran
                </button>

                <p class="text-[11px] text-gray-400 text-center mt-3 leading-relaxed">
                    Pastikan bukti pembayaran jelas agar segera diverifikasi admin
                </p>
            </div>
        </div>
    </form>
</div>

<script>
    const subtotal = {{ $tutor['price'] }};

    const formatRupiah = (n) =>
        new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 })
            .format(n).replace('Rp', 'Rp ').trim();

    const voucherSelect    = document.getElementById('voucherSelect');
    const voucherAmountEl  = document.getElementById('voucherAmount');
    const totalAmountEl    = document.getElementById('totalAmount');
    const inputTotal       = document.getElementById('input-total');
    const inputVoucher     = document.getElementById('input-voucher');

    voucherSelect.addEventListener('change', function () {
        const opt      = this.options[this.selectedIndex];
        const type     = opt.dataset.type;
        const val      = parseFloat(opt.dataset.val || 0);
        let discount   = 0;

        if (type === 'persen') discount = Math.round(subtotal * val / 100);
        if (type === 'flat')   discount = val;

        const total = subtotal - discount;
        voucherAmountEl.textContent = `- ${formatRupiah(discount)}`;
        totalAmountEl.textContent   = formatRupiah(total);
        inputTotal.value            = total;
        inputVoucher.value          = this.value;
    });

    const fileInput       = document.getElementById('dropzone-file');
    const fileNameDisplay = document.getElementById('file-name-display');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files.length > 0) {
            fileNameDisplay.querySelector('span').textContent = this.files[0].name;
            fileNameDisplay.classList.remove('hidden');
            document.getElementById('file-error').classList.add('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    });

    document.getElementById('confirmPaymentButton').addEventListener('click', function (e) {
        if (!fileInput.files || fileInput.files.length === 0) {
            e.preventDefault();
            const err = document.getElementById('file-error');
            err.classList.remove('hidden');
            err.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

@endsection
