<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function create(
        int $userId,
        string $type,
        string $title,
        string $description,
        ?string $url = null
    ): Notification {

        return Notification::create([
            'user_id'     => $userId,
            'type'        => $type,
            'title'       => $title,
            'description' => $description,
            'url'         => $url,
            'is_read'     => false,
            'read_at'     => null,
        ]);
    }

    
}
