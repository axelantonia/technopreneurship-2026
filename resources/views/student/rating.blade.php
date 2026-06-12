@extends('student.layouts.app')
@section('title', 'Rating & Review')
@section('meta_description', 'Beri ulasan dan rating untuk tutor di platform Tutorium.')

@section('content')

{{-- ── Page Heading ──────────────────────────────────────────────────────────── --}}
<div class="mb-6">
    <h1 class="text-xl font-bold" style="color:#283044;">Rating & Review</h1>
    <p class="text-sm mt-0.5" style="color:#64748b;">Bagikan pengalamanmu belajar bersama tutor agar membantu mahasiswa lain.</p>
</div>

{{-- ═══════════════════════════════════════════════════════════════
     BAGIAN ATAS — Form Ulasan (Bento Card)
═══════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">

    {{-- ── Tutor Info Mini Card ─────────────────────────────────────── --}}
    <div class="lg:col-span-2 rounded-2xl p-6 flex flex-col items-center text-center lift"
         style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.10);">

        {{-- Tutor Avatar --}}
        <div class="relative mb-4">
            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=334060&color=7ba7f5&size=160&bold=true"
                 class="w-24 h-24 rounded-2xl ring-4" style="ring-color:#D0E2F2; box-shadow:0 0 0 4px #D0E2F2, 0 0 0 7px #4D81EE40;"
                 alt="Budi Santoso">
            <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full flex items-center justify-center"
                  style="background:#22c55e; border:2px solid #fff;">
                <i class="bi bi-check text-white text-[9px] font-black"></i>
            </span>
        </div>

        <p class="font-extrabold text-base mb-0.5" style="color:#283044;">Budi Santoso</p>
        <p class="text-xs font-semibold mb-1" style="color:#4D81EE;">Tutor Web Development & Database</p>
        <p class="text-xs mb-4" style="color:#64748b;">Universitas Kristen Petra</p>

        {{-- Current rating stars --}}
        <div class="flex items-center gap-1 mb-2">
            @for($i = 1; $i <= 5; $i++)
            <i class="bi bi-star-fill text-lg star-filled"></i>
            @endfor
        </div>
        <p class="text-xs font-semibold" style="color:#64748b;">4.9 · 18 Ulasan</p>

        {{-- Session info --}}
        <div class="mt-5 w-full rounded-xl p-3 text-left space-y-2"
             style="background:#f0f7ff; border:1px solid #c0d3f0;">
            <p class="text-[11px] font-semibold uppercase tracking-widest mb-2" style="color:#4D81EE;">Sesi yang Diajarkan</p>
            <div class="flex items-center gap-2 text-xs" style="color:#283044;">
                <i class="bi bi-journal-text" style="color:#4D81EE;"></i>
                <span class="font-semibold">Laravel Advanced — Relasi & Eloquent ORM</span>
            </div>
            <div class="flex items-center gap-2 text-xs" style="color:#64748b;">
                <i class="bi bi-calendar3" style="color:#4D81EE;"></i>
                <span>Rabu, 4 Juni 2026 · 14:00 – 16:00 WIB</span>
            </div>
            <div class="flex items-center gap-2 text-xs" style="color:#64748b;">
                <i class="bi bi-clock-history" style="color:#4D81EE;"></i>
                <span>Durasi 2 Jam · Online</span>
            </div>
        </div>
    </div>

    {{-- ── Review Form Bento Card ───────────────────────────────────── --}}
    <div class="lg:col-span-3 rounded-2xl p-6"
         style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 4px 24px rgba(59,91,138,.10);">

        <div class="flex items-center gap-2 mb-6">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#4D81EE;">
                <i class="bi bi-star-fill text-white text-sm"></i>
            </div>
            <h2 class="font-bold text-base" style="color:#283044;">Tulis Ulasanmu</h2>
        </div>

        {{-- Interactive Star Rating --}}
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#64748b;">Beri Bintang</p>
            <div class="flex items-center gap-2" id="star-group">
                @for($i = 1; $i <= 5; $i++)
                <button id="star-btn-{{ $i }}"
                        class="star-btn text-3xl transition-all duration-150 hover:scale-110 active:scale-95 star-filled"
                        data-val="{{ $i }}"
                        onclick="setRating({{ $i }})"
                        onmouseenter="previewRating({{ $i }})"
                        onmouseleave="resetPreview()">
                    <i class="bi bi-star-fill"></i>
                </button>
                @endfor
            </div>
            <p id="rating-label" class="text-sm font-semibold mt-2" style="color:#4D81EE;">Luar Biasa!</p>
        </div>

        {{-- Aspect tags --}}
        <div class="mb-5">
            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#64748b;">Aspek Penilaian</p>
            <div class="flex flex-wrap gap-2" id="tag-group">
                @foreach(['Penjelasan Jelas','Sabar','Materi Lengkap','On Time','Interaktif','Mudah Dipahami','Helpful','Recommended'] as $tag)
                <button class="tag-btn text-xs font-semibold px-3 py-1.5 rounded-full border transition"
                        style="background:#EEF4FF; color:#4D81EE; border-color:#c0d3f0;"
                        onclick="toggleTag(this)">
                    {{ $tag }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- Textarea --}}
        <div class="mb-5">
            <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#64748b;">Ulasan Lengkap</p>
            <textarea rows="4"
                      class="w-full text-sm rounded-xl px-4 py-3 resize-none focus:outline-none transition"
                      style="background:#f7fbff; border:1.5px solid #c0d3f0; color:#283044;"
                      onfocus="this.style.borderColor='#4D81EE'; this.style.boxShadow='0 0 0 3px rgba(77,129,238,.15)';"
                      onblur="this.style.borderColor='#c0d3f0'; this.style.boxShadow='none';"
                      placeholder="Ceritakan pengalamanmu belajar...">Kak Budi mengajarnya sangat runtut dan sabar! Materi Laravel Eloquent ORM yang tadinya bikin bingung jadi langsung ngerti setelah 1 sesi. Penjelasannya pakai contoh nyata yang relatable banget. Sangat direkomendasikan buat yang mau belajar backend!</textarea>
        </div>

        {{-- Submit --}}
        <button onclick="submitReview()"
                class="w-full py-3 rounded-xl text-sm font-bold text-white flex items-center justify-center gap-2 transition"
                style="background:#4D81EE;"
                onmouseover="this.style.background='#3a6edb'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(77,129,238,.4)';"
                onmouseout="this.style.background='#4D81EE'; this.style.transform=''; this.style.boxShadow='';">
            <i class="bi bi-send-fill"></i> Kirim Ulasan
        </button>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
     BAGIAN BAWAH — Daftar Review Mahasiswa Lain
