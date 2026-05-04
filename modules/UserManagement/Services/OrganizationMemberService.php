<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Actions\OrganizationMember\StoreOrganizationMemberAction;

class OrganizationMemberService
{
    public function __construct(
        public StoreOrganizationMemberAction $storeOrganizationMemberAction,
    ) {}


    /**
     * Execute the organization store action.
     * @param StoreOrganizationMemberData $data
     * @return OrganizationMember
     */
    public function store(StoreOrganizationMemberData $data): OrganizationMember
    {
        return $this->storeOrganizationMemberAction->execute($data);
    }
}
