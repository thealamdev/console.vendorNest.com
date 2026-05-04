<?php

namespace Modules\UserManagement\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;
use Modules\UserManagement\Models\OrganizationMember;

class OrganizationMemberController
{
    public function store(StoreOrganizationMemberRequest $request)
    {
        Gate::authorize('store', OrganizationMember::class);
        $data = StoreOrganizationMemberData::make($request);
        dd($data);
    }
}
