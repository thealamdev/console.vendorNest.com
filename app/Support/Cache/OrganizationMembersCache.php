<?php

namespace App\Support\Cache;

use Illuminate\Support\Facades\Auth;

class OrganizationMembersCache extends BaseCache
{
    public static function key(): string
    {
        return 'organization_members.all' . Auth::id();
    }

    public static function tags(): array
    {
        return ['organization_members'];
    }
}
