@extends('tutors.layouts.app')
@section('title', 'Ruang Chat')

@push('styles')
<style>
    /* Break out of layout container padding */
    #chat-breakout {
        margin: -1rem;
    }
    @media (min-width: 640px)  { #chat-breakout { margin: -1.5rem; } }
    @media (min-width: 1024px) { #chat-breakout { margin: -2rem; } }

    /* Chat bubble tail */
    .bubble-out { border-bottom-right-radius: 2px !important; }
    .bubble-in  { border-bottom-left-radius:  2px !important; }

    /* Scrollbar */
    #messages::-webkit-scrollbar        { width: 4px; }
    #messages::-webkit-scrollbar-track  { background: transparent; }
    #messages::-webkit-scrollbar-thumb  { background: #cbd5e1; border-radius: 99px; }
    #contacts-list::-webkit-scrollbar        { width: 4px; }
    #contacts-list::-webkit-scrollbar-track  { background: transparent; }
    #contacts-list::-webkit-scrollbar-thumb  { background: #cbd5e1; border-radius: 99px; }

    /* Message canvas pattern */
    #messages {
        background-color: #f0f4f8;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23cbd5e1' fill-opacity='0.18'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Input focus glow */
    #msg-box:focus { box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }

    /* Contact active state */
    .contact-btn.is-active { background: #eff6ff; border-left: 3px solid #3b82f6; }
    .contact-btn.is-active .contact-name { color: #1d4ed8; }

    /* Unread badge pulse */
    .unread-badge { animation: pulse-soft 2s ease-in-out infinite; }
    @keyframes pulse-soft { 0%,100% { opacity: 1; } 50% { opacity: 0.75; } }
</style>
@endpush

@section('content')

@php
$contacts = [
    ['name'=>'Randi',  'mk'=>'Laravel Advanced',  'color'=>'1d2540', 'tc'=>'60a5fa', 'unread'=>0, 'last'=>'Guards itu ibarat pintu penjaga akses. Kalau ada screenshot error-nya, kirim sini dulu ya.',  'time'=>'14:02', 'active'=>true,  'online'=>true],
    ['name'=>'Livi',   'mk'=>'Web Development',   'color'=>'065f46', 'tc'=>'34d399', 'unread'=>0, 'last'=>'Siap kak, sampai ketemu besok!',      'time'=>'11:30', 'active'=>false, 'online'=>true],
    ['name'=>'Ivy',    'mk'=>'Basis Data MySQL',  'color'=>'4c1d95', 'tc'=>'a78bfa', 'unread'=>1, 'last'=>'Kak soal JOIN masih bingung nih.',    'time'=>'10:15', 'active'=>false, 'online'=>false],
    ['name'=>'Kevin',  'mk'=>'Struktur Data',     'color'=>'7c2d12', 'tc'=>'fb923c', 'unread'=>0, 'last'=>'Terima kasih kak sudah dibantu!',     'time'=>'Kem.',  'active'=>false, 'online'=>false],
    ['name'=>'Monica', 'mk'=>'Pemrograman Web',   'color'=>'881337', 'tc'=>'fb7185', 'unread'=>0, 'last'=>'Oke kak nanti aku coba dulu ya.',     'time'=>'Kem.',  'active'=>false, 'online'=>false],
];
$activeContact = collect($contacts)->firstWhere('active', true);
@endphp

{{-- ─────────────────────────────────────────────────────── --}}
{{-- BREAKOUT WRAPPER — negates parent layout padding        --}}
{{-- ─────────────────────────────────────────────────────── --}}
<div id="chat-breakout">
<div class="flex w-full bg-white overflow-hidden" style="height: calc(100vh - 64px);">

    {{-- ══════════════════════════════════════════════════════ --}}
    {{--  LEFT PANEL — Contacts Shelf                          --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <div id="contacts-panel"
         class="w-80 shrink-0 flex flex-col h-full bg-white border-r border-slate-200
                {{-- Mobile: visible by default; hidden when chat open --}}
                flex sm:flex">

        {{-- Header --}}
        <div class="px-4 pt-4 pb-3 bg-white border-b border-slate-200 shrink-0">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-base font-extrabold text-ink tracking-tight">Pesan</h2>
                <div class="flex items-center gap-1.5">
                    <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition text-slate-500 hover:text-ink"
                            title="Pesan baru">
                        <i class="bi bi-pencil-square text-sm"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition text-slate-500 hover:text-ink"
                            title="Filter">
                        <i class="bi bi-funnel text-sm"></i>
                    </button>
                </div>
            </div>
            {{-- Search bar --}}
            <div class="relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                <input id="search-contacts"
                       type="text"
                       placeholder="Cari mahasiswa atau mata kuliah…"
                       oninput="filterContacts(this.value)"
                       class="w-full bg-slate-100 hover:bg-slate-50 border border-transparent focus:border-accent/30 focus:bg-white
                              rounded-lg pl-8 pr-3 py-2 text-xs text-ink placeholder-slate-400
                              focus:outline-none focus:ring-2 focus:ring-accent/20 transition">
            </div>
        </div>

        {{-- Unread filter chip --}}
        <div class="px-4 py-2 flex items-center gap-2 shrink-0 border-b border-slate-100">
            <button onclick="setFilter('all')"   id="chip-all"    class="filter-chip active-chip text-xs font-semibold px-3 py-1 rounded-full bg-accent text-white transition">Semua</button>
            <button onclick="setFilter('unread')" id="chip-unread" class="filter-chip text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-muted hover:bg-slate-200 transition">Belum Dibaca</button>
        </div>

        {{-- Contact list --}}
        <div id="contacts-list" class="flex-1 overflow-y-auto">
            @foreach($contacts as $c)
            <button onclick="switchContact('{{ $c['name'] }}','{{ $c['mk'] }}','{{ $c['color'] }}','{{ $c['tc'] }}', {{ $c['online'] ? 'true' : 'false' }})"
                    data-cname="{{ $c['name'] }}"
                    data-mk="{{ strtolower($c['mk']) }}"
                    data-unread="{{ $c['unread'] }}"
                    class="contact-btn w-full flex items-center gap-3 px-4 py-3.5 hover:bg-slate-50 transition text-left border-b border-slate-100
                           {{ $c['active'] ? 'is-active' : '' }}">

                {{-- Avatar + online dot --}}
                <div class="relative shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($c['name']) }}&size=44&background={{ $c['color'] }}&color={{ $c['tc'] }}&bold=true"
                         class="w-11 h-11 rounded-full ring-2 ring-white" alt="{{ $c['name'] }}">
                    @if($c['online'])
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald border-2 border-white rounded-full"></span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-1 mb-0.5">
                        <span class="contact-name font-semibold text-ink text-sm truncate {{ $c['active'] ? 'text-blue-700' : '' }}">{{ $c['name'] }}</span>
                        <span class="text-[10px] shrink-0 {{ $c['unread'] > 0 ? 'text-accent font-semibold' : 'text-subtle' }}">{{ $c['time'] }}</span>
                    </div>
                    <p class="text-[11px] text-muted truncate">
                        <span class="text-slate-400 font-medium">{{ $c['mk'] }}</span>
                    </p>
                    <div class="flex items-center justify-between mt-0.5">
                        <p class="text-[11px] text-subtle truncate flex-1">{{ $c['last'] }}</p>
                        @if($c['unread'] > 0)
                        <span class="unread-badge shrink-0 ml-2 w-5 h-5 bg-accent rounded-full text-white text-[9px] font-extrabold flex items-center justify-center">{{ $c['unread'] }}</span>
                        @endif
                    </div>
                </div>
            </button>
            @endforeach

            {{-- Empty search state --}}
            <div id="no-results" class="hidden py-12 flex flex-col items-center gap-2 text-center px-6">
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mb-1">
                    <i class="bi bi-search text-xl text-slate-400"></i>
                </div>
                <p class="text-sm font-semibold text-ink">Tidak ditemukan</p>
                <p class="text-xs text-muted">Coba nama mahasiswa atau mata kuliah lain.</p>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════ --}}
    {{--  RIGHT PANEL — Conversation Canvas                    --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <div id="convo-panel" class="flex-1 flex flex-col h-full overflow-hidden">

        {{-- ── Chat Header ──────────────────────────────────── --}}
        <div class="shrink-0 h-16 bg-white border-b border-slate-200 flex items-center gap-3 px-5">

            {{-- Back button (mobile only) --}}
            <button id="btn-back"
                    onclick="showContacts()"
                    class="hidden w-8 h-8 rounded-full hover:bg-slate-100 items-center justify-center mr-1 transition text-muted hover:text-ink">
                <i class="bi bi-arrow-left text-base"></i>
            </button>

            {{-- Avatar --}}
            <div class="relative shrink-0">
                <img id="chat-av"
                     src="https://ui-avatars.com/api/?name={{ urlencode($activeContact['name']) }}&size=44&background={{ $activeContact['color'] }}&color={{ $activeContact['tc'] }}&bold=true"
                     class="w-10 h-10 rounded-full ring-2 ring-white shadow-sm" alt="">
                <span id="chat-online-dot" class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald border-2 border-white rounded-full {{ $activeContact['online'] ? '' : 'hidden' }}"></span>
            </div>

            {{-- Name + status --}}
            <div class="min-w-0 flex-1">
                <p id="chat-nm" class="font-bold text-ink text-sm leading-tight truncate">{{ $activeContact['name'] }}</p>
                <p id="chat-status" class="text-xs {{ $activeContact['online'] ? 'text-emerald font-semibold' : 'text-muted' }}">
                    {{ $activeContact['online'] ? 'Online' : $activeContact['mk'] }}
                </p>
            </div>

            {{-- Action buttons --}}
            <div class="shrink-0 flex items-center gap-1">
                <button title="Jadwalkan sesi"
                        class="w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center transition text-slate-500 hover:text-ink">
                    <i class="bi bi-calendar-plus text-base"></i>
                </button>
                <button title="Info mahasiswa"
                        class="w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center transition text-slate-500 hover:text-ink">
                    <i class="bi bi-info-circle text-base"></i>
                </button>
            </div>
        </div>

        {{-- ── Message Canvas ────────────────────────────────── --}}
        <div id="messages" class="flex-1 overflow-y-auto px-6 py-5 space-y-3">

            {{-- Date divider --}}
            <div class="flex items-center gap-3 my-2">
                <div class="flex-1 h-px bg-slate-300/50"></div>
                <span class="text-[11px] text-slate-500 font-medium bg-white/80 px-3 py-1 rounded-full shadow-sm border border-slate-200/80">Hari ini</span>
                <div class="flex-1 h-px bg-slate-300/50"></div>
            </div>

            {{-- Outgoing: Tutor --}}
            <div class="flex justify-end">
                <div class="max-w-xs lg:max-w-md xl:max-w-lg">
                    <div class="bg-blue-600 text-white text-sm px-4 py-2.5 rounded-2xl bubble-out shadow-sm">
                        <p class="leading-relaxed">Halo Randi! Tentang materi hari ini apa udah aman?</p>
                        <div class="flex items-center justify-end gap-1 mt-1.5">
                            <span class="text-[10px] text-blue-200">13:45</span>
                            <i class="bi bi-check2-all text-[11px] text-blue-200"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Incoming: Student --}}
            <div class="flex justify-start gap-2.5">
                <img id="bubble-av"
                     src="https://ui-avatars.com/api/?name={{ urlencode($activeContact['name']) }}&size=32&background={{ $activeContact['color'] }}&color={{ $activeContact['tc'] }}&bold=true"
                     class="w-8 h-8 rounded-full shrink-0 self-end shadow-sm" alt="">
                <div class="max-w-xs lg:max-w-md xl:max-w-lg">
                    <div class="bg-white border border-slate-200 text-ink text-sm px-4 py-2.5 rounded-2xl bubble-in shadow-sm">
                        <p class="leading-relaxed">Kak, aku masih bingung di bagian Guards, bisa dijelasin dari awal?</p>
                        <p class="text-[10px] text-subtle mt-1.5 text-right">13:47</p>
                    </div>
                </div>
            </div>

            {{-- Outgoing --}}
            <div class="flex justify-end">
                <div class="max-w-xs lg:max-w-md xl:max-w-lg">
                    <div class="bg-blue-600 text-white text-sm px-4 py-2.5 rounded-2xl bubble-out shadow-sm">
                        <p class="leading-relaxed">Guards itu ibarat pintu penjaga akses. Kalau ada screenshot error-nya, kirim sini dulu ya.</p>
                        <div class="flex items-center justify-end gap-1 mt-1.5">
                            <span class="text-[10px] text-blue-200">13:49</span>
                            <i class="bi bi-check2-all text-[11px] text-blue-200"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Incoming --}}
            <!-- <div class="flex justify-start gap-2.5">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($activeContact['name']) }}&size=32&background={{ $activeContact['color'] }}&color={{ $activeContact['tc'] }}&bold=true"
                     class="w-8 h-8 rounded-full shrink-0 self-end shadow-sm" alt="">
                <div class="max-w-xs lg:max-w-md xl:max-w-lg">
                    <div class="bg-white border border-slate-200 text-ink text-sm px-4 py-2.5 rounded-2xl bubble-in shadow-sm">
                        <p class="leading-relaxed">Kak bisa dibahas soal Middleware?</p>
                        <p class="text-[10px] text-subtle mt-1.5 text-right">14:02</p>
                    </div>
                </div>
            </div> -->

        </div>

        {{-- ── File Preview Bar ──────────────────────────────── --}}
        <div id="file-bar"
             class="hidden shrink-0 px-5 py-2.5 bg-white border-t border-slate-200 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-accent/10 border border-accent/20 flex items-center justify-center shrink-0">
                <i id="file-bar-icon" class="bi bi-file-earmark text-accent text-sm"></i>
            </div>
            <span id="file-bar-name" class="text-xs text-ink font-medium truncate flex-1"></span>
            <button onclick="clearFile()"
                    class="w-7 h-7 rounded-full hover:bg-red-50 flex items-center justify-center text-subtle hover:text-red-500 transition">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>

        {{-- ── Input Bar ─────────────────────────────────────── --}}
        <div class="shrink-0 bg-white border-t border-slate-200 px-5 py-3.5">
            <div class="flex items-center gap-2.5">

                {{-- Attachment --}}
                <input type="file" id="file-pick" class="hidden" accept="image/*,.pdf,.doc,.docx">
                <button onclick="document.getElementById('file-pick').click()"
                        title="Lampirkan file"
                        class="w-9 h-9 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 hover:text-ink transition shrink-0">
                    <i class="bi bi-paperclip text-base"></i>
                </button>

                {{-- Text input --}}
                <div class="flex-1 relative">
                    <input id="msg-box"
                           type="text"
                           placeholder="Tulis pesan…"
                           class="w-full bg-slate-100 hover:bg-slate-50 border border-transparent focus:border-accent/30 focus:bg-white
                                  rounded-full px-5 py-2.5 text-sm text-ink placeholder-slate-400
                                  focus:outline-none transition">
                </div>

                {{-- Send --}}
                <button id="btn-send"
                        onclick="sendMsg()"
                        class="w-10 h-10 bg-accent hover:bg-accent-dark text-white rounded-full flex items-center justify-center transition shadow-md hover:shadow-lg shrink-0">
                    <i class="bi bi-send-fill text-sm"></i>
                </button>
            </div>
        </div>

    </div>{{-- /convo-panel --}}

