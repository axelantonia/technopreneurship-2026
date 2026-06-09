<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="#" class="flex items-center gap-2">
                <img src="assets/logo/tutorium-logo.png" alt="Tutorium" class="h-16 w-auto">
            </a>

            <!-- Mobile button -->
            <div class="flex items-center lg:hidden">
                <button id="mobile-menu-btn" class="text-gray-500 hover:text-blue-600 focus:outline-none">
                    <i class="bi bi-list text-3xl"></i>
                </button>
            </div>

            <!-- Menu -->
            <div class="hidden lg:flex flex-1 justify-center space-x-5">
                <a href="/" class="text-blue-600 font-bold">Beranda</a>
                <a href="/tutors" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Cari Tutor</a>
                <a href="#" data-modal="kebijakan-privasi" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Kebijakan Privasi</a>
                <a href="/#faq" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">FAQ</a>
            </div>

            <!-- PROFILE ICON -->
            <div class="hidden lg:flex items-center">
                <div class="relative">
                    <button id="profile-btn" class="flex items-center gap-2 focus:outline-none">

                        <!-- ICON BULAT (kayak IG style) -->
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="bi bi-person-fill text-gray-600 text-lg"></i>
                        </div>

                        <i class="bi bi-chevron-down text-gray-500 text-sm"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="profile-menu" class="hidden absolute right-0 mt-3 w-44 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Settings</a>
                        <a href="/login" class="block px-4 py-2 text-red-500 hover:bg-red-50">Logout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 px-4 pt-2 pb-4 space-y-2 shadow-lg">
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50">Beranda</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Cari Tutor</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Cara Kerja</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">FAQ</a>

        <!-- Profile Mobile -->
        <div class="pt-4 flex items-center gap-3 px-3 py-2">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                <i class="bi bi-person-fill text-gray-600"></i>
            </div>
            <span class="font-medium text-gray-700">Profile</span>
        </div>

        <a href="#" class="w-full block text-center bg-red-500 text-white px-4 py-2 rounded-full font-medium hover:bg-red-600">
            Logout
        </a>
    </div>
</nav>

<script>
    // mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // profile dropdown
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');

    profileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        profileMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });
</script>
