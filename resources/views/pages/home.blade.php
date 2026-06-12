@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-b from-surface via-white to-white py-12 lg:py-16 relative">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-dark leading-tight mb-4 tracking-tight">
            Mau Belajar Apa Hari Ini? <br class="hidden lg:block"> Cari Tutor Buat Temenin Kamu
        </h1>
        <p class="text-lg text-gray-500 mb-10 max-w-2xl mx-auto">
            Kejar nilai A dengan bimbingan langsung dari mahasiswa berprestasi.
        </p>

        <div class="bg-white p-3 rounded-2xl shadow-[0_8px_30px_rgb(59,130,246,0.12)] border border-secondary mx-auto w-full relative z-20">
            <form action="/tutors" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="relative">
                        <input type="text" id="input-kampus" name="kampus" autocomplete="off" placeholder="Pilih kampus..."
                            class="w-full bg-lightgray border border-transparent text-gray-700 py-3 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition placeholder-gray-400 cursor-text">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <ul id="dropdown-kampus" class="absolute z-50 w-full bg-white border border-secondary shadow-lg rounded-xl mt-2 hidden max-h-60 overflow-y-auto custom-scrollbar"></ul>
                </div>

                <div class="flex-1 md:border-l md:border-gray-100 md:pl-3 relative">
                    <div class="relative">
                        <input type="text" id="input-jurusan" name="jurusan" autocomplete="off" placeholder="Pilih kampus terlebih dahulu..." disabled
                            class="w-full bg-lightgray border border-transparent text-gray-700 py-3 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition placeholder-gray-400 disabled:opacity-50 disabled:cursor-not-allowed cursor-text">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <ul id="dropdown-jurusan" class="absolute z-50 w-full bg-white border border-secondary shadow-lg rounded-xl mt-2 hidden max-h-60 overflow-y-auto custom-scrollbar"></ul>
                </div>

                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full md:w-32 bg-primary hover:bg-primary-hover text-white font-semibold py-3 px-6 rounded-xl transition-all shadow-lg shadow-primary/30 hover:shadow-primary/50">
                        Cari Tutor
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="relative z-10 -mt-20 px-4 sm:px-6 lg:px-8 max-w-7xl mt-16 mx-auto font-sans">
    <div class="bg-blue-50 rounded-[2rem] p-6 lg:p-8 shadow-[0_8px_30px_rgb(59,130,246,0.1)] border border-blue-100 relative">

        <div class="flex flex-col lg:flex-row items-center gap-8">

            <div class="flex items-center gap-5 w-full lg:w-auto">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=User+Mahasiswa&background=ffffff&color=3B82F6&size=150" alt="Profile" class="w-20 h-20 rounded-2xl border-2 border-white object-cover shadow-sm">
                    <div class="absolute -bottom-3 -right-3 bg-yellow-400 text-yellow-900 text-[10px] font-extrabold px-2.5 py-1 rounded-lg border-2 border-white shadow-sm flex items-center gap-1">
                        <i class="bi bi-star-fill text-[10px]"></i> LVL 12
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-blue-950 mb-1">Halo, Pejuang Kampus! 👋</h2>
                    <p class="text-blue-600/80 text-sm font-medium"><i class="bi bi-mortarboard mr-1"></i> Siap Belajar Hari Ini</p>
                </div>
            </div>

            <div class="hidden lg:block w-px h-16 bg-blue-200"></div>

            <div class="flex-1 w-full lg:w-auto">
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <p class="text-blue-500 text-[10px] font-bold uppercase tracking-widest mb-1">Total Poin</p>
                        <div class="flex items-center gap-2 text-amber-500 font-extrabold text-2xl lg:text-3xl">
                            <i class="bi bi-coin"></i> 2,450
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-500 text-[10px] font-bold uppercase tracking-widest mb-1">Menuju Level 13</p>
                        <p class="text-primary text-sm font-bold">850 <span class="text-blue-400 font-medium">/ 1000 XP</span></p>
                    </div>
                </div>

                <div class="w-full bg-white rounded-full h-3 shadow-inner overflow-hidden border border-blue-100">
                    <div class="bg-primary h-full rounded-full transition-all duration-500" style="width: 85%"></div>
                </div>
            </div>

            <div class="hidden lg:block w-px h-16 bg-blue-200"></div>

            <div class="w-full lg:w-auto flex flex-col lg:justify-center border-t border-blue-200 pt-5 lg:border-t-0 lg:pt-0 mt-2 lg:mt-0">
                <div class="flex justify-between lg:justify-center items-center mb-3">
                    <p class="text-blue-500 text-[10px] font-bold uppercase tracking-widest">Koleksi Badge</p>
                </div>
                <div class="flex gap-4 lg:justify-center">
                    <div class="w-12 h-12 rounded-full bg-amber-100 border border-amber-200 flex items-center justify-center text-amber-500 text-xl shadow-sm hover:scale-110 transition-transform cursor-pointer">
                        <i class="bi bi-fire"></i>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-purple-100 border border-purple-200 flex items-center justify-center text-purple-500 text-xl shadow-sm hover:scale-110 transition-transform cursor-pointer">
                        <i class="bi bi-chat-quote-fill"></i>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-rose-100 border border-rose-200 flex items-center justify-center text-rose-500 text-xl shadow-sm hover:scale-110 transition-transform cursor-pointer">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white border-2 border-dashed border-blue-300 flex items-center justify-center text-blue-300">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- 🔥 VOUCHER BUTTON (POJOK KANAN BAWAH CARD) -->
        <a href="{{ route('belivoucher') }}"
           class="absolute -bottom-4 right-6 inline-flex items-center gap-2 bg-white border border-primary text-primary text-xs font-bold px-4 py-2 rounded-xl shadow-lg hover:bg-primary hover:text-white transition-all active:scale-95">

            <i class="bi bi-gift-fill"></i>
            Tukar Voucher
        </a>

    </div>
