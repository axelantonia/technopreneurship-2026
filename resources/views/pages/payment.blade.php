@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-16 flex flex-col items-center justify-center min-h-[70vh]">

    <div class="w-24 h-24 mb-6 text-primary animate-pulse bg-surface p-5 rounded-full border border-secondary flex items-center justify-center shadow-sm">
        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>

    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-dark mb-3">Pembayaran Sedang Diverifikasi!</h1>
        <p class="text-gray-500 text-sm max-w-md mx-auto leading-relaxed">
            Terima kasih! Admin kami sedang mengecek bukti transfer kamu secara manual. Estimasi waktu verifikasi biasanya memakan waktu sekitar <span class="font-bold text-dark">15-30 menit</span>.
        </p>
    </div>

    <div class="bg-white border border-secondary rounded-3xl p-7 w-full shadow-sm mb-6 text-left">
        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-5 pb-3 border-b border-secondary/50">Detail Transaksi</h2>

        <div class="space-y-4 text-sm text-gray-600">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>ID Booking</span>
                <span class="font-bold text-dark">#{{ $bookingId }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Tutor</span>
                <span class="font-bold text-dark">{{ $tutor['name'] }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Jurusan / Kampus</span>
                <span class="font-bold text-dark">{{ $tutor['jurusan'] }}, {{ $tutor['kampus'] }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Mata Kuliah</span>
                <span class="font-bold text-dark">{{ $matkul }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Jadwal</span>
                <span class="font-bold text-dark">{{ $jadwal }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Metode</span>
                <span class="font-bold text-dark">{{ $metode }}</span>
            </div>
            @if($voucher)
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <span>Voucher</span>
                <span class="font-bold text-green-600">{{ $voucher }}</span>
            </div>
            @endif
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1 pt-3 border-t border-secondary/50 mt-2">
                <span>Total Dibayar</span>
                <span class="font-extrabold text-primary text-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="bg-surface border border-secondary rounded-2xl p-5 w-full flex items-start gap-4 mb-10 shadow-sm">
        <div class="mt-0.5 text-primary">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-dark text-sm mb-1">Langkah Selanjutnya</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                Setelah pembayaran sukses diverifikasi, link Google Meet dan akses chat penuh dengan tutor akan otomatis aktif. Pemberitahuan akan dikirimkan langsung ke WhatsApp dan Email kamu.
            </p>
        </div>
    </div>

    <a href="{{ route('tutors') }}" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-hover transition-all shadow-lg shadow-blue-200 mb-6">
        Cari Tutor Lain
    </a>

    <p class="text-xs text-gray-400 text-center max-w-md mx-auto leading-relaxed">
        Jika dalam 30 menit status belum berubah atau kamu butuh bantuan darurat, silakan hubungi WhatsApp Customer Service Tutorium di <span class="font-medium text-gray-500">+62 812-3456-7890</span>.
    </p>

</div>

@endsection
