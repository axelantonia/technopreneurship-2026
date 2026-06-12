<footer class="bg-primary text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 mb-12">

            <!-- LOGO + DESC -->
            <div class="md:col-span-5">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <img src="assets/logo/white-tut.png"
                        alt="Tutorium"
                        class="h-10 w-auto">
                </a>

                <p class="text-white/80 text-sm leading-relaxed mb-6 max-w-sm">
                    Platform belajar peer-to-peer yang menghubungkan mahasiswa dengan tutor terbaik.
                </p>

                <!-- SOCIAL -->
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- LINKS -->
            <div class="md:col-span-3">
                <h6 class="font-bold text-lg mb-5">Tautan Singkat</h6>
                <ul class="space-y-3">
                    <li><a href="#" class="text-white/80 hover:text-white transition text-sm">Tentang Kami</a></li>
                    <li><a href="#cara-kerja" class="text-white/80 hover:text-white transition text-sm">Cara Kerja</a></li>
                    <li><a href="#" class="text-white/80 hover:text-white transition text-sm">Daftar Jadi Tutor</a></li>
                    <li><a href="#" data-modal="kebijakan-privasi" class="text-white/80 hover:text-white transition text-sm">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="md:col-span-4">
                <h6 class="font-bold text-lg mb-5">Kontak Kami</h6>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/80 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <i class="bi bi-envelope"></i>
                        </div>
                        halo@tutorium.id
                    </li>
                    <li class="flex items-center gap-3 text-white/80 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        +62 812 3456 7890
                    </li>
                    <li class="flex items-start gap-3 text-white/80 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <span>Jl. Siwalankerto No.121-131,<br>Surabaya, Jawa Timur 60236</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-white/60 text-sm">
            <p>&copy; 2026 Tutorium Surabaya. Dibuat untuk UTS dengan ❤️</p>
        </div>
    </div>
</footer>
