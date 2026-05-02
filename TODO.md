### Organization Create Flow
1. Organization create -> organizers table
2. After Create Organization create Organization member.(For vendor owner or platform owner)
 user assign to organizer_members table with roles.
3. Then create Member role

4. Important those should be created at a time.
5. 
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\Permission;

class BootstrapPlatformSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | 1. Create User (Platform Owner)
            |--------------------------------------------------------------------------
            */
            $user = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('password'),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | 2. Create Platform Organization
            |--------------------------------------------------------------------------
            */
            $organization = Organization::firstOrCreate(
                ['type' => 'platform'],
                [
                    'name' => 'Platform',
                    'owner_user_id' => $user->id,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | 3. Create Organization Member
            |--------------------------------------------------------------------------
            */
            $member = OrganizationMember::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'organization_id' => $organization->id,
                ],
                [
                    'invited_by' => $user->id,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | 4. Create Roles
            |--------------------------------------------------------------------------
            */
            $superAdminRole = Role::firstOrCreate([
                'name' => 'Super Admin',
                'organization_id' => $organization->id,
            ], [
                'is_system' => true,
                'created_by' => $user->id,
            ]);

            $vendorOwnerRole = Role::firstOrCreate([
                'name' => 'Vendor Owner',
                'organization_id' => $organization->id,
            ], [
                'is_system' => true,
                'created_by' => $user->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 5. Assign Permissions to Roles
            |--------------------------------------------------------------------------
            */

            // Super Admin → ALL permissions
            $allPermissions = Permission::pluck('id');
            $superAdminRole->permissions()->sync($allPermissions);

            // Vendor Owner → limited permissions
            $vendorPermissions = Permission::whereIn('module', [
                'product',
                'order',
                'category',
            ])->pluck('id');

            $vendorOwnerRole->permissions()->sync($vendorPermissions);

            /*
            |--------------------------------------------------------------------------
            | 6. Assign Role to Member
            |--------------------------------------------------------------------------
            */
            MemberRole::firstOrCreate([
                'organization_member_id' => $member->id,
                'role_id' => $superAdminRole->id,
            ]);

        });
    }
}
```

## Follow the sequence

```
1. User created
2. Organization created
3. Membership created
4. Roles created
5. Permissions attached to roles
6. Role assigned to member
```
### 02 May, 2026

1. Role update
2. Role Delete
3. Permission creates
4. Study how permission work
5. Organizatin, Organization Member & Member role has been done