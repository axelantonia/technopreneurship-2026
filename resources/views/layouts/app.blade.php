<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorium - Tutor Kampusmu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4D81EE',         /* Biru Utama */
                        'primary-hover': '#3B5B8A', /* Biru Gelap pas di-hover */
                        secondary: '#DBEAFE',       /* Biru Pastel buat border/aksen */
                        surface: '#EFF6FF',         /* Biru Sangat Muda buat background card */
                        dark: '#283044',            /* Slate 900 untuk teks heading */
                        lightgray: '#F8FAFC',       /* Slate 50 untuk background section */
                    },
                    fontFamily: {
                        /* Override font bawaan jadi Plus Jakarta Sans */
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Sembunyikan scrollbar untuk carousel kampus tapi fungsi scroll tetap jalan */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-600 antialiased font-sans">

    @include('components.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Modal Kebijakan Privasi -->
    <div id="modal-kebijakan" class="fixed inset-0 z-[100] flex items-center justify-center hidden">
        <!-- Backdrop -->
        <div id="modal-backdrop" class="absolute inset-0 bg-black/50"></div>

        <!-- Modal Box -->
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[80vh] flex flex-col z-10">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-dark">Kebijakan Privasi</h2>
                <button id="modal-close" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>

            <!-- Content (scrollable) -->
            <div class="overflow-y-auto px-6 py-5 text-gray-600 text-sm leading-relaxed space-y-4">
                {{-- Isi konten kebijakan privasi di sini --}}
                <div class="header">
                    <h1>Kebijakan Privasi Tutorium</h1>
                    <div class="meta">Khusus Tutee (Mahasiswa Pengguna Jasa Les) • Terakhir Diperbarui: Juni 2026</div>
                </div>

                <p>Selamat datang di Tutorium. Kami sangat menghargai privasi Anda dan berkomitmen penuh untuk melindungi data pribadi Anda sebagai Tutee. Kebijakan Privasi ini dirancang untuk membantu Anda memahami bagaimana kami mengumpulkan, menggunakan, menyimpan, dan menjaga informasi pribadi Anda saat menggunakan aplikasi dan website Tutorium.</p>
                
                <p>Dengan mendaftar, mengakses, dan menggunakan platform Tutorium, Anda dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan yang tertulis di dalam Kebijakan Privasi ini serta tunduk pada UU No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP).</p>

                <h2>1. Informasi yang Kami Kumpulkan</h2>
                <p>Untuk memberikan pengalaman belajar lintas kampus yang optimal dan personal, kami mengumpulkan beberapa data pribadi Anda, termasuk namun tidak terbatas pada:</p>
                <ul>
                    <li><strong>Informasi Profil Dasar:</strong> Nama lengkap, alamat email aktif, nomor WhatsApp/handphone (untuk verifikasi OTP), foto profil, dan kata sandi akun Anda.</li>
                    <li><strong>Informasi Akademik:</strong> Nama Universitas/Perguruan Tinggi asal, jurusan atau program studi, angkatan, serta riwayat pencarian mata kuliah yang Anda minati.</li>
                    <li><strong>Informasi Transaksi:</strong> Riwayat pemesanan sesi les (<em>booking history</em>), detail pembayaran, penggunaan kode voucher, serta poin/badge <em>gamification</em> yang Anda kumpulkan.</li>
                    <li><strong>Data Komunikasi:</strong> Isi pesan teks yang Anda kirimkan melalui fitur <em>chat system</em> internal Tutorium sebelum atau sesudah sesi reservasi dikonfirmasi.</li>
                </ul>

                <h2>2. Penggunaan Informasi Anda</h2>
                <p>Data yang telah dikumpulkan dari Anda akan digunakan secara bertanggung jawab untuk keperluan operasional berikut:</p>
                <ul>
                    <li>Memproses verifikasi akun dan menjaga keamanan akses masuk (<em>login</em>) berkala Anda.</li>
                    <li>Menjalankan fitur pencarian pintar dan algoritma rekomendasi berbasis AI untuk mencocokkan Anda dengan Tutor (Asdos/Kating) yang paling kompeten.</li>
                    <li>Memasilitasi sistem reservasi jadwal secara <em>real-time</em> dan mengirimkan tautan ruang pertemuan daring otomatis (seperti Google Meet API).</li>
                    <li>Memproses transaksi pembayaran digital secara aman melalui integrasi mitra <em>payment gateway</em> resmi.</li>
                    <li>Mengirimkan notifikasi push dan pengingat jadwal sesi les agar proses belajar berjalan tepat waktu.</li>
                    <li>Melakukan analisis performa platform untuk meningkatkan kualitas layanan berdasarkan masukan (<em>review</em> dan <em>rating</em>) yang Anda berikan kepada tutor.</li>
                </ul>

                <h2>3. Keamanan Data dan Transaksi Finansial</h2>
                <p>Kami menerapkan sistem enkripsi data standar industri (SSL Security) untuk melindungi data pribadi Anda dari akses yang tidak sah, modifikasi ilegal, atau risiko kebocoran data di jaringan publik.</p>
                <p>Tutorium <strong>tidak pernah menyimpan</strong> informasi kartu kredit, PIN, atau detail dompet digital Anda secara langsung di server kami. Seluruh proses transaksi finansial diproses secara terenkripsi menggunakan sistem <em>escrow</em> (rekening bersama) melalui pihak ketiga (Payment Gateway) yang berizin resmi Bank Indonesia. Dana Anda hanya akan diteruskan ke pihak Tutor setelah sesi les dinyatakan selesai secara valid.</p>

                <h2>4. Pengungkapan Data kepada Pihak Ketiga</h2>
                <p>Kami berkomitmen untuk tidak menjual, menyewakan, atau menyebarluaskan data pribadi Anda kepada pihak luar demi keuntungan komersial sepihak. Namun, kami dapat membagikan data terbatas Anda kepada:</p>
                <ul>
                    <li><strong>Tutor yang Anda Pesan:</strong> Nama dan catatan kebutuhan belajar Anda akan dibagikan kepada Tutor terkait agar mereka dapat mempersiapkan materi bimbingan.</li>
                    <li><strong>Mitra Penyedia Layanan (API Vendor):</strong> Pihak infrastruktur server cloud, penyedia layanan WhatsApp OTP, dan payment gateway demi menjamin kelancaran operasional fitur aplikasi.</li>
                    <li><strong>Penegak Hukum:</strong> Jika diwajibkan oleh undang-undang atau perintah pengadilan yang sah di bawah yurisdiksi hukum Republik Indonesia.</li>
                </ul>

                <h2>5. Hak-Hak Pengguna (Tutee)</h2>
                <p>Sebagai pengguna, Anda memiliki hak penuh untuk mengontrol data pribadi Anda di dalam sistem, meliputi:</p>
                <ul>
                    <li>Mengubah, memperbarui, atau melengkapi data profil akademik Anda kapan saja melalui menu <em>Dashboard</em> utama.</li>
                    <li>Memberikan ulasan dan penilaian secara objektif kepada Tutor setelah sesi belajar selesai demi transparansi komunitas.</li>
                    <li>Mengajukan permohonan penutupan akun secara permanen dengan menghubungi tim layanan pelanggan Tutorium.</li>
                </ul>

                <h2>6. Perubahan Kebijakan Privasi</h2>
                <p>Tutorium berhak untuk memperbarui atau mengubah Kebijakan Privasi ini sewaktu-waktu guna menyesuaikan dengan perkembangan teknologi aplikasi dan regulasi hukum yang berlaku. Setiap perubahan signifikan akan kami informasikan melalui email terdaftar atau melalui notifikasi halaman utama platform sebelum perubahan tersebut berlaku efektif.</p>

                <div class="footer-section">
                    <p>Jika Anda memiliki pertanyaan, kendala, atau keluhan terkait penanganan data pribadi dan Kebijakan Privasi ini, silakan hubungi tim kami.</p>
                    <div class="contact-box">
                        <p><strong>Tim Support & Customer Service Tutorium</strong></p>
                        <p>Email: support@tutorium.id</p>
                        <p>WhatsApp Business: +628123456789 (Surabaya, Indonesia)</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                <button id="modal-close-btn" class="bg-primary text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-primary-hover transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const modalKebijakan = document.getElementById('modal-kebijakan');
        const openModal = () => modalKebijakan.classList.remove('hidden');
        const closeModal = () => modalKebijakan.classList.add('hidden');

        document.querySelectorAll('[data-modal="kebijakan-privasi"]').forEach(el => el.addEventListener('click', e => { e.preventDefault(); openModal(); }));
        document.getElementById('modal-close').addEventListener('click', closeModal);
        document.getElementById('modal-close-btn').addEventListener('click', closeModal);
        document.getElementById('modal-backdrop').addEventListener('click', closeModal);
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
    </script>

</body>
</html>