═══════════════════════════════════════════════════════════════ --}}
<div class="rounded-2xl overflow-hidden"
     style="background:#fff; border:1.5px solid #3B5B8A; box-shadow:0 6px 32px rgba(59,91,138,.10);">

    {{-- Header --}}
    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid #dce9f5; background:#f7fbff;">
        <div>
            <h2 class="font-bold text-sm" style="color:#283044;">Ulasan Mahasiswa Lain untuk Tutor Ini</h2>
            <p class="text-xs mt-0.5" style="color:#64748b;">18 ulasan · rata-rata 4.9 bintang</p>
        </div>
        <div class="flex items-center gap-1 px-3 py-1.5 rounded-xl" style="background:#EEF4FF; border:1px solid #c0d3f0;">
            <span class="text-lg font-extrabold" style="color:#283044;">4.9</span>
            <i class="bi bi-star-fill text-base star-filled ml-1"></i>
        </div>
    </div>

    {{-- Review Cards --}}
    @php
    $reviews = [
        [
            'name'    => 'Alya Ramadhani',
            'univ'    => 'Universitas Airlangga',
            'tanggal' => '3 Jun 2026',
            'matkul'  => 'Web Development (Laravel)',
            'rating'  => 5,
            'tags'    => ['Penjelasan Jelas', 'Sabar', 'Recommended'],
            'text'    => 'Kak Budi keren banget! Dari yang sama sekali nggak ngerti routing Laravel, sekarang udah bisa bikin CRUD lengkap sendiri dalam 2 sesi. Cara ngajarnya pakai analogi sehari-hari, jadi gampang nyangkut di otak.',
        ],
        [
            'name'    => 'Reza Pratama',
            'univ'    => 'Institut Teknologi Sepuluh Nopember',
            'tanggal' => '28 Mei 2026',
            'matkul'  => 'Basis Data MySQL',
            'rating'  => 5,
            'tags'    => ['Materi Lengkap', 'On Time', 'Interaktif'],
            'text'    => 'Sangat membantu buat persiapan UAS Basis Data. Kak Budi menjelaskan normalisasi dan JOIN query dengan sangat sistematis. Datang tepat waktu dan responsif banget kalau ada yang nggak dimengerti. Nilai A!',
        ],
        [
            'name'    => 'Monica Setiawan',
            'univ'    => 'Universitas Surabaya (UBAYA)',
            'tanggal' => '20 Mei 2026',
            'matkul'  => 'Algoritma & Pemrograman',
            'rating'  => 4,
            'tags'    => ['Sabar', 'Helpful', 'Mudah Dipahami'],
            'text'    => 'Penjelasannya jelas dan step-by-step. Agak cepat di bagian rekursi tapi bisa minta ulang penjelasan dan kak Budi dengan sabar mengulanginya. Overall sangat puas dan worth the money!',
        ],
    ];
    @endphp

    <div class="divide-y" style="border-color:#dce9f5;">
        @foreach($reviews as $r)
        <div class="p-6 hover:bg-[#f7fbff] transition-colors">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-3">

                {{-- Reviewer info --}}
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center font-extrabold text-base shrink-0"
                         style="background:#EEF4FF; color:#4D81EE; border:1.5px solid #c0d3f0;">
                        {{ strtoupper(substr($r['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-sm" style="color:#283044;">{{ $r['name'] }}</p>
                        <p class="text-[11px]" style="color:#64748b;">{{ $r['univ'] }}</p>
                    </div>
                </div>

                {{-- Rating + date --}}
                <div class="flex flex-col items-start sm:items-end gap-1">
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $r['rating'] ? '-fill' : '' }} text-sm star-{{ $i <= $r['rating'] ? 'filled' : 'empty' }}"></i>
                        @endfor
                    </div>
                    <p class="text-[11px]" style="color:#64748b;">{{ $r['tanggal'] }}</p>
                </div>
            </div>

            {{-- Matkul badge + tags --}}
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg"
                      style="background:#EEF4FF; color:#4D81EE; border:1px solid #c0d3f0;">
                    <i class="bi bi-journal-text mr-1"></i>{{ $r['matkul'] }}
                </span>
                @foreach($r['tags'] as $tag)
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full"
                      style="background:#f0f7ff; color:#5a7297; border:1px solid #dce9f5;">{{ $tag }}</span>
                @endforeach
            </div>

            {{-- Review text --}}
            <blockquote class="text-sm leading-relaxed italic border-l-2 pl-4"
                        style="color:#283044; border-color:#4D81EE;">
                "{{ $r['text'] }}"
            </blockquote>

            {{-- Helpful button --}}
            <div class="mt-3 flex items-center gap-2">
                <button onclick="markHelpful(this)"
                        class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                        style="background:#f7fbff; color:#64748b; border:1px solid #dce9f5;"
                        onmouseover="this.style.borderColor='#4D81EE'; this.style.color='#4D81EE';"
                        onmouseout="this.style.borderColor='#dce9f5'; this.style.color='#64748b';">
                    <i class="bi bi-hand-thumbs-up"></i> Membantu
                </button>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Load more --}}
    <div class="px-6 py-4 text-center" style="border-top:1px solid #dce9f5; background:#f7fbff;">
        <button onclick="sToast('Memuat ulasan lainnya...', 'info')"
                class="text-sm font-bold px-6 py-2.5 rounded-xl transition"
                style="background:#EEF4FF; color:#4D81EE; border:1.5px solid #c0d3f0;"
                onmouseover="this.style.background='#4D81EE'; this.style.color='#fff';"
                onmouseout="this.style.background='#EEF4FF'; this.style.color='#4D81EE';">
            Lihat Semua 18 Ulasan <i class="bi bi-chevron-down ml-1"></i>
        </button>
    </div>
</div>

@push('scripts')
<script>
// ── Star Rating Logic ───────────────────────────────────────────────────────
let selectedRating = 5;
const labels = { 1:'Sangat Buruk', 2:'Buruk', 3:'Cukup', 4:'Bagus', 5:'Luar Biasa!' };

function setRating(val) {
    selectedRating = val;
    updateStars(val);
    document.getElementById('rating-label').textContent = labels[val];
}

function previewRating(val) { updateStars(val); }

function resetPreview() { updateStars(selectedRating); }

function updateStars(val) {
    document.querySelectorAll('.star-btn').forEach(btn => {
        const v = parseInt(btn.dataset.val);
        const icon = btn.querySelector('i');
        if (v <= val) {
            icon.className = 'bi bi-star-fill';
            btn.style.color = '#4D81EE';
            btn.style.filter = 'drop-shadow(0 0 6px rgba(77,129,238,.5))';
        } else {
            icon.className = 'bi bi-star';
            btn.style.color = '#c0d3f0';
            btn.style.filter = 'none';
        }
    });
}

// ── Tag Toggle ──────────────────────────────────────────────────────────────
function toggleTag(btn) {
    const active = btn.dataset.active === '1';
    if (active) {
        btn.dataset.active = '0';
        btn.style.background = '#EEF4FF';
        btn.style.color = '#4D81EE';
        btn.style.borderColor = '#c0d3f0';
    } else {
        btn.dataset.active = '1';
        btn.style.background = '#4D81EE';
        btn.style.color = '#fff';
        btn.style.borderColor = '#4D81EE';
    }
}

// ── Submit Review ───────────────────────────────────────────────────────────
function submitReview() {
    sToast('Ulasan berhasil dikirim! Terima kasih, Jeremy 🎉', 'success');
}

// ── Mark Helpful ────────────────────────────────────────────────────────────
function markHelpful(btn) {
    btn.style.background = '#EEF4FF';
    btn.style.color = '#4D81EE';
    btn.style.borderColor = '#4D81EE';
    btn.innerHTML = '<i class="bi bi-hand-thumbs-up-fill"></i> Ditandai Membantu';
    btn.disabled = true;
}

// Init
updateStars(5);
</script>
@endpush

@endsection
