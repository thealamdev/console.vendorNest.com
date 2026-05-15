<?php

namespace App\Support\Cache;

use Illuminate\Support\Facades\Auth;

class OrganizationMembershipsCache extends BaseCache
{
    public static function key(): string
    {
        return 'organization_memberships.all'. Auth::id();
    }

    public static function tags(): array
    {
        return ['organization_memberships'];
    }
}
