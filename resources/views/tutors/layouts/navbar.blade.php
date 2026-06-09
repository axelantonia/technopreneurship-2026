<nav class="bg-white border-b border-secondary sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-18 py-3">

            {{-- Logo --}}
            <a href="/tutors/dashboard" class="flex items-center gap-2 flex-shrink-0">
                <img src="/assets/logo/tutorium-logo.png" alt="Tutorium" class="h-10 w-auto">
            </a>

            {{-- Desktop nav --}}
            @php
                $page = request()->query('page', 'dashboard');
            @endphp
            <div class="hidden md:flex items-center space-x-1">
                <a href="/tutors/dashboard"
                   class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors
                          {{ $page === 'dashboard' ? 'bg-surface text-primary border border-secondary' : 'text-gray-500 hover:text-dark hover:bg-gray-50' }}">
                    <i class="bi bi-grid mr-1.5"></i>Dashboard
                </a>
                <a href="/tutors/dashboard?page=packages"
                   class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors
                          {{ $page === 'packages' ? 'bg-surface text-primary border border-secondary' : 'text-gray-500 hover:text-dark hover:bg-gray-50' }}">
                    <i class="bi bi-box-seam mr-1.5"></i>Paket Kursus
                </a>
                <a href="/tutors/dashboard?page=reviews"
                   class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors
                          {{ $page === 'reviews' ? 'bg-surface text-primary border border-secondary' : 'text-gray-500 hover:text-dark hover:bg-gray-50' }}">
                    <i class="bi bi-star mr-1.5"></i>Ulasan Murid
                </a>
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-3">
                {{-- PRO badge --}}
                <span class="pro-badge hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold text-white shadow">
                    <i class="bi bi-gem"></i> PRO
                </span>

                {{-- Avatar & name --}}
                <div class="hidden md:flex items-center gap-2.5">
                    <img class="h-9 w-9 rounded-full object-cover border-2 border-secondary shadow-sm"
                         src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4D81EE&color=fff" alt="Profil">
                    <div class="text-right leading-tight">
                        <p class="text-xs font-extrabold text-dark">Budi Santoso</p>
                        <span class="text-[10px] text-green-600 font-bold">● Verified Tutor</span>
                    </div>
                </div>

                <div class="h-7 w-px bg-secondary hidden md:block"></div>

                <a href="/login" class="text-xs font-bold text-red-500 hover:text-red-600 transition hidden md:block">
                    <i class="bi bi-box-arrow-right mr-1"></i>Keluar
                </a>

                {{-- Mobile burger --}}
                <button id="tutor-mobile-btn" class="md:hidden text-gray-500 hover:text-dark">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="tutor-mobile-menu" class="hidden md:hidden bg-white border-t border-secondary px-4 pt-3 pb-4 space-y-1">
        <a href="/tutors/dashboard"
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                  {{ $page === 'dashboard' ? 'bg-surface text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a href="/tutors/dashboard?page=packages"
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                  {{ $page === 'packages' ? 'bg-surface text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="bi bi-box-seam"></i> Paket Kursus
        </a>
        <a href="/tutors/dashboard?page=reviews"
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                  {{ $page === 'reviews' ? 'bg-surface text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
            <i class="bi bi-star"></i> Ulasan Murid
        </a>
        <div class="pt-2 border-t border-secondary">
            <a href="/login" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('tutor-mobile-btn').addEventListener('click', function () {
        document.getElementById('tutor-mobile-menu').classList.toggle('hidden');
    });
</script>
