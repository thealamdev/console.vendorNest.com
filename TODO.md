### Organization Create Flow
1. Organization create -> organizers table
2. After Create Organization create Organization member.(For vendor owner or platform owner)
 user assign to organizer_members table with roles.
3. Then create Member role

4. Important those should be created at a time.
5. 
```
DB::transaction(function () use ($user, $org) {

    $organization = Organization::create([...]);

    $member = OrganizationMember::create([
        'user_id' => $user->id,
        'organization_id' => $organization->id,
        'invited_by' => $user->id,
    ]);

    MemberRole::create([
        'organization_member_id' => $member->id,
        'role_id' => $vendorOwnerRoleId,
    ]);
});
```