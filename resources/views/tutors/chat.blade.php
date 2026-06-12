@extends('tutors.layouts.app')
@section('title', 'Ruang Chat')

@section('content')

<div class="mb-4">
    <h1 class="text-xl font-bold text-ink">Ruang Chat</h1>
    <p class="text-sm text-muted mt-0.5">Berkomunikasi langsung dengan mahasiswamu.</p>
</div>

@php
$contacts = [
    ['name'=>'Randi',  'mk'=>'Laravel Advanced',  'color'=>'1d2540', 'tc'=>'60a5fa', 'unread'=>2, 'last'=>'Kak bisa dibahas soal Middleware?', 'time'=>'14:02', 'active'=>true],
    ['name'=>'Livi',   'mk'=>'Web Development',   'color'=>'065f46', 'tc'=>'34d399', 'unread'=>0, 'last'=>'Siap kak, sampai ketemu besok!',   'time'=>'11:30', 'active'=>false],
    ['name'=>'Ivy',    'mk'=>'Basis Data MySQL',  'color'=>'4c1d95', 'tc'=>'a78bfa', 'unread'=>1, 'last'=>'Kak soal JOIN masih bingung nih.', 'time'=>'10:15', 'active'=>false],
    ['name'=>'Kevin',  'mk'=>'Struktur Data',     'color'=>'7c2d12', 'tc'=>'fb923c', 'unread'=>0, 'last'=>'Terima kasih kak sudah dibantu!',  'time'=>'Kem.',  'active'=>false],
    ['name'=>'Monica', 'mk'=>'Pemrograman Web',   'color'=>'881337', 'tc'=>'fb7185', 'unread'=>0, 'last'=>'Oke kak nanti aku coba dulu ya.',  'time'=>'Kem.',  'active'=>false],
];
@endphp

<div class="bg-white border border-border-ui rounded-lg overflow-hidden flex"
     style="height: calc(100vh - 200px); min-height: 480px;">

    {{-- ── Kiri: Contact List ───────────────────────────────────────────── --}}
    <div class="w-64 shrink-0 border-r border-border-ui flex flex-col bg-slate-50/60 hidden sm:flex">
        <div class="px-4 py-3.5 border-b border-border-ui bg-white">
            <p class="text-[11px] font-semibold text-muted uppercase tracking-widest">Mahasiswa</p>
        </div>
        <div class="flex-1 overflow-y-auto">
            @foreach($contacts as $c)
            <button onclick="switchContact('{{ $c['name'] }}','{{ $c['mk'] }}','{{ $c['color'] }}','{{ $c['tc'] }}')"
                    data-cname="{{ $c['name'] }}"
                    class="contact-btn w-full flex items-center gap-3 px-4 py-3.5 hover:bg-white transition text-left border-b border-border-ui/60
                           {{ $c['active'] ? 'bg-white border-l-2 border-l-accent' : '' }}">
                <div class="relative shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($c['name']) }}&size=36&background={{ $c['color'] }}&color={{ $c['tc'] }}"
                         class="w-9 h-9 rounded-md" alt="{{ $c['name'] }}">
                    @if($c['unread'] > 0)
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-accent rounded-full text-white text-[9px] font-extrabold flex items-center justify-center">{{ $c['unread'] }}</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-1">
                        <span class="font-semibold text-ink text-xs truncate">{{ $c['name'] }}</span>
                        <span class="text-[10px] text-subtle shrink-0">{{ $c['time'] }}</span>
                    </div>
                    <p class="text-[11px] text-muted truncate mt-0.5">{{ $c['last'] }}</p>
                </div>
            </button>
            @endforeach
        </div>
    </div>

    {{-- ── Kanan: Ruang Obrolan ─────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Chat header --}}
        <div class="px-5 py-3.5 border-b border-border-ui bg-white flex items-center gap-3 shrink-0">
            <img id="chat-av"
                 src="https://ui-avatars.com/api/?name=Randi&size=36&background=1d2540&color=60a5fa"
                 class="w-9 h-9 rounded-md shrink-0" alt="">
            <div class="min-w-0">
                <p id="chat-nm" class="font-bold text-ink text-sm leading-tight">Randi</p>
                <p id="chat-mk" class="text-xs text-muted">Laravel Advanced</p>
            </div>
            <div class="ml-auto flex items-center gap-1.5 shrink-0">
                <span class="w-2 h-2 rounded-full bg-emerald"></span>
                <span class="text-xs text-muted">Online</span>
            </div>
        </div>

        {{-- Messages --}}
        <div id="messages" class="flex-1 overflow-y-auto px-5 py-5 space-y-4 bg-slate-50/40">

            <div class="flex justify-center">
                <span class="text-[11px] text-muted bg-white border border-border-ui px-3 py-1 rounded-full">Hari ini</span>
            </div>

            {{-- Tutor sent --}}
            <div class="flex justify-end">
                <div class="max-w-sm bg-sidebar text-white text-sm px-4 py-3 rounded-lg rounded-br-sm shadow-sm">
                    <p class="leading-relaxed">Halo Randi! Siap kita bahas Middleware dan Guards hari ini.</p>
                    <p class="text-[10px] text-slate-500 text-right mt-1">13:45</p>
                </div>
            </div>

            {{-- Student received --}}
            <div class="flex justify-start">
                <div class="flex items-end gap-2 max-w-sm">
                    <img id="bubble-av" src="https://ui-avatars.com/api/?name=Randi&size=28&background=1d2540&color=60a5fa"
                         class="w-7 h-7 rounded-md shrink-0" alt="">
                    <div class="bg-white border border-border-ui text-ink text-sm px-4 py-3 rounded-lg rounded-bl-sm shadow-sm">
                        <p class="leading-relaxed">Kak, aku masih bingung di bagian Guards, bisa dijelasin dari awal?</p>
                        <p class="text-[10px] text-subtle mt-1">13:47</p>
                    </div>
                </div>
            </div>

            {{-- Tutor sent --}}
            <div class="flex justify-end">
                <div class="max-w-sm bg-sidebar text-white text-sm px-4 py-3 rounded-lg rounded-br-sm shadow-sm">
                    <p class="leading-relaxed">Tentu! Guards itu ibarat pintu penjaga akses. Kalau ada screenshot error-nya, kirim sini dulu ya.</p>
                    <p class="text-[10px] text-slate-500 text-right mt-1">13:49</p>
                </div>
            </div>

        </div>

        {{-- File preview bar --}}
        <div id="file-bar" class="hidden px-4 py-2 bg-white border-t border-border-ui flex items-center gap-2.5">
            <i id="file-bar-icon" class="bi bi-file-earmark text-accent"></i>
            <span id="file-bar-name" class="text-xs text-ink font-medium truncate flex-1"></span>
            <button onclick="clearFile()" class="text-subtle hover:text-red-500 transition">
                <i class="bi bi-x-lg text-sm"></i>
            </button>
        </div>

        {{-- Input area --}}
        <div class="px-4 py-3.5 bg-white border-t border-border-ui shrink-0">
            <div class="flex items-center gap-2.5">
                <input type="file" id="file-pick" class="hidden" accept="image/*,.pdf,.doc,.docx">
                <button onclick="document.getElementById('file-pick').click()"
                        title="Lampirkan file / gambar"
                        class="w-9 h-9 border border-border-ui bg-slate-50 hover:bg-slate-100 rounded-md flex items-center justify-center text-muted transition shrink-0">
                    <i class="bi bi-paperclip text-sm"></i>
                </button>
                <input id="msg-box" type="text" placeholder="Tulis pesan..."
                       class="flex-1 border border-slate-300 rounded-md px-3.5 py-2.5 text-sm text-ink placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition">
                <button onclick="sendMsg()"
                        class="w-9 h-9 bg-accent hover:bg-accent-dark text-white rounded-md flex items-center justify-center transition shadow-sm shrink-0">
                    <i class="bi bi-send-fill text-sm"></i>
                </button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
