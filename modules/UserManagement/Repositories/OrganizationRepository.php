<?php

namespace Modules\UserManagement\Repositories;

use App\Support\Cache\OrganizationCache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Organization\CheckOrgContextData;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Enums\OrganizationType;
use Modules\UserManagement\Interfaces\OrganizationRepositoryInterface;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Enums\Role as EnumsRole;
use Modules\UserManagement\Models\Permission;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    /**
     * Get specific organizer info
     * @return array|null
     */
    public function get(): array|null
    {
        $data = OrganizationCache::remember(
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
     * Check org context
     * @param CheckOrgContextData $data
     * @return bool
     */
    public function checkOrgContext(CheckOrgContextData $data):bool
    {
        $response = OrganizationMember::where('organization_id', $data->organization_id)
            ->where('user_id', Auth::id())->exists();

        return $response;
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


            $vendorOwnerRole = Role::firstOrCreate([
                'name' => EnumsRole::VENDOR_OWNER->value,
                'organization_id' => $organization->id,
            ], [
                'organization_type' => OrganizationType::VENDOR->value,
                'slug'              => Str::slug(EnumsRole::VENDOR_OWNER->value),
                'description'       => 'This is Vendor Owner role',
                'is_system_role'    => false,
                'is_editable'       => false,
                'created_by'        => Auth::id()
            ]);

            $vendorPermissions = Permission::whereNotIn('module', ['platform', 'user', 'vendor', 'payout'])->pluck('id');
            $vendorOwnerRole->permissions()->sync($vendorPermissions);

            $member = OrganizationMember::create([
                'organization_id'   => $organization->id,
                'user_id'           => Auth::id(),
                'invited_by'        => Auth::id(),
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => $vendorOwnerRole->id,
                'assigned_by'               => Auth::id()
            ]);

            return $organization;
        });
    }
}
