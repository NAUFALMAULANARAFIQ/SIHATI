@php
    $user = auth()->user();
    $isAdmin = $user?->role === 'admin';

    // ─── Dummy notifications ───────────────────────────────────────────
    // These simulate data that would later come from a controller.
    // Remove this block and use $notifications / $unreadNotificationCount
    // once the backend is ready.

    $dummyNotifications = $isAdmin ? [
        [
            'id'          => 1,
            'type'        => 'new',
            'title'       => 'Aduan Baru Masuk',
            'description' => 'Budi Santoso mengajukan aduan baru: "Server Sering Mati" di Bidang Infrastruktur.',
            'time'        => '5 menit lalu',
            'unread'      => true,
        ],
        [
            'id'          => 2,
            'type'        => 'priority',
            'title'       => 'Aduan Prioritas Tinggi',
            'description' => 'Aduan "Jaringan Putus Total" mendapat prioritas tinggi dan perlu segera ditangani.',
            'time'        => '15 menit lalu',
            'unread'      => true,
        ],
        [
            'id'          => 3,
            'type'        => 'comment',
            'title'       => 'Komentar Baru dari Pegawai',
            'description' => 'Siti Nurhaliza menambahkan komentar pada aduan #042: "Mohon segera ditindaklanjuti."',
            'time'        => '1 jam lalu',
            'unread'      => true,
        ],
        [
            'id'          => 4,
            'type'        => 'followup',
            'title'       => 'Aduan Perlu Ditindaklanjuti',
            'description' => 'Aduan "Printer Rusak" sudah 3 hari belum mendapat tindak lanjut dari petugas.',
            'time'        => '3 jam lalu',
            'unread'      => false,
        ],
        [
            'id'          => 5,
            'type'        => 'report',
            'title'       => 'Laporan Bulanan Tersedia',
            'description' => 'Laporan aduan bulan Juni 2026 telah siap untuk diunduh.',
            'time'        => 'Kemarin',
            'unread'      => false,
        ],
    ] : [
        [
            'id'          => 1,
            'type'        => 'status',
            'title'       => 'Status Aduan Diperbarui',
            'description' => 'Aduan "Printer Rusak" telah diterima dan sedang dalam proses pengecekan oleh petugas.',
            'time'        => '10 menit lalu',
            'unread'      => true,
        ],
        [
            'id'          => 2,
            'type'        => 'reply',
            'title'       => 'Tanggapan dari Petugas',
            'description' => 'Petugas menambahkan tanggapan pada aduan "Email Error": "Kami sedang memperbaiki, harap tunggu."',
            'time'        => '30 menit lalu',
            'unread'      => true,
        ],
        [
            'id'          => 3,
            'type'        => 'completed',
            'title'       => 'Aduan Selesai Diproses',
            'description' => 'Aduan "Aplikasi Tidak Bisa Dibuka" telah selesai diproses oleh petugas.',
            'time'        => '2 jam lalu',
            'unread'      => true,
        ],
        [
            'id'          => 4,
            'type'        => 'revision',
            'title'       => 'Informasi Tambahan Diperlukan',
            'description' => 'Aduan "Data Tidak Muncul" membutuhkan informasi tambahan dari Anda. Silakan lengkapi data.',
            'time'        => '5 jam lalu',
            'unread'      => false,
        ],
    ];

    // Use $notifications from controller if available, otherwise fallback to dummy
    $notifications = $notifications ?? $dummyNotifications;

    // Use $unreadNotificationCount from controller if available, otherwise calculate from dummy
    $unreadCount = $unreadNotificationCount ?? collect($notifications)->where('unread', true)->count();

    // ─── Icon mapping ──────────────────────────────────────────────────
    $iconMap = [
        'new'       => ['bg' => 'bg-sihati-sky',       'color' => 'text-blue',       'path' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        'priority'  => ['bg' => 'bg-sihati-peach',     'color' => 'text-sihati-orange', 'path' => 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z'],
        'comment'   => ['bg' => 'bg-sihati-lavender',  'color' => 'text-sihati-primary','path' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
        'followup'  => ['bg' => 'bg-sihati-rose',      'color' => 'text-sihati-error', 'path' => 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'],
        'report'    => ['bg' => 'bg-sihati-mint',      'color' => 'text-sihati-success','path' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        'status'    => ['bg' => 'bg-sihati-sky',       'color' => 'text-blue',       'path' => 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182'],
        'reply'     => ['bg' => 'bg-sihati-lavender',  'color' => 'text-sihati-primary','path' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z'],
        'completed' => ['bg' => 'bg-sihati-mint',      'color' => 'text-sihati-success','path' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        'revision'  => ['bg' => 'bg-sihati-yellow',    'color' => 'text-sihati-warning','path' => 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z'],
    ];
@endphp

<div class="relative" id="notificationContainer">
    {{-- ─────── Bell Button ─────── --}}
    <button id="notificationBell"
        type="button"
        onclick="toggleNotificationDropdown(event)"
        class="relative flex h-9 w-9 items-center justify-center rounded-md text-sihati-slate transition hover:bg-sihati-surface focus:outline-none focus-visible:ring-2 focus-visible:ring-sihati-primary focus-visible:ring-offset-1"
        aria-label="Notifikasi"
        aria-haspopup="true"
        aria-expanded="false">
        {{-- Bell icon --}}
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
        </svg>

        {{-- Unread badge --}}
        @if($unreadCount > 0)
            <span id="notificationBadge"
                class="absolute -right-0.5 -top-0.5 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-sihati-error px-1 text-[10px] font-bold leading-none text-white shadow-sm">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- ─────── Dropdown Panel ─────── --}}
    <div id="notificationDropdown"
        role="menu"
        aria-label="Notifikasi"
        class="fixed sm:absolute left-1/2 sm:left-auto -translate-x-1/2 sm:translate-x-0 sm:right-0 top-16 sm:top-full sm:mt-2 z-[100] hidden w-[calc(100vw-2rem)] max-w-sm origin-top-right animate-scale-in rounded-xl border border-sihati-hairline bg-sihati-canvas shadow-modal sm:w-96">

        {{-- ── Header ── --}}
        <div class="border-b border-sihati-hairline px-4 py-3">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-sihati-ink">Notifikasi</h3>
                @if($unreadCount > 0)
                    <button id="markAllReadBtn"
                        onclick="markAllNotificationsRead()"
                        class="text-xs font-medium text-sihati-link transition hover:text-sihati-link-pressed focus:outline-none focus-visible:ring-2 focus-visible:ring-sihati-primary rounded-sm">
                        Tandai dibaca
                    </button>
                @endif
            </div>
            <p class="mt-0.5 text-xs text-sihati-steel">
                {{ $isAdmin ? 'Informasi aduan yang perlu ditindaklanjuti' : 'Update status aduan Anda' }}
            </p>
        </div>

        {{-- ── Notification List ── --}}
        <div class="max-h-[70vh] overflow-y-auto overscroll-contain sm:max-h-[28rem]">
            @forelse($notifications as $notif)
                @php
                    $icon = $iconMap[$notif['type']] ?? $iconMap['new'];
                    $isUnread = $notif['unread'] ?? false;
                @endphp
                <a href="#"
                    role="menuitem"
                    class="group flex items-start gap-3 px-4 py-3 text-left transition
                        {{ $isUnread ? 'bg-sihati-surface' : 'hover:bg-sihati-surface/50' }}
                        hover:bg-sihati-surface"
                    onclick="event.preventDefault(); {{ $isUnread ? "markNotificationRead(this, {$notif['id']})" : '' }}">
                    {{-- Icon --}}
                    <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full {{ $icon['bg'] }} {{ $icon['color'] }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="{{ $icon['path'] }}"/>
                        </svg>
                    </span>

                    {{-- Content --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-medium text-sihati-ink {{ $isUnread ? '' : '' }}">
                                {{ $notif['title'] }}
                            </p>
                            @if($isUnread)
                                <span class="mt-1.5 h-2 w-2 flex-shrink-0 rounded-full bg-sihati-primary" aria-label="Belum dibaca"></span>
                            @endif
                        </div>
                        <p class="mt-0.5 text-xs text-sihati-slate line-clamp-2 leading-relaxed">
                            {{ $notif['description'] }}
                        </p>
                        <p class="mt-1 text-[11px] text-sihati-steel">
                            {{ $notif['time'] }}
                        </p>
                    </div>
                </a>
            @empty
                {{-- ── Empty State ── --}}
                <div class="flex flex-col items-center justify-center px-6 py-12 text-center">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-sihati-gray">
                        <svg class="h-6 w-6 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-medium text-sihati-ink">Belum ada notifikasi</p>
                    <p class="mt-1 text-xs text-sihati-steel">
                        {{ $isAdmin ? 'Belum ada aktivitas aduan terbaru.' : 'Tidak ada update status aduan saat ini.' }}
                    </p>
                </div>
            @endforelse
        </div>

        {{-- ── Footer ── --}}
        @if(count($notifications) > 0)
            <div class="border-t border-sihati-hairline px-4 py-2.5">
                <a href="#"
                    class="block text-center text-sm font-medium text-sihati-link transition hover:text-sihati-link-pressed"
                    onclick="event.preventDefault(); closeNotificationDropdown();">
                    Lihat semua notifikasi
                </a>
            </div>
        @endif
    </div>
</div>

{{-- ─────── JavaScript ─────── --}}
@push('scripts')
<script>
    /**
     * Toggle the notification dropdown visibility.
     */
    function toggleNotificationDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('notificationDropdown');
        const bell = document.getElementById('notificationBell');
        const isHidden = dropdown.classList.contains('hidden');

        // Close any other open dropdowns (e.g. user menu)
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdown && !userDropdown.classList.contains('hidden')) {
            userDropdown.classList.add('hidden');
        }

        if (isHidden) {
            dropdown.classList.remove('hidden');
            bell.setAttribute('aria-expanded', 'true');
        } else {
            dropdown.classList.add('hidden');
            bell.setAttribute('aria-expanded', 'false');
        }
    }

    /**
     * Close the notification dropdown.
     */
    function closeNotificationDropdown() {
        const dropdown = document.getElementById('notificationDropdown');
        const bell = document.getElementById('notificationBell');
        dropdown.classList.add('hidden');
        bell.setAttribute('aria-expanded', 'false');
    }

    /**
     * Mark a single notification as read (frontend only).
     * Hides the blue dot and removes the highlighted background.
     */
    function markNotificationRead(el, id) {
        // Remove unread background
        el.classList.remove('bg-sihati-surface');
        // Remove the unread dot
        const dot = el.querySelector('span.rounded-full.bg-sihati-primary');
        if (dot) dot.remove();
        // Update badge count
        const badge = document.getElementById('notificationBadge');
        if (badge) {
            const current = parseInt(badge.textContent);
            if (current > 1) {
                badge.textContent = current - 1;
            } else {
                badge.remove();
                document.getElementById('markAllReadBtn')?.remove();
            }
        }
    }

    /**
     * Mark all notifications as read (frontend only).
     * Hides the badge and resets all unread indicators.
     */
    function markAllNotificationsRead() {
        // Remove all unread dots and backgrounds
        document.querySelectorAll('#notificationDropdown [role="menuitem"]').forEach(function (item) {
            item.classList.remove('bg-sihati-surface');
            const dot = item.querySelector('span.rounded-full.bg-sihati-primary');
            if (dot) dot.remove();
        });
        // Remove badge
        const badge = document.getElementById('notificationBadge');
        if (badge) badge.remove();
        // Hide "Tandai dibaca" button
        const markBtn = document.getElementById('markAllReadBtn');
        if (markBtn) markBtn.remove();
    }

    /**
     * Close dropdown when clicking outside.
     */
    document.addEventListener('click', function (e) {
        const container = document.getElementById('notificationContainer');
        const dropdown = document.getElementById('notificationDropdown');
        if (!container || !dropdown) return;

        // If click is outside the notification container, close dropdown
        if (!container.contains(e.target)) {
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                document.getElementById('notificationBell')?.setAttribute('aria-expanded', 'false');
            }
        }
    });

    /**
     * Close dropdown on Escape key.
     */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const dropdown = document.getElementById('notificationDropdown');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                document.getElementById('notificationBell')?.setAttribute('aria-expanded', 'false');
            }
        }
    });
</script>
@endpush