</div>
</div>{{-- /chat-breakout --}}

@push('scripts')
<script>
/* ═══════════════════════════════════════════════════════════ */
/*  CHAT — Core State & Helpers                               */
/* ═══════════════════════════════════════════════════════════ */

const msgBox   = document.getElementById('msg-box');
const filePick = document.getElementById('file-pick');
const fileBar  = document.getElementById('file-bar');
const fileIcon = document.getElementById('file-bar-icon');
const fileName = document.getElementById('file-bar-name');
const messages = document.getElementById('messages');
let   chosenFile = null;
let   currentFilter = 'all';
let   isMobile = () => window.innerWidth < 640;

function timeNow() {
    return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
}
function scrollDown(smooth = true) {
    messages.scrollTo({ top: messages.scrollHeight, behavior: smooth ? 'smooth' : 'instant' });
}
function esc(s) {
    return String(s)
        .replace(/&/g,'&amp;').replace(/</g,'&lt;')
        .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

/* ─── File Attachment ─────────────────────────────────────── */
filePick.addEventListener('change', function () {
    if (!this.files.length) return;
    chosenFile = this.files[0];
    fileName.textContent = chosenFile.name;
    fileIcon.className   = chosenFile.type.startsWith('image/')
        ? 'bi bi-image text-accent text-sm'
        : 'bi bi-file-earmark-pdf text-red-500 text-sm';
    fileBar.classList.remove('hidden');
});

function clearFile() {
    chosenFile       = null;
    filePick.value   = '';
    fileBar.classList.add('hidden');
}

/* ─── Send Message ────────────────────────────────────────── */
msgBox.addEventListener('keydown', e => { if (e.key === 'Enter') sendMsg(); });

function sendMsg() {
    const text = msgBox.value.trim();
    if (!text && !chosenFile) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'flex justify-end';

    let inner = '';

    if (chosenFile) {
        if (chosenFile.type.startsWith('image/')) {
            const url = URL.createObjectURL(chosenFile);
            inner += `<img src="${url}" class="max-w-full rounded-xl mb-2 block shadow-sm" style="max-height:220px;object-fit:cover;" alt="gambar">`;
        } else {
            inner += `<div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-lg px-3 py-2 mb-2">
                        <div class="w-7 h-7 rounded-lg bg-white/20 flex items-center justify-center shrink-0">
                            <i class="bi bi-file-earmark-pdf text-sm"></i>
                        </div>
                        <span class="text-xs font-semibold truncate max-w-[180px]">${esc(chosenFile.name)}</span>
                      </div>`;
        }
    }

    if (text) inner += `<p class="leading-relaxed">${esc(text)}</p>`;

    wrapper.innerHTML = `
        <div class="max-w-xs lg:max-w-md xl:max-w-lg">
            <div class="bg-blue-600 text-white text-sm px-4 py-2.5 rounded-2xl bubble-out shadow-sm">
                ${inner}
                <div class="flex items-center justify-end gap-1 mt-1.5">
                    <span class="text-[10px] text-blue-200">${timeNow()}</span>
                    <i class="bi bi-check2 text-[11px] text-blue-200"></i>
                </div>
            </div>
        </div>`;

    messages.appendChild(wrapper);
    scrollDown();
    msgBox.value = '';
    clearFile();
}

/* ─── Switch Contact ──────────────────────────────────────── */
function switchContact(name, mk, bg, tc, online) {
    // Update header
    document.getElementById('chat-nm').textContent  = name;
    document.getElementById('chat-status').textContent = online ? 'Online' : mk;
    document.getElementById('chat-status').className   = `text-xs ${online ? 'text-emerald font-semibold' : 'text-muted'}`;

    const onlineDot = document.getElementById('chat-online-dot');
    online ? onlineDot.classList.remove('hidden') : onlineDot.classList.add('hidden');

    // Update avatars
    const avUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=44&background=${bg}&color=${tc}&bold=true`;
    document.getElementById('chat-av').src     = avUrl;
    document.getElementById('bubble-av').src   = avUrl.replace('size=44','size=32');

    // Highlight active contact
    document.querySelectorAll('.contact-btn').forEach(btn => {
        const isMe = btn.dataset.cname === name;
        btn.classList.toggle('is-active', isMe);
        btn.querySelector('.contact-name')?.classList.toggle('text-blue-700', isMe);
        // Clear unread badge
        if (isMe) {
            const badge = btn.querySelector('.unread-badge');
            if (badge) badge.remove();
            btn.dataset.unread = '0';
        }
    });

    // Clear messages + add placeholder divider
    messages.innerHTML = `
        <div class="flex items-center gap-3 my-2">
            <div class="flex-1 h-px bg-slate-300/50"></div>
            <span class="text-[11px] text-slate-500 font-medium bg-white/80 px-3 py-1 rounded-full shadow-sm border border-slate-200/80">
                Percakapan dengan ${esc(name)}
            </span>
            <div class="flex-1 h-px bg-slate-300/50"></div>
        </div>`;
    scrollDown(false);

    // Mobile: switch to convo view
    if (isMobile()) showConversation();
}

/* ─── Mobile Panel Toggle ─────────────────────────────────── */
function showConversation() {
    document.getElementById('contacts-panel').classList.add('hidden');
    document.getElementById('convo-panel').classList.remove('hidden');
    document.getElementById('btn-back').classList.remove('hidden');
    document.getElementById('btn-back').classList.add('flex');
}
function showContacts() {
    document.getElementById('contacts-panel').classList.remove('hidden');
    document.getElementById('contacts-panel').classList.add('flex');
    if (isMobile()) {
        document.getElementById('convo-panel').classList.add('hidden');
    }
    document.getElementById('btn-back').classList.add('hidden');
    document.getElementById('btn-back').classList.remove('flex');
}

// Init mobile state
function initLayout() {
    const cp = document.getElementById('contacts-panel');
    const kp = document.getElementById('convo-panel');
    if (isMobile()) {
        cp.classList.remove('hidden');
        cp.classList.add('flex', 'w-full');
        kp.classList.add('hidden');
    } else {
        cp.classList.remove('hidden', 'w-full');
        cp.classList.add('flex');
        kp.classList.remove('hidden');
    }
}
window.addEventListener('resize', initLayout);
initLayout();

/* ─── Contact Search ──────────────────────────────────────── */
function filterContacts(query) {
    const q = query.toLowerCase().trim();
    const btns = document.querySelectorAll('.contact-btn');
    let visible = 0;
    btns.forEach(btn => {
        const name  = btn.dataset.cname.toLowerCase();
        const mk    = btn.dataset.mk.toLowerCase();
        const unread = parseInt(btn.dataset.unread || '0');
        const matchSearch  = !q || name.includes(q) || mk.includes(q);
        const matchFilter  = currentFilter === 'all' || (currentFilter === 'unread' && unread > 0);
        const show = matchSearch && matchFilter;
        btn.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('no-results').classList.toggle('hidden', visible > 0);
}

function setFilter(type) {
    currentFilter = type;
    document.querySelectorAll('.filter-chip').forEach(c => {
        c.classList.remove('bg-accent','text-white','active-chip');
        c.classList.add('bg-slate-100','text-muted','hover:bg-slate-200');
    });
    const active = document.getElementById(`chip-${type}`);
    active.classList.add('bg-accent','text-white','active-chip');
    active.classList.remove('bg-slate-100','text-muted','hover:bg-slate-200');
    filterContacts(document.getElementById('search-contacts').value);
}

/* ─── Init ────────────────────────────────────────────────── */
scrollDown(false);
</script>
@endpush

@endsection