</section>

<section class="bg-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 gap-4">
            <div class="text-center md:text-left">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-dark mb-2 tracking-tight">Pilih Kampus Kebanggaanmu</h2>
                <p class="text-gray-500 font-medium">Tersedia <span class="text-primary font-bold">1000+ Tutor</span> dari berbagai universitas ternama di Surabaya.</p>
            </div>

            <div class="flex gap-2">
                <button onclick="document.getElementById('campus-carousel').scrollBy({left: -320, behavior: 'smooth'})"
                    class="w-12 h-12 rounded-full border-2 border-secondary bg-surface flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                    <i class="bi bi-arrow-left text-lg"></i>
                </button>
                <button onclick="document.getElementById('campus-carousel').scrollBy({left: 320, behavior: 'smooth'})"
                    class="w-12 h-12 rounded-full border-2 border-secondary bg-surface flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                    <i class="bi bi-arrow-right text-lg"></i>
                </button>
            </div>
        </div>

        <div id="campus-carousel" class="flex gap-6 overflow-x-auto pb-8 scrollbar-hide snap-x snap-mandatory lg:grid lg:grid-cols-4 lg:overflow-x-visible">
            <div class="flex-shrink-0 w-[280px] lg:w-full snap-center group">
                <a href="/tutors?kampus=Universitas+Kristen+Petra" class="block bg-surface rounded-[2.5rem] p-8 text-center border-2 border-transparent hover:border-secondary hover:bg-white hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500">
                    <div class="w-28 h-28 mx-auto bg-white rounded-[2rem] p-4 shadow-sm mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 flex items-center justify-center">
                        <img src="/assets/logo/PetraLogo.png" class="w-full h-full object-contain" alt="UK Petra">
                    </div>
                    <h5 class="text-xl font-bold text-dark mb-1">UK Petra</h5>
                    <p class="text-[10px] text-primary uppercase tracking-[0.2em] font-bold">Surabaya</p>
                </a>
            </div>
            <div class="flex-shrink-0 w-[280px] lg:w-full snap-center group">
                <a href="/tutors?kampus=Universitas+Surabaya" class="block bg-surface rounded-[2.5rem] p-8 text-center border-2 border-transparent hover:border-secondary hover:bg-white hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500">
                    <div class="w-28 h-28 mx-auto bg-white rounded-[2rem] p-4 shadow-sm mb-6 group-hover:scale-110 group-hover:-rotate-3 transition-all duration-500 flex items-center justify-center">
                        <img src="/assets/logo/UbayaLogo.png" class="w-full h-full object-contain" alt="UBAYA">
                    </div>
                    <h5 class="text-xl font-bold text-dark mb-1">UBAYA</h5>
                    <p class="text-[10px] text-primary uppercase tracking-[0.2em] font-bold">Surabaya</p>
                </a>
            </div>
            <div class="flex-shrink-0 w-[280px] lg:w-full snap-center group">
                <a href="/tutors?kampus=ITS" class="block bg-surface rounded-[2.5rem] p-8 text-center border-2 border-transparent hover:border-secondary hover:bg-white hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500">
                    <div class="w-28 h-28 mx-auto bg-white rounded-[2rem] p-4 shadow-sm mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 flex items-center justify-center">
                        <img src="/assets/logo/ItsLogo.png" class="w-full h-full object-contain" alt="ITS">
                    </div>
                    <h5 class="text-xl font-bold text-dark mb-1">ITS</h5>
                    <p class="text-[10px] text-primary uppercase tracking-[0.2em] font-bold">Surabaya</p>
                </a>
            </div>
            <div class="flex-shrink-0 w-[280px] lg:w-full snap-center group">
                <a href="/tutors?kampus=UNAIR" class="block bg-surface rounded-[2.5rem] p-8 text-center border-2 border-transparent hover:border-secondary hover:bg-white hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500">
                    <div class="w-28 h-28 mx-auto bg-white rounded-[2rem] p-4 shadow-sm mb-6 group-hover:scale-110 group-hover:-rotate-3 transition-all duration-500 flex items-center justify-center">
                        <img src="/assets/logo/UnairLogo.png" class="w-full h-full object-contain" alt="UNAIR">
                    </div>
                    <h5 class="text-xl font-bold text-dark mb-1">UNAIR</h5>
                    <p class="text-[10px] text-primary uppercase tracking-[0.2em] font-bold">Surabaya</p>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-lightgray py-20 border-y border-gray-100" id="cari-tutor">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-dark tracking-tight">Kenapa Tutorium?</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl text-center border border-secondary/50 shadow-sm hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-surface text-primary mb-6 shadow-inner">
                    <i class="bi bi-clock-history text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-dark mb-3">Jadwal Fleksibel</h5>
                <p class="text-gray-500 text-sm leading-relaxed">Tentukan jam belajarmu sendiri sesuai kesepakatan dengan tutor. Kuliah padat bukan halangan.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl text-center border border-secondary/50 shadow-sm hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-surface text-primary mb-6 shadow-inner">
                    <i class="bi bi-laptop text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-dark mb-3">Bebas Pilih Mode</h5>
                <p class="text-gray-500 text-sm leading-relaxed">Pilih mode belajar yang nyaman buatmu, entah itu Online atau Offline di sekitar kampus.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl text-center border border-secondary/50 shadow-sm hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-surface text-primary mb-6 shadow-inner">
                    <i class="bi bi-patch-check text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-dark mb-3">Tutor Terverifikasi</h5>
                <p class="text-gray-500 text-sm leading-relaxed">Belajar langsung dari asdos atau kakak tingkat dari kampus sendiri yang sudah pasti paham gaya dosenmu ataupun kampus lain.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-surface py-20 border-b border-secondary/50" id="top-tutor">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-12 gap-4">
            <div class="text-center md:text-left">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-dark mb-3 tracking-tight">Tutor of The Month</h2>
                <p class="text-gray-500 font-medium">Belajar dari pengajar dengan rating tertinggi.</p>
            </div>
            <a href="/tutors" class="hidden md:inline-flex items-center gap-2 text-primary font-bold hover:text-primary-hover hover:underline transition-all">
                Lihat Semua Tutor <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-3xl border border-secondary shadow-sm hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col group">
                <div class="relative mb-4 overflow-hidden rounded-2xl">
                    <img src="{{ asset('assets/img/profil-budi.jpeg') }}" alt="Budi" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-xl text-xs font-extrabold text-yellow-500 shadow-sm flex items-center gap-1.5 border border-white">
                        <i class="bi bi-star-fill"></i> 4.9
                    </div>
                </div>
                <h4 class="text-lg font-bold text-dark flex items-center gap-1.5 mb-1">
                    Budi Santoso <i class="bi bi-patch-check-fill text-primary text-sm"></i>
                </h4>
                <p class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-wider">Informatika, UK Petra</p>
                <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Web Dev</span>
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Laravel</span>
                </div>
                <a href="#" class="w-full block text-center bg-surface hover:bg-primary hover:text-white text-primary font-bold py-3 rounded-xl transition-colors border border-secondary hover:border-primary">
                    Lihat Profil
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-secondary shadow-sm hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col group">
                <div class="relative mb-4 overflow-hidden rounded-2xl">
                    <img src="{{ asset('assets/img/profil-kevin.jpg') }}" alt="Kevin" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-xl text-xs font-extrabold text-yellow-500 shadow-sm flex items-center gap-1.5 border border-white">
                        <i class="bi bi-star-fill"></i> 4.8
                    </div>
                </div>
                <h4 class="text-lg font-bold text-dark flex items-center gap-1.5 mb-1">
                    Kevin Wijaya <i class="bi bi-patch-check-fill text-primary text-sm"></i>
                </h4>
                <p class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-wider">Manajemen, UBAYA</p>
                <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Statistik Bisnis</span>
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Akuntansi</span>
                </div>
                <a href="#" class="w-full block text-center bg-surface hover:bg-primary hover:text-white text-primary font-bold py-3 rounded-xl transition-colors border border-secondary hover:border-primary">
                    Lihat Profil
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-secondary shadow-sm hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col group">
                <div class="relative mb-4 overflow-hidden rounded-2xl">
                    <img src="{{ asset('assets/img/profil-siska.jpg') }}" alt="Siska" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-xl text-xs font-extrabold text-yellow-500 shadow-sm flex items-center gap-1.5 border border-white">
                        <i class="bi bi-star-fill"></i> 5.0
                    </div>
                </div>
                <h4 class="text-lg font-bold text-dark flex items-center gap-1.5 mb-1">
                    Siska Amanda <i class="bi bi-patch-check-fill text-primary text-sm"></i>
                </h4>
                <p class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-wider">Sistem Informasi, ITS</p>
                <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">UI/UX Design</span>
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Figma</span>
                </div>
                <a href="#" class="w-full block text-center bg-surface hover:bg-primary hover:text-white text-primary font-bold py-3 rounded-xl transition-colors border border-secondary hover:border-primary">
                    Lihat Profil
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-secondary shadow-sm hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col group md:hidden lg:flex">
                <div class="relative mb-4 overflow-hidden rounded-2xl">
                    <img src="{{ asset('assets/img/profil-dimas.jpg') }}" alt="Dimas" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-xl text-xs font-extrabold text-yellow-500 shadow-sm flex items-center gap-1.5 border border-white">
                        <i class="bi bi-star-fill"></i> 4.8
                    </div>
                </div>
                <h4 class="text-lg font-bold text-dark flex items-center gap-1.5 mb-1">
                    Dimas Pratama
                </h4>
                <p class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-wider">Ilmu Komunikasi, UNAIR</p>
                <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Public Speaking</span>
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-surface text-primary rounded-lg border border-secondary">Copywriting</span>
                </div>
                <a href="#" class="w-full block text-center bg-surface hover:bg-primary hover:text-white text-primary font-bold py-3 rounded-xl transition-colors border border-secondary hover:border-primary">
                    Lihat Profil
                </a>
            </div>

        </div>

        <div class="mt-8 text-center md:hidden">
            <a href="/tutors" class="inline-flex items-center gap-2 text-primary border border-secondary bg-white px-6 py-3 rounded-xl font-bold hover:bg-surface transition-all">
                Lihat Semua Tutor <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

