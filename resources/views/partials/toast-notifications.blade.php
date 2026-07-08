@php
    // ── Collect all possible flash messages ──
    $toastMessages = [];

    foreach (['success', 'error', 'warning', 'info'] as $type) {
        $msg = session($type);
        if (!empty($msg)) {
            if (is_array($msg)) {
                foreach ($msg as $m) {
                    if (!empty($m)) {
                        $toastMessages[] = ['type' => $type, 'message' => $m];
                    }
                }
            } else {
                $toastMessages[] = ['type' => $type, 'message' => $msg];
            }
        }
    }

    // ── Icon & color map ──
    $toastConfig = [
        'success' => [
            'border' => 'border-sihati-success/25',
            'bg'     => 'bg-sihati-mint',
            'text'   => 'text-sihati-success',
            'iconBg' => 'bg-sihati-success/15',
            'icon'   => '<svg class="h-5 w-5 text-sihati-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
        'error' => [
            'border' => 'border-sihati-error/25',
            'bg'     => 'bg-sihati-rose',
            'text'   => 'text-sihati-error',
            'iconBg' => 'bg-sihati-error/15',
            'icon'   => '<svg class="h-5 w-5 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>',
        ],
        'warning' => [
            'border' => 'border-sihati-warning/25',
            'bg'     => 'bg-sihati-yellow',
            'text'   => 'text-sihati-warning',
            'iconBg' => 'bg-sihati-warning/15',
            'icon'   => '<svg class="h-5 w-5 text-sihati-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>',
        ],
        'info' => [
            'border' => 'border-blue/25',
            'bg'     => 'bg-sihati-sky',
            'text'   => 'text-blue',
            'iconBg' => 'bg-blue/15',
            'icon'   => '<svg class="h-5 w-5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>',
        ],
    ];
@endphp

@if(count($toastMessages) > 0)
<div id="toastContainer"
     class="pointer-events-none fixed top-0 right-0 z-[80] flex flex-col items-end gap-2 p-4 pt-20 sm:pt-18 md:pt-16">
    @foreach($toastMessages as $toast)
        @php $cfg = $toastConfig[$toast['type']] ?? $toastConfig['info']; @endphp
        <div class="toast-item pointer-events-auto flex w-[calc(100vw-2rem)] max-w-sm items-start gap-3 rounded-xl border {{ $cfg['border'] }} {{ $cfg['bg'] }} p-4 shadow-modal sm:w-96"
             role="alert"
             data-toast-type="{{ $toast['type'] }}">
            {{-- Icon --}}
            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full {{ $cfg['iconBg'] }}">
                {!! $cfg['icon'] !!}
            </span>
            {{-- Message --}}
            <div class="min-w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium {{ $cfg['text'] }}">{{ $toast['message'] }}</p>
            </div>
            {{-- Close --}}
            <button type="button"
                class="toast-close-btn flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md opacity-60 transition hover:opacity-100 {{ $cfg['text'] }}">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    (function() {
        'use strict';

        var container = document.getElementById('toastContainer');
        if (!container) return;

        var MAX_VISIBLE = 2;
        var DURATION    = 4000; // ms before fade starts
        var FADE_MS     = 400;  // ms fade-out duration

        var allToasts    = Array.from(container.querySelectorAll('.toast-item'));
        var visibleQueue = [];  // currently visible toasts
        var pendingQueue = [];  // hidden toasts waiting to show

        /* ─── Init: split into visible / pending ─── */
        allToasts.forEach(function(toast, i) {
            if (i < MAX_VISIBLE) {
                showToast(toast);
            } else {
                toast.style.display = 'none';
                pendingQueue.push(toast);
            }
        });

        /* ─── Show a toast with auto-fade timer ─── */
        function showToast(toast) {
            visibleQueue.push(toast);
            toast.style.display = ''; // reveal

            var timer = setTimeout(function() { fadeOut(toast); }, DURATION);
            toast._toastTimer = timer;

            // Pause timer on hover
            toast.addEventListener('mouseenter', function() {
                clearTimeout(toast._toastTimer);
            });
            toast.addEventListener('mouseleave', function() {
                toast._toastTimer = setTimeout(function() { fadeOut(toast); }, DURATION);
            });
        }

        /* ─── Fade-out animation ─── */
        function fadeOut(toast) {
            toast.style.transition = 'opacity ' + FADE_MS + 'ms ease, transform ' + FADE_MS + 'ms ease';
            toast.style.opacity   = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(function() { removeToast(toast); }, FADE_MS);
        }

        /* ─── Remove toast + show next from queue ─── */
        function removeToast(toast) {
            var idx = visibleQueue.indexOf(toast);
            if (idx !== -1) visibleQueue.splice(idx, 1);
            toast.remove();

            if (pendingQueue.length > 0) {
                var next = pendingQueue.shift();
                showToast(next);
            }
        }

        /* ─── Wire close buttons ─── */
        container.querySelectorAll('.toast-item .toast-close-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                var toast = this.closest('.toast-item');
                if (toast) {
                    clearTimeout(toast._toastTimer);
                    removeToast(toast);
                }
            });
        });

        /* ─── Public API for future dynamic toasts ─── */
        window.showToast = function(type, message) {
            if (!container) return;

            var cfg = {
                success: {
                    border: 'border-sihati-success/25', bg: 'bg-sihati-mint', text: 'text-sihati-success',
                    iconBg: 'bg-sihati-success/15',
                    icon: '<svg class="h-5 w-5 text-sihati-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                },
                error: {
                    border: 'border-sihati-error/25', bg: 'bg-sihati-rose', text: 'text-sihati-error',
                    iconBg: 'bg-sihati-error/15',
                    icon: '<svg class="h-5 w-5 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>'
                },
                warning: {
                    border: 'border-sihati-warning/25', bg: 'bg-sihati-yellow', text: 'text-sihati-warning',
                    iconBg: 'bg-sihati-warning/15',
                    icon: '<svg class="h-5 w-5 text-sihati-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>'
                },
                info: {
                    border: 'border-blue/25', bg: 'bg-sihati-sky', text: 'text-blue',
                    iconBg: 'bg-blue/15',
                    icon: '<svg class="h-5 w-5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>'
                }
            };

            var c = cfg[type] || cfg.info;
            var div = document.createElement('div');
            div.className = 'toast-item pointer-events-auto flex w-[calc(100vw-2rem)] max-w-sm items-start gap-3 rounded-xl border ' + c.border + ' ' + c.bg + ' p-4 shadow-modal sm:w-96';
            div.setAttribute('role', 'alert');
            div.innerHTML =
                '<span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ' + c.iconBg + '">' + c.icon + '</span>' +
                '<div class="min-w-0 flex-1 pt-0.5"><p class="text-sm font-medium ' + c.text + '">' + message.replace(/</g,'&lt;') + '</p></div>' +
                '<button type="button" class="toast-close-btn flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md opacity-60 transition hover:opacity-100 ' + c.text + '">' +
                    '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>' +
                '</button>';

            // Add to queue
            if (visibleQueue.length < MAX_VISIBLE) {
                container.appendChild(div);
                showToast(div);
                // Wire close button
                var btn = div.querySelector('.toast-close-btn');
                if (btn) {
                    btn.addEventListener('click', function() {
                        clearTimeout(div._toastTimer);
                        removeToast(div);
                    });
                }
            } else {
                div.style.display = 'none';
                container.appendChild(div);
                pendingQueue.push(div);
            }
        };
    })();
</script>
@endpush
@endif
