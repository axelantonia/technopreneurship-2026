@extends('tutors.layouts.app')
@section('title', 'Paket Kursus')

@section('content')

<div class="mb-6 flex items-start justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-ink">Paket Kursus</h1>
        <p class="text-sm text-muted mt-0.5">Kelola layanan dan harga yang ditawarkan kepada mahasiswa.</p>
    </div>
    <button onclick="toggleAddForm()"
            class="shrink-0 inline-flex items-center gap-1.5 bg-accent hover:bg-accent-dark text-white text-xs font-semibold px-3.5 py-2.5 rounded-md transition shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Paket
    </button>
</div>

{{-- ── Form Tambah ───────────────────────────────────────────────────────── --}}
<div id="add-form" class="hidden bg-white border border-border-ui rounded-lg p-5 mb-5">
    <h2 class="text-xs font-semibold text-muted uppercase tracking-widest mb-4">Form Paket Baru</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2">
            <label class="block text-xs font-semibold text-ink mb-1.5">Nama Paket <span class="text-red-400">*</span></label>
            <input id="f-name" type="text" placeholder="cth: Paket Intensif Laravel"
                   class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Harga (Rp) <span class="text-red-400">*</span></label>
            <input id="f-price" type="number" placeholder="65000"
                   class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Satuan Harga</label>
            <select id="f-unit" class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                <option>/ Jam</option><option>/ Paket</option><option>/ Bulan</option>
            </select>
        </div>
        <div class="sm:col-span-2">
            <label class="block text-xs font-semibold text-ink mb-1.5">Fasilitas (pisahkan dengan koma)</label>
            <input id="f-features" type="text" placeholder="Sesi 1-on-1, Free Modul, Chat 24/7"
                   class="w-full border border-slate-300 rounded-md px-3 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
        </div>
    </div>
    <div class="flex gap-2 mt-4 pt-4 border-t border-border-ui">
        <button onclick="addPackage()"
                class="bg-accent hover:bg-accent-dark text-white text-xs font-semibold px-4 py-2.5 rounded-md transition">
            Simpan Paket
        </button>
        <button onclick="toggleAddForm()"
                class="bg-slate-100 hover:bg-slate-200 text-muted text-xs font-semibold px-4 py-2.5 rounded-md transition">
            Batal
        </button>
    </div>
</div>

{{-- ── Daftar Paket ──────────────────────────────────────────────────────── --}}
<div id="pkg-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

    {{-- Paket 1 --}}
    <div class="pkg-card bg-white border border-border-ui rounded-lg overflow-hidden" data-id="1">
        <div class="px-4 py-3 bg-sidebar flex items-center justify-between">
            <div class="flex items-center gap-2 min-w-0">
                <span class="font-semibold text-white text-sm truncate pkg-name-display">Sesi Kilat UTS</span>
            </div>
            <span class="shrink-0 bg-white/10 border border-white/15 text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded pkg-unit-display">/ Jam</span>
        </div>
        <div class="p-5">
            <div class="mb-1">
                <span class="text-2xl font-extrabold text-ink">Rp </span>
                <span class="text-2xl font-extrabold text-ink pkg-price-display">65.000</span>
                <span class="text-sm text-muted pkg-unit-label"> / Jam</span>
            </div>
            <ul class="mt-3 space-y-1.5 text-xs text-muted pkg-features-display mb-5">
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Sesi One-on-One</li>
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Free Modul Ringkasan</li>
            </ul>
            <div class="flex gap-2 pt-4 border-t border-border-ui">
                <button onclick="editPackage(this)"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-ink text-xs font-semibold py-2 rounded-md transition edit-btn">
                    <i class="bi bi-pencil mr-1"></i> Edit
                </button>
                <button onclick="removePackage(this)"
                        class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-500 text-xs font-semibold px-3 py-2 rounded-md transition">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Paket 2 --}}
    <div class="pkg-card bg-white border-2 border-accent rounded-lg overflow-hidden relative" data-id="2">
        <div class="absolute top-3 right-3 z-10">
            <span class="bg-gold text-white text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wide">Best Seller</span>
        </div>
        <div class="px-4 py-3 bg-sidebar flex items-center justify-between">
            <span class="font-semibold text-white text-sm truncate pkg-name-display">Paket Intensif 4 Sesi</span>
            <span class="shrink-0 bg-white/10 border border-white/15 text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded pkg-unit-display">/ Paket</span>
        </div>
        <div class="p-5">
            <div class="mb-1">
                <span class="text-2xl font-extrabold text-ink">Rp </span>
                <span class="text-2xl font-extrabold text-ink pkg-price-display">240.000</span>
                <span class="text-sm text-muted pkg-unit-label"> / Paket</span>
            </div>
            <ul class="mt-3 space-y-1.5 text-xs text-muted pkg-features-display mb-5">
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> 4× Pertemuan Interaktif</li>
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Akses Chat 24/7</li>
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Review Tugas & Kuis</li>
            </ul>
            <div class="flex gap-2 pt-4 border-t border-border-ui">
                <button onclick="editPackage(this)"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-ink text-xs font-semibold py-2 rounded-md transition edit-btn">
                    <i class="bi bi-pencil mr-1"></i> Edit
                </button>
                <button onclick="removePackage(this)"
                        class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-500 text-xs font-semibold px-3 py-2 rounded-md transition">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Paket 3 --}}
    <div class="pkg-card bg-white border border-border-ui rounded-lg overflow-hidden" data-id="3">
        <div class="px-4 py-3 bg-sidebar flex items-center justify-between">
            <span class="font-semibold text-white text-sm truncate pkg-name-display">Bimbingan Skripsi</span>
            <span class="shrink-0 bg-white/10 border border-white/15 text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded pkg-unit-display">/ Jam</span>
        </div>
        <div class="p-5">
            <div class="mb-1">
                <span class="text-2xl font-extrabold text-ink">Rp </span>
                <span class="text-2xl font-extrabold text-ink pkg-price-display">75.000</span>
                <span class="text-sm text-muted pkg-unit-label"> / Jam</span>
            </div>
            <ul class="mt-3 space-y-1.5 text-xs text-muted pkg-features-display mb-5">
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Konsultasi Metodologi</li>
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Review BAB per Sesi</li>
                <li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Pendampingan Sidang</li>
            </ul>
            <div class="flex gap-2 pt-4 border-t border-border-ui">
                <button onclick="editPackage(this)"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-ink text-xs font-semibold py-2 rounded-md transition edit-btn">
                    <i class="bi bi-pencil mr-1"></i> Edit
                </button>
                <button onclick="removePackage(this)"
                        class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-500 text-xs font-semibold px-3 py-2 rounded-md transition">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