<section class="bg-white py-20" id="ulasan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-dark mb-4 tracking-tight">Testimoni</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Pengalaman nyata dari mahasiswa yang berhasil  perbaiki nilai berkat bantuan Tutorium.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface p-8 rounded-3xl relative border border-secondary hover:shadow-lg hover:shadow-primary/10 transition-shadow">
                <i class="bi bi-quote text-5xl text-primary/20 absolute top-6 right-6"></i>
                <div class="flex text-yellow-400 mb-5 text-sm">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed mb-8 font-medium">"Gila sih, belajar sama Kak Budi bikin materi Struktur Data yang awalnya kayak bahasa alien jadi gampang banget dipahami. UTS kemarin aman sentosa!"</p>
                <div class="flex items-center gap-3 border-t border-secondary/60 pt-4 mt-auto">
                    <img src="https://ui-avatars.com/api/?name=Andi+P&background=3B82F6&color=fff&size=100" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                    <div>
                        <h6 class="font-bold text-dark text-sm">Andi Pratama</h6>
                        <p class="text-xs text-primary font-medium">Informatika 2024</p>
                    </div>
                </div>
            </div>

            <div class="bg-surface p-8 rounded-3xl relative border border-secondary hover:shadow-lg hover:shadow-primary/10 transition-shadow">
                <i class="bi bi-quote text-5xl text-primary/20 absolute top-6 right-6"></i>
                <div class="flex text-yellow-400 mb-5 text-sm">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed mb-8 font-medium">"Jadwalnya fleksibel banget, aku bisa request belajar offline di kantin kampus. Kak Kevin sabar banget ngajarin aku hitungan statistik bisnis."</p>
                <div class="flex items-center gap-3 border-t border-secondary/60 pt-4 mt-auto">
                    <img src="https://ui-avatars.com/api/?name=Siska+A&background=3B82F6&color=fff&size=100" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                    <div>
                        <h6 class="font-bold text-dark text-sm">Siska Amelia</h6>
                        <p class="text-xs text-primary font-medium">Manajemen 2023</p>
                    </div>
                </div>
            </div>

            <div class="bg-surface p-8 rounded-3xl relative border border-secondary hover:shadow-lg hover:shadow-primary/10 transition-shadow">
                <i class="bi bi-quote text-5xl text-primary/20 absolute top-6 right-6"></i>
                <div class="flex text-yellow-400 mb-5 text-sm">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed mb-8 font-medium">"Platform ini nolong banget! Gak perlu bingung lagi nyari asdos buat bimbingan privat. Langsung klik, pilih, terus janjian. Super praktis!"</p>
                <div class="flex items-center gap-3 border-t border-secondary/60 pt-4 mt-auto">
                    <img src="https://ui-avatars.com/api/?name=Reza+M&background=3B82F6&color=fff&size=100" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                    <div>
                        <h6 class="font-bold text-dark text-sm">Reza Mahendra</h6>
                        <p class="text-xs text-primary font-medium">Sistem Informasi 2022</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     SECTION: PRICING PLANS
