<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Plus Jakarta Sans', var(--font-sans, sans-serif);
            }
            [x-cloak] {
                display: none !important;
            }
            @keyframes pulse-subtle {
                0%, 100% { opacity: 0.3; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.05); }
            }
            .animate-pulse-subtle {
                animation: pulse-subtle 8s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#07090e] text-slate-100 antialiased selection:bg-indigo-500 selection:text-white overflow-x-hidden">
        {{ $slot }}
        @fluxScripts
    </body>
</html>
