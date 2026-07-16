<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') - SIHATI BPPKAD</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full bg-sihati-surface font-sans antialiased overflow-x-hidden">
    <div class="min-h-full flex">
        <div class="hidden lg:flex lg:w-1/2 xl:w-[55%] bg-sihati-navy items-center justify-center p-8 xl:p-12 relative overflow-hidden">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-20 -right-20 w-72 h-72 opacity-[0.09]">
                    <svg viewBox="0 0 200 200" fill="#5645D4" class="w-full h-full">
                        <path d="M100 0L200 100L100 200L0 100Z"/>
                    </svg>
                </div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 opacity-[0.1] rotate-45">
                    <svg viewBox="0 0 200 200" fill="#0075DE" class="w-full h-full">
                        <circle cx="100" cy="100" r="80"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10 max-w-lg text-center">
                <div class="mb-6">
                    <img src="{{ asset('images/LogoWhite.svg') }}" alt="SIHATI BPPKAD" class="h-28 mx-auto mb-6">
                    <p class="text-base md:text-lg font-medium text-sihati-on-dark-muted">Sistem Helpdesk Aduan Teknologi Informasi</p>
                </div>
                <p class="text-sm md:text-base leading-relaxed max-w-md mx-auto text-sihati-on-dark-muted">
                    Sistem pengaduan teknologi informasi internal untuk mendukung operasional BPPKAD dengan lebih efisien dan terstruktur.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 xl:w-[45%] flex items-center justify-center p-4 sm:p-6 md:p-8">
            <div class="w-full max-w-md">
                <div class="lg:hidden text-center mb-8">
                    @php $hasLogoHorizontal = file_exists(public_path('images/logo-sihati-horizontal.png')); @endphp
                    @if($hasLogoHorizontal)
                    <img src="{{ asset('images/logo-sihati-horizontal.png') }}" alt="SIHATI BPPKAD" class="h-12 mx-auto mb-3">
                    @else
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-sihati-primary rounded-xl mb-3 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    @endif
                    <h1 class="text-2xl font-bold text-sihati-ink tracking-tight">SIHATI BPPKAD</h1>
                    <p class="text-sihati-steel text-sm">Sistem Helpdesk Aduan Teknologi Informasi</p>
                </div>
                @yield('content')
                <div class="sidebar-label border-t border-white/10 px-5 py-3 text-center text-[15px] text-sihati-on-dark-muted">
                    &copy; 2026 by Magang UIN-Malang
                </div>
            </div>
        </div>

    </div>
    @stack('scripts')
</body>
</html>
