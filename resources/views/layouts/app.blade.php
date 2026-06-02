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
                        primary: '#3B82F6',         /* Biru Utama */
                        'primary-hover': '#2563EB', /* Biru Gelap pas di-hover */
                        secondary: '#DBEAFE',       /* Biru Pastel buat border/aksen */
                        surface: '#EFF6FF',         /* Biru Sangat Muda buat background card */
                        dark: '#0F172A',            /* Slate 900 untuk teks heading */
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

</body>
</html>
