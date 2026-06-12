@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-dark">Checkout Booking</h1>
        <p class="text-gray-500 text-sm mt-1">
            Selesaikan pembayaran untuk mengkonfirmasi jadwal tutor kamu
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-6">

            <!-- DATA DIRI -->
            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-5">Data Kamu</h2>

                <div class="space-y-4">
                    <input type="text" placeholder="Nama Lengkap"
                        class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">

                    <input type="email" placeholder="Email"
                        class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                </div>
            </div>

            <!-- DETAIL BOOKING -->
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

            <!-- VOUCHER DROPDOWN -->
            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-4">Voucher Saya</h2>

                <select class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none text-sm font-medium">
                    <option value="">Pilih voucher</option>
                    <option value="NEWUSER">NEWUSER - Diskon 10%</option>
                    <option value="HEMAT10">HEMAT10 - Potongan Rp10.000</option>
                    <option value="TUTOR5">TUTOR5 - Diskon 5%</option>
                </select>

                <p class="text-xs text-gray-400 mt-2">
                    Voucher akan otomatis dipotong dari total pembayaran
                </p>
            </div>

            <!-- PAYMENT TRANSFER -->
            <div class="bg-white border border-secondary rounded-3xl p-6 shadow-sm">

                <h2 class="text-lg font-bold mb-4">Transfer Pembayaran</h2>

                <!-- REKENING -->
                <div class="bg-surface border border-secondary rounded-2xl p-4 mb-5">
                    <p class="text-xs text-gray-400 mb-1">Transfer ke rekening</p>
                    <p class="text-lg font-extrabold text-dark">Tutorium Official</p>

                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                        <p>Bank BCA</p>
                        <p class="font-bold text-dark">123-456-7890</p>
                        <p>a.n Tutorium Indonesia</p>
                    </div>
                </div>

                <!-- UPLOAD BUKTI -->
                <label class="block text-sm font-bold mb-2 text-dark">
                    Upload Bukti Pembayaran
                </label>

                <input type="file"
                    class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white hover:file:bg-primary-hover">
            </div>

        </div>

        <!-- RIGHT SUMMARY -->
        <div class="bg-white border border-secondary rounded-3xl p-6 shadow-xl sticky top-10 h-fit">

            <h2 class="text-lg font-bold mb-5">Ringkasan</h2>

            <div class="space-y-3 text-sm text-gray-600 border-b pb-5">

                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp 65.000</span>
                </div>

                <div class="flex justify-between">
                    <span>Voucher</span>
                    <span class="text-green-500 font-bold">- Rp 10.000</span>
                </div>

                <div class="flex justify-between font-extrabold text-lg pt-3 border-t text-dark">
                    <span>Total</span>
                    <span class="text-primary">Rp 55.000</span>
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

@endsection
