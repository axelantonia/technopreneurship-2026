<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Mahasiswa') — Tutorium</title>
    <meta name="description" content="@yield('meta_description', 'Platform belajar Tutorium — Dashboard Mahasiswa')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800;1,14..32,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* ── Student palette ── */
                        'si':          '#283044',   /* Space Indigo — sidebar bg */
                        'si-border':   '#36435e',   /* sidebar border */
                        'si-hover':    '#2f3a52',   /* sidebar hover */
                        'si-active':   '#334060',   /* sidebar active row */
                        'sky':         '#D0E2F2',   /* Pale Sky — canvas bg */
                        'sky-card':    '#FFFFFF',   /* card bg */
                        'azure':       '#4D81EE',   /* Azure Blue — accent */
                        'azure-dark':  '#3a6edb',   /* deeper azure */
                        'navy':        '#3B5B8A',   /* Navy — borders, dividers */
                        'ink':         '#283044',   /* body text */
                        'muted':       '#64748b',
                    },
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    borderRadius: { '2xl': '1rem', '3xl': '1.5rem' },
                }
            }
        }
    </script>
    <style>
        body { background: #D0E2F2; }

        /* ── Sidebar drawer ── */
        #s-drawer  { transition: transform .22s cubic-bezier(.4,0,.2,1); }
        #s-overlay { transition: opacity  .22s ease; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #36435e; border-radius: 99px; }

        /* ── Nav active indicator ── */
        .s-nav-item.active  { background: #334060; border-left: 3px solid #4D81EE; }
        .s-nav-item.active  span { color: #fff; }
        .s-nav-item.active  i    { color: #7ba7f5; }
        .s-nav-item:not(.active):hover { background: #2f3a52; }

        /* ── Toast ── */
        @keyframes t-up   { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
        @keyframes t-down { from { opacity:1; transform:translateY(0); }   to { opacity:0; transform:translateY(14px); } }
        .toast-in  { animation: t-up   .28s ease forwards; }
        .toast-out { animation: t-down .28s ease forwards; }

        /* ── Star rating glow ── */
        .star-filled { color: #4D81EE; filter: drop-shadow(0 0 4px rgba(77,129,238,.45)); }
        .star-empty  { color: #c0d3f0; }

        /* ── Card hover lift ── */
        .lift { transition: transform .2s ease, box-shadow .2s ease; }
        .lift:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(59,91,138,.12); }

        /* ── Animated gradient badge ── */
        @keyframes shimmer { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
        .badge-active {
            background: linear-gradient(270deg,#4D81EE,#5b95ff,#3a6edb);
            background-size: 200% 200%;
            animation: shimmer 3s ease infinite;
        }
    </style>
    @stack('head')
</head>
<body class="font-sans antialiased">

{{-- ═══ MOBILE TOP BAR ═══════════════════════════════════════════════════ --}}
<header class="lg:hidden fixed top-0 inset-x-0 z-30 h-14 flex items-center justify-between px-4 shadow-sm"
        style="background:#283044; border-bottom:1px solid #36435e;">
    <div class="flex items-center gap-2.5">
        <div class="w-7 h-7 rounded-lg flex items-center justify-center" style="background:#4D81EE;">
            <span class="text-white font-extrabold text-xs">T</span>
        </div>
        <span class="font-bold text-white text-sm tracking-wide">Tutorium</span>
    </div>
    <button id="s-open-btn" class="text-slate-300 hover:text-white p-1 transition">
        <i class="bi bi-list text-xl"></i>
    </button>
</header>

{{-- ═══ MOBILE OVERLAY ════════════════════════════════════════════════════ --}}
<div id="s-overlay" class="fixed inset-0 z-40 bg-black/60 hidden opacity-0 lg:hidden"></div>

{{-- ═══ ROOT LAYOUT ═══════════════════════════════════════════════════════ --}}
<div class="flex min-h-screen">

    {{-- ── SIDEBAR ─────────────────────────────────────────────────────── --}}
    <aside id="s-drawer"
           class="fixed top-0 left-0 z-50 h-screen flex flex-col -translate-x-full lg:translate-x-0 lg:sticky lg:shrink-0"
           style="width:240px; background:#283044;">

        {{-- Brand --}}
        <div class="flex items-center gap-2.5 px-5 h-14 shrink-0" style="border-bottom:1px solid #36435e;">
            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" style="background:#4D81EE;">
                <span class="text-white font-extrabold text-xs">T</span>
            </div>
            <span class="font-bold text-white text-sm tracking-wide">Tutorium</span>
            <button class="ml-auto lg:hidden text-slate-400 hover:text-white p-1 transition" onclick="sCloseDrawer()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Student mini-profile --}}
        <div class="px-4 py-4 shrink-0" style="border-bottom:1px solid #36435e;">
            <div class="flex items-center gap-3">
                <div class="relative shrink-0">
                    <img src="https://ui-avatars.com/api/?name=Jeremy+Axel&background=334060&color=7ba7f5&size=72"
                         class="w-10 h-10 rounded-xl object-cover ring-2" style="ring-color:#36435e;" alt="Mahasiswa">
                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full border-2" style="background:#22c55e; border-color:#283044;"></span>
                </div>
                <div class="min-w-0">
                    <p class="text-white font-semibold text-sm truncate leading-tight">Jeremy Axel</p>
                    <p class="text-xs truncate mt-0.5" style="color:#7ba7f5;">Teknik Informatika</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        @include('student.layouts.navbar')

        {{-- Sidebar footer --}}
        <div class="px-3 py-4 shrink-0 space-y-0.5" style="border-top:1px solid #36435e;">
            <a href="{{ route('home') }}"
               class="s-nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors cursor-pointer">
                <i class="bi bi-house text-base" style="color:#7ba7f5;"></i>
                <span class="text-sm font-medium" style="color:#a8c4e8;">Ke Beranda</span>
            </a>
            <a href="{{ route('login') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors" style="hover:background:rgba(239,68,68,.1);"
               onmouseover="this.style.background='rgba(239,68,68,.1)'" onmouseout="this.style.background='transparent'">
                <i class="bi bi-box-arrow-right text-base" style="color:rgba(239,68,68,.7);"></i>
                <span class="text-sm font-medium" style="color:rgba(248,113,113,.8);">Keluar</span>
            </a>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ─────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0 pt-14 lg:pt-0" style="background:#D0E2F2;">
        <main class="flex-1 p-5 lg:p-8 max-w-6xl w-full mx-auto">
            @yield('content')
        </main>
        <footer class="px-8 py-3 text-xs" style="border-top:1px solid #b8ceea; background:#c4d9ef; color:#64748b;">
            © {{ date('Y') }} Tutorium — Dashboard Mahasiswa
        </footer>
    </div>
</div>

{{-- ═══ TOAST CONTAINER ══════════════════════════════════════════════════ --}}
<div id="s-toast-container" class="fixed bottom-5 right-5 z-[200] flex flex-col gap-2 items-end pointer-events-none"></div>

{{-- ═══ GLOBAL JS ════════════════════════════════════════════════════════ --}}
<script>
const sDrawer  = document.getElementById('s-drawer');
const sOverlay = document.getElementById('s-overlay');

function sOpenDrawer() {
    sDrawer.classList.remove('-translate-x-full');
    sOverlay.classList.remove('hidden');
    requestAnimationFrame(() => sOverlay.classList.replace('opacity-0','opacity-100'));
}
function sCloseDrawer() {
    sDrawer.classList.add('-translate-x-full');
    sOverlay.classList.replace('opacity-100','opacity-0');
    setTimeout(() => sOverlay.classList.add('hidden'), 220);
}
document.getElementById('s-open-btn')?.addEventListener('click', sOpenDrawer);
sOverlay.addEventListener('click', sCloseDrawer);

function sToast(message, type = 'success') {
    const cfg = {
        success: { bg:'#283044', border:'#22c55e', icon:'bi-check-circle-fill', ic:'#22c55e' },
        error:   { bg:'#283044', border:'#ef4444', icon:'bi-x-circle-fill',     ic:'#f87171' },
        info:    { bg:'#283044', border:'#4D81EE', icon:'bi-info-circle-fill',  ic:'#7ba7f5' },
    };
    const c  = cfg[type] || cfg.info;
    const el = document.createElement('div');
    el.className = 'pointer-events-auto toast-in flex items-start gap-3 text-white text-sm px-4 py-3 rounded-xl shadow-2xl max-w-xs w-full';
    el.style.cssText = `background:${c.bg}; border-left:4px solid ${c.border};`;
    el.innerHTML = `<i class="bi ${c.icon} mt-0.5 flex-shrink-0 text-base" style="color:${c.ic};"></i>
                    <div class="flex-1"><p class="leading-snug">${message}</p></div>
                    <button onclick="this.closest('div')?.remove()" class="text-slate-400 hover:text-white flex-shrink-0 mt-0.5 transition"><i class="bi bi-x text-base"></i></button>`;
    document.getElementById('s-toast-container').appendChild(el);
    setTimeout(() => { el.classList.replace('toast-in','toast-out'); setTimeout(() => el.remove(), 300); }, 3500);
}
</script>
@stack('scripts')
</body>
</html>
