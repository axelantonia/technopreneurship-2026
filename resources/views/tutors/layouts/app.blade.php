<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tutor — Tutorium</title>

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
                        primary:        '#4D81EE',
                        'primary-hover':'#3B5B8A',
                        secondary:      '#DBEAFE',
                        surface:        '#EFF6FF',
                        dark:           '#283044',
                        lightgray:      '#F8FAFC',
                        gold:           '#F59E0B',
                        'gold-light':   '#FEF3C7',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Custom class tokens */
        .text-primary-custom  { color: #4D81EE; }
        .btn-primary-custom   { background: #4D81EE; color: #fff; }
        .btn-primary-custom:hover { background: #3B5B8A; }

        /* PRO badge shimmer */
        .pro-badge {
            background: linear-gradient(135deg, #F59E0B, #FBBF24, #D97706);
            animation: shimmer 2.5s ease-in-out infinite alternate;
        }
        @keyframes shimmer {
            from { filter: brightness(1); }
            to   { filter: brightness(1.15); }
        }
    </style>
    @stack('head')
</head>
<body class="flex flex-col min-h-screen bg-lightgray text-gray-600 antialiased font-sans">

    @include('tutors.layouts.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="border-t border-secondary bg-white py-5 mt-10">
        <p class="text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Tutorium Surabaya &mdash; Dashboard Tutor
        </p>
    </footer>

</body>
</html>
