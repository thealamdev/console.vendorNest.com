<?php

use Illuminate\Support\Facades\Broadcast;
use Modules\AuthManagement\Models\User;

Broadcast::channel('user.logout.{userId}', function (User $user, string $userId): bool {
    \Log::info('Channel auth attempt', [
        'user_id' => $user->id,
        'requested_id' => $userId,
        'match' => (string) $user->id === $userId
    ]);
    return (string) $user->id === $userId;
});
