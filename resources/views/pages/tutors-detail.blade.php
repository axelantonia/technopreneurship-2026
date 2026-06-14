@extends('layouts.app')

@section('content')
@php
// ── Mock reviews for this tutor (in production: query from DB based on tutor['id']) ──
$reviews = [
    ['id'=>1,'name'=>'Andi Pratama','univ'=>'Universitas Kristen Petra','rating'=>5,'matkul'=>'Web Development (Laravel)','tanggal'=>'12 Jun 2026','comment'=>'Penjelasannya enak banget, sabar ngajarin dari nol. UTS kemaren langsung dapet nilai bagus!','nilai_sebelum'=>'65','nilai_sesudah'=>'88','reply'=>null],
    ['id'=>2,'name'=>'Siska Amelia','univ'=>'Universitas Surabaya','rating'=>5,'matkul'=>'Basis Data MySQL','tanggal'=>'10 Jun 2026','comment'=>'Kak Budi ngejelasin JOIN tabel pakai analogi buku perpustakaan, langsung nyantol di otak! Recommended banget.','nilai_sebelum'=>null,'nilai_sesudah'=>null,'reply'=>'Terima kasih Siska! Senang bisa membantu 😊'],
    ['id'=>3,'name'=>'Reza Mahendra','univ'=>'ITS','rating'=>5,'matkul'=>'Web Development (Laravel)','tanggal'=>'5 Jun 2026','comment'=>'Dari yang bingung routing Laravel, sekarang udah bisa bikin CRUD sendiri dalam 2 sesi. Mantap!','nilai_sebelum'=>'45','nilai_sesudah'=>'82','reply'=>null],
    ['id'=>4,'name'=>'Monica Setiawan','univ'=>'Universitas Surabaya','rating'=>4,'matkul'=>'Algoritma Pemrograman','tanggal'=>'1 Jun 2026','comment'=>'Penjelasannya sistematis, cuma agak cepat di bagian rekursi. Tapi overall puas dan worth it!','nilai_sebelum'=>null,'nilai_sesudah'=>null,'reply'=>null],
    ['id'=>5,'name'=>'Dita Andini','univ'=>'UNAIR','rating'=>5,'matkul'=>'Struktur Data','tanggal'=>'28 Mei 2026','comment'=>'Keren banget! Linked list dan BST yang dulu bikin pusing sekarang udah paham. Makasih kak!','nilai_sebelum'=>'58','nilai_sesudah'=>'90','reply'=>null],
    ['id'=>6,'name'=>'Kevin Aditya','univ'=>'UK Petra','rating'=>5,'matkul'=>'Basis Data MySQL','tanggal'=>'22 Mei 2026','comment'=>'Metode ngajarnya pakai analogi sehari-hari, jadi konsep abstrak terasa nyata. Sesi ke-3 aku udah bisa bikin ERD sendiri.','nilai_sebelum'=>null,'nilai_sesudah'=>null,'reply'=>null],
    ['id'=>7,'name'=>'Hendra Wijaya','univ'=>'UBAYA','rating'=>4,'matkul'=>'Algoritma Pemrograman','tanggal'=>'18 Mei 2026','comment'=>'Dapet banyak tips ngerjain soal UTS. Explanation complexity analysis jadi lebih gampang dimengerti.','nilai_sebelum'=>'70','nilai_sesudah'=>'85','reply'=>null],
    ['id'=>8,'name'=>'Alya Ramadhani','univ'=>'UNAIR','rating'=>5,'matkul'=>'Web Development (Laravel)','tanggal'=>'14 Mei 2026','comment'=>'Luar biasa! Kak Budi ngajarin Eloquent ORM dengan cara yang super simpel. Sekarang aku pede bikin project sendiri.','nilai_sebelum'=>null,'nilai_sesudah'=>null,'reply'=>null],
];

$totalReview  = count($reviews);
$avgRating    = $totalReview > 0 ? round(array_sum(array_column($reviews,'rating')) / $totalReview, 1) : 0;
$dist         = [5=>0,4=>0,3=>0,2=>0,1=>0];
foreach ($reviews as $r) $dist[$r['rating']]++;
$bintang45    = $dist[5] + $dist[4];

