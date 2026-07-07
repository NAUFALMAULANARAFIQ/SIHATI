@php
    $user = auth()->user();
    $isAdmin = $user?->role === 'admin';
    $userName = $user?->name ?? 'Pengguna';
    $initial = strtoupper(substr($userName, 0, 1));

    $routeName = request()->route()?->getName();
    $pageTitle = match(true) {
        str_starts_with($routeName ?? '', 'pegawai.aduan.') => 'Aduan',
        str_starts_with($routeName ?? '', 'admin.aduan.') => 'Aduan',
        str_starts_with($routeName ?? '', 'admin.laporan.') => 'Laporan',
        str_starts_with($routeName ?? '', 'admin.activity-logs.') => 'Log Aktivitas',
        str_starts_with($routeName ?? '', 'admin.users.') => 'Data Pengguna',
        str_starts_with($routeName ?? '', 'admin.bidangs.') => 'Data Bidang',
        str_starts_with($routeName ?? '', 'admin.categories.') => 'Data Kategori',
        $routeName === 'pegawai.dashboard' || $routeName === 'admin.dashboard' => 'Dashboard',
        $routeName === 'profile.edit' => 'Profil',
        default => 'SIHATI BPPKAD'
    };
@endphp

<header class="sticky top-0 z-30 border-b border-sihati-hairline bg-sihati-canvas">
    <div class="flex h-16 items-center justify-between px-4 md:px-6">
        <div class="flex items-center gap-3 md:gap-4">
            <button onclick="toggleSidebar()"
                class="flex h-9 w-9 items-center justify-center rounded-md text-sihati-slate hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h1 class="text-lg font-semibold text-sihati-ink">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div class="relative flex items-center gap-2">
            <button onclick="toggleUserMenu(event)"
                class="flex items-center gap-2 rounded-md p-1.5 transition hover:bg-sihati-surface">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-medium text-sihati-ink">{{ $userName }}</p>
                    <p class="text-xs text-sihati-steel">{{ $isAdmin ? 'Admin' : 'Pegawai' }}</p>
                </div>
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-sihati-lavender text-xs font-semibold text-sihati-primary-deep">
                    {{ $initial }}
                </div>
                <svg class="hidden h-4 w-4 text-sihati-slate sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="userDropdown" class="absolute right-0 top-full mt-2 hidden w-48 origin-top-right rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-modal">
                <div class="border-b border-sihati-hairline-soft px-4 py-3">
                    <p class="text-sm font-medium text-sihati-ink">{{ $userName }}</p>
                    <p class="text-xs text-sihati-steel">{{ $isAdmin ? 'Admin' : 'Pegawai' }}</p>
                </div>
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-2 text-sm text-sihati-ink transition hover:bg-sihati-surface">
                        <svg class="h-4 w-4 text-sihati-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                </div>
                <div class="border-t border-sihati-hairline-soft py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 px-4 py-2 text-sm text-sihati-error transition hover:bg-sihati-rose">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            function toggleUserMenu(event) {
                event.stopPropagation();
                const dropdown = document.getElementById('userDropdown');
                dropdown.classList.toggle('hidden');
            }
            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('userDropdown');
                if (!e.target.closest('[onclick*="toggleUserMenu"]') && !e.target.closest('#userDropdown')) {
                    dropdown?.classList.add('hidden');
                }
            });
        </script>
        @endpush
    </div>
</header>
