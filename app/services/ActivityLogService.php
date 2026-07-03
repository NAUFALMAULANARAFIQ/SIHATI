<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    public static function log(
        string $action,
        string $module,
        string $description,
        ?string $targetTable = null,
        ?int $targetId = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'target_table' => $targetTable,
            'target_id' => $targetId,
            'old_values' => self::sanitize($oldValues),
            'new_values' => self::sanitize($newValues),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'created_at' => now(),
        ]);
    }

    private static function sanitize(?array $values): ?array
    {
        if (! $values) {
            return null;
        }

        $hiddenKeys = [
            'password',
            'password_confirmation',
            'remember_token',
            'current_password',
            'token',
            'api_token',
        ];

        foreach ($hiddenKeys as $key) {
            if (array_key_exists($key, $values)) {
                $values[$key] = '[FILTERED]';
            }
        }

        return $values;
    }
}
