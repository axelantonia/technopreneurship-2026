@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="{{ route('tutors') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-primary transition-colors mb-8 group">
        <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Tutor
    </a>

    <div class="flex flex-col lg:flex-row gap-12">

        {{-- ── KIRI: Info Tutor ── --}}
        <div class="flex-1">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor['name']) }}&background={{ $tutor['color'] }}&color=fff&size=150"
                     class="w-32 h-32 rounded-full shadow-lg ring-4 ring-surface" alt="{{ $tutor['name'] }}">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-dark mb-2">
                        {{ $tutor['name'] }} <i class="bi bi-patch-check-fill text-primary"></i>
                    </h2>
                    <p class="text-lg text-gray-600 mb-3 font-medium">{{ $tutor['jurusan'] }}, {{ $tutor['kampus'] }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                        <div class="inline-flex items-center bg-yellow-50 text-yellow-700 px-4 py-1.5 rounded-xl text-sm font-bold border border-yellow-100">
                            <i class="bi bi-star-fill mr-1.5"></i> {{ $tutor['rating'] }} <span class="mx-2 text-yellow-400">•</span> {{ $tutor['reviews'] }} Review
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
                <p class="text-gray-600 leading-relaxed">{{ $tutor['bio'] }}</p>
            </section>

            <section class="mb-10">
                <h5 class="text-xl font-extrabold text-dark mb-4">Mata Kuliah yang Dikuasai</h5>
                <div class="flex flex-wrap gap-3">
                    @foreach($tutor['matkul'] as $mk)
                        <span class="bg-surface text-primary px-4 py-2 rounded-xl text-sm font-bold border border-secondary shadow-sm">{{ $mk }}</span>
                    @endforeach
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-6">
                    <h5 class="text-xl font-extrabold text-dark">Apa Kata Mereka?</h5>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-secondary shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-surface border border-secondary flex items-center justify-center font-bold text-primary text-lg">A</div>
                            <div>
                                <h6 class="font-bold text-dark text-sm">Andi (Mahasiswa 2024)</h6>
                                <div class="text-yellow-400 text-xs flex gap-0.5 mt-1">
                                    @for($i=0;$i<5;$i++)<i class="bi bi-star-fill"></i>@endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Penjelasannya enak banget, sabar ngajarin dari nol. UTS kemaren langsung dapet nilai bagus!
                    </p>
                </div>
            </section>
        </div>

        {{-- ── KANAN: Booking Card ── --}}
        <div class="w-full lg:w-[450px]">
            <div class="bg-white rounded-3xl border border-secondary shadow-xl p-8 sticky top-10">
                <div class="mb-6 border-b border-secondary pb-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tarif Mengajar</p>
                    <h4 class="text-4xl font-black text-dark">
                        Rp {{ number_format($tutor['price'], 0, ',', '.') }}<span class="text-sm font-bold text-gray-400">/jam</span>
                    </h4>
                </div>

                <form action="{{ route('checkout') }}" method="GET" class="space-y-6">
                    <input type="hidden" name="tutor_id" value="{{ $tutor['id'] }}">

                    <div>
                        <label class="block text-xs font-bold text-dark mb-3">Pilih Mata Kuliah</label>
                        <select name="matkul" class="w-full bg-surface border border-secondary rounded-xl py-3.5 px-4 text-sm text-gray-700 font-medium focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                            @foreach($tutor['matkul'] as $mk)
                                <option value="{{ $mk }}">{{ $mk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-xs font-bold text-dark">Pilih Jadwal Tersedia</label>
                        </div>

                        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide snap-x">
                            @foreach($tutor['jadwal'] as $data)
                            <div class="flex-shrink-0 w-20 snap-center">
                                <div class="text-center mb-3">
                                    <p class="text-[10px] font-bold text-gray-400">{{ $data['day'] }}</p>
                                    <p class="text-lg font-extrabold text-dark">{{ $data['date'] }}</p>
                                </div>
                                <div class="space-y-2">
                                    @foreach($data['slots'] as $time)
                                    <label class="block cursor-pointer">
                                        <input type="radio" name="jadwal" class="peer hidden"
                                               value="{{ $data['day'] }}, {{ $data['date'] }} Jul {{ $time }} WIB">
                                        <div class="py-2.5 rounded-xl border border-secondary bg-surface text-gray-600 text-center transition-all hover:border-primary peer-checked:bg-primary peer-checked:border-primary peer-checked:text-white peer-checked:shadow-md">
                                            <p class="text-[11px] font-bold">{{ $time }}</p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p id="jadwal-error" class="text-red-500 text-xs mt-2 hidden">Pilih jadwal terlebih dahulu.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-dark mb-3">Metode Pertemuan</label>
                        <select name="metode" class="w-full bg-surface border border-secondary rounded-xl py-3.5 px-4 text-sm text-gray-700 font-medium focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                            @foreach($tutor['modes'] as $mode)
                                @if($mode === 'Online')
                                    <option value="Online (GMeet / Zoom)">Online (GMeet / Zoom)</option>
                                @else
                                    <option value="Offline (Tatap Muka)">Offline (Tatap Muka)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-surface p-4 rounded-2xl flex gap-3 border border-secondary items-start">
                        <i class="bi bi-lightning-charge-fill text-primary mt-0.5"></i>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong class="text-dark">Fast Response:</strong> Tutor ini biasanya merespon dalam waktu kurang dari 3 jam.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('chat') }}" class="w-14 h-[56px] bg-primary hover:bg-primary-hover text-white rounded-xl flex items-center justify-center transition-all shadow-lg shadow-blue-200 active:scale-95">
                            <i class="bi bi-chat-dots-fill text-lg"></i>
                        </a>
                        <button type="submit" id="btn-book"
                            class="flex-1 bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-blue-200 active:scale-95">
                            Book Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<a href="{{ route('chat') }}"
   class="fixed bottom-6 right-6 w-12 h-12 bg-surface border border-secondary rounded-2xl shadow-md flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:shadow-lg transition">
    <i class="bi bi-chat-dots-fill text-lg"></i>
</a>

<script>
    document.getElementById('btn-book').addEventListener('click', function (e) {
        const selected = document.querySelector('input[name="jadwal"]:checked');
        if (!selected) {
            e.preventDefault();
            const err = document.getElementById('jadwal-error');
            err.classList.remove('hidden');
            err.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
