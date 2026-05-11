<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\OrganizationMember\ListOrganizationMemberAction;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Actions\OrganizationMember\StoreOrganizationMemberAction;

class OrganizationMemberService
{
    public function __construct(
        public ListOrganizationMemberAction $listOrganizationMemberAction,
        public StoreOrganizationMemberAction $storeOrganizationMemberAction,
    ) {}

    /**
     * Execute the organization member list action.
     * @return array
     */
    public function getAll(): array
    {
        return $this->listOrganizationMemberAction->execute();
    }


    /**
     * Execute the organization member store action.
     * @param StoreOrganizationMemberData $data
     * @return OrganizationMember
     */
    public function store(StoreOrganizationMemberData $data): OrganizationMember
    {
        return $this->storeOrganizationMemberAction->execute($data);
    }
}
