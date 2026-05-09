<?php

namespace Modules\UserManagement\Repositories;

use App\Support\Cache\OrganizationCache;
use App\Support\Traits\HasCache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Interfaces\OrganizationRepositoryInterface;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    use HasCache;
    /**
     * Get specific organizer info
     * @return array|null
     */
    public function get(): array|null
    {
        $data = $this->rememberCache(
            key: OrganizationCache::GET_CACHE_KEY . Auth::id(),
            tags: OrganizationCache::TAGS,
            callback: fn() => Organization::query()
                ->select('id', 'name', 'email', 'phone', 'type', 'owner_user_id')
                ->where('owner_user_id', Auth::id())
                ->with('owner:id,name,email')
                ->first()
                ?->toArray()
        );

        return $data ?? null;
    }


    /**
     * Store the data to database
     * @param StoreOrganizationData $data
     * @return Organization
     */
    public function store(StoreOrganizationData $data): Organization
    {
        return DB::transaction(function () use ($data) {
            $organization = Organization::create([
                'owner_user_id' => Auth::id(),
                'type'          => $data->type,
                'name'          => $data->name,
                'slug'          => Str::slug($data->name) . '_' . uniqid(),
                'email'         => $data->email,
                'phone'         => $data->phone
            ]);

            $member = OrganizationMember::create([
                'organization_id'   => $organization->id,
                'user_id'           => Auth::id(),
                'invited_by'        => Auth::id(),
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => vendorRoleId(),
                'assigned_by'               => Auth::id()
            ]);
            return $organization;
        });
    }
}
