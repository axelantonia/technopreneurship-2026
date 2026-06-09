@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Checkout Booking</h1>
        <p class="text-gray-500 text-sm mt-1">
            Selesaikan pembayaran untuk mengkonfirmasi jadwal tutor kamu
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-5">Data Kamu</h2>
                <div class="space-y-4">
                    <input type="text" placeholder="Nama Lengkap"
                        class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                    <input type="email" placeholder="Email"
                        class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                </div>
            </div>

            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-5">Detail Booking</h2>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Tutor</span>
                        <span class="font-bold text-dark">Budi Santoso</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Mata Kuliah</span>
                        <span class="font-bold text-dark">Web Development (Laravel)</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jadwal</span>
                        <span class="font-bold text-dark">Rabu, 16:00 WIB</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Durasi</span>
                        <span class="font-bold text-dark">1 Jam</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-4">Voucher Saya</h2>
                <select id="voucherSelect" class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none text-sm font-medium">
                    <option value="">Pilih voucher</option>
                    <option value="NEWUSER">NEWUSER - Diskon 10%</option>
                    <option value="HEMAT10">HEMAT10 - Potongan Rp10.000</option>
                    <option value="TUTOR5">TUTOR5 - Diskon 5%</option>
                </select>
                <p class="text-xs text-gray-400 mt-2">
                    Voucher akan otomatis dipotong dari total pembayaran
                </p>
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

                <label class="block text-sm font-bold mb-3 text-dark">
                    Upload Bukti Pembayaran
                </label>

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" id="dropzone-label" class="flex flex-col items-center justify-center w-full h-36 border-2 border-secondary border-dashed rounded-xl cursor-pointer bg-surface hover:border-primary transition-colors relative overflow-hidden group">
                        
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

                        <input id="dropzone-file" type="file" class="hidden" accept=".png, .jpg, .jpeg, .pdf" />
                    </label>
                </div>

            </div>
        </div>

        <div class="bg-white border border-secondary rounded-3xl p-6 shadow-xl sticky top-10 h-fit">
            <h2 class="text-lg font-bold mb-5">Ringkasan</h2>

            <div class="space-y-3 text-sm text-gray-600 border-b pb-5">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp 65.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Voucher</span>
                    <span id="voucherAmount" class="text-green-500 font-bold">- Rp 0</span>
                </div>
                <div class="flex justify-between font-extrabold text-lg pt-3 border-t text-dark">
                    <span>Total</span>
                    <span id="totalAmount" class="text-primary">Rp 65.000</span>
                </div>
            </div>

            <button class="w-full mt-6 bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-xl shadow-lg active:scale-95 transition-all">
                Konfirmasi Pembayaran
            </button>

            <p class="text-[11px] text-gray-400 text-center mt-3 leading-relaxed">
                Pastikan bukti pembayaran jelas agar segera diverifikasi admin
            </p>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. LOGIKA VOUCHER & TOTAL
        const voucherSelect = document.getElementById('voucherSelect');
        const voucherAmountEl = document.getElementById('voucherAmount');
        const totalAmountEl = document.getElementById('totalAmount');
        
        const subtotal = 65000;
        
        // Fungsi helper untuk format ke bentuk Rupiah (Rp XX.XXX)
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0 
            }).format(number).replace('Rp', 'Rp ').trim();
        };

        voucherSelect.addEventListener('change', function() {
            let discount = 0;
            const code = this.value;

            // Aturan diskon sesuai permintaan
            if (code === 'NEWUSER') {
                discount = 6500; // 10% dari 65.000
            } else if (code === 'HEMAT10') {
                discount = 10000; // Flat Rp 10.000
            } else if (code === 'TUTOR5') {
                discount = 3250; // 5% dari 65.000
            }

            const total = subtotal - discount;

            // Update DOM di bagian Ringkasan
            voucherAmountEl.innerText = `- ${formatRupiah(discount)}`;
            totalAmountEl.innerText = formatRupiah(total);
        });

        // 2. LOGIKA UPLOAD FILE UI
        const fileInput = document.getElementById('dropzone-file');
        const fileNameDisplay = document.getElementById('file-name-display');
        const fileNameText = fileNameDisplay.querySelector('span');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                // Ambil nama file dan potong jika terlalu panjang
                const file = this.files[0];
                fileNameText.innerText = file.name;
                // Tampilkan overlay hijau dengan nama file
                fileNameDisplay.classList.remove('hidden');
            } else {
                // Sembunyikan jika batal memilih file
                fileNameDisplay.classList.add('hidden');
            }
        });
    });
</script>

@endsection