let pkgCounter = 10;

function toggleAddForm() {
    const f = document.getElementById('add-form');
    f.classList.toggle('hidden');
}

function addPackage() {
    const name     = document.getElementById('f-name').value.trim();
    const price    = document.getElementById('f-price').value.trim();
    const unit     = document.getElementById('f-unit').value;
    const features = document.getElementById('f-features').value.trim();

    if (!name || !price) { showToast('Nama dan harga wajib diisi.', 'warning'); return; }

    const priceNum = parseInt(price);
    const priceStr = priceNum.toLocaleString('id-ID');
    const feats    = features
        ? features.split(',').map(f => `<li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> ${f.trim()}</li>`).join('')
        : '<li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> Sesi One-on-One</li>';

    pkgCounter++;
    const div = document.createElement('div');
    div.className = 'pkg-card bg-white border border-border-ui rounded-lg overflow-hidden';
    div.dataset.id = pkgCounter;
    div.innerHTML = `
        <div class="px-4 py-3 bg-sidebar flex items-center justify-between">
            <span class="font-semibold text-white text-sm truncate pkg-name-display">${name}</span>
            <span class="shrink-0 bg-white/10 border border-white/15 text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded pkg-unit-display">${unit}</span>
        </div>
        <div class="p-5">
            <div class="mb-1">
                <span class="text-2xl font-extrabold text-ink">Rp </span>
                <span class="text-2xl font-extrabold text-ink pkg-price-display">${priceStr}</span>
                <span class="text-sm text-muted pkg-unit-label"> ${unit}</span>
            </div>
            <ul class="mt-3 space-y-1.5 text-xs text-muted pkg-features-display mb-5">${feats}</ul>
            <div class="flex gap-2 pt-4 border-t border-border-ui">
                <button onclick="editPackage(this)" class="flex-1 bg-slate-100 hover:bg-slate-200 text-ink text-xs font-semibold py-2 rounded-md transition edit-btn">
                    <i class="bi bi-pencil mr-1"></i> Edit
                </button>
                <button onclick="removePackage(this)" class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-500 text-xs font-semibold px-3 py-2 rounded-md transition">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>`;
    document.getElementById('pkg-grid').appendChild(div);
    document.getElementById('f-name').value = '';
    document.getElementById('f-price').value = '';
    document.getElementById('f-features').value = '';
    document.getElementById('add-form').classList.add('hidden');
    showToast(`Paket "${name}" berhasil ditambahkan!`, 'success');
}

