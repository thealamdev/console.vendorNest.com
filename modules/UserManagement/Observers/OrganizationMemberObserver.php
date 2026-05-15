<?php

namespace Modules\UserManagement\Observers;

use App\Support\Cache\OrganizationMembersCache;
use Modules\UserManagement\Models\OrganizationMember;

class OrganizationMemberObserver
{
    /**
     * Handle the OrganizationMember "created" event.
     */
    public function created(OrganizationMember $organizationMember): void
    {
        OrganizationMembersCache::forget();
    }

    /**
     * Handle the OrganizationMember "updated" event.
     */
    public function updated(OrganizationMember $organizationMember): void
    {
        //
    }

    /**
     * Handle the OrganizationMember "deleted" event.
     */
    public function deleted(OrganizationMember $organizationMember): void
    {
        //
    }

    /**
     * Handle the OrganizationMember "restored" event.
     */
    public function restored(OrganizationMember $organizationMember): void
    {
        //
    }

    /**
     * Handle the OrganizationMember "force deleted" event.
     */
    public function forceDeleted(OrganizationMember $organizationMember): void
    {
        //
    }
}
