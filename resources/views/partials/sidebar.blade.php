@php
    $role = auth()->user()?->role ?? 'pegawai';
    $isAdmin = $role === 'admin';
    $route = request()->route();

    $hasLogoHorizontal = file_exists(public_path('images/logo-sihati-horizontal.png'));
    $hasLogoIcon = file_exists(public_path('images/logo-sihati-icon.png'));

    function isActive($names) {
        $current = request()->route()?->getName();
        foreach ((array) $names as $n) {
            if ($current === $n || str_starts_with($current ?? '', $n . '.')) return true;
        }
        return false;
    }
@endphp

<div class="flex h-full flex-col bg-sihati-navy">
    <div class="flex flex-1 flex-col overflow-y-auto px-3 py-4">
        <a href="{{ route($isAdmin ? 'admin.dashboard' : 'pegawai.dashboard') }}" class="mb-6 flex items-center justify-center gap-3 px-2">
            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md bg-sihati-primary text-xs font-bold text-white">SI</div>
            <span class="sidebar-label text-lg font-bold text-sihati-on-dark logo-text">SIHATI</span>
        </a>

        <nav class="flex-1 space-y-1">
            <a href="{{ route($isAdmin ? 'admin.dashboard' : 'pegawai.dashboard') }}"
                class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['pegawai.dashboard', 'admin.dashboard']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span class="sidebar-label">Dashboard</span>
            </a>

            @if($isAdmin)
                <a href="{{ route('admin.aduan.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.aduan']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <span class="sidebar-label">Semua Aduan</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.laporan']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/>
                    </svg>
                    <span class="sidebar-label">Laporan</span>
                </a>

                <a href="{{ route('admin.activity-logs.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.activity-logs']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="sidebar-label">Log Aktivitas</span>
                </a>

                <div class="sidebar-label my-3 border-t border-white/10"></div>
                <p class="sidebar-label px-3 pb-1 text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-on-dark-muted">Master</p>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.users']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    </svg>
                    <span class="sidebar-label">Pengguna</span>
                </a>

                <a href="{{ route('admin.bidangs.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.bidangs']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="sidebar-label">Bidang</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['admin.categories']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="sidebar-label">Kategori</span>
                </a>
            @else
                <a href="{{ route('pegawai.aduan.index') }}"
                    class="flex items-center justify-center gap-3 rounded-md px-2 py-2.5 text-sm font-medium transition lg:justify-start lg:px-3 {{ isActive(['pegawai.aduan.index']) ? 'bg-sihati-primary text-white' : 'text-sihati-on-dark/80 hover:bg-white/10 hover:text-sihati-on-dark' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <span class="sidebar-label">Aduan Saya</span>
                </a>


            @endif
        </nav>
    </div>
</div>
