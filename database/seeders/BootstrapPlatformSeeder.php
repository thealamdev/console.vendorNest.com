<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Enums\OrganizationType;
use Modules\UserManagement\Enums\Role as EnumsRole;
use Modules\UserManagement\Enums\UserType;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\Models\Role;
use Illuminate\Support\Facades\DB;
use Modules\UserManagement\Models\Permission;

class BootstrapPlatformSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            /**
             * User create
             */
            $user = User::create([
                'name'      => 'Shah Alam',
                'email'     => 'shahalam141072@gmail.com',
                'phone'     => '01795678789',
                'password'  => Hash::make('9bV~DvGO&b'),
                'type'      => UserType::PLATFORM->value
            ]);

            /**
             * Organizaion create
             */
            $organization = Organization::create([
                'owner_user_id' => $user->id,
                'type'          => OrganizationType::PLATFORM->value,
                'name'          => 'Tech Today',
                'slug'          => Str::slug('Tech Today') . '_' . uniqid(),
                'email'         => 'techtoday@gmail.com',
                'phone'         => '01735284438'
            ]);

            /**
             * Roles Create
             */
            $superAdminRole = Role::firstOrCreate([
                'name'              => EnumsRole::SUPER_ADMIN->value,
                'organization_id' => $organization->id,
            ], [
                'organization_type' => OrganizationType::PLATFORM->value,
                'slug'              => Str::slug(EnumsRole::SUPER_ADMIN->value),
                'description'       => 'This is Platform owner role(super-admin)',
                'is_system_role'    => true,
                'is_editable'       => false,
                'created_by'        => $user->id
            ]);

            $vendorOwnerRole = Role::firstOrCreate([
                'name' => EnumsRole::VENDOR_OWNER->value,
                'organization_id' => $organization->id,
            ], [
                'organization_type' => OrganizationType::VENDOR->value,
                'slug'              => Str::slug(EnumsRole::VENDOR_OWNER->value),
                'description'       => 'This is Vendor Owner role',
                'is_system_role'    => true,
                'is_editable'       => false,
                'created_by'        => $user->id
            ]);

            $allPermissions = Permission::pluck('id');
            $vendorPermissions = Permission::whereNotIn('module', ['platform', 'user', 'vendor', 'payout'])->pluck('id');

            $superAdminRole->permissions()->sync($allPermissions);
            $vendorOwnerRole->permissions()->sync($vendorPermissions);

            $member = OrganizationMember::create([
                'organization_id'   => $organization->id,
                'user_id'           => $user->id,
                'invited_by'        => $user->id,
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => $superAdminRole->id,
                'assigned_by'               => $user->id
            ]);
        });
    }
}
