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

<body class="m-0 min-h-dvh bg-sihati-surface text-sihati-ink font-notion antialiased">
    <div class="flex h-dvh overflow-hidden">
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-[45] w-72 -translate-x-full overflow-hidden border-r border-white/10 bg-sihati-navy transition-transform duration-300 lg:w-16 lg:translate-x-0 lg:transition-all"
            style="box-shadow: 4px 0 12px rgba(0,0,0,0.15);">
            @include('partials.sidebar')
        </aside>

        <div id="sidebar-overlay"
            class="fixed inset-0 z-[44] hidden bg-black/50 lg:hidden"
            onclick="closeSidebar()">
        </div>

        <div id="content-area"
            class="flex h-dvh min-w-0 flex-1 flex-col overflow-hidden transition-all duration-300 lg:ml-16">
            @include('partials.topbar')

            <main class="min-h-0 flex-1 overflow-y-auto px-4 pb-6 md:px-6 md:pb-8 lg:px-8">
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

        <div id="mobile-menu-overlay"
            class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden"
            onclick="closeMobileMenu()">
        </div>
    </div>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        .sidebar-label {
            display: none;
        }

        /* Mobile / tablet: sidebar overlay */
        body.sidebar-open #sidebar {
            translate: 0 0 !important;
        }

        body.sidebar-open #sidebar-overlay {
            display: block;
        }

        @media (max-width: 1023px) {
            body.sidebar-open #content-area {
                margin-left: 0 !important;
            }

            body.sidebar-open .sidebar-label {
                display: inline;
            }
        }

        /* Desktop: sidebar collapse / expand */
        @media (min-width: 1024px) {
            #sidebar {
                width: 64px;
                translate: 0 0 !important;
            }

            body.sidebar-expanded #sidebar {
                width: 288px;
            }

            body.sidebar-expanded #content-area {
                margin-left: 288px;
            }

            body.sidebar-expanded .sidebar-label {
                display: inline;
            }
        }
    </style>

    <script>
        function isMobileSidebar() {
            return window.innerWidth < 1024;
        }

        function toggleSidebar() {
            if (isMobileSidebar()) {
                document.body.classList.toggle('sidebar-open');
                return;
            }

            const isExpanded = document.body.classList.contains('sidebar-expanded');

            if (isExpanded) {
                document.body.classList.remove('sidebar-expanded');
                localStorage.setItem('sidebar', 'collapsed');
            } else {
                document.body.classList.add('sidebar-expanded');
                localStorage.setItem('sidebar', 'expanded');
            }
        }

        function closeSidebar() {
            document.body.classList.remove('sidebar-open');

            if (!isMobileSidebar()) {
                document.body.classList.remove('sidebar-expanded');
                localStorage.setItem('sidebar', 'collapsed');
            }
        }

        function closeSidebarOnMobile() {
            if (isMobileSidebar()) {
                document.body.classList.remove('sidebar-open');
            }
        }

        function initSidebar() {
            document.body.classList.remove('sidebar-open');

            if (isMobileSidebar()) {
                document.body.classList.remove('sidebar-expanded');
                return;
            }

            const saved = localStorage.getItem('sidebar');

            if (saved === 'expanded') {
                document.body.classList.add('sidebar-expanded');
            } else {
                document.body.classList.remove('sidebar-expanded');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initSidebar();

            document.querySelectorAll('#sidebar a').forEach(function (link) {
                link.addEventListener('click', function () {
                    closeSidebarOnMobile();
                });
            });
        });

        window.addEventListener('resize', initSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSidebar();
                const modalBackdrops = document.querySelectorAll('[id$="-backdrop"]:not(.hidden)');
                modalBackdrops.forEach(backdrop => {
                    backdrop.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
