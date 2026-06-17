@php
    $route = request()->route()?->getName() ?? '';
    $nav = [
        ['name'=>'admin.dashboard', 'icon'=>'bi-grid-1x2-fill',          'label'=>'Dashboard Utama'],
        ['name'=>'admin.revenue',   'icon'=>'bi-cash-stack',             'label'=>'Detail Pendapatan'],
        ['name'=>'admin.kyc',       'icon'=>'bi-shield-check',           'label'=>'Verifikasi Tutor / KYC'],
        ['name'=>'admin.voucher',   'icon'=>'bi-ticket-perforated-fill', 'label'=>'Voucher & Promo'],
    ];
@endphp

{{-- ── Brand ──────────────────────────────────────────────────────────── --}}
<div class="flex items-center gap-3 px-5 h-16 border-b border-sidebar-border shrink-0">
    <div class="w-8 h-8 rounded-md bg-accent flex items-center justify-center shrink-0">
        <span class="text-white font-extrabold text-sm">T</span>
    </div>
    <div class="min-w-0">
        <p class="text-white font-bold text-sm leading-tight">Tutorium Admin</p>
        <p class="text-slate-500 text-[10px] leading-tight mt-0.5">Super Admin Panel v1.0</p>
    </div>
    <button class="ml-auto lg:hidden text-slate-500 hover:text-white p-1 transition" onclick="closeDrawer()">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

{{-- ── Admin Profile ────────────────────────────────────────────────────── --}}
<div class="relative px-4 py-4 border-b border-sidebar-border shrink-0">
    <button id="account-toggle" onclick="toggleAccountDropdown()"
            class="w-full flex items-center gap-3 group cursor-pointer text-left">
        <div class="relative shrink-0">
            <img src="https://ui-avatars.com/api/?name=Admin&background=1d2540&color=60a5fa&size=72"
                 class="w-10 h-10 rounded-md object-cover ring-2 ring-sidebar-border" alt="Admin">
            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald rounded-full border-2 border-sidebar"></span>
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-white font-semibold text-sm truncate leading-tight">Super Admin</p>
            <p class="text-slate-500 text-xs truncate mt-0.5">admin@tutorium.app</p>
        </div>
        <i id="account-chevron" class="bi bi-chevron-down ml-auto text-slate-500 text-xs transition-transform group-hover:text-slate-300"></i>
    </button>

    <div id="account-dropdown" class="hidden mt-3 space-y-1">
        <a href="{{ route('login') }}" onclick="closeDrawer(); closeAccountDropdown()"
           class="flex items-center gap-2.5 px-3 py-2 rounded-md hover:bg-red-500/10 transition text-slate-400 hover:text-red-400 text-xs font-medium">
            <i class="bi bi-box-arrow-right text-sm"></i> Keluar
        </a>
    </div>
</div>

{{-- ── Navigasi ────────────────────────────────────────────────────────── --}}
<nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">
    <p class="text-slate-600 text-[10px] font-semibold uppercase tracking-widest px-3 mb-2">Menu Utama</p>
    @foreach($nav as $item)
    @php
        // Determine active: exact match or prefix match for section anchors
        $active = $route === $item['name'];
    @endphp
    <a href="{{ route($item['name']) }}"
       onclick="closeDrawer(); closeAccountDropdown()"
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
<div class="px-3 py-4 border-t border-sidebar-border shrink-0">
    <div class="flex items-center gap-3 px-3 py-2">
        <i class="bi bi-shield-lock-fill text-slate-600 text-sm"></i>
        <span class="text-xs text-slate-600 font-medium">Semua aksi tercatat</span>
    </div>
</div>

<script>
function toggleAccountDropdown() {
  const dd = document.getElementById('account-dropdown');
  const ch = document.getElementById('account-chevron');
  if (!dd || !ch) return;
  dd.classList.toggle('hidden');
  ch.classList.toggle('rotate-180');
}
function closeAccountDropdown() {
  const dd = document.getElementById('account-dropdown');
  const ch = document.getElementById('account-chevron');
  if (!dd || !ch) return;
  dd.classList.add('hidden');
  ch.classList.remove('rotate-180');
}
</script>
