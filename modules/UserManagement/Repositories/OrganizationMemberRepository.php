<?php

namespace Modules\UserManagement\Repositories;

use App\Support\Traits\HasCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\UserResolverService;
use App\Support\Cache\OrganizationMemberCache;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;

class OrganizationMemberRepository
{
    use HasCache;
    public function getAll(): array
    {
        $data = $this->rememberCache(
            key: OrganizationMemberCache::GET_CACHE_KEY . Auth::id(),
            tags: OrganizationMemberCache::TAGS,
            callback: fn() => OrganizationMember::where('user_id', Auth::id())
                ->where('status', true)
                ->select('id', 'user_id', 'organization_id')
                ->with([
                    'organization:id,owner_user_id,type,name,email,phone',
                ])

                ->get()?->toArray()
        );

        return $data;
    }

    /**
     * Store the data to database
     * @param StoreOrganizationMemberData $data
     * @return OrganizationMember
     */
    public function store(StoreOrganizationMemberData $data): OrganizationMember
    {
        return DB::transaction(function () use ($data) {
            $user = UserResolverService::resolve($data);

            $member = OrganizationMember::create([
                'organization_id'   => activeOrganizationId(),
                'user_id'           => $user->id,
                'invited_by'        => Auth::id(),
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => $data->role_id,
                'assigned_by'               => Auth::id()
            ]);

            return $member;
        });
    }
}
