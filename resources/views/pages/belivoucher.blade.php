@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-b from-blue-50 via-white to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-blue-950 tracking-tight">
                Tukar Poin Jadi Voucher 🎁
            </h1>
            <p class="text-gray-500 mt-2 max-w-2xl mx-auto">
                Gunakan poin yang kamu kumpulkan dari aktivitas belajar untuk mendapatkan potongan biaya sesi tutor.
                Semakin sering belajar, semakin besar reward yang bisa kamu klaim.
            </p>
        </div>

        <!-- BALANCE -->
        <div class="bg-white border border-blue-100 shadow-sm rounded-3xl p-6 mb-10 flex flex-col md:flex-row justify-between items-center gap-6">

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-primary text-2xl">
                    <i class="bi bi-coin"></i>
                </div>

                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Total Poin Kamu</p>
                    <h2 class="text-3xl font-extrabold text-amber-500">2,450</h2>
                </div>
            </div>

            <div class="text-sm text-gray-500 text-center md:text-right">
                Tukarkan poin untuk menghemat biaya belajar kamu <br>
                <span class="text-primary font-semibold">Reward aktif berdasarkan aktivitas belajar</span>
            </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- 1 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">Diskon Sesi 10%</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Potongan langsung 10% untuk semua sesi tutor. Cocok untuk kamu yang sering belajar rutin.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 400
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

            <!-- 2 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">Voucher Rp10.000</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Potongan langsung Rp10.000 untuk 1 sesi belajar. Ideal untuk sesi singkat atau review materi.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 800
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

            <!-- 3 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">Voucher Rp25.000</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Diskon menengah untuk sesi belajar intensif atau tugas besar yang butuh banyak waktu.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 1400
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

            <!-- 4 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">Voucher Rp50.000</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Diskon besar untuk kelas intensif atau persiapan ujian penting.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 2200
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

            <!-- 5 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">1x Sesi Gratis</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Dapatkan 1 sesi belajar gratis dengan tutor pilihan untuk first time user reward.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 3000
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

            <!-- 6 -->
            <div class="bg-white rounded-3xl border border-blue-100 shadow-sm hover:shadow-lg transition p-6">

                <h3 class="text-lg font-extrabold text-blue-950">Voucher Prioritas Booking</h3>
                <p class="text-gray-500 text-sm mt-2">
                    Prioritas memilih jadwal tutor favorit tanpa antre. Cocok saat jadwal tutor padat.
                </p>

                <div class="mt-6 flex justify-between items-center">
                    <span class="text-amber-500 font-extrabold flex items-center gap-1">
                        <i class="bi bi-coin"></i> 1800
                    </span>
                    <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary-hover">
                        Tukar
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
