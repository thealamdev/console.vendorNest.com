<?php

namespace Modules\UserManagement\Observers;

use App\Support\Cache\OrganizationCache;
use Illuminate\Support\Facades\Cache;
use Modules\UserManagement\Models\Organization;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        Cache::forget(OrganizationCache::GET_CACHE_KEY);
    }

    /**
     * Handle the Organization "updated" event.
     */
    public function updated(Organization $organization): void
    {
        Cache::forget(OrganizationCache::GET_CACHE_KEY);
    }

    /**
     * Handle the Organization "deleted" event.
     */
    public function deleted(Organization $organization): void
    {
        Cache::forget(OrganizationCache::GET_CACHE_KEY);
    }

    /**
     * Handle the Organization "restored" event.
     */
    public function restored(Organization $organization): void
    {
        Cache::forget(OrganizationCache::GET_CACHE_KEY);
    }

    /**
     * Handle the Organization "force deleted" event.
     */
    public function forceDeleted(Organization $organization): void
    {
        Cache::forget(OrganizationCache::GET_CACHE_KEY);
    }
}
