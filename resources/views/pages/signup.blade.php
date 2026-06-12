@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-4 py-12 bg-gradient-to-br from-surface via-white to-secondary/30">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="/assets/logo/tutorium-logo.png" alt="Tutorium" class="h-12 mx-auto mb-4">
            </a>
            <h1 class="text-2xl font-extrabold text-dark">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm mt-1">Bergabung dan mulai belajar bersama tutor terbaik</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-blue-100/60 border border-secondary/60 px-8 py-10">

            {{-- Alert sukses (hidden) --}}
            <div id="alert-success" class="hidden mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-2xl">
                <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                <span>Akun berhasil dibuat! Mengalihkan ke halaman login...</span>
            </div>

            {{-- Alert error (hidden) --}}
            <div id="alert-error" class="hidden mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-2xl">
                <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                <span id="alert-error-msg">Semua field wajib diisi.</span>
            </div>

            <form id="signup-form" novalidate class="space-y-5">

                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="nama" type="text" placeholder="Masukkan nama lengkap kamu"
                               class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-4 py-3 text-sm text-dark placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Alamat Email</label>
                    <div class="relative">
                        <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="email" type="email" placeholder="nama@email.com"
                               class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-4 py-3 text-sm text-dark placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Kata Sandi</label>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="password" type="password" placeholder="Minimal 8 karakter"
                               class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-12 py-3 text-sm text-dark placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <button type="button" id="toggle-pw"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors">
                            <i class="bi bi-eye" id="pw-icon"></i>
                        </button>
                    </div>
                    {{-- Password strength bar --}}
                    <div class="mt-2 flex gap-1" id="strength-bars">
                        <div class="h-1 flex-1 rounded-full bg-secondary transition-all" id="bar-1"></div>
                        <div class="h-1 flex-1 rounded-full bg-secondary transition-all" id="bar-2"></div>
                        <div class="h-1 flex-1 rounded-full bg-secondary transition-all" id="bar-3"></div>
                        <div class="h-1 flex-1 rounded-full bg-secondary transition-all" id="bar-4"></div>
                    </div>
                    <p class="text-[11px] text-gray-400 mt-1" id="strength-label"></p>
                </div>

                {{-- Role --}}
                {{-- <div>
                    <label class="block text-xs font-bold text-dark mb-2">Saya mendaftar sebagai</label>
                    <div class="relative">
                        <i class="bi bi-person-badge absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        <select id="role"
                                class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-4 py-3 text-sm text-dark font-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all appearance-none cursor-pointer">
                            <option value="mahasiswa">🎓 Mahasiswa (Mencari Tutor)</option>
                            <option value="tutor">👨🏫 Tutor (Asdos / Kakak Tingkat)</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                </div> --}}

                {{-- Terms --}}
                <label class="flex items-start gap-3 cursor-pointer group">
                    <input type="checkbox" id="terms"
                           class="w-4 h-4 mt-0.5 rounded text-primary border-secondary focus:ring-primary flex-shrink-0">
                    <span class="text-xs text-gray-500 leading-relaxed">
                        Saya setuju dengan
                        <a href="#" data-modal="kebijakan-privasi" class="text-primary hover:text-primary-hover font-semibold">Kebijakan Privasi</a>
                        Tutorium
                    </span>
                </label>

                {{-- Submit --}}
                <button type="submit" id="btn-signup"
                        class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 active:scale-[0.98] transition-all text-sm">
                    Daftar Sekarang
                </button>

            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-secondary"></div>
                <span class="text-xs text-gray-400 font-medium">atau</span>
                <div class="flex-1 h-px bg-secondary"></div>
            </div>

            {{-- Login link --}}
            <p class="text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary hover:text-primary-hover font-bold transition-colors">
                    Masuk di sini →
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            Data kamu aman dan tidak disebarluaskan 🔒
        </p>

    </div>
</div>

<script>
    // ── Toggle password ───────────────────────────────────────────────
    document.getElementById('toggle-pw').addEventListener('click', function () {
        const pw   = document.getElementById('password');
        const icon = document.getElementById('pw-icon');
        pw.type        = pw.type === 'password' ? 'text' : 'password';
        icon.className = pw.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    });

    // ── Password strength ─────────────────────────────────────────────
    document.getElementById('password').addEventListener('input', function () {
        const val    = this.value;
        const bars   = [1,2,3,4].map(i => document.getElementById('bar-' + i));
        const label  = document.getElementById('strength-label');

        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))     score++;

        const colors  = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-green-500'];
        const labels  = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
        const lblClrs = ['', 'text-red-400', 'text-orange-400', 'text-yellow-500', 'text-green-600'];

        bars.forEach((b, i) => {
            b.className = 'h-1 flex-1 rounded-full transition-all ' +
                (i < score ? colors[score - 1] : 'bg-secondary');
        });
        label.textContent  = val.length ? labels[score]  : '';
        label.className    = 'text-[11px] mt-1 ' + (val.length ? lblClrs[score] : 'text-gray-400');
    });

    // ── Form submit ───────────────────────────────────────────────────
    document.getElementById('signup-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const nama     = document.getElementById('nama').value.trim();
        const email    = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const terms    = document.getElementById('terms').checked;
        const errBox   = document.getElementById('alert-error');
        const errMsg   = document.getElementById('alert-error-msg');

        // Validasi
        if (!nama || !email || !password) {
            errMsg.textContent = 'Nama, email, dan kata sandi wajib diisi.';
            errBox.classList.remove('hidden');
            return;
        }
        if (password.length < 8) {
            errMsg.textContent = 'Kata sandi minimal 8 karakter.';
            errBox.classList.remove('hidden');
            return;
        }
        if (!terms) {
            errMsg.textContent = 'Kamu harus menyetujui Kebijakan Privasi terlebih dahulu.';
            errBox.classList.remove('hidden');
            return;
        }
        errBox.classList.add('hidden');

        // Loading state
        const btn = document.getElementById('btn-signup');
        btn.disabled  = true;
        btn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin mr-2"></i>Mendaftarkan...';

        // Tampilkan alert sukses lalu redirect
        setTimeout(() => {
            document.getElementById('alert-success').classList.remove('hidden');
            setTimeout(() => { window.location.href = '/login'; }, 1200);
        }, 800);
    });
</script>
@endsection