function editPackage(btn) {
    const card      = btn.closest('.pkg-card');
    const nameEl    = card.querySelector('.pkg-name-display');
    const priceEl   = card.querySelector('.pkg-price-display');
    const featEl    = card.querySelector('.pkg-features-display');
    const unitEl    = card.querySelector('.pkg-unit-label');
    const bodyEl    = card.querySelector('.p-5');

    const curName   = nameEl.textContent.trim();
    const curPrice  = priceEl.textContent.replace(/\./g,'').trim();
    const curUnit   = unitEl.textContent.trim();
    const curFeats  = Array.from(featEl.querySelectorAll('li')).map(l=>l.textContent.trim()).join(', ');

    // Ganti header name jadi input
    nameEl.outerHTML = `<input class="pkg-name-input bg-transparent border-b border-white/40 text-white text-sm font-semibold w-full outline-none" value="${curName}">`;

    // Ganti body jadi form inline
    bodyEl.innerHTML = `
        <div class="space-y-3 mb-4">
            <div>
                <label class="block text-[10px] font-semibold text-muted uppercase mb-1">Harga (angka)</label>
                <input class="pkg-edit-price w-full border border-slate-300 rounded-md px-3 py-2 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30" type="number" value="${curPrice}">
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-muted uppercase mb-1">Satuan Harga</label>
                <input class="pkg-edit-unit w-full border border-slate-300 rounded-md px-3 py-2 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30" value="${curUnit.replace('/','').trim()}">
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-muted uppercase mb-1">Fasilitas (pisah koma)</label>
                <input class="pkg-edit-feats w-full border border-slate-300 rounded-md px-3 py-2 text-sm text-ink focus:outline-none focus:ring-2 focus:ring-accent/30" value="${curFeats}">
            </div>
        </div>
        <div class="flex gap-2 pt-4 border-t border-border-ui">
            <button onclick="savePackage(this)" class="flex-1 bg-accent hover:bg-accent-dark text-white text-xs font-semibold py-2.5 rounded-md transition">
                <i class="bi bi-check2 mr-1"></i> Simpan
            </button>
            <button onclick="cancelEdit(this)" class="bg-slate-100 hover:bg-slate-200 text-muted text-xs font-semibold px-4 py-2.5 rounded-md transition">
                Batal
            </button>
        </div>`;
}

function savePackage(btn) {
    const card      = btn.closest('.pkg-card');
    const nameInput = card.querySelector('.pkg-name-input');
    const priceInput= card.querySelector('.pkg-edit-price');
    const unitInput = card.querySelector('.pkg-edit-unit');
    const featsInput= card.querySelector('.pkg-edit-feats');

    const newName  = nameInput ? nameInput.value.trim() : '';
    const newPrice = priceInput ? parseInt(priceInput.value) : 0;
    const newUnit  = unitInput ? unitInput.value.trim() : 'Jam';
    const newFeats = featsInput ? featsInput.value.trim() : '';

    if (!newName || !newPrice) { showToast('Nama dan harga tidak boleh kosong.', 'warning'); return; }

    const priceStr  = newPrice.toLocaleString('id-ID');
    const featsList = newFeats
        ? newFeats.split(',').map(f=>`<li class="flex items-center gap-2"><i class="bi bi-check2 text-emerald"></i> ${f.trim()}</li>`).join('')
        : '';

    // Update header
    const headerSpan = card.querySelector('.pkg-name-input') || card.querySelector('.pkg-name-display');
    if (headerSpan) {
        const newSpan = document.createElement('span');
        newSpan.className = 'font-semibold text-white text-sm truncate pkg-name-display';
        newSpan.textContent = newName;
        headerSpan.replaceWith(newSpan);
    }
    const unitBadge = card.querySelector('.pkg-unit-display');
    if (unitBadge) unitBadge.textContent = `/ ${newUnit}`;

    // Update body
    const bodyEl = card.querySelector('.p-5');
    bodyEl.innerHTML = `
        <div class="mb-1">
            <span class="text-2xl font-extrabold text-ink">Rp </span>
            <span class="text-2xl font-extrabold text-ink pkg-price-display">${priceStr}</span>
            <span class="text-sm text-muted pkg-unit-label"> / ${newUnit}</span>
        </div>
        <ul class="mt-3 space-y-1.5 text-xs text-muted pkg-features-display mb-5">${featsList}</ul>
        <div class="flex gap-2 pt-4 border-t border-border-ui">
            <button onclick="editPackage(this)" class="flex-1 bg-slate-100 hover:bg-slate-200 text-ink text-xs font-semibold py-2 rounded-md transition edit-btn">
                <i class="bi bi-pencil mr-1"></i> Edit
            </button>
            <button onclick="removePackage(this)" class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-500 text-xs font-semibold px-3 py-2 rounded-md transition">
                <i class="bi bi-trash3"></i>
            </button>
        </div>`;

    showToast(`Paket "${newName}" berhasil diperbarui!`, 'success');
}

function cancelEdit(btn) {
    window.location.reload();
}

function removePackage(btn) {
    if (!confirm('Hapus paket ini?')) return;
    btn.closest('.pkg-card').remove();
    showToast('Paket dihapus.', 'info');
}
</script>
@endpush
@endsection
