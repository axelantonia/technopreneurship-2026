@extends('layouts.app')

@section('content')

<div class="bg-primary pt-12 pb-28">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight">Temukan Tutor Terbaikmu</h1>
        <p class="text-blue-100 mb-8 text-sm md:text-base">Pilih kampusmu dan mulai belajar dengan mahasiswa berprestasi.</p>

        <div class="relative max-w-xl mx-auto text-left z-50">
            <div class="relative" id="kampus-selector" onclick="toggleDropdown()" style="cursor: pointer;">
                <input type="text" id="input-kampus" class="w-full bg-white text-dark font-semibold py-4 px-6 rounded-2xl shadow-xl focus:outline-none border-none cursor-pointer" value="Universitas Kristen Petra" readonly>
                <i class="bi bi-chevron-down absolute right-6 top-4 text-gray-400 font-bold"></i>
            </div>
            <div id="dropdown-kampus" class="hidden absolute w-full mt-2 bg-white text-gray-600 rounded-2xl shadow-2xl border border-secondary overflow-hidden transition-all">
                <ul class="py-2">
                    <li class="px-6 py-3 hover:bg-surface hover:text-primary font-medium cursor-pointer transition-colors" onclick="selectKampus('Universitas Kristen Petra')">Universitas Kristen Petra</li>
                    <li class="px-6 py-3 hover:bg-surface hover:text-primary font-medium cursor-pointer transition-colors" onclick="selectKampus('Universitas Surabaya (UBAYA)')">Universitas Surabaya (UBAYA)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 mb-20 relative z-10">
    <div class="flex flex-col lg:flex-row gap-8">

        <aside class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-secondary sticky top-8">
                <div class="flex justify-between items-center mb-6 border-b border-secondary pb-4">
                    <h3 class="font-bold text-dark text-lg">Filter Pencarian</h3>
                    <button id="btn-reset" onclick="resetFilters()" class="text-sm text-primary font-medium hover:text-primary-hover hover:underline transition-colors">Reset</button>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-bold text-dark mb-2">Jurusan</label>
                    <select id="filter-jurusan" class="w-full bg-surface border border-secondary text-gray-700 py-3 px-4 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        <option value="Semua Jurusan">Semua Jurusan</option>
                        @php $jurusanList = collect($tutors)->pluck('jurusan')->unique()->sort()->values() @endphp
                        @foreach($jurusanList as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-bold text-dark mb-2">Mata Kuliah</label>
                    <input type="text" id="filter-matkul" placeholder="Ketik mata kuliah..." class="w-full bg-surface border border-secondary text-gray-700 py-3 px-4 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-bold text-dark mb-3">Mode Belajar</label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 text-sm text-gray-600 cursor-pointer group">
                            <input type="checkbox" class="filter-mode rounded text-primary w-4 h-4 focus:ring-primary border-gray-300" value="Online" checked>
                            <span class="group-hover:text-primary transition-colors">Online (Zoom/GMeet)</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-600 cursor-pointer group">
                            <input type="checkbox" class="filter-mode rounded text-primary w-4 h-4 focus:ring-primary border-gray-300" value="Offline" checked>
                            <span class="group-hover:text-primary transition-colors">Offline (Tatap Muka)</span>
                        </label>
                    </div>
                </div>

                <div class="mb-5 border-t border-secondary pt-5">
                    <label class="block text-sm font-bold text-dark mb-2">Pilih Waktu</label>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <select id="filter-hari" class="text-sm bg-surface border border-secondary py-2.5 px-3 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none">
                            <option value="Semua Hari">Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                        <input type="time" id="filter-jam" class="text-sm bg-surface border border-secondary py-2.5 px-3 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-dark mb-2 flex justify-between">
                        Harga Maks
                        <span id="label-harga" class="text-primary font-extrabold">Rp 100.000</span>
                    </label>
                    <input type="range" id="range-harga" min="30000" max="150000" step="5000" value="100000" class="w-full h-2 bg-secondary rounded-lg appearance-none cursor-pointer accent-primary">
                </div>

                <button onclick="applyFilters()" class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-blue-200 active:scale-95">
                    Terapkan Filter
                </button>
            </div>
        </aside>

        <main class="w-full lg:w-3/4">
            <div class="bg-white p-4 px-6 rounded-2xl shadow-sm border border-secondary mb-6 flex justify-between items-center">
                <p class="text-gray-500 text-sm font-medium">Menampilkan <span id="total-text" class="font-bold text-primary text-base">0</span> tutor terbaik</p>
                <select id="sort-select" onchange="applyFilters()" class="bg-surface border border-secondary text-dark text-sm font-medium py-2 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary cursor-pointer">
                    <option value="rekomendasi">✨ Rekomendasi</option>
                    <option value="rating">⭐ Rating Tertinggi</option>
                    <option value="harga-rendah">💸 Harga Terendah</option>
                </select>
            </div>

            <div id="tutor-wrapper" class="space-y-5"></div>
            <div id="pagination-wrapper" class="mt-12 flex justify-center gap-2"></div>
        </main>
    </div>
</div>

<script>
    // Data dari PHP
    const tutors = @json($tutors);

    let currentPage = 1;
    const itemsPerPage = 7;
    let filtered = [];

    function formatRupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    function render() {
        const container = document.getElementById('tutor-wrapper');
        container.innerHTML = '';

        const start = (currentPage - 1) * itemsPerPage;
        const pageData = filtered.slice(start, start + itemsPerPage);
        document.getElementById('total-text').textContent = filtered.length;

        if (pageData.length === 0) {
            container.innerHTML = `
                <div class="bg-white p-10 rounded-3xl border border-secondary text-center">
                    <i class="bi bi-search text-4xl text-gray-300 mb-3 block"></i>
                    <h4 class="text-lg font-bold text-dark mb-1">Tutor tidak ditemukan</h4>
                    <p class="text-gray-500 text-sm">Coba ubah filter pencarianmu untuk melihat hasil yang lain.</p>
                </div>`;
            document.getElementById('pagination-wrapper').innerHTML = '';
            return;
        }

        pageData.forEach(t => {
            const matkulBadges = t.matkul.slice(0, 2).map(m =>
                `<span class="text-[10px] bg-surface border border-secondary text-gray-600 px-3 py-1.5 rounded-lg font-bold uppercase tracking-wide">${m}</span>`
            ).join('');

            container.innerHTML += `
                <div class="bg-white p-6 rounded-3xl border border-secondary flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group">
                    <div class="md:w-1/4 flex flex-col items-center">
                        <img src="{{ asset('assets/img/profil-${t.profil}.jpg') }}" alt="Foto Profil"
                             class="w-24 h-24 object-cover rounded-full mb-3 ring-4 ring-surface group-hover:ring-blue-100 transition-all">
                        <div class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-lg text-xs font-bold border border-yellow-100 flex items-center gap-1">
                            <i class="bi bi-star-fill"></i> ${t.rating}
                        </div>
                    </div>
                    <div class="md:w-2/4">
                        <h4 class="font-bold text-xl text-dark mb-1 group-hover:text-primary transition-colors">
                            ${t.name} <i class="bi bi-patch-check-fill text-primary"></i>
                        </h4>
                        <p class="text-primary text-sm font-semibold mb-3">${t.jurusan}, ${t.kampus}</p>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">${t.bio}</p>
                        <div class="mt-4 flex gap-2 flex-wrap">${matkulBadges}</div>
                    </div>
                    <div class="md:w-1/4 flex flex-col justify-center items-end md:border-l border-secondary md:pl-6 pt-4 md:pt-0 border-t md:border-t-0 mt-4 md:mt-0">
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Mulai dari</p>
                        <h5 class="font-extrabold text-2xl text-dark">${formatRupiah(t.price)}<span class="text-xs text-gray-400 font-normal">/jam</span></h5>
                        <a href="/tutors/${t.id}"
                           class="w-full text-center bg-primary text-white py-3 rounded-2xl mt-5 text-sm font-bold shadow-lg shadow-blue-200 hover:bg-primary-hover transition-all active:scale-95">
                            Lihat Profil
                        </a>
                    </div>
                </div>`;
        });
        renderPagination();
    }

    function renderPagination() {
        const total = Math.ceil(filtered.length / itemsPerPage);
        const wrapper = document.getElementById('pagination-wrapper');
        wrapper.innerHTML = '';
        if (total <= 1) return;
        for (let i = 1; i <= total; i++) {
            wrapper.innerHTML += `
                <button onclick="goToPage(${i})" class="w-10 h-10 rounded-xl font-bold transition-all ${i === currentPage ? 'bg-primary text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-500 hover:bg-surface border border-secondary hover:text-primary'}">
                    ${i}
                </button>`;
        }
    }

    window.goToPage = (p) => { currentPage = p; render(); window.scrollTo({ top: 350, behavior: 'smooth' }); };

    window.applyFilters = () => {
        const kampus  = document.getElementById('input-kampus').value;
        const jurusan = document.getElementById('filter-jurusan').value;
        const matkul  = document.getElementById('filter-matkul').value.toLowerCase().trim();
        const harga   = parseInt(document.getElementById('range-harga').value);
        const hari    = document.getElementById('filter-hari').value;
        const sort    = document.getElementById('sort-select').value;
        const modes   = Array.from(document.querySelectorAll('.filter-mode:checked')).map(cb => cb.value);

        filtered = tutors.filter(t => {
            const matchKampus  = t.kampus === kampus;
            const matchJurusan = jurusan === 'Semua Jurusan' || t.jurusan === jurusan;
            const matchHarga   = t.price <= harga;
            const matchMode    = t.modes.some(m => modes.includes(m));
            const matchHari    = hari === 'Semua Hari' || hari === 'Hari' || t.availableDays.includes(hari);
            const matchMatkul  = matkul === '' || t.matkul.some(m => m.toLowerCase().includes(matkul));
            return matchKampus && matchJurusan && matchHarga && matchMode && matchHari && matchMatkul;
        });

        if (sort === 'rating')       filtered.sort((a, b) => b.rating - a.rating);
        if (sort === 'harga-rendah') filtered.sort((a, b) => a.price - b.price);

        currentPage = 1;
        render();
    };

    window.resetFilters = () => {
        document.getElementById('filter-jurusan').value = 'Semua Jurusan';
        document.getElementById('filter-matkul').value = '';
        document.getElementById('filter-hari').value = 'Semua Hari';
        document.getElementById('filter-jam').value = '';
        document.getElementById('range-harga').value = 150000;
        document.getElementById('label-harga').textContent = 'Rp 150.000';
        document.querySelectorAll('.filter-mode').forEach(cb => cb.checked = true);
        document.getElementById('sort-select').value = 'rekomendasi';
        applyFilters();
    };

    document.getElementById('range-harga').oninput = function () {
        document.getElementById('label-harga').textContent = `Rp ${parseInt(this.value).toLocaleString('id-ID')}`;
    };

    window.toggleDropdown = () => document.getElementById('dropdown-kampus').classList.toggle('hidden');

    window.selectKampus = (n) => {
        document.getElementById('input-kampus').value = n;
        toggleDropdown();
        applyFilters();
    };

    document.addEventListener('click', (e) => {
        const selector = document.getElementById('kampus-selector');
        const dropdown = document.getElementById('dropdown-kampus');
        if (!selector.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', applyFilters);
</script>

<style>
    input[type=range]::-webkit-slider-thumb { margin-top: -4px; box-shadow: 0 0 10px rgba(59,130,246,0.3); }
    .sticky { position: -webkit-sticky; position: sticky; }
</style>

@endsection