═══════════════════════════════════════════════════════════════ --}}
<section class="py-24 relative overflow-hidden" id="pricing"
         style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #283044 100%);">

    {{-- Decorative blobs --}}
    <div class="absolute top-0 left-0 w-96 h-96 rounded-full opacity-10 pointer-events-none"
         style="background: radial-gradient(circle, #4D81EE, transparent); transform: translate(-30%, -30%);"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full opacity-10 pointer-events-none"
         style="background: radial-gradient(circle, #7ba7f5, transparent); transform: translate(30%, 30%);"></div>
    <div class="absolute top-1/2 left-1/2 w-[600px] h-[600px] rounded-full opacity-5 pointer-events-none"
         style="background: radial-gradient(circle, #4D81EE, transparent); transform: translate(-50%, -50%);"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.25em] px-4 py-2 rounded-full mb-5"
                  style="background: rgba(77,129,238,0.15); color: #7ba7f5; border: 1px solid rgba(77,129,238,0.3);">
                <i class="bi bi-lightning-charge-fill"></i> Pricing Plans
            </span>
            <h2 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-5 tracking-tight">
                Upgrade, Belajar Lebih <span style="background: linear-gradient(90deg, #4D81EE, #7ba7f5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Maksimal</span>
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                Pilih paket yang sesuai dengan kebutuhan dan raih potensi belajarmu bersama Tutorium.
            </p>
        </div>

        {{-- Pricing Cards Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">

            {{-- ── Card 1: Mahasiswa Premium ──────────────────── --}}
            <div class="relative group"
                 style="transition: transform 0.3s ease;"
                 onmouseover="this.style.transform='translateY(-8px)'"
                 onmouseout="this.style.transform='translateY(0)'">

                {{-- Glow effect --}}
                <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background: linear-gradient(135deg, rgba(77,129,238,0.3), rgba(123,167,245,0.1)); filter: blur(20px); transform: scale(1.05);"></div>

                <div class="relative rounded-3xl p-8 h-full flex flex-col"
                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(20px);">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-xl mb-6 w-fit"
                         style="background: rgba(77,129,238,0.2); color: #7ba7f5; border: 1px solid rgba(77,129,238,0.4);">
                        <i class="bi bi-mortarboard-fill"></i> Mahasiswa
                    </div>

                    {{-- Plan name & price --}}
                    <h3 class="text-2xl font-extrabold text-white mb-1">Mahasiswa Premium</h3>
                    <p class="text-gray-400 text-sm mb-6">Untuk mahasiswa yang serius tingkatkan nilainya.</p>

                    <div class="flex items-end gap-2 mb-8">
                        <span class="text-5xl font-black text-white">Rp35.000</span>
                        <span class="text-gray-400 font-medium mb-1">/bulan</span>
                    </div>

                    {{-- Divider --}}
                    <div class="h-px mb-8" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);"></div>

                    {{-- Features --}}
                    <ul class="space-y-4 flex-1 mb-8">
                        @foreach([
                            ['bi-robot', 'AI Recommendation lebih akurat', 'Rekomendasi tutor yang presisi berdasarkan profil belajarmu.'],
                            ['bi-ticket-perforated', 'Voucher diskon sesi belajar', 'Dapatkan voucher eksklusif setiap bulan untuk hemat biaya sesi.'],
                            ['bi-calendar2-check', 'Prioritas booking tutor', 'Slot jadwal tutor populer tersedia lebih dulu untukmu.'],
                            ['bi-bar-chart-line', 'Learning analytics lengkap', 'Dashboard progress belajar komprehensif & insight mingguan.'],
                            ['bi-arrow-counterclockwise', 'Free cancellation lebih fleksibel', 'Batalkan sesi tanpa penalti hingga H-3 sebelum jadwal.'],
                        ] as [$icon, $title, $desc])
                        <li class="flex items-start gap-3 group/item">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 mt-0.5 transition-colors"
                                 style="background: rgba(77,129,238,0.2);">
                                <i class="bi {{ $icon }} text-[13px]" style="color: #7ba7f5;"></i>
                            </div>
                            <div>
                                <span class="text-white text-sm font-semibold">{{ $title }}</span>
                                <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">{{ $desc }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    {{-- CTA Button --}}
                    <button onclick="sToast('Fitur pembayaran segera hadir! Pantau terus update Tutorium.', 'info')"
                            class="w-full py-4 rounded-2xl font-extrabold text-sm tracking-wide transition-all duration-300 hover:scale-[1.02] active:scale-95"
                            style="background: linear-gradient(135deg, #4D81EE, #3B5B8A); color: #fff; border: none; box-shadow: 0 8px 32px rgba(77,129,238,0.4);"
                            onmouseover="this.style.boxShadow='0 12px 40px rgba(77,129,238,0.6)'"
                            onmouseout="this.style.boxShadow='0 8px 32px rgba(77,129,238,0.4)'">
                        <i class="bi bi-lightning-charge-fill mr-2"></i>Mulai Mahasiswa Premium
                    </button>
                </div>
            </div>

            {{-- ── Card 2: Tutor Premium ──────────────────────── --}}
            <div class="relative group"
                 style="transition: transform 0.3s ease;"
                 onmouseover="this.style.transform='translateY(-8px)'"
                 onmouseout="this.style.transform='translateY(0)'">

                {{-- MOST POPULAR badge ribbon --}}
                <div class="absolute -top-4 left-1/2 z-20"
                     style="transform: translateX(-50%);">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-extrabold uppercase tracking-widest px-5 py-2 rounded-full shadow-lg"
                          style="background: linear-gradient(90deg, #f59e0b, #fbbf24); color: #451a03; box-shadow: 0 4px 20px rgba(245,158,11,0.5);">
                        <i class="bi bi-star-fill text-[10px]"></i> Paling Diminati
                    </span>
                </div>

                {{-- Glow effect --}}
                <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background: linear-gradient(135deg, rgba(245,158,11,0.25), rgba(251,191,36,0.1)); filter: blur(20px); transform: scale(1.05);"></div>

                <div class="relative rounded-3xl p-8 h-full flex flex-col mt-4 lg:mt-0"
                     style="background: linear-gradient(145deg, rgba(245,158,11,0.08), rgba(255,255,255,0.05)); border: 1px solid rgba(245,158,11,0.35); backdrop-filter: blur(20px);">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-xl mb-6 w-fit"
                         style="background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.4);">
                        <i class="bi bi-person-workspace"></i> Tutor
                    </div>

                    {{-- Plan name & price --}}
                    <h3 class="text-2xl font-extrabold text-white mb-1">Tutor Premium</h3>
                    <p class="text-gray-400 text-sm mb-6">Untuk tutor yang ingin tingkatkan visibilitas & penghasilan.</p>

                    <div class="flex items-end gap-2 mb-8">
                        <span class="text-5xl font-black text-white">Rp79.000</span>
                        <span class="text-gray-400 font-medium mb-1">/bulan</span>
                    </div>

                    {{-- Divider --}}
                    <div class="h-px mb-8" style="background: linear-gradient(90deg, transparent, rgba(245,158,11,0.4), transparent);"></div>

                    {{-- Features --}}
                    <ul class="space-y-4 flex-1 mb-8">
                        @foreach([
                            ['bi-graph-up-arrow', 'Analytics dashboard lanjutan', 'Pantau performa mengajar, pendapatan, dan tren permintaan tutor.'],
                            ['bi-search-heart', 'Prioritas tampil di pencarian', 'Profilmu muncul lebih awal di hasil pencarian mahasiswa.'],
                            ['bi-patch-check-fill', 'Badge Premium Tutor', 'Tampilkan badge eksklusif yang meningkatkan kepercayaan pelajar.'],
                            ['bi-percent', 'Komisi platform lebih rendah', 'Nikmati potongan komisi yang lebih kecil untuk setiap sesi selesai.'],
                            ['bi-collection-play', 'Akses fitur kelas/paket belajar', 'Buat paket belajar multi-sesi dan kelas grup eksklusif.'],
                        ] as [$icon, $title, $desc])
                        <li class="flex items-start gap-3 group/item">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 mt-0.5 transition-colors"
                                 style="background: rgba(245,158,11,0.2);">
                                <i class="bi {{ $icon }} text-[13px]" style="color: #fbbf24;"></i>
                            </div>
                            <div>
                                <span class="text-white text-sm font-semibold">{{ $title }}</span>
                                <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">{{ $desc }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    {{-- CTA Button --}}
                    <button onclick="sToast('Fitur pembayaran segera hadir! Pantau terus update Tutorium.', 'info')"
                            class="w-full py-4 rounded-2xl font-extrabold text-sm tracking-wide transition-all duration-300 hover:scale-[1.02] active:scale-95"
                            style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #1c0a00; border: none; box-shadow: 0 8px 32px rgba(245,158,11,0.4);"
                            onmouseover="this.style.boxShadow='0 12px 40px rgba(245,158,11,0.6)'"
                            onmouseout="this.style.boxShadow='0 8px 32px rgba(245,158,11,0.4)'">
                        <i class="bi bi-rocket-takeoff-fill mr-2"></i>Mulai Tutor Premium
                    </button>
                </div>
            </div>
        </div>

        {{-- Bottom note --}}
        <div class="text-center mt-12">
            <p class="text-gray-500 text-sm">
                <i class="bi bi-shield-check mr-1.5" style="color: #4D81EE;"></i>
                Garansi uang kembali dalam 7 hari &nbsp;•&nbsp;
                <i class="bi bi-lock mr-1.5" style="color: #4D81EE;"></i>
                Pembayaran aman &amp; terenkripsi &nbsp;•&nbsp;
                <i class="bi bi-arrow-repeat mr-1.5" style="color: #4D81EE;"></i>
                Batalkan kapan saja
            </p>
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-white to-surface py-20" id="faq">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-dark text-center mb-12 tracking-tight">Frequently Asked Questions</h2>
        <div class="space-y-4">

        <!-- QUESTIONS N ANSWERS -->
            <div class="bg-white rounded-2xl shadow-sm border border-secondary overflow-hidden hover:shadow-md transition-shadow">
                <input type="checkbox" id="faq-1" class="peer hidden" checked>
                <label for="faq-1" class="flex justify-between items-center font-bold cursor-pointer p-6 text-dark select-none hover:bg-surface transition-colors">
                    <span>Apa itu Tutorium?</span>
                    <span class="transition-transform duration-300 ease-in-out peer-checked:rotate-180 text-primary">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </label>
                <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out peer-checked:grid-rows-[1fr]">
                    <div class="overflow-hidden">
                        <div class="text-gray-600 px-6 pb-6 pt-4 text-sm leading-relaxed border-t border-secondary/50 bg-surface/30">
                            Tutorium adalah platform marketplace yang menghubungkan mahasiswa dengan tutor tepercaya, seperti asisten dosen (asdos) dan kakak tingkat (kating) dari universitas yang sama atau kampus berbeda untuk membantu proses belajar akademik.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-secondary overflow-hidden hover:shadow-md transition-shadow">
                <input type="checkbox" id="faq-2" class="peer hidden" checked>
                <label for="faq-2" class="flex justify-between items-center font-bold cursor-pointer p-6 text-dark select-none hover:bg-surface transition-colors">
                    <span>Siapa saja yang bisa menjadi pengajar di Tutorium?</span>
                    <span class="transition-transform duration-300 ease-in-out peer-checked:rotate-180 text-primary">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </label>
                <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out peer-checked:grid-rows-[1fr]">
                    <div class="overflow-hidden">
                        <div class="text-gray-600 px-6 pb-6 pt-4 text-sm leading-relaxed border-t border-secondary/50 bg-surface/30">
                            Pengajar di Tutorium disaring secara ketat dan difokuskan pada asisten dosen (asdos) serta kakak tingkat berprestasi yang telah melewati kurikulum matkul terkait, sehingga materi yang diajarkan sangat relevan dengan kisi-kisi ujian kampus mahasiswa.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-secondary overflow-hidden hover:shadow-md transition-shadow">
                <input type="checkbox" id="faq-3" class="peer hidden" checked>
                <label for="faq-3" class="flex justify-between items-center font-bold cursor-pointer p-6 text-dark select-none hover:bg-surface transition-colors">
                    <span>Apa keuntungan dari sistem Poin di Tutorium?</span>
                    <span class="transition-transform duration-300 ease-in-out peer-checked:rotate-180 text-primary">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </label>
                <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out peer-checked:grid-rows-[1fr]">
                    <div class="overflow-hidden">
                        <div class="text-gray-600 px-6 pb-6 pt-4 text-sm leading-relaxed border-t border-secondary/50 bg-surface/30">
                            Setiap kali Anda menyelesaikan sesi les atau memberikan ulasan, Anda akan mendapatkan poin loyalitas. Poin ini dapat dikumpulkan dan ditukarkan menjadi Voucher Belajar untuk potongan harga pada sesi les berikutnya.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-secondary overflow-hidden hover:shadow-md transition-shadow">
                <input type="checkbox" id="faq-4" class="peer hidden" checked>
                <label for="faq-4" class="flex justify-between items-center font-bold cursor-pointer p-6 text-dark select-none hover:bg-surface transition-colors">
                    <span>Bagaimana sistem pembayarannya?</span>
                    <span class="transition-transform duration-300 ease-in-out peer-checked:rotate-180 text-primary">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </label>
                <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out peer-checked:grid-rows-[1fr]">
                    <div class="overflow-hidden">
                        <div class="text-gray-600 px-6 pb-6 pt-4 text-sm leading-relaxed border-t border-secondary/50 bg-surface/30">
                            Semua pembayaran dilakukan melalui payment gateway resmi di dalam platform untuk menghindari penipuan atau sistem pembayaran manual yang tidak teratur. Dana mahasiswa akan diteruskan ke tutor setelah sesi les dinyatakan selesai secara valid.
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-secondary overflow-hidden hover:shadow-md transition-shadow">
                <input type="checkbox" id="faq-5" class="peer hidden">
                <label for="faq-5" class="flex justify-between items-center font-bold cursor-pointer p-6 text-dark select-none hover:bg-surface transition-colors">
                    <span>Apakah bisa ganti jadwal jika berhalangan?</span>
                    <span class="transition-transform duration-300 ease-in-out peer-checked:rotate-180 text-primary">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </label>
                <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out peer-checked:grid-rows-[1fr]">
                    <div class="overflow-hidden">
                        <div class="text-gray-600 px-6 pb-6 pt-4 text-sm leading-relaxed border-t border-secondary/50 bg-surface/30">
                            Tentu bisa! Kamu cukup menghubungi tutor melalui kontak yang tertera setelah booking berhasil, maksimal H-1 sebelum jadwal yang ditentukan untuk melakukan reschedule.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400">Sponsored</p>
                <h2 class="text-2xl font-bold text-gray-800">Featured Ads</h2>
            </div>
        </div>

        <div class="relative">

            <!-- CAROUSEL -->
            <div id="carousel"
                 class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4">

                @php
                    $posters = [
                        ["img" => "assets/img/Grab.jpg", "title" => "#GrabHemat"],
                        ["img" => "assets/img/Indomie.jpg", "title" => "Indomie ter Best"],
                        ["img" => "assets/img/kenangan.jpg", "title" => "Kenangan Frappe"],
                        ["img" => "assets/img/yamie.jpg", "title" => "Yamie Spesial Mahasiswa"],
                        ["img" => "assets/img/epiclair.jpg", "title" => "Epiclair"],                    ];
                @endphp

                @foreach($posters as $item)
                <div class="relative w-[340px] h-[260px] flex-shrink-0 snap-center group">

                    <!-- IMAGE -->
                    <img src="{{ $item['img'] }}"
                        class="w-full h-full object-cover rounded-3xl shadow-md">

                    <!-- OVERLAY -->
                    <div class="absolute inset-0 rounded-3xl
                                bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                    <!-- CONTENT -->
                    <div class="absolute bottom-0 p-4 text-white">
                        <p class="text-sm opacity-80">Sponsored</p>
                        <h3 class="text-lg font-semibold leading-tight">
                            {{ $item['title'] }}
                        </h3>
                        <button class="mt-2 text-sm underline opacity-90 hover:opacity-100">
                            Learn more →
                        </button>
                    </div>

                    <!-- HOVER EFFECT -->
                    <div class="absolute inset-0 rounded-3xl
                                ring-1 ring-white/0 group-hover:ring-white/30
                                transition"></div>

                </div>
                @endforeach

            </div>

            <!-- LEFT -->
            <button onclick="scrollCarousel(-1)"
                class="absolute left-0 top-1/2 -translate-y-1/2
                       bg-white/90 backdrop-blur shadow-lg
                       w-10 h-10 rounded-full hover:scale-105 transition">
                ‹
            </button>

            <!-- RIGHT -->
            <button onclick="scrollCarousel(1)"
                class="absolute right-0 top-1/2 -translate-y-1/2
                       bg-white/90 backdrop-blur shadow-lg
                       w-10 h-10 rounded-full hover:scale-105 transition">
                ›
            </button>

        </div>
    </div>
</section>

<script>
    function scrollCarousel(direction) {
        const container = document.getElementById('carousel');
        const scrollAmount = 360;
        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

<script>
    /* ── Mini Toast untuk Pricing Plans ─────────────────────────── */
    function sToast(message, type = 'info') {
        const colors = {
            info:    { bg: '#4D81EE', icon: 'bi-info-circle-fill' },
            success: { bg: '#22c55e', icon: 'bi-check-circle-fill' },
            warning: { bg: '#f59e0b', icon: 'bi-exclamation-triangle-fill' },
            error:   { bg: '#ef4444', icon: 'bi-x-circle-fill' },
        };
        const c = colors[type] || colors.info;

        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 10px;
            background: ${c.bg}; color: #fff;
            padding: 14px 20px; border-radius: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            transform: translateY(20px); opacity: 0;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            max-width: 360px;
        `;
        toast.innerHTML = `<i class="bi ${c.icon}" style="font-size:18px;flex-shrink:0;"></i><span>${message}</span>`;
        document.body.appendChild(toast);

        requestAnimationFrame(() => {
            toast.style.transform = 'translateY(0)';
            toast.style.opacity = '1';
        });

        setTimeout(() => {
            toast.style.transform = 'translateY(20px)';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3500);
    }
</script>


    tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#3B82F6',       /* Biru Utama (Blue 500) */
                        'primary-hover': '#2563EB', /* Biru Gelap (Blue 600) */
                        secondary: '#DBEAFE',     /* Biru Pastel (Blue 100) */
                        surface: '#EFF6FF',       /* Biru Sangat Muda (Blue 50) */
                        dark: '#0F172A',          /* Slate 900 untuk teks */
                        lightgray: '#F8FAFC',     /* Slate 50 */
                    }
                }
            }
        };

    document.addEventListener("DOMContentLoaded", function() {
        const databaseKampus = {
            "Universitas Kristen Petra": ["Informatika", "Sistem Informasi", "Desain Komunikasi Visual (DKV)", "Teknik Sipil", "Manajemen Bisnis", "Ilmu Komunikasi"],
            "Universitas Surabaya (UBAYA)": ["Hukum", "Farmasi", "Psikologi", "Informatika", "Manajemen", "Bioteknologi"],
            "Universitas Airlangga (UNAIR)": ["Kedokteran", "Kedokteran Gigi", "Kesehatan Masyarakat", "Akuntansi", "Ilmu Komunikasi", "Hubungan Internasional"],
            "Institut Teknologi Sepuluh Nopember (ITS)": ["Teknik Informatika", "Sistem Informasi", "Arsitektur", "Teknik Mesin", "Teknik Industri", "Desain Produk"]
        };

        const inputKampus = document.getElementById('input-kampus');
        const dropdownKampus = document.getElementById('dropdown-kampus');
        const inputJurusan = document.getElementById('input-jurusan');
        const dropdownJurusan = document.getElementById('dropdown-jurusan');

        let kampusTerpilih = "";

        function renderDropdown(inputEl, dropdownEl, dataList, onSelectCallback) {
            dropdownEl.innerHTML = '';
            const keyword = inputEl.value.toLowerCase();
            const filteredData = dataList.filter(item => item.toLowerCase().includes(keyword));

            if (filteredData.length === 0) {
                dropdownEl.innerHTML = '<li class="px-4 py-3 text-gray-400 text-sm italic">Tidak ditemukan</li>';
                return;
            }

            filteredData.forEach(item => {
                const li = document.createElement('li');
                li.className = 'px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary cursor-pointer transition-colors border-b border-gray-50 last:border-0';
                li.textContent = item;

                li.addEventListener('click', () => {
                    inputEl.value = item;
                    dropdownEl.classList.add('hidden');
                    if (onSelectCallback) onSelectCallback(item);
                });
                dropdownEl.appendChild(li);
            });
        }

        inputKampus.addEventListener('focus', () => {
            dropdownKampus.classList.remove('hidden');
            renderDropdown(inputKampus, dropdownKampus, Object.keys(databaseKampus), handleKampusSelect);
        });

        inputKampus.addEventListener('input', () => {
            dropdownKampus.classList.remove('hidden');
            renderDropdown(inputKampus, dropdownKampus, Object.keys(databaseKampus), handleKampusSelect);
            resetJurusan();
        });

        function handleKampusSelect(selected) {
            kampusTerpilih = selected;
            inputJurusan.disabled = false;
            inputJurusan.placeholder = "Ketik atau pilih jurusan...";
            inputJurusan.value = '';
        }

        function resetJurusan() {
            kampusTerpilih = "";
            inputJurusan.disabled = true;
            inputJurusan.placeholder = "Pilih kampus terlebih dahulu...";
            inputJurusan.value = '';
            dropdownJurusan.classList.add('hidden');
        }

        inputJurusan.addEventListener('focus', () => {
            if (inputJurusan.disabled) return;
            dropdownJurusan.classList.remove('hidden');
            renderDropdown(inputJurusan, dropdownJurusan, databaseKampus[kampusTerpilih] || []);
        });

        inputJurusan.addEventListener('input', () => {
            if (inputJurusan.disabled) return;
            dropdownJurusan.classList.remove('hidden');
            renderDropdown(inputJurusan, dropdownJurusan, databaseKampus[kampusTerpilih] || []);
        });

        document.addEventListener('click', (e) => {
            if (!inputKampus.contains(e.target) && !dropdownKampus.contains(e.target)) {
                dropdownKampus.classList.add('hidden');
            }
            if (!inputJurusan.contains(e.target) && !dropdownJurusan.contains(e.target)) {
                dropdownJurusan.classList.add('hidden');
            }
        });
    });

    let current = 0;
    const items = document.querySelectorAll(".carousel-item");
    const total = items.length;

    function render() {
        items.forEach((el, i) => {

            let offset = i - current;

            // LOOP effect
            if (offset > total / 2) offset -= total;
            if (offset < -total / 2) offset += total;

            let abs = Math.abs(offset);

            let scale = 1 - abs * 0.15;
            let opacity = 1 - abs * 0.3;
            let blur = abs * 2;

            if (abs === 0) {
                scale = 1.1;
                opacity = 1;
                blur = 0;
                el.style.zIndex = 10;
            } else {
                el.style.zIndex = 5 - abs;
            }

            el.style.transform = `
                translateX(${offset * 180}px)
                scale(${scale})
            `;

            el.style.opacity = opacity;
            el.style.filter = `blur(${blur}px)`;
        });
    }

    function move(dir) {
        current = (current + dir + total) % total;
        render();
    }

    render();
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Scrollbar khusus untuk dropdown */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #DBEAFE; border-radius: 10px; }
</style>

@endsection
