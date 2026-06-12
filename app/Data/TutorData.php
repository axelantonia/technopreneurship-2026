<?php

namespace App\Data;

class TutorData
{
    public static function all(): array
    {
        return [
            // ── TEKNIK INFORMATIKA / SISTEM INFORMASI ──────────────────────
            [
                'id'            => 1,
                'name'          => 'Budi Santoso',
                'jurusan'       => 'Informatika',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['Web Development (Laravel)', 'Basis Data MySQL', 'Algoritma Pemrograman', 'Struktur Data'],
                'rating'        => 4.8,
                'reviews'       => 24,
                'price'         => 65000,
                'color'         => '3b82f6',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['09:00', '13:00']],
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['11:00', '15:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['13:00', '19:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['09:00']],
                    ['day' => 'JUM', 'date' => '18', 'slots' => ['10:00', '15:00']],
                ],
                'bio' => 'Mahasiswa tingkat akhir Informatika Petra yang sering dipercaya menjadi asisten dosen untuk mata kuliah pemrograman dasar. Metode pengajaran santai menggunakan perumpamaan sehari-hari agar logika pemrograman lebih mudah dicerna.',
            ],
            [
                'id'            => 2,
                'name'          => 'Amanda Kurnia',
                'jurusan'       => 'Sistem Informasi',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['Basis Data MySQL', 'Pemrograman Web', 'Sistem Informasi Manajemen', 'Jaringan Komputer'],
                'rating'        => 4.7,
                'reviews'       => 18,
                'price'         => 60000,
                'color'         => '10b981',
                'modes'         => ['Online'],
                'availableDays' => ['Senin', 'Rabu', 'Jumat'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['10:00', '14:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['09:00', '13:00']],
                    ['day' => 'JUM', 'date' => '18', 'slots' => ['11:00', '16:00']],
                ],
                'bio' => 'Asisten lab Sistem Informasi yang berpengalaman membantu 50+ mahasiswa melewati mata kuliah wajib. Spesialis Basis Data dan Pemrograman Web dengan pendekatan project-based learning.',
            ],
            [
                'id'            => 3,
                'name'          => 'Samuel Wijaya',
                'jurusan'       => 'Informatika',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Struktur Data', 'Pemrograman Berorientasi Objek', 'Kecerdasan Buatan', 'Mobile Programming'],
                'rating'        => 4.9,
                'reviews'       => 31,
                'price'         => 70000,
                'color'         => 'f59e0b',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Selasa', 'Kamis', 'Sabtu'],
                'jadwal'        => [
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['09:00', '13:00', '17:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['10:00', '14:00']],
                    ['day' => 'SAB', 'date' => '19', 'slots' => ['09:00', '11:00']],
                ],
                'bio' => 'Juara Competitive Programming tingkat regional dengan pengalaman mengajar privat 2 tahun. Sangat piawai membantu mahasiswa memahami Struktur Data dan OOP dari nol hingga mahir.',
            ],
            [
                'id'            => 4,
                'name'          => 'Kevin Hartono',
                'jurusan'       => 'Informatika',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Pemrograman Web', 'Basis Data MySQL', 'Algoritma Pemrograman', 'Cloud Computing'],
                'rating'        => 4.6,
                'reviews'       => 12,
                'price'         => 55000,
                'color'         => '8b5cf6',
                'modes'         => ['Online'],
                'availableDays' => ['Senin', 'Selasa', 'Rabu'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['16:00', '19:00']],
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['16:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['16:00', '19:00']],
                ],
                'bio' => 'Full-stack developer muda yang aktif berkontribusi di open source. Mengajar dengan metode hands-on langsung coding bersama, cocok untuk mahasiswa yang lebih suka praktek daripada teori.',
            ],

            // ── AKUNTANSI / MANAJEMEN ──────────────────────────────────────
            [
                'id'            => 5,
                'name'          => 'Cindy Lestari',
                'jurusan'       => 'Akuntansi',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['Akuntansi Pengantar', 'Akuntansi Keuangan Menengah', 'Auditing', 'Perpajakan'],
                'rating'        => 4.8,
                'reviews'       => 27,
                'price'         => 60000,
                'color'         => 'ec4899',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Senin', 'Rabu', 'Kamis'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['10:00', '13:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['10:00', '14:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['15:00', '18:00']],
                ],
                'bio' => 'Mahasiswa Akuntansi dengan IPK 3.9 yang telah membantu lebih dari 40 teman memahami jurnal dan laporan keuangan. Menjelaskan dengan contoh kasus nyata bisnis sehari-hari.',
            ],
            [
                'id'            => 6,
                'name'          => 'Reza Firmansyah',
                'jurusan'       => 'Manajemen',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Manajemen Keuangan', 'Statistika Bisnis', 'Manajemen Pemasaran', 'Analisis Investasi'],
                'rating'        => 4.7,
                'reviews'       => 19,
                'price'         => 55000,
                'color'         => 'f97316',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Selasa', 'Kamis', 'Jumat'],
                'jadwal'        => [
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['09:00', '13:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['09:00', '13:00']],
                    ['day' => 'JUM', 'date' => '18', 'slots' => ['13:00']],
                ],
                'bio' => 'Mantan ketua UKM Bisnis kampus dengan pengalaman magang di perusahaan finance. Ahli membantu analisis kasus manajemen keuangan dan memecah rumus statistika bisnis yang membingungkan.',
            ],
            [
                'id'            => 7,
                'name'          => 'Felicia Tanoto',
                'jurusan'       => 'Akuntansi',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Akuntansi Pengantar', 'Statistika Bisnis', 'Manajemen Keuangan', 'Pengantar Ekonomi'],
                'rating'        => 4.5,
                'reviews'       => 15,
                'price'         => 50000,
                'color'         => '14b8a6',
                'modes'         => ['Online'],
                'availableDays' => ['Senin', 'Rabu', 'Sabtu'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['14:00', '17:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['14:00']],
                    ['day' => 'SAB', 'date' => '19', 'slots' => ['10:00', '13:00']],
                ],
                'bio' => 'Spesialis Akuntansi Pengantar untuk mahasiswa baru yang masih asing dengan debit-kredit. Pendekatan visual dan tabel membuat konsep akuntansi lebih mudah diingat.',
            ],

            // ── TEKNIK SIPIL / ARSITEKTUR ──────────────────────────────────
            [
                'id'            => 8,
                'name'          => 'Denny Prasetyo',
                'jurusan'       => 'Teknik Sipil',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['Mekanika Bahan', 'Statika Struktur', 'Aplikasi AutoCAD', 'Mekanika Tanah'],
                'rating'        => 4.9,
                'reviews'       => 22,
                'price'         => 70000,
                'color'         => '64748b',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Selasa', 'Kamis', 'Sabtu'],
                'jadwal'        => [
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['13:00', '16:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['13:00', '16:00']],
                    ['day' => 'SAB', 'date' => '19', 'slots' => ['09:00', '11:00', '13:00']],
                ],
                'bio' => 'Asisten dosen Mekanika Bahan yang dikenal sabar menjelaskan diagram gaya geser dan momen lentur. Hafal kisi-kisi soal UTS/UAS dari 3 tahun terakhir.',
            ],
            [
                'id'            => 9,
                'name'          => 'Natasha Indri',
                'jurusan'       => 'Arsitektur',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['Aplikasi AutoCAD', 'Aplikasi SketchUp', 'Desain Arsitektur', 'Utilitas Bangunan'],
                'rating'        => 4.7,
                'reviews'       => 16,
                'price'         => 65000,
                'color'         => 'a855f7',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Senin', 'Rabu', 'Jumat'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['15:00', '18:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['15:00', '18:00']],
                    ['day' => 'JUM', 'date' => '18', 'slots' => ['13:00', '16:00']],
                ],
                'bio' => 'Mahasiswa Arsitektur dengan portofolio juara desain interior kampus. Mengajar AutoCAD dan SketchUp dari dasar hingga rendering, cocok untuk mahasiswa tingkat pertama maupun tingkat akhir.',
            ],

            // ── ILMU KOMUNIKASI / DESAIN ───────────────────────────────────
            [
                'id'            => 10,
                'name'          => 'Jessica Halim',
                'jurusan'       => 'Ilmu Komunikasi',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Teori Komunikasi', 'Produksi Media Digital', 'Public Relations', 'Jurnalistik Dasar'],
                'rating'        => 4.6,
                'reviews'       => 20,
                'price'         => 50000,
                'color'         => 'ef4444',
                'modes'         => ['Online'],
                'availableDays' => ['Senin', 'Selasa', 'Kamis'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['13:00', '16:00']],
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['13:00', '16:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['15:00']],
                ],
                'bio' => 'Content creator aktif dengan 10k+ followers yang membantu teman-teman Ilmu Komunikasi menghadapi UAS teori. Dari Teori Uses & Gratifications sampai bias media, semua bisa dijelaskan dengan mudah.',
            ],
            [
                'id'            => 11,
                'name'          => 'Adrian Setiawan',
                'jurusan'       => 'Desain Komunikasi Visual',
                'kampus'        => 'Universitas Kristen Petra',
                'matkul'        => ['UI/UX Design', 'Adobe Photoshop', 'Adobe Illustrator', 'Motion Graphics'],
                'rating'        => 4.8,
                'reviews'       => 29,
                'price'         => 65000,
                'color'         => '06b6d4',
                'modes'         => ['Online', 'Offline'],
                'availableDays' => ['Senin', 'Rabu', 'Sabtu'],
                'jadwal'        => [
                    ['day' => 'SEN', 'date' => '14', 'slots' => ['10:00', '14:00', '19:00']],
                    ['day' => 'RAB', 'date' => '16', 'slots' => ['10:00', '14:00']],
                    ['day' => 'SAB', 'date' => '19', 'slots' => ['10:00', '13:00', '16:00']],
                ],
                'bio' => 'Freelance designer berpengalaman dengan klien dari berbagai startup Surabaya. Mengajar Photoshop, Illustrator, dan dasar UI/UX Figma dengan pendekatan real-project yang langsung bisa masuk portofolio.',
            ],
            [
                'id'            => 12,
                'name'          => 'Meilani Putri',
                'jurusan'       => 'Desain Komunikasi Visual',
                'kampus'        => 'Universitas Surabaya (UBAYA)',
                'matkul'        => ['Adobe Photoshop', 'UI/UX Design', 'Tipografi', 'Desain Kemasan'],
                'rating'        => 4.5,
                'reviews'       => 11,
                'price'         => 50000,
                'color'         => 'f472b6',
                'modes'         => ['Online'],
                'availableDays' => ['Selasa', 'Kamis', 'Jumat'],
                'jadwal'        => [
                    ['day' => 'SEL', 'date' => '15', 'slots' => ['10:00', '14:00']],
                    ['day' => 'KAM', 'date' => '17', 'slots' => ['10:00', '14:00']],
                    ['day' => 'JUM', 'date' => '18', 'slots' => ['10:00']],
                ],
                'bio' => 'Spesialis Photoshop dan desain grafis dasar untuk mahasiswa DKV semester awal. Sabar dalam membimbing dari instalasi hingga eksekusi tugas desain pertamamu.',
            ],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $tutor) {
            if ($tutor['id'] === $id) return $tutor;
        }
        return null;
    }
}
