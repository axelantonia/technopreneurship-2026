@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-4 py-12 bg-gradient-to-br from-surface via-white to-secondary/30">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="/assets/logo/tutorium-logo.png" alt="Tutorium" class="h-12 mx-auto mb-4">
            </a>
            <h1 class="text-2xl font-extrabold text-dark">Selamat Datang Kembali!</h1>
            <p class="text-gray-500 text-sm mt-1">Masuk ke akun Tutorium kamu</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-blue-100/60 border border-secondary/60 px-8 py-10">

            {{-- Alert error (hidden by default) --}}
            <div id="alert-error" class="hidden mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-2xl">
                <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                <span id="alert-error-msg">Semua field harus diisi.</span>
            </div>

            <form id="login-form" novalidate class="space-y-5">

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
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-dark">Kata Sandi</label>
                        <a href="#" class="text-xs text-primary hover:text-primary-hover font-semibold transition-colors">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="password" type="password" placeholder="Masukkan kata sandi"
                               class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-12 py-3 text-sm text-dark placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <button type="button" id="toggle-pw"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors">
                            <i class="bi bi-eye" id="pw-icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-xs font-bold text-dark mb-2">Masuk Sebagai</label>
                    <div class="relative">
                        <i class="bi bi-person-badge absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        <select id="role"
                                class="w-full bg-surface border border-secondary rounded-xl pl-11 pr-4 py-3 text-sm text-dark font-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all appearance-none cursor-pointer">
                            <option value="mahasiswa">🎓 Mahasiswa (Tutee)</option>
                            <option value="tutor">👨‍🏫 Tutor (Asdos / Kating)</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                </div>

                {{-- Remember me --}}
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" id="remember"
                           class="w-4 h-4 rounded text-primary border-secondary focus:ring-primary">
                    <span class="text-xs text-gray-500 group-hover:text-dark transition-colors">Ingat saya di perangkat ini</span>
                </label>

                {{-- Submit --}}
                <button type="submit" id="btn-login"
                        class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 active:scale-[0.98] transition-all text-sm">
                    Masuk ke Tutorium
                </button>

            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-secondary"></div>
                <span class="text-xs text-gray-400 font-medium">atau</span>
                <div class="flex-1 h-px bg-secondary"></div>
            </div>

            {{-- Sign up link --}}
            <p class="text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('signup') }}" class="text-primary hover:text-primary-hover font-bold transition-colors">
                    Daftar gratis →
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            Dengan masuk, kamu menyetujui
            <a href="#" data-modal="kebijakan-privasi" class="underline hover:text-primary transition-colors">Kebijakan Privasi</a>
            Tutorium.
        </p>

    </div>
</div>

<script>
    // ── Toggle password visibility ────────────────────────────────────
    document.getElementById('toggle-pw').addEventListener('click', function () {
        const pw   = document.getElementById('password');
        const icon = document.getElementById('pw-icon');
        if (pw.type === 'password') {
            pw.type    = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            pw.type    = 'password';
            icon.className = 'bi bi-eye';
        }
    });

    // ── Form submit & redirect ────────────────────────────────────────
    document.getElementById('login-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const email    = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const role     = document.getElementById('role').value;
        const errBox   = document.getElementById('alert-error');
        const errMsg   = document.getElementById('alert-error-msg');

        // Simple validation
        if (!email || !password) {
            errMsg.textContent = 'Email dan kata sandi wajib diisi.';
            errBox.classList.remove('hidden');
            return;
        }
        errBox.classList.add('hidden');

        // Loading state
        const btn = document.getElementById('btn-login');
        btn.disabled     = true;
        btn.innerHTML    = '<i class="bi bi-arrow-repeat animate-spin mr-2"></i>Memproses...';

        setTimeout(() => {
            if (role === 'tutor') {
                window.location.href = '/tutors/dashboard';
            } else {
                window.location.href = '/';
            }
        }, 800);
    });
</script>
@endsection
