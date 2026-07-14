@php
    $user = auth()->user();
    $isAdmin = $user?->role === 'admin';

    $notifications = $notifications ?? collect();
    $unreadCount = $unreadNotificationCount ?? 0;

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
        <div id="notificationList" class="max-h-[70vh] overflow-y-auto overscroll-contain sm:max-h-[28rem]">
            @forelse($notifications as $notif)
                @php
                    $icon = $iconMap[$notif['type']] ?? $iconMap['new'];
                    $isUnread = !$notif->is_read;
                @endphp
                <a href="{{ $notif->url }}"
                    role="menuitem"
                    class="group flex items-start gap-3 px-4 py-3 text-left transition
                        {{ $isUnread ? 'bg-sihati-surface' : 'hover:bg-sihati-surface/50' }}
                        hover:bg-sihati-surface"
                    onclick="markNotificationRead(this, {{ $notif->id }}, '{{ $notif->url }}'); return false;">
                    <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full {{ $icon['bg'] }} {{ $icon['color'] }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="{{ $icon['path'] }}"/>
                        </svg>
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-medium text-sihati-ink">{{ $notif->title }}</p>
                            @if($isUnread)
                                <span class="mt-1.5 h-2 w-2 flex-shrink-0 rounded-full bg-sihati-primary" aria-label="Belum dibaca"></span>
                            @endif
                        </div>
                        <p class="mt-0.5 text-xs text-sihati-slate line-clamp-2 leading-relaxed">{{ $notif->description }}</p>
                        <p class="mt-1 text-[11px] text-sihati-steel">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                </a>
            @empty
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
                <a href="{{ route('notifications.all') }}"
                    class="block text-center text-sm font-medium text-sihati-link transition hover:text-sihati-link-pressed">
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
    async function markNotificationRead(el,id,url){

        const response = await fetch(`/notifications/${id}/read`,{

            method:'POST',

            headers:{
                'X-CSRF-TOKEN':
                document.querySelector('meta[name="csrf-token"]').content,

                'Accept':'application/json'
            }

        });

        if(response.ok){

            window.location.replace(url);

        }

    }
    /**
     * Mark all notifications as read (frontend only).
     * Hides the badge and resets all unread indicators.
     */
    async function markAllNotificationsRead() {

        await fetch('/notifications/read-all',{

            method:'POST',

            headers:{
                'X-CSRF-TOKEN':
                    document.querySelector('meta[name="csrf-token"]').content,
                'Accept':'application/json'
            }

        });

        document.querySelectorAll(
            '#notificationDropdown [role="menuitem"]'
        ).forEach(function(item){

            item.classList.remove('bg-sihati-surface');

            const dot=item.querySelector(
                'span.rounded-full.bg-sihati-primary'
            );

            if(dot) dot.remove();

        });

        document.getElementById('notificationBadge')?.remove();
        document.getElementById('markAllReadBtn')?.remove();
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

    /**
     * ─── Icon map (sama dengan PHP $iconMap) ───
     */
    var iconMap = {
        'new':       { bg: 'bg-sihati-sky',       color: 'text-blue',       path: 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
        'priority':  { bg: 'bg-sihati-peach',     color: 'text-sihati-orange', path: 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z' },
        'comment':   { bg: 'bg-sihati-lavender',  color: 'text-sihati-primary', path: 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z' },
        'status':    { bg: 'bg-sihati-sky',       color: 'text-blue',       path: 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182' },
        'completed': { bg: 'bg-sihati-mint',      color: 'text-sihati-success', path: 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
    };

    function timeAgo(dateStr) {
        var diff = Math.floor((Date.now() - new Date(dateStr).getTime()) / 1000);
        if (diff < 60) return 'baru saja';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return Math.floor(diff / 86400) + ' hari lalu';
    }

    /**
     * ─── Polling: update notifikasi setiap 15 detik ───
     */
    async function pollNotifications() {
        try {
            var res = await fetch('/notifications', {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) return;
            var list = await res.json();
            var unread = list.filter(function(n) { return !n.is_read; }).length;

            // Update badge
            var badge = document.getElementById('notificationBadge');
            var bell = document.getElementById('notificationBell');
            if (unread > 0) {
                if (badge) {
                    badge.textContent = unread > 9 ? '9+' : unread;
                } else {
                    var span = document.createElement('span');
                    span.id = 'notificationBadge';
                    span.className = 'absolute -right-0.5 -top-0.5 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-sihati-error px-1 text-[10px] font-bold leading-none text-white shadow-sm';
                    span.textContent = unread > 9 ? '9+' : unread;
                    bell?.appendChild(span);
                }
            } else {
                if (badge) badge.remove();
            }

            // Rebuild notification list
            var container = document.getElementById('notificationList');
            var emptyHtml =
                '<div class="flex flex-col items-center justify-center px-6 py-12 text-center">' +
                    '<div class="flex h-12 w-12 items-center justify-center rounded-full bg-sihati-gray">' +
                        '<svg class="h-6 w-6 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>' +
                    '</div>' +
                    '<p class="mt-3 text-sm font-medium text-sihati-ink">Belum ada notifikasi</p>' +
                    '<p class="mt-1 text-xs text-sihati-steel">Tidak ada notifikasi baru.</p>' +
                '</div>';

            if (!container) return;

            if (list.length === 0) {
                container.innerHTML = emptyHtml;
                return;
            }

            var html = '';
            for (var i = 0; i < list.length; i++) {
                var n = list[i];
                var icon = iconMap[n.type] || iconMap['new'];
                var isUnread = !n.is_read;
                var createdAt = n.created_at ? timeAgo(n.created_at) : '';

                html +=
                    '<a href="' + n.url + '" role="menuitem"' +
                    ' class="group flex items-start gap-3 px-4 py-3 text-left transition ' +
                    (isUnread ? 'bg-sihati-surface ' : '') +
                    'hover:bg-sihati-surface"' +
                    ' onclick="markNotificationRead(this, ' + n.id + ', \'' + n.url.replace(/'/g, "\\'") + '\'); return false;">' +
                        '<span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ' + icon.bg + ' ' + icon.color + '">' +
                            '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">' +
                                '<path d="' + icon.path + '"/>' +
                            '</svg>' +
                        '</span>' +
                        '<div class="min-w-0 flex-1">' +
                            '<div class="flex items-start justify-between gap-2">' +
                                '<p class="text-sm font-medium text-sihati-ink">' + escapeHtml(n.title) + '</p>' +
                                (isUnread ? '<span class="mt-1.5 h-2 w-2 flex-shrink-0 rounded-full bg-sihati-primary" aria-label="Belum dibaca"></span>' : '') +
                            '</div>' +
                            '<p class="mt-0.5 text-xs text-sihati-slate line-clamp-2 leading-relaxed">' + escapeHtml(n.description || '') + '</p>' +
                            '<p class="mt-1 text-[11px] text-sihati-steel">' + createdAt + '</p>' +
                        '</div>' +
                    '</a>';
            }

            container.innerHTML = html;

            // Update mark all read button
            var markAllBtn = document.getElementById('markAllReadBtn');
            if (unread > 0) {
                if (!markAllBtn) {
                    var header = document.querySelector('#notificationDropdown .border-b .flex.items-center.justify-between');
                    if (header) {
                        var btn = document.createElement('button');
                        btn.id = 'markAllReadBtn';
                        btn.onclick = markAllNotificationsRead;
                        btn.className = 'text-xs font-medium text-sihati-link transition hover:text-sihati-link-pressed focus:outline-none focus-visible:ring-2 focus-visible:ring-sihati-primary rounded-sm';
                        btn.textContent = 'Tandai dibaca';
                        header.appendChild(btn);
                    }
                }
            } else {
                if (markAllBtn) markAllBtn.remove();
            }
        } catch(e) {}
    }

    function escapeHtml(text) {
        if (!text) return '';
        var d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }

    setInterval(pollNotifications, 10000);
</script>
@endpush
