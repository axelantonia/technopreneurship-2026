@extends('layouts.app')

@section('content')
@php
    $tutorAvatarSrc = $tutor['profil']
        ? asset('assets/img/profil-' . $tutor['profil'] . '.jpg')
        : asset('assets/img/profil-default.jpg');
    $tutorAvatarAlt = $tutor['name'] ?? 'Tutor';
@endphp
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ── HEADER ── --}}
    <div class="bg-white border border-secondary rounded-3xl shadow-sm p-4 px-5 flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <div class="relative">
                <img src="{{ $tutorAvatarSrc }}"
                     alt="{{ $tutorAvatarAlt }}"
                     class="w-12 h-12 object-cover rounded-full shadow-sm">
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></span>
            </div>
            <div>
                <h2 class="font-extrabold text-dark flex items-center gap-2">
                    {{ $tutor['name'] }}
                    <i class="bi bi-patch-check-fill text-primary text-sm"></i>
                </h2>
                <p class="text-xs text-gray-500">{{ $tutor['jurusan'] }} • {{ $tutor['kampus'] }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button id="btn-clear" title="Hapus riwayat chat"
                    class="text-sm text-gray-400 hover:text-red-500 transition cursor-pointer flex items-center gap-1">
                <i class="bi bi-trash3"></i>
                <span class="hidden sm:inline text-xs font-medium">Hapus Chat</span>
            </button>
            <a href="{{ route('tutors') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition cursor-pointer">
                Kembali →
            </a>
        </div>
    </div>

    {{-- ── CHAT CARD ── --}}
    <div class="bg-white border border-secondary rounded-3xl shadow-lg overflow-hidden flex flex-col" style="height: 72vh;">

        {{-- Chat Area --}}
        <div id="chat-area" class="flex-1 overflow-y-auto px-5 py-5 space-y-5 bg-surface/40">

            <div class="flex justify-center">
                <span class="text-[11px] font-bold text-gray-400 bg-white border border-secondary px-4 py-1 rounded-full shadow-sm">
                    Hari Ini
                </span>
            </div>

            {{-- Pesan sambutan tutor --}}
            <div class="flex items-end gap-3">
                <img src="{{ $tutorAvatarSrc }}"
                     alt="{{ $tutorAvatarAlt }}"
                     class="w-12 h-12 object-cover rounded-full shadow-sm">
                <div class="bg-white border border-secondary px-4 py-3 rounded-2xl rounded-bl-md shadow-sm max-w-sm">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Halo! 👋 Saya <strong>{{ $tutor['name'] }}</strong>, tutor kamu hari ini.<br>
                        Kita bisa bahas: <em>{{ implode(', ', array_slice($tutor['matkul'], 0, 2)) }}</em>, dan lainnya.<br>
                        Silakan kirim pesan atau foto tugasmu ya! 😊
                    </p>
                    <span class="text-[10px] text-gray-400 mt-1 block">{{ now()->format('H:i') }}</span>
                </div>
            </div>

        </div>

        {{-- File Preview Bar --}}
        <div id="file-preview-bar" class="hidden px-5 py-2 bg-white border-t border-secondary flex items-center gap-3">
            <div class="flex items-center gap-2 bg-surface border border-secondary rounded-xl px-3 py-2 text-sm text-dark font-medium max-w-xs">
                <i id="file-preview-icon" class="bi bi-file-earmark text-primary"></i>
                <span id="file-preview-name" class="truncate max-w-[200px] text-xs"></span>
            </div>
            <button id="btn-remove-file" type="button" class="text-gray-400 hover:text-red-500 transition cursor-pointer">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        </div>

        {{-- Input Area --}}
        <div class="p-4 bg-white border-t border-secondary">
            <div class="flex items-center gap-3">

                <input type="file" id="file-input" class="hidden" accept="image/*,.pdf,.doc,.docx">

                <button type="button" id="btn-attach"
                        class="w-11 h-11 rounded-xl bg-surface border border-secondary hover:bg-blue-50 hover:border-primary transition flex items-center justify-center flex-shrink-0 cursor-pointer"
                        title="Lampirkan file">
                    <i class="bi bi-paperclip text-gray-500 text-lg"></i>
                </button>

                <div class="flex-1">
                    <textarea id="msg-input" rows="1"
                              placeholder="Tulis pesan ke {{ $tutor['name'] }}..."
                              class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition resize-none leading-relaxed"
                              style="max-height: 120px;"></textarea>
                </div>

                <button type="button" id="btn-send"
                        class="w-11 h-11 bg-primary hover:bg-primary-hover text-white rounded-xl flex items-center justify-center shadow-lg active:scale-95 transition flex-shrink-0 cursor-pointer">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
            <p class="text-[10px] text-gray-400 mt-2 text-center">
                Kirim pesan atau foto tugas ke tutormu 📎
            </p>
        </div>

    </div>
</div>

<script>
    const TUTOR_NAME      = "{{ $tutor['name'] }}";
    const TUTOR_AVATAR_SRC = "{{ $tutorAvatarSrc }}";

    const chatArea   = document.getElementById('chat-area');
    const msgInput   = document.getElementById('msg-input');
    const fileInput  = document.getElementById('file-input');
    const previewBar = document.getElementById('file-preview-bar');
    const previewName = document.getElementById('file-preview-name');
    const previewIcon = document.getElementById('file-preview-icon');

    // ── Auto-resize textarea ──────────────────────────────────────────
    msgInput.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Enter kirim, Shift+Enter newline
    msgInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // ── File attach ───────────────────────────────────────────────────
    document.getElementById('btn-attach').addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function () {
        if (!this.files.length) return;
        const file = this.files[0];
        previewName.textContent = file.name;
        previewIcon.className = file.type.startsWith('image/')
            ? 'bi bi-image text-primary'
            : 'bi bi-file-earmark-text text-blue-500';
        previewBar.classList.remove('hidden');
    });

    document.getElementById('btn-remove-file').addEventListener('click', () => {
        fileInput.value = '';
        previewBar.classList.add('hidden');
    });

    // ── Helpers ───────────────────────────────────────────────────────
    function scrollToBottom() {
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function timeNow() {
        return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // ── Append bubble user (kanan) ────────────────────────────────────
    function appendUserBubble(text, file) {
        let mediaHtml = '';

        if (file) {
            if (file.type.startsWith('image/')) {
                const objectUrl = URL.createObjectURL(file);
                mediaHtml = `<img src="${objectUrl}" alt="${escapeHtml(file.name)}"
                                  class="max-w-[220px] w-full rounded-xl mb-2 block shadow-sm">`;
            } else {
                const icon = file.type === 'application/pdf'
                    ? 'bi-file-earmark-pdf text-red-300'
                    : 'bi-file-earmark-text text-blue-200';
                mediaHtml = `
                    <div class="flex items-center gap-2 bg-white/20 border border-white/30 rounded-xl px-3 py-2 mb-2 text-xs font-bold">
                        <i class="bi ${icon} text-base"></i>
                        <span class="truncate max-w-[180px]">${escapeHtml(file.name)}</span>
                    </div>`;
            }
        }

        const textHtml = text
            ? `<p class="text-sm leading-relaxed">${escapeHtml(text).replace(/\n/g, '<br>')}</p>`
            : '';

        const div = document.createElement('div');
        div.className = 'flex justify-end';
        div.innerHTML = `
            <div class="bg-primary text-white px-4 py-3 rounded-2xl rounded-br-md shadow-md max-w-sm">
                ${mediaHtml}${textHtml}
                <span class="text-[10px] text-white/70 mt-1 block text-right">${timeNow()}</span>
            </div>`;
        chatArea.appendChild(div);
        scrollToBottom();
    }

    // ── Main send ─────────────────────────────────────────────────────
    function sendMessage() {
        const text = msgInput.value.trim();
        const file = fileInput.files[0] ?? null;

        if (!text && !file) return;

        appendUserBubble(text, file);

        // Reset input
        msgInput.value = '';
        msgInput.style.height = 'auto';
        fileInput.value = '';
        previewBar.classList.add('hidden');

        msgInput.focus();
    }

    document.getElementById('btn-send').addEventListener('click', sendMessage);

    // ── Clear chat ────────────────────────────────────────────────────
    document.getElementById('btn-clear').addEventListener('click', function () {
        if (!confirm('Hapus semua riwayat chat ini?')) return;

        chatArea.innerHTML = `
            <div class="flex justify-center">
                <span class="text-[11px] font-bold text-gray-400 bg-white border border-secondary px-4 py-1 rounded-full shadow-sm">
                    Chat dibersihkan
                </span>
            </div>
            <div class="flex items-end gap-3">
                <img src="${TUTOR_AVATAR_SRC}" alt="${TUTOR_NAME}" class="w-8 h-8 object-cover rounded-full shadow-sm flex-shrink-0">
                <div class="bg-white border border-secondary px-4 py-3 rounded-2xl rounded-bl-md shadow-sm max-w-sm">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Chat sudah direset. Ada yang mau ditanyakan? 😊
                    </p>
                    <span class="text-[10px] text-gray-400 mt-1 block">${timeNow()}</span>
                </div>
            </div>`;
        scrollToBottom();
    });

    scrollToBottom();
</script>
@endsection
