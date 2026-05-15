<?php

namespace App\Support\Cache;

class OrganizationMembershipsCache extends BaseCache
{
    public static function key(): string
    {
        return 'organization_memberships.all';
    }

    public static function tags(): array
    {
        return ['organization_memberships'];
    }
}