// ── Tutor of The Month ranks (reuse data from home page, not duplicate) ──
// Only Budi (id:1), Siska (id:5), Kevin (id:4) have ranks in homepage
// Tutor of The Month ranks (from homepage data, single source of truth)
$tutorRanks = [1=>1, 4=>2, 5=>3, 6=>4]; // tutor_id => rank
$monthRank  = $tutorRanks[$tutor['id']] ?? null;

// ── Simulasi: apakah user login punya sesi selesai dengan tutor ini? ──
$hasCompletedSession = true; // ganti dengan logic DB nantinya
$alreadyReviewed     = false; // ganti dengan cek DB
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <a href="{{ route('tutors') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-primary transition-colors mb-8 group">
        <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Tutor
    </a>

    <div class="flex flex-col lg:flex-row gap-12">

        {{-- ═══ KIRI: Info Tutor ═══ --}}
        <div class="flex-1">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10">
                <img src="{{ asset('assets/img/profil-' . $tutor['profil'] . '.jpg') }}"
                     class="w-32 h-32 object-cover rounded-full shadow-lg ring-4 ring-surface"
                     alt="{{ $tutor['name'] }}">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-dark mb-2">
                        {{ $tutor['name'] }}
                        <i class="bi bi-patch-check-fill text-primary"></i>
                        {{-- Badge Tutor of The Month --}}
                        @if($monthRank)
                            <span class="inline-flex items-center gap-1.5 text-sm bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-1 rounded-xl font-bold ml-1 align-middle">
                                🏆 Tutor of The Month #{{ $monthRank }}
                            </span>
                        @endif
                    </h2>
                    <p class="text-lg text-gray-600 mb-3 font-medium">{{ $tutor['jurusan'] }}, {{ $tutor['kampus'] }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                        <div class="inline-flex items-center bg-yellow-50 text-yellow-700 px-4 py-1.5 rounded-xl text-sm font-bold border border-yellow-100">
                            <i class="bi bi-star-fill mr-1.5"></i> {{ $tutor['rating'] }} <span class="mx-2 text-yellow-400">•</span> {{ $totalReview }} Ulasan
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

            {{-- ════════════════════════════════════════════
                 ULASAN DARI MURID
            ════════════════════════════════════════════ --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h5 class="text-xl font-extrabold text-dark">Ulasan dari Murid</h5>
                </div>

                {{-- ── SUMMARY CARD ── --}}
                <div class="bg-white rounded-3xl border border-secondary shadow-sm p-6 md:p-8 mb-8" id="summary-card">
                    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">
                        {{-- Avg rating besar --}}
                        <div class="text-center flex-shrink-0">
                            <p class="text-6xl font-extrabold text-dark leading-none" id="avg-rating">{{ number_format($avgRating, 1) }}</p>
                            <div class="flex justify-center gap-0.5 mt-2 text-yellow-400 text-lg" id="avg-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-400 mt-2" id="avg-label">dari <span id="total-ulasan">{{ $totalReview }}</span> ulasan</p>
                        </div>

                        <div class="w-px bg-secondary hidden lg:block self-stretch"></div>

                        {{-- 5 baris breakdown --}}
                        <div class="flex-1 w-full space-y-2.5">
                            @foreach([5,4,3,2,1] as $star)
                            @php $pct = $totalReview > 0 ? round($dist[$star] / $totalReview * 100) : 0; @endphp
                            <div class="flex items-center gap-3 text-sm">
                                <span class="w-10 text-xs font-semibold text-gray-500 flex items-center gap-1 flex-shrink-0">
                                    {{ $star }} <i class="bi bi-star-fill text-yellow-400 text-[10px]"></i>
                                </span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="h-2.5 rounded-full bg-yellow-400 transition-all duration-500 star-bar" data-pct="{{ $pct }}" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="w-6 text-xs text-gray-400 text-right" id="dist-{{ $star }}">{{ $dist[$star] }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="w-px bg-secondary hidden lg:block self-stretch"></div>

                        {{-- Cards kanan --}}
                        <div class="flex-shrink-0 space-y-3">
                            <div class="bg-surface border border-secondary rounded-2xl p-4 text-center min-w-[130px]">
                                <p class="text-2xl font-extrabold text-dark" id="total-review-count">{{ $totalReview }}</p>
                                <p class="text-[11px] text-gray-500 mt-1">Total Ulasan</p>
                            </div>
                            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                                <p class="text-2xl font-extrabold text-green-700" id="bintang-45">{{ $bintang45 }}</p>
                                <p class="text-[11px] text-green-600 mt-1">Bintang 4-5 ⭐</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── FILTER PILLS ── --}}
                <div class="flex flex-wrap gap-2 mb-6" id="filter-pills">
                    <button onclick="filterReviews('all', this)"
                            class="filter-pill active px-4 py-2 rounded-xl text-xs font-bold bg-primary text-white border border-primary transition-all">
                        Semua (<span id="filter-all-count">{{ $totalReview }}</span>)
                    </button>
                    @foreach([5,4,3,2,1] as $star)
                    <button onclick="filterReviews({{ $star }}, this)"
                            class="filter-pill px-4 py-2 rounded-xl text-xs font-bold bg-white text-gray-600 border border-secondary hover:border-primary hover:text-primary transition-all">
                        {{ $star }}★ (<span id="filter-{{ $star }}-count">{{ $dist[$star] }}</span>)
                    </button>
                    @endforeach
                </div>

                {{-- ── REVIEW CARDS GRID ── --}}
                <div id="reviews-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                    @foreach($reviews as $r)
                    <div class="review-card bg-white border border-secondary rounded-3xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition-all"
                         data-rating="{{ $r['rating'] }}" data-id="{{ $r['id'] }}">
                        {{-- Header: avatar + nama + rating --}}
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-surface border border-secondary flex items-center justify-center font-extrabold text-primary text-base flex-shrink-0">
                                    {{ strtoupper(substr($r['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-dark text-sm">{{ $r['name'] }}</h4>
                                    <p class="text-[11px] text-gray-400">{{ $r['univ'] }}</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="flex gap-0.5 text-yellow-400 justify-end mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $r['rating'] ? 'bi-star-fill' : 'bi-star' }} text-sm"></i>
                                    @endfor
                                </div>
                                <p class="text-[10px] text-gray-400">{{ $r['tanggal'] }}</p>
                            </div>
                        </div>

                        {{-- Mata kuliah tag --}}
                        <span class="inline-block bg-surface border border-secondary text-xs font-semibold text-primary px-3 py-1 rounded-lg mb-3">
                            {{ $r['matkul'] }}
                        </span>

                        {{-- Chip nilai naik --}}
                        @if($r['nilai_sebelum'] && $r['nilai_sesudah'])
                        <div class="mb-3">
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold bg-green-50 text-green-700 border border-green-200 px-2.5 py-1 rounded-lg">
                                📈 Nilai naik: {{ $r['nilai_sebelum'] }} → {{ $r['nilai_sesudah'] }}
                            </span>
                        </div>
                        @endif

                        {{-- Comment --}}
                        <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $r['comment'] }}"</p>

                        {{-- Reply dari tutor --}}
                        @if($r['reply'])
                        <div class="mt-4 pt-4 border-t border-secondary bg-surface/50 -mx-6 -mb-6 px-6 py-4 rounded-b-3xl">
                            <p class="text-[11px] font-bold text-primary mb-1 flex items-center gap-1">
                                <i class="bi bi-reply-fill"></i> Balasan Tutor
                            </p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $r['reply'] }}</p>
                        </div>
                        @else
                        {{-- Tombol balas (untuk tutor) --}}
                        <div class="mt-4 pt-4 border-t border-secondary flex justify-end">
                            <button onclick="this.closest('.review-card').querySelector('.reply-box').classList.toggle('hidden')"
                                    class="text-xs font-semibold text-primary hover:text-primary-hover transition flex items-center gap-1">
                                <i class="bi bi-reply"></i> Balas
                            </button>
                        </div>
                        <div class="reply-box hidden mt-3">
                            <textarea rows="2" placeholder="Tulis balasan..."
                                      class="w-full bg-surface border border-secondary rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-primary transition resize-none"></textarea>
                            <button class="mt-2 text-xs bg-primary text-white px-4 py-2 rounded-xl font-bold hover:bg-primary-hover transition"
                                    onclick="sendReply(this, {{ $r['id'] }})">Kirim Balasan</button>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- ── TOMBOL "TULIS ULASAN" (hanya muncul jika user punya sesi selesai & belum review) --}}
                @if($hasCompletedSession && !$alreadyReviewed)
                <div class="text-center mb-6">
                    <button onclick="document.getElementById('review-form-section').classList.remove('hidden'); this.scrollIntoView({behavior:'smooth'});"
                            class="inline-flex items-center gap-2 bg-primary hover:bg-primary-hover text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg active:scale-95">
                        <i class="bi bi-pencil-square"></i> Tulis Ulasan
                    </button>
                </div>
                @endif

                {{-- ── FORM TULIS ULASAN ── --}}
                <div id="review-form-section" class="hidden bg-white border border-secondary rounded-3xl p-6 md:p-8 shadow-sm mb-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                            <i class="bi bi-star-fill text-white text-sm"></i>
                        </div>
                        <h5 class="text-lg font-extrabold text-dark">Tulis Ulasan</h5>
                    </div>

                    <form id="review-form" onsubmit="submitReview(event)" class="space-y-5">
                        {{-- Rating bintang --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Rating</label>
                            <div class="flex gap-2 text-3xl" id="form-star-group">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="form-star text-gray-300 hover:text-yellow-400 transition-all hover:scale-110 active:scale-95"
                                        data-val="{{ $i }}" onclick="setFormRating({{ $i }})"
                                        onmouseenter="previewFormRating({{ $i }})"
                                        onmouseleave="resetFormRating()">
                                    <i class="bi bi-star"></i>
                                </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="form-rating" value="0">
                            <p id="form-rating-label" class="text-sm font-semibold mt-1 text-primary">Klik bintang untuk memberi rating</p>
                        </div>

                        {{-- Mata kuliah --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Mata Kuliah</label>
                            <select name="matkul" id="form-matkul" required
                                    class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-primary outline-none">
                                @foreach($tutor['matkul'] as $mk)
                                    <option value="{{ $mk }}">{{ $mk }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Komentar --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Komentar</label>
                            <textarea name="comment" id="form-comment" rows="4" required
                                      class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none resize-none"
                                      placeholder="Ceritakan pengalaman belajarmu..."></textarea>
                        </div>

                        {{-- Checkbox peningkatan nilai --}}
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="show-nilai" onchange="toggleNilai()"
                                   class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary cursor-pointer">
                            <label for="show-nilai" class="text-sm font-semibold text-dark cursor-pointer select-none">
                                Tunjukkan peningkatan nilai
                            </label>
                        </div>

                        {{-- Input nilai sebelum/sesudah (hidden by default) --}}
                        <div id="nilai-fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nilai Sebelum</label>
                                <input type="number" name="nilai_sebelum" min="0" max="100" placeholder="0-100"
                                       class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nilai Sesudah</label>
                                <input type="number" name="nilai_sesudah" min="0" max="100" placeholder="0-100"
                                       class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none">
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3.5 rounded-xl transition-all shadow-lg active:scale-95">
                            <i class="bi bi-send-fill mr-2"></i>Kirim Ulasan
                        </button>
                    </form>
                </div>

            </section>
        </div>

        {{-- ═══ KANAN: Booking Card ═══ --}}
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
                        <a href="{{ route('chat', $tutor['id']) }}" class="w-14 h-[56px] bg-primary hover:bg-primary-hover text-white rounded-xl flex items-center justify-center transition-all shadow-lg shadow-blue-200 active:scale-95">
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

<a href="{{ route('chat', $tutor['id']) }}"
   class="fixed bottom-6 right-6 w-12 h-12 bg-surface border border-secondary rounded-2xl shadow-md flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:shadow-lg transition">
    <i class="bi bi-chat-dots-fill text-lg"></i>
</a>

<script>
// ═══════════════════════════════════════════════════
// BOOKING VALIDATION
// ═══════════════════════════════════════════════════
document.getElementById('btn-book')?.addEventListener('click', function (e) {
    const selected = document.querySelector('input[name="jadwal"]:checked');
    if (!selected) {
        e.preventDefault();
        const err = document.getElementById('jadwal-error');
        err.classList.remove('hidden');
        err.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// ═══════════════════════════════════════════════════
// FILTER REVIEWS (by star rating)
// ═══════════════════════════════════════════════════
function filterReviews(star, btn) {
    document.querySelectorAll('.filter-pill').forEach(b => {
        b.classList.remove('bg-primary', 'text-white', 'border-primary');
        b.classList.add('bg-white', 'text-gray-600', 'border-secondary');
    });
    btn.classList.add('bg-primary', 'text-white', 'border-primary');
    btn.classList.remove('bg-white', 'text-gray-600', 'border-secondary');

    document.querySelectorAll('.review-card').forEach(card => {
        const show = star === 'all' || parseInt(card.dataset.rating) === star;
        card.style.display = show ? '' : 'none';
    });
}

// ═══════════════════════════════════════════════════
// SEND REPLY
// ═══════════════════════════════════════════════════
function sendReply(btn, reviewId) {
    const box = btn.closest('.reply-box');
    const textarea = box.querySelector('textarea');
    if (!textarea.value.trim()) return;

    // Simulate reply save
    const card = btn.closest('.review-card');
    const replyHtml = `
        <div class="mt-4 pt-4 border-t border-secondary bg-surface/50 -mx-6 -mb-6 px-6 py-4 rounded-b-3xl">
            <p class="text-[11px] font-bold text-primary mb-1 flex items-center gap-1">
                <i class="bi bi-reply-fill"></i> Balasan Tutor
            </p>
            <p class="text-sm text-gray-600 leading-relaxed">${textarea.value}</p>
        </div>`;
    card.querySelector('.reply-box').remove();
    // Remove the "Balas" button row too
    const btnWrap = card.querySelector('.flex.justify-end');
    if (btnWrap) btnWrap.remove();
    card.insertAdjacentHTML('beforeend', replyHtml);

    // Toast
    showToast('Balasan terkirim!', 'success');
}

// ═══════════════════════════════════════════════════
// FORM STAR RATING
// ═══════════════════════════════════════════════════
let currentFormRating = 0;
const ratingLabels = {
    0: 'Klik bintang untuk memberi rating',
    1: 'Sangat Buruk 😤',
    2: 'Buruk 😕',
    3: 'Cukup 😐',
    4: 'Bagus 😊',
    5: 'Luar Biasa! 🎉'
};

function setFormRating(val) {
    currentFormRating = val;
    document.getElementById('form-rating').value = val;
    updateFormStars(val);
    document.getElementById('form-rating-label').textContent = ratingLabels[val];
}

function previewFormRating(val) {
    if (currentFormRating === 0) updateFormStars(val);
    else {
        document.querySelectorAll('.form-star').forEach(btn => {
            const v = parseInt(btn.dataset.val);
            const icon = btn.querySelector('i');
            if (v <= val && v <= currentFormRating) {
                icon.className = 'bi bi-star-fill';
                btn.style.color = '#facc15';
            } else if (v <= val) {
                icon.className = 'bi bi-star-fill';
                btn.style.color = '#fde68a';
            } else {
                icon.className = 'bi bi-star';
                btn.style.color = '#d1d5db';
            }
        });
    }
}

function resetFormRating() {
    updateFormStars(currentFormRating);
}

function updateFormStars(val) {
    document.querySelectorAll('.form-star').forEach(btn => {
        const v = parseInt(btn.dataset.val);
        const icon = btn.querySelector('i');
        if (v <= val) {
            icon.className = 'bi bi-star-fill';
            btn.style.color = '#facc15';
        } else {
            icon.className = 'bi bi-star';
            btn.style.color = '#d1d5db';
        }
    });
}

// Init form stars
document.addEventListener('DOMContentLoaded', () => updateFormStars(0));

// ═══════════════════════════════════════════════════
// TOGGLE NILAI FIELDS
// ═══════════════════════════════════════════════════
function toggleNilai() {
    const fields = document.getElementById('nilai-fields');
    fields.classList.toggle('hidden');
}

// ═══════════════════════════════════════════════════
// SUBMIT REVIEW
// ═══════════════════════════════════════════════════
function submitReview(e) {
    e.preventDefault();

    const rating = parseInt(document.getElementById('form-rating').value);
    if (rating === 0) {
        showToast('Pilih rating bintang terlebih dahulu!', 'warning');
        return;
    }

    const matkul = document.getElementById('form-matkul').value;
    const comment = document.getElementById('form-comment').value.trim();
    if (!comment) {
        showToast('Tulis komentar ulasanmu!', 'warning');
        return;
    }

    const nilaiSebelum = document.querySelector('[name="nilai_sebelum"]')?.value || '';
    const nilaiSesudah = document.querySelector('[name="nilai_sesudah"]')?.value || '';
    const showNilai = document.getElementById('show-nilai').checked;

    // Build new review card
    const now = new Date();
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const dateStr = `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

    const starsHtml = Array.from({length: 5}, (_, i) =>
        `<i class="bi ${i < rating ? 'bi-star-fill' : 'bi-star'} text-sm"></i>`
    ).join('');

    const nilaiChip = (showNilai && nilaiSebelum && nilaiSesudah)
        ? `<div class="mb-3"><span class="inline-flex items-center gap-1 text-[11px] font-bold bg-green-50 text-green-700 border border-green-200 px-2.5 py-1 rounded-lg">📈 Nilai naik: ${nilaiSebelum} → ${nilaiSesudah}</span></div>`
        : '';

    const cardHtml = `
        <div class="review-card bg-white border border-secondary rounded-3xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition-all" data-rating="${rating}">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-surface border border-secondary flex items-center justify-center font-extrabold text-primary text-base flex-shrink-0">K</div>
                    <div>
                        <h4 class="font-bold text-dark text-sm">Kamu</h4>
                        <p class="text-[11px] text-gray-400">—</p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <div class="flex gap-0.5 text-yellow-400 justify-end mb-1">${starsHtml}</div>
                    <p class="text-[10px] text-gray-400">${dateStr}</p>
                </div>
            </div>
            <span class="inline-block bg-surface border border-secondary text-xs font-semibold text-primary px-3 py-1 rounded-lg mb-3">${matkul}</span>
            ${nilaiChip}
            <p class="text-sm text-gray-600 leading-relaxed italic">"${comment}"</p>
        </div>`;

    // Prepend to grid
    const grid = document.getElementById('reviews-grid');
    grid.insertAdjacentHTML('afterbegin', cardHtml);

    // Update summary stats
    updateStatsAfterSubmit(rating);

    // Reset form
    document.getElementById('review-form').reset();
    currentFormRating = 0;
    updateFormStars(0);
    document.getElementById('form-rating-label').textContent = ratingLabels[0];
    document.getElementById('nilai-fields').classList.add('hidden');

    // Hide form + show button again
    document.getElementById('review-form-section').classList.add('hidden');

    showToast('Ulasan berhasil dikirim! Terima kasih 🎉', 'success');
}

// ═══════════════════════════════════════════════════
// UPDATE STATS AFTER SUBMIT
// ═══════════════════════════════════════════════════
function updateStatsAfterSubmit(newRating) {
    const totalEl = document.getElementById('total-review-count');
    const totalUlasanEl = document.getElementById('total-ulasan');
    let total = parseInt(totalUlasanEl.textContent);

    // Update total
    total++;
    totalEl.textContent = total;
    totalUlasanEl.textContent = total;
    document.getElementById('filter-all-count').textContent = total;

    // Update distribution count for this star
    const distEl = document.getElementById('dist-' + newRating);
    if (distEl) {
        let count = parseInt(distEl.textContent) || 0;
        count++;
        distEl.textContent = count;
        document.getElementById('filter-' + newRating + '-count').textContent = count;
    }

    // Update bintang 4-5
    if (newRating >= 4) {
        const b45 = document.getElementById('bintang-45');
        b45.textContent = parseInt(b45.textContent) + 1;
    }

    // Update avg rating
    const avgEl = document.getElementById('avg-rating');
    const currentAvg = parseFloat(avgEl.textContent);
    // Approximate: new avg = (oldAvg * (total-1) + newRating) / total
    const newAvg = ((currentAvg * (total - 1)) + newRating) / total;
    avgEl.textContent = newAvg.toFixed(1);

    // Update avg stars visual
    const avgStars = document.getElementById('avg-stars');
    const rounded = Math.round(newAvg);
    avgStars.innerHTML = '';
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        star.className = `bi ${i <= rounded ? 'bi-star-fill' : 'bi-star'} text-lg`;
        star.style.color = '#facc15';
        avgStars.appendChild(star);
    }

    // Update progress bars
    document.querySelectorAll('.star-bar').forEach(bar => {
        const star = parseInt(bar.closest('.flex').querySelector('span:first-child').textContent.trim());
        const distVal = parseInt(document.getElementById('dist-' + star)?.textContent || '0');
        const pct = total > 0 ? Math.round(distVal / total * 100) : 0;
        bar.style.width = pct + '%';
    });
}

// ═══════════════════════════════════════════════════
// TOAST NOTIFICATION
// ═══════════════════════════════════════════════════
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
        position: fixed; bottom: 24px; right: 24px; z-index: 9999;
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
    document.body.appendChild(toast);

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

// Init: auto-show first filter
document.addEventListener('DOMContentLoaded', () => {
    const firstPill = document.querySelector('.filter-pill');
    if (firstPill) firstPill.click();
});
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
