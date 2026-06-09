@php
    $route = request()->route()?->getName() ?? '';
    $nav = [
        ['name'=>'tutor.dashboard', 'icon'=>'bi-grid-1x2-fill',      'label'=>'Dashboard'],
        ['name'=>'tutor.packages',  'icon'=>'bi-box-seam-fill',      'label'=>'Paket Kursus'],
        ['name'=>'tutor.schedule',  'icon'=>'bi-calendar-week',      'label'=>'Jadwal Mengajar'],
        ['name'=>'tutor.history',   'icon'=>'bi-clock-history',     'label'=>'Riwayat Mengajar'],
        ['name'=>'tutor.financial', 'icon'=>'bi-wallet2',            'label'=>'Keuangan & Saldo'],
        ['name'=>'tutor.chat',       'icon'=>'bi-chat-text-fill',     'label'=>'Ruang Chat'],
    ];
@endphp


{{-- ── Brand ──────────────────────────────────────────────────────────── --}}
<div class="flex items-center gap-2.5 px-5 h-14 border-b border-sidebar-border shrink-0">
    <div class="w-7 h-7 rounded bg-accent flex items-center justify-center shrink-0">
        <span class="text-white font-extrabold text-xs">T</span>
    </div>
    <span class="font-bold text-white text-sm tracking-wide">Tutorium</span>
    <button class="ml-auto lg:hidden text-slate-500 hover:text-white p-1 transition" onclick="closeDrawer()">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

{{-- ── Profil Tutor ────────────────────────────────────────────────────── --}}
<div class="px-4 py-5 border-b border-sidebar-border shrink-0">
    <div class="flex items-center gap-3">
        <div class="relative shrink-0">
            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=1d2540&color=60a5fa&size=72"
                 class="w-10 h-10 rounded-md object-cover ring-2 ring-sidebar-border" alt="Tutor">
            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald rounded-full border-2 border-sidebar"></span>
        </div>
        <div class="min-w-0">
            <div class="flex items-center gap-1.5">
                <p class="text-white font-semibold text-sm truncate leading-tight">Budi Santoso</p>
                <span class="shrink-0 bg-gold/20 border border-gold/40 text-gold text-[9px] font-extrabold px-1.5 py-0.5 rounded leading-none tracking-wide">PRO</span>
            </div>
            <p class="text-slate-500 text-xs truncate mt-0.5">Teknik Informatika</p>
        </div>
    </div>
</div>

{{-- ── Navigasi ────────────────────────────────────────────────────────── --}}
<nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">
    <p class="text-slate-600 text-[10px] font-semibold uppercase tracking-widest px-3 mb-2">Menu Utama</p>
    @foreach($nav as $item)
    @php $active = $route === $item['name']; @endphp
    <a href="{{ route($item['name']) }}"
       onclick="closeDrawer()"
       class="nav-item {{ $active ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-md cursor-pointer transition-colors">
        <i class="bi {{ $item['icon'] }} text-base {{ $active ? '' : 'text-slate-500' }}"></i>
        <span class="text-sm {{ $active ? 'font-semibold' : 'text-slate-400 font-medium' }}">{{ $item['label'] }}</span>
        @if($active)
        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span>
        @endif
    </a>
    @endforeach
</nav>

{{-- ── Footer sidebar ──────────────────────────────────────────────────── --}}
<div class="px-3 py-4 border-t border-sidebar-border space-y-0.5 shrink-0">
    <a href="{{ route('tutors') }}"
       class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-md transition-colors">
        <i class="bi bi-person-badge text-base text-slate-500"></i>
        <span class="text-sm text-slate-400 font-medium">Profil Publik</span>
    </a>
    <a href="{{ route('login') }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-md hover:bg-red-500/10 transition-colors">
        <i class="bi bi-box-arrow-right text-base text-red-500/70"></i>
        <span class="text-sm text-red-400/80 font-medium">Keluar</span>
    </a>
</div>
