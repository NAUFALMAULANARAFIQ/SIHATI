<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $notifications = $user->appNotifications()
            ->latest()
            ->take(20)
            ->get();

        return response()->json($notifications);
    }

    public function markRead(Notification $notification): JsonResponse
    {
        abort_if(
            $notification->user_id !== Auth::id(),
            403
        );

        $notification->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function markAllRead(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->appNotifications()
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function showAll(): View
    {
        $allNotifications = \App\Models\Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notifications.index', compact('allNotifications'));
    }

    public function unreadCount(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $count = $user->appNotifications()
            ->where('is_read', false)
            ->count();

        return response()->json([
            'count' => $count,
        ]);
    }

    public function destroyAll(): \Illuminate\Http\JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->notifications()
            ->where('is_read', true)
            ->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
