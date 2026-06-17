@extends('admin.layouts.app')
@section('title', 'Laporan & Rincian Arus Kas')

@section('content')

{{-- Page Header with Month Filter --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div>
        <h1 class="text-xl font-bold text-ink">Laporan & Rincian Arus Kas</h1>
        <p class="text-sm text-muted mt-0.5">Pencatatan granular seluruh aliran dana masuk platform Tutorium — <span id="period-label" class="font-semibold text-accent">Februari 2026</span></p>
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

{{-- Live Search Bar --}}
<div class="mb-5">
    <div class="relative max-w-sm">
        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-muted text-sm"></i>
        <input type="text" id="live-search" placeholder="Cari nama tutee, mitra, atau member..."
               class="w-full pl-9 pr-4 py-2.5 text-sm border border-border-ui rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
    </div>
</div>

{{-- Tab Navigation --}}
<div class="bg-white border border-border-ui rounded-lg overflow-hidden mb-6">
    <div class="flex flex-wrap border-b border-border-ui bg-slate-50/50" id="tab-buttons">
        <button id="btn-tab-ads"
                onclick="switchTab('ads')"
                class="tab-btn px-5 py-3 text-sm font-semibold border-b-2 border-transparent transition-colors flex items-center gap-2 text-ink border-accent bg-white">
            <i class="bi bi-broadcast text-base"></i>
            Revenue Iklan & Kemitraan
        </button>
        <button id="btn-tab-premium"
                onclick="switchTab('premium')"
                class="tab-btn px-5 py-3 text-sm font-semibold border-b-2 border-transparent transition-colors flex items-center gap-2 text-muted bg-transparent">
            <i class="bi bi-trophy text-base"></i>
            Premium Subscription Member
        </button>
        <button id="btn-tab-komisi"
                onclick="switchTab('komisi')"
                class="tab-btn px-5 py-3 text-sm font-semibold border-b-2 border-transparent transition-colors flex items-center gap-2 text-muted bg-transparent">
            <i class="bi bi-cash-stack text-base"></i>
            Komisi Transaksi Escrow 10%
        </button>
    </div>
</div>

{{-- Tab Content Containers --}}
<div id="content-ads" class="tab-content"></div>
<div id="content-premium" class="tab-content hidden"></div>
<div id="content-komisi" class="tab-content hidden"></div>

{{-- Hidden Modal Backdrop --}}
<div id="invoice-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4 overflow-hidden border border-border-ui">
        <div class="px-6 py-5 border-b border-border-ui flex items-center justify-between">
            <h3 class="text-sm font-bold text-ink flex items-center gap-2">
                <i class="bi bi-receipt text-accent"></i>
                Kuitansi Digital — <span id="modal-invoice-id" class="font-mono"></span>
            </h3>
            <button onclick="closeModal()" class="text-muted hover:text-ink transition p-1">
                <i class="bi bi-x-lg text-sm"></i>
            </button>
        </div>
        <div class="px-6 py-5 space-y-4" id="modal-body">
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div><span class="text-muted text-xs">Tanggal</span><p id="modal-date" class="font-semibold text-ink">—</p></div>
                <div><span class="text-muted text-xs">Status</span><p id="modal-status" class="font-semibold">—</p></div>
                <div class="col-span-2"><span class="text-muted text-xs">Deskripsi</span><p id="modal-desc" class="font-semibold text-ink">—</p></div>
            </div>
            <div class="border-t border-border-ui pt-3 flex items-center justify-between">
                <span class="text-sm text-muted">Total Dibayarkan</span>
                <span id="modal-nominal" class="text-lg font-extrabold text-ink">Rp 0</span>
            </div>
            <div class="flex justify-center pt-2">
                <div class="inline-flex items-center gap-2 bg-emerald/10 border-2 border-emerald/40 rounded-lg px-6 py-3">
                    <i class="bi bi-check-circle-fill text-emerald text-2xl"></i>
                    <span class="text-emerald font-extrabold text-lg tracking-wider">PAID</span>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-slate-50 border-t border-border-ui flex justify-end">
            <button onclick="closeModal()" class="text-xs font-semibold bg-accent text-white px-5 py-2 rounded-md hover:bg-accent-dark transition">Tutup</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ═══════════════════════════════════════════════════════════════════════
// MASTER DATA — SAME AS DASHBOARD (mathematical sync guaranteed)
// ═══════════════════════════════════════════════════════════════════════
const MONTH_DATA = {
    1: {
        label: 'Februari 2026',
        ads: {
            total: 100000,
            items: [
                { invoice: 'INV-ADS-2026-001', date: '12 Feb 2026', mitra: 'Google AdSense In-App', jenis: 'Google AdSense', metrik: '8.230 klik', nominal: 100000, status: 'SETTLED' }
            ]
        },
        komisi: {
            total: 1000000,
            count: 100,
            sesi: 100,
            items: [
                { sid: 'SES-2026-0201', tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '08 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0202', tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '10 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0203', tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '12 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0204', tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '15 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0205', tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '18 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0206', tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '20 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0207', tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '22 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0208', tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '24 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0209', tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '26 Feb 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0210', tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '28 Feb 2026', total: 100000, komisi: 10000 }
            ]
        },
        premium: {
            total: 350000,
            count: 10,
            items: [
                { uid: 'USR-P001', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Bulanan', mulai: '02 Feb 2026', akhir: '02 Mar 2026', nominal: 35000 },
                { uid: 'USR-P002', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Bulanan', mulai: '05 Feb 2026', akhir: '05 Mar 2026', nominal: 35000 },
                { uid: 'USR-P003', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', mulai: '08 Feb 2026', akhir: '08 Mar 2026', nominal: 35000 },
                { uid: 'USR-P004', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Bulanan', mulai: '10 Feb 2026', akhir: '10 Mar 2026', nominal: 35000 },
                { uid: 'USR-P005', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', mulai: '12 Feb 2026', akhir: '12 Mar 2026', nominal: 35000 },
                { uid: 'USR-P006', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', mulai: '15 Feb 2026', akhir: '15 Mar 2026', nominal: 35000 },
                { uid: 'USR-P007', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', mulai: '18 Feb 2026', akhir: '18 Mar 2026', nominal: 35000 },
                { uid: 'USR-P008', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Bulanan', mulai: '20 Feb 2026', akhir: '20 Mar 2026', nominal: 35000 },
                { uid: 'USR-P009', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', mulai: '22 Feb 2026', akhir: '22 Mar 2026', nominal: 35000 },
                { uid: 'USR-P010', name: 'William Tan', role: 'Tutor', paket: 'PRO Bulanan', mulai: '25 Feb 2026', akhir: '25 Mar 2026', nominal: 35000 }
            ]
        }
    },
    2: {
        label: 'Maret 2026',
        ads: {
            total: 200000,
            items: [
                { invoice: 'INV-ADS-2026-002', date: '05 Mar 2026', mitra: 'Google AdSense In-App', jenis: 'Google AdSense', metrik: '9.450 klik', nominal: 150000, status: 'SETTLED' },
                { invoice: 'INV-ADS-2026-003', date: '18 Mar 2026', mitra: 'Banner Sponsor Kampus', jenis: 'Banner Sponsor', metrik: '9.870 impressions', nominal: 50000, status: 'SETTLED' }
            ]
        },
        komisi: {
            total: 2130000,
            count: 213,
            sesi: 213,
            items: [
                { sid: 'SES-2026-0301', tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Mar 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0302', tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Mar 2026', total: 150000, komisi: 15000 },
                { sid: 'SES-2026-0303', tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Mar 2026', total: 100000, komisi: 10000 },
                { sid: 'SES-2026-0304', tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Mar 2026', total: 180000, komisi: 18000 },
                { sid: 'SES-2026-0305', tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Mar 2026', total: 120000, komisi: 12000 },
                { sid: 'SES-2026-0306', tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Mar 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0307', tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Mar 2026', total: 160000, komisi: 16000 },
                { sid: 'SES-2026-0308', tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Mar 2026', total: 140000, komisi: 14000 },
                { sid: 'SES-2026-0309', tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Mar 2026', total: 150000, komisi: 15000 },
                { sid: 'SES-2026-0310', tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Mar 2026', total: 130000, komisi: 13000 },
                { sid: 'SES-2026-0311', tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Mar 2026', total: 170000, komisi: 17000 },
                { sid: 'SES-2026-0312', tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Mar 2026', total: 190000, komisi: 19000 },
                { sid: 'SES-2026-0313', tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Mar 2026', total: 130000, komisi: 13000 },
                { sid: 'SES-2026-0314', tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Mar 2026', total: 120000, komisi: 12000 },
                { sid: 'SES-2026-0315', tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Mar 2026', total: 160000, komisi: 16000 },
                { sid: 'SES-2026-0316', tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '31 Mar 2026', total: 200000, komisi: 20000 }
            ]
        },
        premium: {
            total: 745500,
            count: 10,
            items: [
                { uid: 'USR-P011', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 250000 },
                { uid: 'USR-P012', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Bulanan', mulai: '02 Mar 2026', akhir: '02 Apr 2026', nominal: 35000 },
                { uid: 'USR-P013', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', mulai: '05 Mar 2026', akhir: '05 Apr 2026', nominal: 60000 },
                { uid: 'USR-P014', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 250000 },
                { uid: 'USR-P015', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', mulai: '10 Mar 2026', akhir: '10 Apr 2026', nominal: 65000 },
                { uid: 'USR-P016', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 25000 },
                { uid: 'USR-P017', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', mulai: '12 Mar 2026', akhir: '12 Apr 2026', nominal: 35000 },
                { uid: 'USR-P018', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 25000 },
                { uid: 'USR-P019', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 50000 },
                { uid: 'USR-P020', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mar 2026', akhir: '01 Mar 2027', nominal: 50000 }
            ]
        }
    },
    3: {
        label: 'April 2026',
        ads: {
            total: 300000,
            items: [
                { invoice: 'INV-ADS-2026-004', date: '05 Apr 2026', mitra: 'Google AdSense In-App', jenis: 'Google AdSense', metrik: '11.450 klik', nominal: 200000, status: 'SETTLED' },
                { invoice: 'INV-ADS-2026-005', date: '18 Apr 2026', mitra: 'Banner Sponsor Kampus', jenis: 'Banner Sponsor', metrik: '14.200 impressions', nominal: 100000, status: 'SETTLED' }
            ]
        },
        komisi: {
            total: 3410000,
            count: 310,
            sesi: 310,
            items: [
                { sid: 'SES-2026-0401', tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0402', tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0403', tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0404', tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0405', tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0406', tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0407', tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0408', tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0409', tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0410', tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0411', tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0412', tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0413', tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0414', tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0415', tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Apr 2026', total: 200000, komisi: 20000 },
                { sid: 'SES-2026-0416', tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '30 Apr 2026', total: 210000, komisi: 21000 }
            ]
        },
        premium: {
            total: 1193500,
            count: 12,
            items: [
                { uid: 'USR-P021', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Apr 2026', akhir: '01 Apr 2027', nominal: 250000 },
                { uid: 'USR-P022', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Apr 2026', akhir: '01 Apr 2027', nominal: 250000 },
                { uid: 'USR-P023', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Bulanan', mulai: '02 Apr 2026', akhir: '02 Mei 2026', nominal: 60000 },
                { uid: 'USR-P024', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Apr 2026', akhir: '01 Apr 2027', nominal: 250000 },
                { uid: 'USR-P025', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', mulai: '05 Apr 2026', akhir: '05 Mei 2026', nominal: 60000 },
                { uid: 'USR-P026', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', mulai: '08 Apr 2026', akhir: '08 Mei 2026', nominal: 60000 },
                { uid: 'USR-P027', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', mulai: '10 Apr 2026', akhir: '10 Mei 2026', nominal: 60000 },
                { uid: 'USR-P028', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Apr 2026', akhir: '01 Apr 2027', nominal: 25000 },
                { uid: 'USR-P029', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', mulai: '12 Apr 2026', akhir: '12 Mei 2026', nominal: 60000 },
                { uid: 'USR-P030', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Apr 2026', akhir: '01 Apr 2027', nominal: 50000 },
                { uid: 'USR-P031', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', mulai: '15 Apr 2026', akhir: '15 Mei 2026', nominal: 50000 },
                { uid: 'USR-P032', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', mulai: '18 Apr 2026', akhir: '18 Mei 2026', nominal: 77500 }
            ]
        }
    },
    4: {
        label: 'Mei 2026',
        ads: {
            total: 400000,
            items: [
                { invoice: 'INV-ADS-2026-006', date: '02 Mei 2026', mitra: 'Google AdSense In-App', jenis: 'Google AdSense', metrik: '12.300 klik', nominal: 250000, status: 'SETTLED' },
                { invoice: 'INV-ADS-2026-007', date: '18 Mei 2026', mitra: 'Banner Sponsor Kampus', jenis: 'Banner Sponsor', metrik: '15.100 impressions', nominal: 150000, status: 'SETTLED' }
            ]
        },
        komisi: {
            total: 4880000,
            count: 400,
            sesi: 400,
            items: [
                { sid: 'SES-2026-0501', tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0502', tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0503', tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0504', tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0505', tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0506', tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0507', tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0508', tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0509', tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0510', tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0511', tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0512', tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0513', tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0514', tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0515', tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Mei 2026', total: 250000, komisi: 25000 },
                { sid: 'SES-2026-0516', tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '31 Mei 2026', total: 380000, komisi: 38000 }
            ]
        },
        premium: {
            total: 1701000,
            count: 14,
            items: [
                { uid: 'USR-P033', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 250000 },
                { uid: 'USR-P034', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 250000 },
                { uid: 'USR-P035', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 250000 },
                { uid: 'USR-P036', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 250000 },
                { uid: 'USR-P037', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Bulanan', mulai: '02 Mei 2026', akhir: '02 Jun 2026', nominal: 60000 },
                { uid: 'USR-P038', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', mulai: '05 Mei 2026', akhir: '05 Jun 2026', nominal: 60000 },
                { uid: 'USR-P039', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', mulai: '08 Mei 2026', akhir: '08 Jun 2026', nominal: 60000 },
                { uid: 'USR-P040', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 50000 },
                { uid: 'USR-P041', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', mulai: '10 Mei 2026', akhir: '10 Jun 2026', nominal: 60000 },
                { uid: 'USR-P042', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 50000 },
                { uid: 'USR-P043', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', mulai: '12 Mei 2026', akhir: '12 Jun 2026', nominal: 60000 },
                { uid: 'USR-P044', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', mulai: '15 Mei 2026', akhir: '15 Jun 2026', nominal: 60000 },
                { uid: 'USR-P045', name: 'Cindy Permata', role: 'Tutee', paket: 'PRO Bulanan', mulai: '18 Mei 2026', akhir: '18 Jun 2026', nominal: 60000 },
                { uid: 'USR-P046', name: 'Eko Prasetyo', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Mei 2026', akhir: '01 Mei 2027', nominal: 100000 }
            ]
        }
    },
    5: {
        label: 'Juni 2026',
        ads: {
            total: 500000,
            items: [
                { invoice: 'INV-ADS-2026-008', date: '05 Jun 2026', mitra: 'Google AdSense In-App', jenis: 'Google AdSense', metrik: '14.100 klik', nominal: 300000, status: 'SETTLED' },
                { invoice: 'INV-ADS-2026-009', date: '18 Jun 2026', mitra: 'Banner Sponsor Kampus', jenis: 'Banner Sponsor', metrik: '18.500 impressions', nominal: 200000, status: 'SETTLED' }
            ]
        },
        komisi: {
            total: 6500000,
            count: 500,
            sesi: 500,
            items: [
                { sid: 'SES-2026-0601', tutee: 'Budi Hartono', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '01 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0602', tutee: 'Sinta Permatasari', tutor: 'Tutor Amanda Putri', mapel: 'Machine Learning', tgl: '03 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0603', tutee: 'Rizky Fadhilah', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '05 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0604', tutee: 'Dewi Lestari', tutor: 'Tutor Felicia Tan', mapel: 'UI/UX Design', tgl: '07 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0605', tutee: 'Andi Pratama', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '09 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0606', tutee: 'Maya Sari', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '11 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0607', tutee: 'Deni Setiawan', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '13 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0608', tutee: 'Farhan Hakim', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '15 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0609', tutee: 'Siska Anindya', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '17 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0610', tutee: 'Galih Rakasiwi', tutor: 'Tutor Felicia Tan', mapel: 'Figma Prototyping', tgl: '19 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0611', tutee: 'Rina Amelia', tutor: 'Tutor Gilang Ramadhan', mapel: 'Database Design', tgl: '21 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0612', tutee: 'William Tan', tutor: 'Tutor Rina Gunawan', mapel: 'Next.js Routing', tgl: '23 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0613', tutee: 'Jessica Vania', tutor: 'Tutor Dimas Ardian', mapel: 'React Native', tgl: '25 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0614', tutee: 'Ahmad Faisal', tutor: 'Tutor Budi Wahyudi', mapel: 'Git & Version Control', tgl: '27 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0615', tutee: 'Melati Kusuma', tutor: 'Tutor Amanda Putri', mapel: 'Python Basics', tgl: '29 Jun 2026', total: 300000, komisi: 30000 },
                { sid: 'SES-2026-0616', tutee: 'Kevin Wijaya', tutor: 'Tutor Asdos Eko', mapel: 'Laravel Advanced', tgl: '30 Jun 2026', total: 500000, komisi: 50000 }
            ]
        },
        premium: {
            total: 2275000,
            count: 15,
            items: [
                { uid: 'USR-P047', name: 'Randi Mansoor', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 250000 },
                { uid: 'USR-P048', name: 'Safira Citra', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 250000 },
                { uid: 'USR-P049', name: 'Dimas Prayoga', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 250000 },
                { uid: 'USR-P050', name: 'Melati Kusuma', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 250000 },
                { uid: 'USR-P051', name: 'Budi Santoso', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 250000 },
                { uid: 'USR-P052', name: 'Kevin Wijaya', role: 'Tutor', paket: 'PRO Bulanan', mulai: '02 Jun 2026', akhir: '02 Jul 2026', nominal: 60000 },
                { uid: 'USR-P053', name: 'Rina Amelia', role: 'Tutee', paket: 'PRO Bulanan', mulai: '05 Jun 2026', akhir: '05 Jul 2026', nominal: 60000 },
                { uid: 'USR-P054', name: 'Ahmad Faisal', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 50000 },
                { uid: 'USR-P055', name: 'Jessica Vania', role: 'Tutee', paket: 'PRO Bulanan', mulai: '08 Jun 2026', akhir: '08 Jul 2026', nominal: 60000 },
                { uid: 'USR-P056', name: 'William Tan', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 50000 },
                { uid: 'USR-P057', name: 'Bunga Citra', role: 'Tutee', paket: 'PRO Bulanan', mulai: '10 Jun 2026', akhir: '10 Jul 2026', nominal: 60000 },
                { uid: 'USR-P058', name: 'Adi Saputra', role: 'Tutor', paket: 'PRO Bulanan', mulai: '12 Jun 2026', akhir: '12 Jul 2026', nominal: 60000 },
                { uid: 'USR-P059', name: 'Cindy Permata', role: 'Tutee', paket: 'PRO Bulanan', mulai: '15 Jun 2026', akhir: '15 Jul 2026', nominal: 60000 },
                { uid: 'USR-P060', name: 'Eko Prasetyo', role: 'Tutor', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 100000 },
                { uid: 'USR-P061', name: 'Fajar Nugroho', role: 'Tutee', paket: 'PRO Tahunan', mulai: '01 Jun 2026', akhir: '01 Jun 2027', nominal: 125000 }
            ]
        }
    }
};

// ═══════════════════════════════════════════════════════════════════════
// RENDER ENGINE
// ═══════════════════════════════════════════════════════════════════════

let activeTab = 'ads';
let currentMonth = 1;

function formatRp(val) {
    return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function getMonthFromURL() {
    const params = new URLSearchParams(window.location.search);
    const m = params.get('month');
    if (m && MONTH_DATA[m]) return parseInt(m);
    return 1;
}

function changeMonth(val) {
    const type = activeTab;
    window.location.href = '{{ route("admin.revenue") }}?month=' + val + '&type=' + type;
}

function buildTableAds(items) {
    if (!items || items.length === 0) {
        return '<div class="p-8 text-center text-muted text-sm">Tidak ada data Revenue Iklan untuk periode ini.</div>';
    }
    const totalComputed = items.reduce(function(sum, item) { return sum + item.nominal; }, 0);
    const rows = items.map(function(item) {
        var badge = item.status === 'SETTLED'
            ? '<span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-check-circle-fill text-[10px]"></i> SETTLED</span>'
            : '<span class="inline-flex items-center gap-1 bg-amber-500/10 border border-amber-500/30 text-amber-600 text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-clock-fill text-[10px]"></i> PENDING</span>';
        var jenisBadge = item.jenis === 'Google AdSense'
            ? '<span class="inline-flex items-center gap-1 bg-accent/10 border border-accent/20 text-accent text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-google text-[10px]"></i> ' + item.jenis + '</span>'
            : '<span class="inline-flex items-center gap-1 bg-gold/10 border border-gold/20 text-gold text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-megaphone-fill text-[10px]"></i> ' + item.jenis + '</span>';
        return '<tr class="hover:bg-slate-50/60 transition searchable">' +
            '<td class="px-5 py-3.5 font-mono text-xs font-bold text-ink">' + item.invoice + '</td>' +
            '<td class="px-5 py-3.5 text-muted text-sm">' + item.date + '</td>' +
            '<td class="px-5 py-3.5 font-semibold text-ink search-target">' + item.mitra + '</td>' +
            '<td class="px-5 py-3.5">' + jenisBadge + '</td>' +
            '<td class="px-5 py-3.5 text-muted text-sm">' + item.metrik + '</td>' +
            '<td class="px-5 py-3.5 text-right font-bold text-ink">Rp ' + formatRp(item.nominal) + '</td>' +
            '<td class="px-5 py-3.5 text-center">' + badge + '</td>' +
            '<td class="px-5 py-3.5 text-center">' +
            '<button onclick="showModal(\'' + item.invoice + '\', \'' + item.date + '\', \'' + item.mitra + '\', \'' + item.jenis + '\', ' + item.nominal + ', \'' + item.status + '\')" class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition bg-accent/5 border border-accent/20 px-3 py-1.5 rounded-md"><i class="bi bi-file-earmark-text-fill"></i> Kuitansi</button>' +
            '</td></tr>';
    }).join('');
    return '<div class="bg-white border border-border-ui rounded-lg overflow-hidden">' +
        '<div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">' +
        '<div><h2 class="text-sm font-bold text-ink flex items-center gap-2"><i class="bi bi-broadcast text-accent"></i> Detail Pendapatan Iklan & Kemitraan</h2>' +
        '<p class="text-xs text-muted mt-0.5">Seluruh pemasukan dari mitra pengiklan dan sponsor kampus.</p></div>' +
        '<span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-xs font-bold px-2.5 py-1 rounded-md"><i class="bi bi-check-circle-fill text-[10px]"></i> ' + items.length + ' transaksi</span></div>' +
        '<div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">' +
        '<th class="px-5 py-3 text-left">Invoice ID</th><th class="px-5 py-3 text-left">Tanggal</th><th class="px-5 py-3 text-left">Nama Mitra</th>' +
        '<th class="px-5 py-3 text-left">Jenis Iklan</th><th class="px-5 py-3 text-left">Metrik</th><th class="px-5 py-3 text-right">Nominal Masuk</th>' +
        '<th class="px-5 py-3 text-center">Status</th><th class="px-5 py-3 text-center">Aksi</th></tr></thead>' +
        '<tbody class="divide-y divide-border-ui">' + rows + '</tbody></table></div>' +
        '<div class="px-5 py-3 border-t border-border-ui bg-slate-50 flex items-center justify-between text-xs text-muted">' +
        '<span><i class="bi bi-info-circle text-accent mr-1"></i> Total pendapatan iklan (via .reduce()): <strong class="text-ink">' + formatRp(totalComputed) + '</strong></span>' +
        '<span>Periode ' + MONTH_DATA[currentMonth].label + '</span></div></div>';
}

function buildTablePremium(items) {
    if (!items || items.length === 0) {
        return '<div class="p-8 text-center text-muted text-sm">Tidak ada data Premium Subscription untuk periode ini.</div>';
    }
    const totalComputed = items.reduce(function(sum, item) { return sum + item.nominal; }, 0);
    const rows = items.map(function(item) {
        var roleBadge = item.role === 'Tutor'
            ? '<span class="inline-flex items-center gap-1 bg-accent/10 border border-accent/20 text-accent text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-mortarboard-fill text-[10px]"></i> Tutor</span>'
            : '<span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/20 text-emerald text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-person-fill text-[10px]"></i> Tutee</span>';
        var paketBadge = item.paket === 'PRO Tahunan'
            ? '<span class="inline-flex items-center gap-1 bg-gold/10 border border-gold/30 text-gold text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-star-fill text-[10px]"></i> ' + item.paket + '</span>'
            : '<span class="inline-flex items-center gap-1 bg-accent/10 border border-accent/20 text-accent text-[11px] font-bold px-2.5 py-1 rounded-md"><i class="bi bi-star text-[10px]"></i> ' + item.paket + '</span>';
        return '<tr class="hover:bg-slate-50/60 transition searchable">' +
            '<td class="px-5 py-3.5 font-mono text-xs font-bold text-ink">' + item.uid + '</td>' +
            '<td class="px-5 py-3.5 font-semibold text-ink search-target">' + item.name + '</td>' +
            '<td class="px-5 py-3.5">' + roleBadge + '</td>' +
            '<td class="px-5 py-3.5">' + paketBadge + '</td>' +
            '<td class="px-5 py-3.5 text-muted text-sm">' + item.mulai + ' &ndash; ' + item.akhir + '</td>' +
            '<td class="px-5 py-3.5 text-right font-bold text-ink">' + formatRp(item.nominal) + '</td>' +
            '<td class="px-5 py-3.5 text-center">' +
            '<button onclick="showModal(\'' + item.uid + '\', \'' + item.mulai + '\', \'' + item.name + '\', \'' + item.paket + '\', ' + item.nominal + ', \'ACTIVE\')" class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition bg-accent/5 border border-accent/20 px-3 py-1.5 rounded-md"><i class="bi bi-file-earmark-text-fill"></i> Kuitansi</button>' +
            '</td></tr>';
    }).join('');
    return '<div class="bg-white border border-border-ui rounded-lg overflow-hidden">' +
        '<div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">' +
        '<div><h2 class="text-sm font-bold text-ink flex items-center gap-2"><i class="bi bi-trophy text-gold"></i> Detail Pendapatan Premium Subscription</h2>' +
        '<p class="text-xs text-muted mt-0.5">Mahasiswa dan tutor yang berlangganan akun PRO.</p></div>' +
        '<span class="inline-flex items-center gap-1 bg-gold/10 border border-gold/30 text-gold text-xs font-bold px-2.5 py-1 rounded-md"><i class="bi bi-people-fill text-[10px]"></i> ' + items.length + ' member aktif</span></div>' +
        '<div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">' +
        '<th class="px-5 py-3 text-left">User ID</th><th class="px-5 py-3 text-left">Nama Pengguna</th><th class="px-5 py-3 text-left">Tipe Peran</th>' +
        '<th class="px-5 py-3 text-left">Paket Dipilih</th><th class="px-5 py-3 text-left">Masa Aktif</th><th class="px-5 py-3 text-right">Nominal</th>' +
        '<th class="px-5 py-3 text-center">Aksi</th></tr></thead>' +
        '<tbody class="divide-y divide-border-ui">' + rows + '</tbody></table></div>' +
        '<div class="px-5 py-3 border-t border-border-ui bg-slate-50 flex items-center justify-between text-xs text-muted">' +
        '<span><i class="bi bi-info-circle text-accent mr-1"></i> Total pendapatan premium (via .reduce()): <strong class="text-ink">' + formatRp(totalComputed) + '</strong></span>' +
        '<span>Periode ' + MONTH_DATA[currentMonth].label + '</span></div></div>';
}

function buildTableKomisi(items) {
    if (!items || items.length === 0) {
        return '<div class="p-8 text-center text-muted text-sm">Tidak ada data Komisi Escrow untuk periode ini.</div>';
    }
    const totalKomisi = items.reduce(function(sum, item) { return sum + item.komisi; }, 0);
    const totalTransaksi = items.reduce(function(sum, item) { return sum + item.total; }, 0);
    const rows = items.map(function(item) {
        return '<tr class="hover:bg-slate-50/60 transition searchable">' +
            '<td class="px-5 py-3.5 font-mono text-xs font-bold text-ink">' + item.sid + '</td>' +
            '<td class="px-5 py-3.5 font-semibold text-ink search-target">' + item.tutee + '</td>' +
            '<td class="px-5 py-3.5 text-muted">' + item.tutor + '</td>' +
            '<td class="px-5 py-3.5"><span class="inline-flex items-center gap-1 bg-slate-100 border border-border-ui text-ink text-[11px] font-semibold px-2.5 py-1 rounded-md">' + item.mapel + '</span></td>' +
            '<td class="px-5 py-3.5 text-muted text-sm">' + item.tgl + '</td>' +
            '<td class="px-5 py-3.5 text-right font-bold text-ink">' + formatRp(item.total) + '</td>' +
            '<td class="px-5 py-3.5 text-right font-bold text-emerald">' + formatRp(item.komisi) + '</td>' +
            '<td class="px-5 py-3.5 text-center">' +
            '<button onclick="showModal(\'' + item.sid + '\', \'' + item.tgl + '\', \'' + item.tutee + ' & ' + item.tutor + '\', \'' + item.mapel + '\', ' + item.komisi + ', \'SETTLED\')" class="inline-flex items-center gap-1 text-xs font-semibold text-accent hover:text-accent-dark transition bg-accent/5 border border-accent/20 px-3 py-1.5 rounded-md"><i class="bi bi-eye-fill"></i> Kuitansi</button>' +
            '</td></tr>';
    }).join('');
    return '<div class="bg-white border border-border-ui rounded-lg overflow-hidden">' +
        '<div class="px-5 py-4 border-b border-border-ui flex items-center justify-between">' +
        '<div><h2 class="text-sm font-bold text-ink flex items-center gap-2"><i class="bi bi-cash-stack text-emerald"></i> Detail Potongan Komisi Escrow 10%</h2>' +
        '<p class="text-xs text-muted mt-0.5">Pemotongan 10% dari setiap sesi les private yang berhasil.</p></div>' +
        '<span class="inline-flex items-center gap-1 bg-emerald/10 border border-emerald/30 text-emerald text-xs font-bold px-2.5 py-1 rounded-md"><i class="bi bi-layers-fill text-[10px]"></i> ' + items.length + ' transaksi</span></div>' +
        '<div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="bg-slate-50 border-b border-border-ui text-[11px] font-semibold text-muted uppercase tracking-wide">' +
        '<th class="px-5 py-3 text-left">Session ID</th><th class="px-5 py-3 text-left">Nama Tutee</th><th class="px-5 py-3 text-left">Nama Tutor</th>' +
        '<th class="px-5 py-3 text-left">Mata Kuliah</th><th class="px-5 py-3 text-left">Tanggal Kelas</th><th class="px-5 py-3 text-right">Total Transaksi</th>' +
        '<th class="px-5 py-3 text-right">Komisi 10%</th><th class="px-5 py-3 text-center">Aksi</th></tr></thead>' +
        '<tbody class="divide-y divide-border-ui">' + rows + '</tbody></table></div>' +
        '<div class="px-5 py-3 border-t border-border-ui bg-slate-50 flex items-center justify-between text-xs text-muted">' +
        '<span><i class="bi bi-info-circle text-accent mr-1"></i> Total komisi (via .reduce()): <strong class="text-ink">' + formatRp(totalKomisi) + '</strong> (dari ' + formatRp(totalTransaksi) + ' transaksi)</span>' +
        '<span>Periode ' + MONTH_DATA[currentMonth].label + '</span></div></div>';
}

function renderActiveTab() {
    const data = MONTH_DATA[currentMonth];
    if (!data) return;
    document.getElementById('period-label').textContent = data.label;
    document.getElementById('content-ads').innerHTML = buildTableAds(data.ads.items);
    document.getElementById('content-premium').innerHTML = buildTablePremium(data.premium.items);
    document.getElementById('content-komisi').innerHTML = buildTableKomisi(data.komisi.items);
    // Re-apply search filter after render
    applyLiveSearch();
}

// ═══════════════════════════════════════════════════════════════════════
// TAB SYSTEM
// ═══════════════════════════════════════════════════════════════════════

function switchTab(tab) {
    if (!tab) return;
    activeTab = tab;
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(function(btn) {
        btn.classList.remove('text-ink', 'border-accent', 'bg-white');
        btn.classList.add('text-muted', 'border-transparent', 'bg-transparent');
    });
    var activeBtn = document.getElementById('btn-tab-' + tab);
    if (activeBtn) {
        activeBtn.classList.remove('text-muted', 'border-transparent', 'bg-transparent');
        activeBtn.classList.add('text-ink', 'border-accent', 'bg-white');
    }
    ['ads', 'premium', 'komisi'].forEach(function(key) {
        var el = document.getElementById('content-' + key);
        if (el) el.classList.toggle('hidden', key !== tab);
    });
}

// ═══════════════════════════════════════════════════════════════════════
// LIVE SEARCH
// ═══════════════════════════════════════════════════════════════════════

function applyLiveSearch() {
    var query = (document.getElementById('live-search').value || '').toLowerCase().trim();
    document.querySelectorAll('.searchable').forEach(function(row) {
        var target = row.querySelector('.search-target');
        if (!target) { row.style.display = ''; return; }
        var text = (target.textContent || '').toLowerCase();
        row.style.display = (!query || text.indexOf(query) !== -1) ? '' : 'none';
    });
}

// ═══════════════════════════════════════════════════════════════════════
// MODAL SYSTEM
// ═══════════════════════════════════════════════════════════════════════

function showModal(id, date, desc, type, nominal, status) {
    document.getElementById('modal-invoice-id').textContent = id;
    document.getElementById('modal-date').textContent = date;
    document.getElementById('modal-desc').textContent = desc + ' (' + type + ')';
    document.getElementById('modal-nominal').textContent = 'Rp ' + nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    document.getElementById('modal-status').innerHTML = status === 'SETTLED' || status === 'ACTIVE'
        ? '<span class="text-emerald flex items-center gap-1"><i class="bi bi-check-circle-fill"></i> ' + status + '</span>'
        : '<span class="text-amber-600 flex items-center gap-1"><i class="bi bi-clock-fill"></i> ' + status + '</span>';
    document.getElementById('invoice-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('invoice-modal').classList.add('hidden');
}

// Close modal on backdrop click
document.addEventListener('click', function(e) {
    var modal = document.getElementById('invoice-modal');
    if (e.target === modal) closeModal();
});

// ═══════════════════════════════════════════════════════════════════════
// INIT
// ═══════════════════════════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', function() {
    currentMonth = getMonthFromURL();
    var sel = document.getElementById('month-filter');
    if (sel) sel.value = currentMonth;

    var params = new URLSearchParams(window.location.search);
    var typeParam = params.get('type');
    if (typeParam && ['ads', 'premium', 'komisi'].indexOf(typeParam) !== -1) {
        activeTab = typeParam;
    }

    renderActiveTab();
    switchTab(activeTab);

    // Live search listener
    document.getElementById('live-search').addEventListener('input', applyLiveSearch);
});
</script>
@endpush
