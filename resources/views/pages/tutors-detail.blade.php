@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="{{ route('tutors') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-primary transition-colors mb-8 group">
        <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Tutor
    </a>

    <div class="flex flex-col lg:flex-row gap-12">

        <div class="flex-1">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff&size=150"
                     class="w-32 h-32 rounded-full shadow-lg ring-4 ring-surface" alt="Tutor">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-dark mb-2">
                        Budi Santoso <i class="bi bi-patch-check-fill text-primary"></i>
                    </h2>
                    <p class="text-lg text-gray-600 mb-3 font-medium">Informatika, Universitas Kristen Petra | Asdos Algoritma 2023</p>

                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                        <div class="inline-flex items-center bg-yellow-50 text-yellow-700 px-4 py-1.5 rounded-xl text-sm font-bold border border-yellow-100">
                            <i class="bi bi-star-fill mr-1.5"></i> 4.8 <span class="mx-2 text-yellow-400">•</span> 24 Review
                        </div>
                        <div class="inline-flex items-center bg-green-50 text-green-700 px-4 py-1.5 rounded-xl text-sm font-bold border border-green-100">
                            <i class="bi bi-check-circle-fill mr-1.5"></i> Terverifikasi
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-secondary mb-10">

            <section class="mb-10">
                <h5 class="text-xl font-extrabold text-dark mb-4">Tentang Saya</h5>
                <div class="prose prose-blue text-gray-600 leading-relaxed max-w-none">
                    <p>Halo! Saya Budi, mahasiswa tingkat akhir <strong class="text-dark">Informatika Petra</strong> yang sering dipercaya menjadi asisten dosen untuk mata kuliah pemrograman dasar. Fokus utama saya adalah membantu teman-teman mahasiswa yang merasa kesulitan di awal belajar koding.</p>
                    <p class="mt-2">Saya punya metode pengajaran yang santai, menggunakan perumpamaan sehari-hari agar logika pemrograman yang sulit jadi lebih gampang dicerna. <em class="text-dark">No more stress</em> sama tugas Laravel!</p>
                </div>
            </section>

            <section class="mb-10">
                <h5 class="text-xl font-extrabold text-dark mb-4">Mata Kuliah yang Dikuasai</h5>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-surface text-primary px-4 py-2 rounded-xl text-sm font-bold border border-secondary shadow-sm">Algoritma Pemrograman</span>
                    <span class="bg-surface text-primary px-4 py-2 rounded-xl text-sm font-bold border border-secondary shadow-sm">Basis Data MySQL</span>
                    <span class="bg-surface text-primary px-4 py-2 rounded-xl text-sm font-bold border border-secondary shadow-sm">Web Development (Laravel)</span>
                    <span class="bg-surface text-primary px-4 py-2 rounded-xl text-sm font-bold border border-secondary shadow-sm">Struktur Data</span>
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-6">
                    <h5 class="text-xl font-extrabold text-dark">Apa Kata Mereka?</h5>
                    <button class="text-primary text-sm font-bold hover:text-primary-hover hover:underline transition-colors">Lihat Semua</button>
                </div>

                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-3xl border border-secondary shadow-sm transition hover:shadow-md hover:border-blue-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-surface border border-secondary flex items-center justify-center font-bold text-primary text-lg">A</div>
                                <div>
                                    <h6 class="font-bold text-dark text-sm">Andi (SI 2024)</h6>
                                    <div class="text-yellow-400 text-xs flex gap-0.5 mt-1">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold bg-surface border border-secondary text-gray-500 px-3 py-1.5 rounded-lg uppercase">UTS Season</span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Penjelasannya enak banget, sabar ngajarin aku yang bener-bener 0 di Laravel. UTS kemaren langsung dapet A! Thanks kak Budi.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="w-full lg:w-[450px]">
            <div class="bg-white rounded-3xl border border-secondary shadow-xl p-8 sticky top-10">
                <div class="mb-6 border-b border-secondary pb-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tarif Mengajar</p>
                    <h4 class="text-4xl font-black text-dark">Rp 65.000<span class="text-sm font-bold text-gray-400">/jam</span></h4>
                </div>

                <form action="#" class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-dark mb-3">Pilih Mata Kuliah</label>
                        <select class="w-full bg-surface border border-secondary rounded-xl py-3.5 px-4 text-sm text-gray-700 font-medium focus:ring-2 focus:ring-primary focus:outline-none transition-all cursor-pointer">
                            <option>Web Development (Laravel)</option>
                            <option>Basis Data MySQL</option>
                        </select>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-xs font-bold text-dark">Pilih Jadwal Tersedia</label>
                            <div class="flex gap-2">
                                <button type="button" class="w-6 h-6 rounded-md bg-surface text-gray-500 hover:bg-primary hover:text-white transition-colors flex items-center justify-center"><i class="bi bi-chevron-left text-xs"></i></button>
                                <button type="button" class="w-6 h-6 rounded-md bg-surface text-gray-500 hover:bg-primary hover:text-white transition-colors flex items-center justify-center"><i class="bi bi-chevron-right text-xs"></i></button>
                            </div>
                        </div>

                        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide snap-x">
                            @php
                                $weekData = [
                                    ['day' => 'SEN', 'date' => '14', 'slots' => ['09:00', '13:00']],
                                    ['day' => 'SEL', 'date' => '15', 'slots' => ['11:00', '15:00']],
                                    ['day' => 'RAB', 'date' => '16', 'slots' => ['13:00', '19:00']],
                                    ['day' => 'KAM', 'date' => '17', 'slots' => ['09:00']],
                                    ['day' => 'JUM', 'date' => '18', 'slots' => ['10:00', '15:00']],
                                ];
                            @endphp

                            @foreach($weekData as $data)
                            <div class="flex-shrink-0 w-20 snap-center">
                                <div class="text-center mb-3">
                                    <p class="text-[10px] font-bold text-gray-400">{{ $data['day'] }}</p>
                                    <p class="text-lg font-extrabold text-dark">{{ $data['date'] }}</p>
                                </div>

                                <div class="space-y-2">
                                    @foreach($data['slots'] as $time)
                                    <label class="block cursor-pointer">
                                        <input type="radio" name="slot" class="peer hidden" value="{{ $data['date'] }}-{{ $time }}">
                                        <div class="py-2.5 rounded-xl border border-secondary bg-surface text-gray-600 text-center transition-all hover:border-primary peer-checked:bg-primary peer-checked:border-primary peer-checked:text-white peer-checked:shadow-md">
                                            <p class="text-[11px] font-bold">{{ $time }}</p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-dark mb-3">Metode Pertemuan</label>
                        <select class="w-full bg-surface border border-secondary rounded-xl py-3.5 px-4 text-sm text-gray-700 font-medium focus:ring-2 focus:ring-primary focus:outline-none transition-all cursor-pointer">
                            <option>Online (GMeet / Zoom)</option>
                            <option>Offline (Tatap Muka)</option>
                        </select>
                    </div>

                    <div class="bg-surface p-4 rounded-2xl flex gap-3 border border-secondary items-start">
                        <i class="bi bi-lightning-charge-fill text-primary mt-0.5"></i>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong class="text-dark">Fast Response:</strong> Tutor ini biasanya merespon dalam waktu kurang dari 3 jam.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('chat') }}"class="w-14 h-[56px] bg-primary hover:bg-primary-hover text-white rounded-xl flex items-center justify-center transition-all shadow-lg shadow-blue-200 active:scale-95">
                            <i class="bi bi-chat-dots-fill text-lg"></i>
                        </a>

                        <button type="submit"
                            formaction="{{ route('checkout') }}"
                            formmethod="GET"
                            class="flex-1 bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-blue-200 active:scale-95">

                            Book Sekarang
                        </button>
                    </div>
                </form>
            </div>x
        </div>
    </div>
</div>
<a href="{{ route('chat') }}"
   class="fixed bottom-6 right-6 w-12 h-12 bg-surface border border-secondary rounded-2xl shadow-md flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:shadow-lg transition">

    <i class="bi bi-chat-dots-fill text-lg"></i>

</a>

<style>
    /* Styling scrollbar disembunyikan supaya jadwal bisa di geser secara rapi */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
