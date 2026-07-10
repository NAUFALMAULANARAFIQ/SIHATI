<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
{
    View::composer('*', function ($view) {

        if (!Auth::check()) {
            return;
        }

        /** @var User $user */
        $user = Auth::user();

        $notifications = $user->appNotifications()
            ->latest()
            ->take(10)
            ->get();

        $view->with('notifications', $notifications);

        $view->with(
            'unreadNotificationCount',
            $user->appNotifications()
                ->where('is_read', false)
                ->count()
        );
    });
}
}
