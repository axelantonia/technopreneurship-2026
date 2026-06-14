@extends('tutors.layouts.app')
@section('title', 'Reviews')

@section('content')
@php
$reviews = [
    ['name'=>'Farel',   'univ'=>'Universitas Kristen Petra',         'rating'=>5, 'matkul'=>'Web Development (Laravel)',   'tanggal'=>'12 Jun 2026', 'text'=>'Kak Budi penjelasannya enak banget, materi Laravel yang susah jadi gampang dipahami! Langsung bisa implementasi buat tugas akhir.'],
    ['name'=>'Jess',    'univ'=>'Universitas Negeri Surabaya',        'rating'=>5, 'matkul'=>'Struktur Data',                'tanggal'=>'10 Jun 2026', 'text'=>'Sangat membantu buat persiapan ujian. Recommended buat yang mau belajar ngebut tapi efektif!'],
    ['name'=>'Andi',    'univ'=>'Universitas Surabaya (UBAYA)',       'rating'=>5, 'matkul'=>'Basis Data MySQL',             'tanggal'=>'5 Jun 2026',  'text'=>'Sabar banget ngajarin dari nol. Langsung ngerti konsep JOIN dan normalisasi setelah 2 sesi!'],
    ['name'=>'Reva',    'univ'=>'Universitas Kristen Petra',         'rating'=>4, 'matkul'=>'Algoritma Pemrograman',        'tanggal'=>'1 Jun 2026',  'text'=>'Penjelasannya jelas dan sistematis. Cuma agak cepat di bagian rekursi, tapi overall oke banget!'],
    ['name'=>'Dita',    'univ'=>'Institut Teknologi Sepuluh Nopember','rating'=>5, 'matkul'=>'Web Development (Laravel)',   'tanggal'=>'28 Mei 2026', 'text'=>'Keren! Dari yang bingung routing Laravel sekarang udah bisa bikin CRUD sendiri. Makasih kak!'],
    ['name'=>'Kevin',   'univ'=>'Universitas Airlangga',              'rating'=>5, 'matkul'=>'Basis Data MySQL',             'tanggal'=>'22 Mei 2026', 'text'=>'Metode pengajaran kak Budi pakai analogi sehari-hari, jadi konsep database yang abstrak terasa nyata.'],
    ['name'=>'Monica',  'univ'=>'Universitas Surabaya (UBAYA)',       'rating'=>4, 'matkul'=>'Struktur Data',                'tanggal'=>'18 Mei 2026', 'text'=>'Ngejelasin BST dan Graph dengan contoh yang mudah dimengerti. Belajar jadi tidak stress!'],
    ['name'=>'Hendra',  'univ'=>'Universitas Kristen Petra',         'rating'=>5, 'matkul'=>'Algoritma Pemrograman',        'tanggal'=>'14 Mei 2026', 'text'=>'Berhasil lolos UTS dengan nilai A. Terima kasih banyak kak Budi sudah sabar mengajari!'],
];
$total     = count($reviews);
$avgRating = round(collect($reviews)->avg('rating'), 1);
$dist      = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
foreach ($reviews as $r) $dist[$r['rating']]++;
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    {{-- ── Header ── --}}
    <div>
        <h1 class="text-2xl font-extrabold text-ink">Ulasan dari Murid</h1>
        <p class="text-muted text-sm mt-1">Feedback jujur dari para mahasiswa yang sudah belajar bersamamu.</p>
    </div>

    {{-- ── Summary Card ── --}}
    <div class="bg-white border border-border-ui rounded-xl p-6 md:p-8 shadow-sm">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">

            {{-- Rating besar --}}
            <div class="text-center flex-shrink-0">
                <p class="text-7xl font-extrabold text-ink leading-none">{{ $avgRating }}</p>
                <div class="flex justify-center gap-0.5 mt-2 text-gold">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }} text-xl"></i>
                    @endfor
                </div>
                <p class="text-xs text-muted mt-2">dari {{ $total }} ulasan</p>
            </div>

            <div class="w-px bg-border-ui hidden md:block self-stretch"></div>

            {{-- Distribusi bintang --}}
            <div class="flex-1 space-y-2.5 w-full">
                @foreach([5,4,3,2,1] as $star)
                @php $pct = $total > 0 ? round($dist[$star] / $total * 100) : 0; @endphp
                <div class="flex items-center gap-3 text-sm">
                    <span class="w-12 text-xs font-semibold text-muted flex items-center gap-1 flex-shrink-0">
                        {{ $star }} <i class="bi bi-star-fill text-gold text-[10px]"></i>
                    </span>
                    <div class="flex-1 bg-slate-200 rounded-full h-2.5 overflow-hidden">
                        <div class="h-2.5 rounded-full bg-gold transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                    <span class="w-8 text-xs text-muted text-right">{{ $dist[$star] }}</span>
                </div>
                @endforeach
            </div>

            {{-- Badges --}}
            <div class="flex-shrink-0 space-y-3">
                <div class="bg-slate-50 border border-border-ui rounded-xl p-4 text-center min-w-[120px]">
                    <p class="text-2xl font-extrabold text-ink">{{ $total }}</p>
                    <p class="text-[11px] text-muted mt-1">Total Ulasan</p>
                </div>
                <div class="bg-emerald/5 border border-emerald/20 rounded-xl p-4 text-center">
                    <p class="text-2xl font-extrabold text-emerald">{{ $dist[5] + $dist[4] }}</p>
                    <p class="text-[11px] text-emerald mt-1">Bintang 4–5 ⭐</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Filter ── --}}
    <div class="flex flex-wrap gap-2" id="filter-buttons">
        <button onclick="filterReviews('all', this)"
                class="filter-btn active px-4 py-2 rounded-xl text-xs font-bold bg-accent text-white border border-accent transition">
            Semua ({{ $total }})
        </button>
        @foreach([5,4,3,2,1] as $star)
        <button onclick="filterReviews({{ $star }}, this)"
                class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-white border border-border-ui text-muted hover:border-accent hover:text-accent transition">
            {{ $star }} ⭐ ({{ $dist[$star] }})
        </button>
        @endforeach
    </div>

    {{-- ── Grid Ulasan ── --}}
    <div id="reviews-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($reviews as $r)
        <div class="review-card bg-white border border-border-ui rounded-xl p-6 shadow-sm hover:shadow-md hover:border-accent/30 transition-all"
             data-rating="{{ $r['rating'] }}">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-slate-50 border border-border-ui flex items-center justify-center font-extrabold text-accent text-base flex-shrink-0">
                        {{ strtoupper(substr($r['name'], 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-ink text-sm">{{ $r['name'] }}</h4>
                        <p class="text-[11px] text-muted">{{ $r['univ'] }}</p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <div class="flex gap-0.5 text-gold justify-end mb-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $r['rating'] ? 'bi-star-fill' : 'bi-star' }} text-sm"></i>
                        @endfor
                    </div>
                    <p class="text-[10px] text-muted">{{ $r['tanggal'] }}</p>
                </div>
            </div>

            <span class="inline-block bg-slate-50 border border-border-ui text-xs font-semibold text-accent px-3 py-1 rounded-lg mb-3">
                {{ $r['matkul'] }}
            </span>

            <p class="text-sm text-subtle leading-relaxed italic">"{{ $r['text'] }}"</p>

            {{-- Tombol balas (simulasi) --}}
            <div class="mt-4 pt-4 border-t border-border-ui flex justify-end">
                <button onclick="this.closest('.review-card').querySelector('.reply-box').classList.toggle('hidden')"
                        class="text-xs font-semibold text-accent hover:text-accent-dark transition flex items-center gap-1">
                    <i class="bi bi-reply"></i> Balas
                </button>
            </div>
            <div class="reply-box hidden mt-3">
                <textarea rows="2" placeholder="Tulis balasan..."
                          class="w-full bg-slate-50 border border-border-ui rounded-lg px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-accent/30 transition resize-none"></textarea>
                <button class="mt-2 text-xs bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-lg font-bold transition"
                        onclick="sendReply(this)">Kirim Balasan</button>
            </div>
        </div>
        @endforeach
    </div>

</div>

<script>
    function filterReviews(star, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-accent', 'text-white', 'border-accent');
            b.classList.add('bg-white', 'text-muted', 'border-border-ui');
        });
        btn.classList.add('bg-accent', 'text-white', 'border-accent');
        btn.classList.remove('bg-white', 'text-muted', 'border-border-ui');

        document.querySelectorAll('.review-card').forEach(card => {
            const show = star === 'all' || parseInt(card.dataset.rating) === star;
            card.style.display = show ? '' : 'none';
        });
    }

    function sendReply(btn) {
        const box      = btn.closest('.reply-box');
        const textarea = box.querySelector('textarea');
        if (!textarea.value.trim()) return;
        textarea.value = '';
        box.classList.add('hidden');
        const card = btn.closest('.review-card');
        const toast = document.createElement('p');
        toast.className = 'text-xs text-emerald font-semibold mt-2 flex items-center gap-1';
        toast.innerHTML = '<i class="bi bi-check-circle-fill"></i> Balasan terkirim!';
        card.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection
