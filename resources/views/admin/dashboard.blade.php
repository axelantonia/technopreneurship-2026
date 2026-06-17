@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

{{-- Page heading with Month Filter Dropdown --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div>
        <h1 class="text-xl font-bold text-ink">Dashboard Operasional</h1>
        <p class="text-sm text-muted mt-0.5">Ringkasan pendapatan, pengguna, dan moderasi platform.</p>
    </div>
    <div class="flex items-center gap-2 bg-white border border-border-ui rounded-lg px-3 py-2">
        <i class="bi bi-calendar3 text-accent"></i>
        <select id="month-filter"
                onchange="changeMonth(this.value)"
                class="text-xs font-semibold text-muted bg-transparent border-none outline-none cursor-pointer focus:ring-0">
            <option value="1">Feb 2026</option>
            <option value="2">Mar 2026</option>
            <option value="3">Apr 2026</option>
            <option value="4">Mei 2026</option>
            <option value="5">Jun 2026</option>
        </select>
    </div>
</div>

{{-- ═════════════════════════════════════════════════════════════════════
     A. REVENUE DASHBOARD — 3 Financial Cards (dynamic via JS)
══════════════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

    {{-- Card 1: Revenue Ads --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Revenue Iklan</p>
                <p class="text-2xl font-extrabold text-ink mt-1" id="card-ads-total">Rp&nbsp;0</p>
                <p class="text-xs text-emerald font-semibold mt-1 flex items-center gap-1" id="card-ads-growth">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> — dari bulan lalu
                </p>
            </div>
            <div class="w-9 h-9 rounded-md bg-accent/10 border border-accent/20 flex items-center justify-center shrink-0">
                <i class="bi bi-broadcast text-accent text-lg"></i>
            </div>
        </div>
        <div class="border-t border-border-ui pt-3 space-y-1.5" id="card-ads-details">
            <div class="flex items-center justify-between text-xs">
                <span class="text-muted">Memuat data...</span>
                <span class="font-semibold text-ink">—</span>
            </div>
        </div>
        <a id="card-ads-link"
           class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition mt-auto cursor-pointer">
            Lihat Rincian Mutasi <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    {{-- Card 2: Revenue Komisi 10% Escrow --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Komisi Escrow (10%)</p>
                <p class="text-2xl font-extrabold text-ink mt-1" id="card-komisi-total">Rp&nbsp;0</p>
                <p class="text-xs text-muted mt-1 flex items-center gap-1" id="card-komisi-count">
                    <i class="bi bi-layers-fill text-accent"></i> Dari 0 transaksi les
                </p>
            </div>
            <div class="w-9 h-9 rounded-md bg-emerald/10 border border-emerald/20 flex items-center justify-center shrink-0">
                <i class="bi bi-cash-stack text-emerald text-lg"></i>
            </div>
        </div>
        <div class="border-t border-border-ui pt-3 space-y-1.5">
            <div class="flex items-center justify-between text-xs">
                <span class="text-muted">Total Sesi Les Sukses</span>
                <span class="font-semibold text-ink" id="card-komisi-sesi">0 transaksi</span>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="text-muted">Rata-rata Komisi per Sesi</span>
                <span class="font-semibold text-ink" id="card-komisi-avg">Rp 0</span>
            </div>
        </div>
        <a id="card-komisi-link"
           class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition mt-auto cursor-pointer">
            Lihat Rincian Mutasi <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    {{-- Card 3: Revenue Premium Subscription --}}
    <div class="bg-white border border-border-ui rounded-lg p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-muted uppercase tracking-wide">Premium Subscription</p>
                <p class="text-2xl font-extrabold text-ink mt-1" id="card-premium-total">Rp&nbsp;0</p>
                <p class="text-xs text-muted mt-1 flex items-center gap-1" id="card-premium-count">
                    <i class="bi bi-people-fill text-gold"></i> 0 member aktif
                </p>
            </div>
            <div class="w-9 h-9 rounded-md bg-gold/10 border border-gold/20 flex items-center justify-center shrink-0">
                <i class="bi bi-trophy text-gold text-lg"></i>
            </div>
        </div>
        <div class="border-t border-border-ui pt-3 space-y-1.5" id="card-premium-details">
            <div class="flex items-center justify-between text-xs">
                <span class="text-muted">Memuat data...</span>
                <span class="font-semibold text-ink">—</span>
            </div>
        </div>
        <a id="card-premium-link"
           class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition mt-auto cursor-pointer">
            Lihat Rincian Mutasi <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

{{-- ═════════════════════════════════════════════════════════════════════
     B. USER ANALYTICS — Horizontal Bar Chart (Pure CSS)
══════════════════════════════════════════════════════════════════════ --}}
<div class="bg-white border border-border-ui rounded-lg p-5 mb-8">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-sm font-bold text-ink">Analisis Pertumbuhan Pengguna</h2>
            <p class="text-xs text-muted mt-0.5">Perbandingan jumlah Tutee vs Tutor</p>
        </div>
        <div class="inline-flex items-center gap-1.5 bg-slate-50 border border-border-ui rounded-md px-3 py-1.5 text-xs text-muted">
            <i class="bi bi-bar-chart-line-fill text-accent"></i>
            <span>Per {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}</span>
        </div>
    </div>

    <div class="space-y-5">
        {{-- Bar Tutee (Navy) --}}
        <div>
            <div class="flex items-center justify-between text-sm mb-1.5">
                <span class="font-semibold text-ink flex items-center gap-2">
                    <span class="w-3 h-3 rounded-sm bg-accent inline-block"></span>
                    Tutee (Murid) Terdaftar
                </span>
                <span class="font-extrabold text-ink">850 Mahasiswa</span>
            </div>
            <div class="w-full bg-slate-100 rounded-md h-5 overflow-hidden">
                <div class="bg-accent h-full rounded-md flex items-center justify-end pr-3 text-[10px] font-bold text-white"
                     style="width: 88%;">88%</div>
            </div>
        </div>

        {{-- Bar Tutor (Gold) --}}
        <div>
            <div class="flex items-center justify-between text-sm mb-1.5">
                <span class="font-semibold text-ink flex items-center gap-2">
                    <span class="w-3 h-3 rounded-sm bg-gold inline-block"></span>
                    Tutor (Pengajar) Terdaftar
                </span>
                <span class="font-extrabold text-ink">120 Tutor</span>
            </div>
            <div class="w-full bg-slate-100 rounded-md h-5 overflow-hidden">
                <div class="bg-gold h-full rounded-md flex items-center justify-end pr-3 text-[10px] font-bold text-white"
                     style="width: 12%;">12%</div>
            </div>
        </div>
    </div>

    {{-- Analisis --}}
    <div class="mt-5 p-4 bg-slate-50 border border-border-ui rounded-lg flex items-start gap-3">
        <div class="w-8 h-8 rounded-md bg-emerald/10 border border-emerald/20 flex items-center justify-center shrink-0">
            <i class="bi bi-check2-circle text-emerald"></i>
        </div>
        <div>
            <p class="text-sm font-semibold text-ink">Status Pasar: <span class="text-emerald">Sehat</span></p>
            <p class="text-xs text-muted mt-0.5">Rasio Tutee:Tutor = <strong class="text-ink">7:1</strong> — Ideal untuk keseimbangan supply & demand pasar les privat. Jumlah tutor masih bisa ditingkatkan untuk memenuhi permintaan yang terus tumbuh.</p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ═══════════════════════════════════════════════════════════════════════
// MASTER DATA — 5 bulan (Feb 2026 – Jun 2026)
// Struktur: month -> { ads: { total, items[] }, komisi: { total, count, items[] }, premium: { total, count, items[] } }
// ═══════════════════════════════════════════════════════════════════════
const MONTH_DATA = {
    1: {
        label: 'Februari 2026',
        ads: {
            total: 100000,
            items: [
                { mitra: 'Google AdSense In-App', nominal: 100000, jenis: 'Google AdSense' }
            ]
        },
        komisi: {
            total: 1000000,
            count: 100,
            avg: 10000,
            sesi: 100,
            items: [
                { tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '08 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '10 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '12 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '15 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '18 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '20 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '22 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '24 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '26 Feb 2026', total: 100000, komisi: 10000 },
                { tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '28 Feb 2026', total: 100000, komisi: 10000 }
            ]
        },
        premium: {
            total: 350000,
            count: 10,
            items: [
                { uid: 'USR-P001', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P002', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P003', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P004', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P005', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P006', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P007', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P008', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P009', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P010', name: 'William Tan', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 }
            ]
        }
    },
    2: {
        label: 'Maret 2026',
        ads: {
            total: 200000,
            items: [
                { mitra: 'Google AdSense In-App', nominal: 150000, jenis: 'Google AdSense' },
                { mitra: 'Banner Sponsor Kampus', nominal: 50000, jenis: 'Banner Sponsor' }
            ]
        },
        komisi: {
            total: 2130000,
            count: 213,
            avg: 10000,
            sesi: 213,
            items: [
                { tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Mar 2026', total: 200000, komisi: 20000 },
                { tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Mar 2026', total: 150000, komisi: 15000 },
                { tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Mar 2026', total: 100000, komisi: 10000 },
                { tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Mar 2026', total: 180000, komisi: 18000 },
                { tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Mar 2026', total: 120000, komisi: 12000 },
                { tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Mar 2026', total: 200000, komisi: 20000 },
                { tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Mar 2026', total: 160000, komisi: 16000 },
                { tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Mar 2026', total: 140000, komisi: 14000 },
                { tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Mar 2026', total: 150000, komisi: 15000 },
                { tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Mar 2026', total: 130000, komisi: 13000 },
                { tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Mar 2026', total: 170000, komisi: 17000 },
                { tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Mar 2026', total: 190000, komisi: 19000 },
                { tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Mar 2026', total: 130000, komisi: 13000 },
                { tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Mar 2026', total: 120000, komisi: 12000 },
                { tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Mar 2026', total: 160000, komisi: 16000 },
                { tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '31 Mar 2026', total: 200000, komisi: 20000 }
            ]
        },
        premium: {
            total: 745500,
            count: 10,
            items: [
                { uid: 'USR-P011', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P012', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P013', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P014', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P015', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', nominal: 65000 },
                { uid: 'USR-P016', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Tahunan', nominal: 25000 },
                { uid: 'USR-P017', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', nominal: 35000 },
                { uid: 'USR-P018', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', nominal: 25000 },
                { uid: 'USR-P019', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P020', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 }
            ]
        }
    },
    3: {
        label: 'April 2026',
        ads: {
            total: 300000,
            items: [
                { mitra: 'Google AdSense In-App', nominal: 200000, jenis: 'Google AdSense' },
                { mitra: 'Banner Sponsor Kampus', nominal: 100000, jenis: 'Banner Sponsor' }
            ]
        },
        komisi: {
            total: 3410000,
            count: 310,
            avg: 11000,
            sesi: 310,
            items: [
                { tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Apr 2026', total: 200000, komisi: 20000 },
                { tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '30 Apr 2026', total: 210000, komisi: 21000 }
            ]
        },
        premium: {
            total: 1193500,
            count: 12,
            items: [
                { uid: 'USR-P021', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P022', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P023', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P024', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P025', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P026', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P027', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P028', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', nominal: 25000 },
                { uid: 'USR-P029', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P030', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P031', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', nominal: 50000 },
                { uid: 'USR-P032', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', nominal: 77500 }
            ]
        }
    },
    4: {
        label: 'Mei 2026',
        ads: {
            total: 400000,
            items: [
                { mitra: 'Google AdSense In-App', nominal: 250000, jenis: 'Google AdSense' },
                { mitra: 'Banner Sponsor Kampus', nominal: 150000, jenis: 'Banner Sponsor' }
            ]
        },
        komisi: {
            total: 4880000,
            count: 400,
            avg: 12200,
            sesi: 400,
            items: [
                { tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Mei 2026', total: 250000, komisi: 25000 },
                { tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '31 Mei 2026', total: 380000, komisi: 38000 }
            ]
        },
        premium: {
            total: 1701000,
            count: 14,
            items: [
                { uid: 'USR-P033', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P034', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P035', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P036', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P037', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P038', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P039', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P040', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P041', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P042', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P043', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P044', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P045', name: 'Cindy Permata', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P046', name: 'Eko Prasetyo', role: 'Tutor', paket: 'PRO Tahunan', nominal: 100000 }
            ]
        }
    },
    5: {
        label: 'Juni 2026',
        ads: {
            total: 500000,
            items: [
                { mitra: 'Google AdSense In-App', nominal: 300000, jenis: 'Google AdSense' },
                { mitra: 'Banner Sponsor Kampus', nominal: 200000, jenis: 'Banner Sponsor' }
            ]
        },
        komisi: {
            total: 6500000,
            count: 500,
            avg: 13000,
            sesi: 500,
            items: [
                { tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Jun 2026', total: 300000, komisi: 30000 },
                { tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '30 Jun 2026', total: 500000, komisi: 50000 }
            ]
        },
        premium: {
            total: 2275000,
            count: 15,
            items: [
                { uid: 'USR-P047', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P048', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P049', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P050', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P051', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Tahunan', nominal: 250000 },
                { uid: 'USR-P052', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P053', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P054', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P055', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P056', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', nominal: 50000 },
                { uid: 'USR-P057', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P058', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P059', name: 'Cindy Permata', role: 'Tutee', paket: 'PRO Bulanan', nominal: 60000 },
                { uid: 'USR-P060', name: 'Eko Prasetyo', role: 'Tutor', paket: 'PRO Tahunan', nominal: 100000 },
                { uid: 'USR-P061', name: 'Fajar Nugroho', role: 'Tutee', paket: 'PRO Tahunan', nominal: 125000 }
            ]
        }
    }
};

// ═══════════════════════════════════════════════════════════════════════
// DASHBOARD RENDER ENGINE
// ═══════════════════════════════════════════════════════════════════════

function formatRp(val) {
    return 'Rp\u00a0' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function getMonthFromURL() {
    const params = new URLSearchParams(window.location.search);
    const m = params.get('month');
    if (m && MONTH_DATA[m]) return parseInt(m);
    return 1; // default Feb 2026
}

function renderDashboard(m) {
    const data = MONTH_DATA[m];
    if (!data) return;

    // Set dropdown
    const sel = document.getElementById('month-filter');
    if (sel) sel.value = m;

    // ── Card 1: Ads ──────────────────────────────────────────────────
    document.getElementById('card-ads-total').textContent = formatRp(data.ads.total);
    const adsDetails = data.ads.items.map(function(item) {
        return '<div class="flex items-center justify-between text-xs"><span class="text-muted">' + item.mitra + '</span><span class="font-semibold text-ink">' + formatRp(item.nominal) + '</span></div>';
    }).join('');
    document.getElementById('card-ads-details').innerHTML = adsDetails;
    document.getElementById('card-ads-link').setAttribute('href', '{{ route("admin.revenue") }}?month=' + m + '&type=ads');
    document.getElementById('card-ads-growth').innerHTML = '<i class="bi bi-arrow-up-right-circle-fill"></i> ' + data.label;

    // ── Card 2: Komisi ───────────────────────────────────────────────
    document.getElementById('card-komisi-total').textContent = formatRp(data.komisi.total);
    document.getElementById('card-komisi-count').innerHTML = '<i class="bi bi-layers-fill text-accent"></i> Dari ' + data.komisi.count + ' transaksi les';
    document.getElementById('card-komisi-sesi').textContent = data.komisi.sesi + ' transaksi';
    document.getElementById('card-komisi-avg').textContent = formatRp(data.komisi.avg);
    document.getElementById('card-komisi-link').setAttribute('href', '{{ route("admin.revenue") }}?month=' + m + '&type=komisi');

    // ── Card 3: Premium ──────────────────────────────────────────────
    document.getElementById('card-premium-total').textContent = formatRp(data.premium.total);
    document.getElementById('card-premium-count').innerHTML = '<i class="bi bi-people-fill text-gold"></i> ' + data.premium.count + ' member aktif';
    const premDetails = data.premium.items.map(function(item) {
        return '<div class="flex items-center justify-between text-xs"><span class="text-muted">' + item.name + ' (' + item.role + ')</span><span class="font-semibold text-ink">' + formatRp(item.nominal) + '</span></div>';
    }).join('');
    document.getElementById('card-premium-details').innerHTML = premDetails;
    document.getElementById('card-premium-link').setAttribute('href', '{{ route("admin.revenue") }}?month=' + m + '&type=premium');
}

function changeMonth(val) {
    window.location.href = '{{ route("admin.dashboard") }}?month=' + val;
}

// ── Init on DOM ready ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    const month = getMonthFromURL();
    renderDashboard(month);
});
</script>
@endpush
