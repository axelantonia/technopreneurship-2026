{{-- resources/views/tutors/packages.blade.php --}}
{{-- Di-include oleh dashboard.blade.php saat ?page=packages --}}

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    {{-- ── Header ── --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-dark">Paket Kursus Saya</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola layanan dan harga yang kamu tawarkan kepada mahasiswa.</p>
        </div>
        <button onclick="openNewPackageModal()"
                class="btn-primary-custom inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm shadow-md hover:opacity-90 transition-all">
            <i class="bi bi-plus-lg"></i> Buat Paket Baru
        </button>
    </div>

    {{-- ── Alert sukses (hidden) ── --}}
    <div id="pkg-alert" class="hidden items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-5 py-3 rounded-2xl">
        <i class="bi bi-check-circle-fill"></i>
        <span id="pkg-alert-msg">Paket baru berhasil ditambahkan!</span>
    </div>

    {{-- ── Grid Paket ── --}}
    <div id="packages-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Paket 1 --}}
        <div class="bg-white border border-secondary rounded-3xl p-6 relative group hover:border-primary hover:shadow-md transition-all">
            <button class="absolute top-4 right-4 text-gray-300 hover:text-primary transition-colors" title="Edit paket">
                <i class="bi bi-pencil-square text-lg"></i>
            </button>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-surface border border-secondary text-xs font-bold text-dark rounded-lg mb-4">
                <i class="bi bi-lightning-charge text-primary"></i> Reguler
            </span>
            <h3 class="text-lg font-extrabold text-dark mb-1">Sesi Kilat UTS</h3>
            <p class="text-primary font-extrabold text-2xl mb-4">Rp 65.000 <span class="text-xs font-normal text-gray-400">/ Jam</span></p>
            <ul class="space-y-2 text-sm text-gray-600 mb-6">
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Sesi One-on-One</li>
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Free Modul Ringkasan</li>
            </ul>
            <div class="flex items-center justify-between text-xs text-gray-400 border-t border-secondary pt-4 mt-auto">
                <span><i class="bi bi-people mr-1"></i>12 murid</span>
                <span class="flex items-center gap-1 text-green-600 font-semibold bg-green-50 border border-green-100 px-2 py-1 rounded-lg">
                    <i class="bi bi-circle-fill text-[8px]"></i> Aktif
                </span>
            </div>
        </div>

        {{-- Paket 2 --}}
        <div class="bg-white border-2 border-primary rounded-3xl p-6 relative group hover:shadow-md transition-all">
            <div class="absolute -top-3 left-6 pro-badge text-white text-[10px] font-extrabold px-3 py-1 rounded-full shadow">
                <i class="bi bi-star-fill mr-1"></i> Best Seller
            </div>
            <button class="absolute top-4 right-4 text-gray-300 hover:text-primary transition-colors" title="Edit paket">
                <i class="bi bi-pencil-square text-lg"></i>
            </button>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-surface border border-secondary text-xs font-bold text-primary rounded-lg mb-4 mt-2">
                <i class="bi bi-fire text-orange-500"></i> Populer
            </span>
            <h3 class="text-lg font-extrabold text-dark mb-1">Paket Intensif 4 Sesi</h3>
            <p class="text-primary font-extrabold text-2xl mb-4">Rp 240.000 <span class="text-xs font-normal text-gray-400">/ Paket</span></p>
            <ul class="space-y-2 text-sm text-gray-600 mb-6">
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> 4x Pertemuan Interaktif</li>
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Akses Chat Tutor 24/7</li>
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Review Tugas & Kuis</li>
            </ul>
            <div class="flex items-center justify-between text-xs text-gray-400 border-t border-secondary pt-4 mt-auto">
                <span><i class="bi bi-people mr-1"></i>8 murid</span>
                <span class="flex items-center gap-1 text-green-600 font-semibold bg-green-50 border border-green-100 px-2 py-1 rounded-lg">
                    <i class="bi bi-circle-fill text-[8px]"></i> Aktif
                </span>
            </div>
        </div>

        {{-- Paket 3 --}}
        <div class="bg-white border border-secondary rounded-3xl p-6 relative group hover:border-primary hover:shadow-md transition-all">
            <button class="absolute top-4 right-4 text-gray-300 hover:text-primary transition-colors" title="Edit paket">
                <i class="bi bi-pencil-square text-lg"></i>
            </button>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-gold-light border border-yellow-200 text-xs font-bold text-yellow-700 rounded-lg mb-4">
                <i class="bi bi-gem text-yellow-500"></i> Premium
            </span>
            <h3 class="text-lg font-extrabold text-dark mb-1">Bimbingan Skripsi</h3>
            <p class="text-primary font-extrabold text-2xl mb-4">Rp 75.000 <span class="text-xs font-normal text-gray-400">/ Jam</span></p>
            <ul class="space-y-2 text-sm text-gray-600 mb-6">
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Konsultasi Metodologi</li>
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Review & Feedback BAB</li>
                <li class="flex items-center gap-2"><i class="bi bi-check-circle-fill text-green-500"></i> Pendampingan Sidang</li>
            </ul>
            <div class="flex items-center justify-between text-xs text-gray-400 border-t border-secondary pt-4 mt-auto">
                <span><i class="bi bi-people mr-1"></i>4 murid</span>
                <span class="flex items-center gap-1 text-green-600 font-semibold bg-green-50 border border-green-100 px-2 py-1 rounded-lg">
                    <i class="bi bi-circle-fill text-[8px]"></i> Aktif
                </span>
            </div>
        </div>

    </div>

</div>

{{-- ── Modal Buat Paket Baru ── --}}
<div id="modal-new-package" class="fixed inset-0 z-[100] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeNewPackageModal()"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 p-8 z-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-extrabold text-dark">Buat Paket Baru</h2>
            <button onclick="closeNewPackageModal()" class="text-gray-400 hover:text-dark transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-dark mb-2">Nama Paket</label>
                <input id="pkg-name" type="text" placeholder="cth: Sesi Kilat UAS Statistika"
                       class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Harga (Rp)</label>
                    <input id="pkg-price" type="number" placeholder="65000"
                           class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Tipe</label>
                    <select id="pkg-type" class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition cursor-pointer">
                        <option value="Reguler">⚡ Reguler</option>
                        <option value="Populer">🔥 Populer</option>
                        <option value="Premium">💎 Premium</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-dark mb-2">Deskripsi Singkat</label>
                <textarea id="pkg-desc" rows="2" placeholder="Jelaskan apa saja yang didapat murid..."
                          class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition resize-none"></textarea>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button onclick="closeNewPackageModal()"
                    class="flex-1 bg-surface border border-secondary text-dark font-bold py-3 rounded-xl text-sm hover:bg-gray-100 transition">
                Batal
            </button>
            <button onclick="saveNewPackage()"
                    class="flex-1 btn-primary-custom font-bold py-3 rounded-xl text-sm hover:opacity-90 transition shadow-md">
                Simpan Paket
            </button>
        </div>
    </div>
</div>

<script>
    function openNewPackageModal()  { document.getElementById('modal-new-package').classList.remove('hidden'); }
    function closeNewPackageModal() { document.getElementById('modal-new-package').classList.add('hidden'); }

    function saveNewPackage() {
        const name  = document.getElementById('pkg-name').value.trim();
        const price = document.getElementById('pkg-price').value.trim();
        const type  = document.getElementById('pkg-type').value;
        const desc  = document.getElementById('pkg-desc').value.trim();

        if (!name || !price) {
            alert('Nama paket dan harga wajib diisi.');
            return;
        }

        const priceFormatted = 'Rp ' + parseInt(price).toLocaleString('id-ID');
        const grid = document.getElementById('packages-grid');

        const card = document.createElement('div');
        card.className = 'bg-white border border-secondary rounded-3xl p-6 relative hover:border-primary hover:shadow-md transition-all';
        card.innerHTML = `
            <button class="absolute top-4 right-4 text-gray-300 hover:text-primary transition-colors"><i class="bi bi-pencil-square text-lg"></i></button>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-surface border border-secondary text-xs font-bold text-dark rounded-lg mb-4">${type}</span>
            <h3 class="text-lg font-extrabold text-dark mb-1">${name}</h3>
            <p class="text-primary font-extrabold text-2xl mb-3">${priceFormatted} <span class="text-xs font-normal text-gray-400">/ Jam</span></p>
            <p class="text-sm text-gray-500 mb-4">${desc || 'Tidak ada deskripsi.'}</p>
            <div class="flex items-center justify-between text-xs text-gray-400 border-t border-secondary pt-4">
                <span><i class="bi bi-people mr-1"></i>0 murid</span>
                <span class="flex items-center gap-1 text-green-600 font-semibold bg-green-50 border border-green-100 px-2 py-1 rounded-lg">
                    <i class="bi bi-circle-fill text-[8px]"></i> Aktif
                </span>
            </div>`;
        grid.appendChild(card);

        closeNewPackageModal();
        document.getElementById('pkg-name').value  = '';
        document.getElementById('pkg-price').value = '';
        document.getElementById('pkg-desc').value  = '';

        const alertEl = document.getElementById('pkg-alert');
        alertEl.classList.remove('hidden');
        alertEl.classList.add('flex');
        setTimeout(() => alertEl.classList.add('hidden'), 3000);
    }
</script>
