{{-- resources/views/tutors/reviews.blade.php --}}
{{-- Di-include oleh dashboard.blade.php saat ?page=reviews --}}

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
        <h1 class="text-2xl font-extrabold text-dark">Ulasan dari Murid</h1>
        <p class="text-gray-500 text-sm mt-1">Feedback jujur dari para mahasiswa yang sudah belajar bersamamu.</p>
    </div>

    {{-- ── Summary Card ── --}}
    <div class="bg-white border border-secondary rounded-3xl p-6 md:p-8 shadow-sm">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">

            {{-- Rating besar --}}
            <div class="text-center flex-shrink-0">
                <p class="text-7xl font-extrabold text-dark leading-none">{{ $avgRating }}</p>
                <div class="flex justify-center gap-0.5 mt-2 text-yellow-400">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }} text-xl"></i>
                    @endfor
                </div>
                <p class="text-xs text-gray-400 mt-2">dari {{ $total }} ulasan</p>
            </div>

            <div class="w-px bg-secondary hidden md:block self-stretch"></div>

            {{-- Distribusi bintang --}}
            <div class="flex-1 space-y-2.5 w-full">
                @foreach([5,4,3,2,1] as $star)
                @php $pct = $total > 0 ? round($dist[$star] / $total * 100) : 0; @endphp
                <div class="flex items-center gap-3 text-sm">
                    <span class="w-12 text-xs font-semibold text-gray-500 flex items-center gap-1 flex-shrink-0">
                        {{ $star }} <i class="bi bi-star-fill text-yellow-400 text-[10px]"></i>
                    </span>
                    <div class="flex-1 bg-secondary rounded-full h-2.5 overflow-hidden">
                        <div class="h-2.5 rounded-full bg-yellow-400 transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                    <span class="w-8 text-xs text-gray-400 text-right">{{ $dist[$star] }}</span>
                </div>
                @endforeach
            </div>

            {{-- Badges --}}
            <div class="flex-shrink-0 space-y-3">
                <div class="bg-surface border border-secondary rounded-2xl p-4 text-center min-w-[120px]">
                    <p class="text-2xl font-extrabold text-dark">{{ $total }}</p>
                    <p class="text-[11px] text-gray-500 mt-1">Total Ulasan</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                    <p class="text-2xl font-extrabold text-green-700">{{ $dist[5] + $dist[4] }}</p>
                    <p class="text-[11px] text-green-600 mt-1">Bintang 4–5 ⭐</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Filter ── --}}
    <div class="flex flex-wrap gap-2" id="filter-buttons">
        <button onclick="filterReviews('all', this)"
                class="filter-btn active px-4 py-2 rounded-xl text-xs font-bold bg-primary text-white border border-primary transition">
            Semua ({{ $total }})
        </button>
        @foreach([5,4,3,2,1] as $star)
        <button onclick="filterReviews({{ $star }}, this)"
                class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-white border border-secondary text-gray-600 hover:border-primary hover:text-primary transition">
            {{ $star }} ⭐ ({{ $dist[$star] }})
        </button>
        @endforeach
    </div>

    {{-- ── Grid Ulasan ── --}}
    <div id="reviews-grid" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($reviews as $r)
        <div class="review-card bg-white border border-secondary rounded-3xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition-all"
             data-rating="{{ $r['rating'] }}">
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

            <span class="inline-block bg-surface border border-secondary text-xs font-semibold text-primary px-3 py-1 rounded-lg mb-3">
                {{ $r['matkul'] }}
            </span>

            <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $r['text'] }}"</p>

            {{-- Tombol balas (simulasi) --}}
            <div class="mt-4 pt-4 border-t border-secondary flex justify-end">
                <button onclick="this.closest('.review-card').querySelector('.reply-box').classList.toggle('hidden')"
                        class="text-xs font-semibold text-primary hover:text-primary-hover transition flex items-center gap-1">
                    <i class="bi bi-reply"></i> Balas
                </button>
            </div>
            <div class="reply-box hidden mt-3">
                <textarea rows="2" placeholder="Tulis balasan..."
                          class="w-full bg-surface border border-secondary rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-primary transition resize-none"></textarea>
                <button class="mt-2 text-xs btn-primary-custom px-4 py-2 rounded-xl font-bold"
                        onclick="sendReply(this)">Kirim Balasan</button>
            </div>
        </div>
        @endforeach
    </div>

</div>

<script>
    function filterReviews(star, btn) {
        // Update tombol aktif
        document.querySelectorAll('.filter-btn').forEach(b => {
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

    function sendReply(btn) {
        const box      = btn.closest('.reply-box');
        const textarea = box.querySelector('textarea');
        if (!textarea.value.trim()) return;
        textarea.value = '';
        box.classList.add('hidden');
        // Tampilkan konfirmasi kecil
        const card = btn.closest('.review-card');
        const toast = document.createElement('p');
        toast.className = 'text-xs text-green-600 font-semibold mt-2 flex items-center gap-1';
        toast.innerHTML = '<i class="bi bi-check-circle-fill"></i> Balasan terkirim!';
        card.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