const msgBox    = document.getElementById('msg-box');
const filePick  = document.getElementById('file-pick');
const fileBar   = document.getElementById('file-bar');
const fileIcon  = document.getElementById('file-bar-icon');
const fileName  = document.getElementById('file-bar-name');
const messages  = document.getElementById('messages');
let   chosenFile = null;

function timeNow() {
    return new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
}
function scrollDown() {
    messages.scrollTop = messages.scrollHeight;
}
function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── File pick ─────────────────────────────────────────────────────────────
filePick.addEventListener('change', function() {
    if (!this.files.length) return;
    chosenFile = this.files[0];
    fileName.textContent = chosenFile.name;
    fileIcon.className   = chosenFile.type.startsWith('image/')
        ? 'bi bi-image text-accent'
        : 'bi bi-file-earmark-pdf text-red-500';
    fileBar.classList.remove('hidden');
});

function clearFile() {
    chosenFile = null;
    filePick.value = '';
    fileBar.classList.add('hidden');
}

// ── Send ──────────────────────────────────────────────────────────────────
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
            inner += `<img src="${url}" class="max-w-[200px] rounded-md mb-2 block shadow-sm" alt="gambar">`;
        } else {
            inner += `<div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-md px-3 py-2 mb-2 text-xs font-semibold">
                        <i class="bi bi-file-earmark-pdf text-sm"></i>
                        <span class="truncate max-w-[160px]">${esc(chosenFile.name)}</span>
                      </div>`;
        }
    }

    if (text) inner += `<p class="leading-relaxed">${esc(text)}</p>`;

    wrapper.innerHTML = `
        <div class="max-w-sm bg-sidebar text-white text-sm px-4 py-3 rounded-lg rounded-br-sm shadow-sm">
            ${inner}
            <p class="text-[10px] text-slate-500 text-right mt-1">${timeNow()}</p>
        </div>`;

    messages.appendChild(wrapper);
    scrollDown();

    msgBox.value = '';
    clearFile();
}

// ── Switch contact ────────────────────────────────────────────────────────
function switchContact(name, mk, bg, tc) {
    document.getElementById('chat-nm').textContent = name;
    document.getElementById('chat-mk').textContent = mk;
    const av = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=36&background=${bg}&color=${tc}`;
    document.getElementById('chat-av').src  = av;
    document.getElementById('bubble-av').src = av.replace('size=36','size=28');

    document.querySelectorAll('.contact-btn').forEach(btn => {
        const isMe = btn.dataset.cname === name;
        btn.classList.toggle('bg-white',       isMe);
        btn.classList.toggle('border-l-2',     isMe);
        btn.classList.toggle('border-l-accent', isMe);
    });

    messages.innerHTML = `
        <div class="flex justify-center">
            <span class="text-[11px] text-muted bg-white border border-border-ui px-3 py-1 rounded-full">
                Percakapan dengan ${name}
            </span>
        </div>`;
    scrollDown();
}

scrollDown();
</script>
@endpush
@endsection
