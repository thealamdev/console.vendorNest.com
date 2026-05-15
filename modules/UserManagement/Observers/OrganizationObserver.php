<?php

namespace Modules\UserManagement\Observers;

use App\Support\Cache\OrganizationCache;
use Modules\UserManagement\Models\Organization;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        OrganizationCache::forget();
    }

    /**
     * Handle the Organization "updated" event.
     */
    public function updated(Organization $organization): void
    {
        OrganizationCache::forget();
    }

    /**
     * Handle the Organization "deleted" event.
     */
    public function deleted(Organization $organization): void
    {
        OrganizationCache::forget();
    }

    /**
     * Handle the Organization "restored" event.
     */
    public function restored(Organization $organization): void
    {
        OrganizationCache::forget();
    }

    /**
     * Handle the Organization "force deleted" event.
     */
    public function forceDeleted(Organization $organization): void
    {
        OrganizationCache::forget();
    }
}
