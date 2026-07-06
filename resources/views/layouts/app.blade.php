<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SIHATI BPPKAD' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="m-0 h-full overflow-hidden bg-sihati-surface text-sihati-ink font-notion antialiased">
    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 -translate-x-full overflow-hidden border-r border-white/10 bg-sihati-navy transition-all duration-300 lg:w-16 lg:translate-x-0">
            @include('partials.sidebar')
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden" onclick="toggleSidebar()"></div>

        <div id="content-area" class="flex h-screen min-w-0 flex-1 flex-col overflow-hidden transition-all duration-300 lg:ml-16">
            @include('partials.topbar')

            <main class="h-full min-h-0 flex-1 overflow-y-scroll px-4 pb-6 md:px-6 md:pb-8 lg:px-8">
                <div class="mx-auto max-w-7xl space-y-6">
                    @if(session('success'))
                        <div class="rounded-md border border-sihati-success/30 bg-sihati-mint px-4 py-3 text-sm text-sihati-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="rounded-md border border-sihati-error/30 bg-sihati-rose px-4 py-3 text-sm text-sihati-error">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body.sidebar-expanded #sidebar {
            width: 288px;
            transform: translateX(0);
        }

        body.sidebar-expanded #content-area {
            margin-left: 288px;
        }

        @media (min-width: 1024px) {
            #sidebar {
                width: 64px;
                transform: translateX(0);
            }

            body.sidebar-expanded #sidebar {
                width: 288px;
            }

            body.sidebar-expanded #content-area {
                margin-left: 288px;
            }
        }

        .sidebar-label {
            display: none;
        }

        body.sidebar-expanded .sidebar-label {
            display: inline;
        }
    </style>

    <script>
        function toggleSidebar() {
            var isExpanded = document.body.classList.contains('sidebar-expanded');

            if (isExpanded) {
                document.body.classList.remove('sidebar-expanded');
                localStorage.setItem('sidebar', 'collapsed');
            } else {
                document.body.classList.add('sidebar-expanded');
                localStorage.setItem('sidebar', 'expanded');
            }
        }

        function initSidebar() {
            if (window.innerWidth >= 1024) {
                var saved = localStorage.getItem('sidebar');

                if (saved === 'expanded') {
                    document.body.classList.add('sidebar-expanded');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', initSidebar);

        window.addEventListener('resize', function() {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('sidebar-expanded');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.body.classList.contains('sidebar-expanded')) {
                toggleSidebar();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
