<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') — Tutorium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sidebar:  '#0b0f19',
                        'sidebar-border': '#1a2035',
                        'sidebar-hover':  '#141929',
                        'sidebar-active': '#1d2540',
                        canvas:   '#f8fafc',
                        ink:      '#1e293b',
                        muted:    '#64748b',
                        subtle:   '#94a3b8',
                        'border-ui': '#e2e8f0',
                        accent:   '#3b82f6',
                        'accent-dark': '#2563eb',
                        emerald:  '#10b981',
                        gold:     '#f59e0b',
                    },
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                }
            }
        }
    </script>
    <style>
        body { background: #f8fafc; }

        /* Sidebar drawer transition */
        #sidebar-drawer { transition: transform 0.22s cubic-bezier(.4,0,.2,1); }
        #sidebar-overlay { transition: opacity 0.22s ease; }

        /* Toast */
        @keyframes slide-up   { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
        @keyframes slide-down { from { opacity:1; transform:translateY(0); }   to { opacity:0; transform:translateY(14px); } }
        .toast-in  { animation: slide-up   0.28s ease forwards; }
        .toast-out { animation: slide-down 0.28s ease forwards; }

        /* Scrollbar thin */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 99px; }

        /* Nav active indicator */
        .nav-item.active { background: #1d2540; border-left: 3px solid #3b82f6; }
        .nav-item.active span { color: #fff; }
        .nav-item.active i   { color: #60a5fa; }
        .nav-item:not(.active):hover { background: #141929; }
    </style>
    @stack('head')
</head>
<body class="font-sans antialiased text-ink">

{{-- ═══════════════════════════════════════════════════════════
     MOBILE TOP BAR
═══════════════════════════════════════════════════════════ --}}
<header class="lg:hidden fixed top-0 inset-x-0 z-30 h-14 bg-sidebar border-b border-sidebar-border flex items-center justify-between px-4">
    <div class="flex items-center gap-2.5">
        <img src="{{ asset('assets/logo/tutorium-logo-white.png') }}" alt="Tutorium" class="h-8 w-auto">
    </div>
    <button id="open-drawer-btn" class="text-slate-400 hover:text-white p-1 transition">
        <i class="bi bi-list text-xl"></i>
    </button>
</header>

{{-- ═══════════════════════════════════════════════════════════
     SIDEBAR OVERLAY (mobile)
═══════════════════════════════════════════════════════════ --}}
<div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black/60 hidden opacity-0 lg:hidden"></div>

{{-- ═══════════════════════════════════════════════════════════
     ROOT LAYOUT: sidebar-left + content-right
═══════════════════════════════════════════════════════════ --}}
<div class="flex min-h-screen">

    {{-- ── SIDEBAR (desktop: kiri sticky; mobile: drawer dari kiri) ─── --}}
    <aside id="sidebar-drawer"
           class="fixed top-0 left-0 z-50 h-screen w-64 bg-sidebar flex flex-col
                  -translate-x-full lg:translate-x-0 lg:sticky lg:shrink-0">
        @include('admin.layouts.navbar')
    </aside>

    {{-- ── MAIN CONTENT ─────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0 pt-14 lg:pt-0">
        <main class="flex-1 p-5 lg:p-8 max-w-6xl w-full mx-auto">
            @yield('content')
        </main>
        <footer class="border-t border-border-ui bg-white px-8 py-3 text-xs text-muted">
            &copy; {{ date('Y') }} Tutorium &mdash; Super Admin Panel v1.0
        </footer>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     TOAST CONTAINER — kanan bawah
═══════════════════════════════════════════════════════════ --}}
<div id="toast-container" class="fixed bottom-5 right-5 z-[200] flex flex-col gap-2 items-end pointer-events-none"></div>

{{-- ═══════════════════════════════════════════════════════════
     GLOBAL JS
═══════════════════════════════════════════════════════════ --}}
<script>
// ── Mobile drawer ─────────────────────────────────────────────────────────
const drawer  = document.getElementById('sidebar-drawer');
const overlay = document.getElementById('sidebar-overlay');

function openDrawer() {
    drawer.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    requestAnimationFrame(() => overlay.classList.replace('opacity-0','opacity-100'));
}
function closeDrawer() {
    drawer.classList.add('-translate-x-full');
    overlay.classList.replace('opacity-100','opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 220);
}
document.getElementById('open-drawer-btn')?.addEventListener('click', openDrawer);
overlay.addEventListener('click', closeDrawer);

// ── Toast global ──────────────────────────────────────────────────────────
function showToast(message, type) {
    type = type || 'success';
    const cfg = {
        success: { bg:'bg-sidebar border-emerald',   icon:'bi-check-circle-fill',          ic:'text-emerald' },
        error:   { bg:'bg-sidebar border-red-500',    icon:'bi-x-circle-fill',              ic:'text-red-400' },
        warning: { bg:'bg-sidebar border-gold',       icon:'bi-exclamation-triangle-fill',  ic:'text-gold'    },
        info:    { bg:'bg-sidebar border-accent',     icon:'bi-info-circle-fill',           ic:'text-accent'  },
    };
    const c  = cfg[type] || cfg.info;
    const el = document.createElement('div');
    el.className = `pointer-events-auto toast-in flex items-start gap-3 ${c.bg}
                    border-l-4 text-white text-sm px-4 py-3 rounded-md shadow-2xl max-w-[320px] w-full`;
    el.innerHTML = `<i class="bi ${c.icon} ${c.ic} mt-0.5 flex-shrink-0 text-base"></i>
                    <div class="flex-1"><p class="leading-snug">${message}</p></div>
                    <button onclick="this.closest('.toast-in,.toast-out')?.remove()"
                            class="text-slate-500 hover:text-white flex-shrink-0 mt-0.5 transition">
                        <i class="bi bi-x text-base"></i>
                    </button>`;
    document.getElementById('toast-container').appendChild(el);
    setTimeout(() => {
        el.classList.remove('toast-in');
        el.classList.add('toast-out');
        setTimeout(() => el.remove(), 300);
    }, 3500);
}
</script>
@stack('scripts')
</body>
</html>
