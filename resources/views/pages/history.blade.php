@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900">Riwayat Sesi Les</h1>
        <p class="mt-2 text-gray-600">Simulasi riwayat sesi untuk mahasiswa (prototype tanpa database).</p>
    </div>

    <div class="space-y-4">
        @php
            $riwayat = [
                [
                    'id' => '#TRM-1024',
                    'tutor' => ['name' => 'Nadia Putri', 'photo' => '/assets/img/Grab.jpg'],
                    'course' => 'UI/UX Design',
                    'date' => '2026-05-18',
                    'time' => '14:00 - 15:30',
                    'fee' => 250000,
                    'status' => 'Selesai',
                ],
                [
                    'id' => '#TRM-1041',
                    'tutor' => ['name' => 'Rizky Hidayat', 'photo' => '/assets/img/Indomie.jpg'],
                    'course' => 'Laravel Web',
                    'date' => '2026-06-02',
                    'time' => '16:00 - 17:30',
                    'fee' => 300000,
                    'status' => 'Menunggu Kelas',
                ],
                [
                    'id' => '#TRM-1060',
                    'tutor' => ['name' => 'Salsabila Azzahra', 'photo' => '/assets/img/yamie.jpg'],
                    'course' => 'Fundamental Programming',
                    'date' => '2026-04-10',
                    'time' => '10:00 - 11:00',
                    'fee' => 180000,
                    'status' => 'Dibatalkan',
                ],
            ];

            $formatRupiah = function ($amount) {
                return 'Rp' . number_format($amount, 0, ',', '.');
            };

            $statusBadge = function ($status) {
                return match ($status) {
                    'Selesai' => 'bg-green-50 text-green-700 border-green-200',
                    'Menunggu Kelas' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'Dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                    default => 'bg-gray-50 text-gray-700 border-gray-200',
                };
            };
        @endphp

        @foreach ($riwayat as $row)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">
                        <img class="w-full h-full object-cover" src="{{ $row['tutor']['photo'] }}" alt="Foto Tutor">
                    </div>

                    <div class="flex-1">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <div class="text-sm font-medium text-gray-500">ID Sesi</div>
                                <div class="text-base font-semibold text-gray-900">{{ $row['id'] }}</div>
                            </div>

                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold border {{ $statusBadge($row['status']) }}">
                                    {{ $row['status'] }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <div class="text-sm font-medium text-gray-500">Tutor</div>
                                <div class="text-base font-semibold text-gray-900">{{ $row['tutor']['name'] }}</div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-500">Mata Kuliah</div>
                                <div class="text-base font-semibold text-gray-900">{{ $row['course'] }}</div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-500">Tanggal & Jam</div>
                                <div class="text-base font-semibold text-gray-900">{{ $row['date'] }} • {{ $row['time'] }}</div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-500">Total Biaya</div>
                                <div class="text-base font-semibold text-gray-900">{{ $formatRupiah($row['fee']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

