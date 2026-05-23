<?php

namespace App\Support\Cache;

use Illuminate\Support\Facades\Auth;

class OrganizationCache extends BaseCache
{
    public static function key(): string
    {
        return 'organizations.all' . Auth::id();
    }

    public static function tags(): array
    {
        return ['organizations'];
    }
}