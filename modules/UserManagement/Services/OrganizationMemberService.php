<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\OrganizationMember\ListOrganizationMemberRolesAction;
use Modules\UserManagement\Actions\OrganizationMember\ListOrganizationMembersAction;
use Modules\UserManagement\Actions\OrganizationMember\ListOrganizationMembershipsAction;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Actions\OrganizationMember\StoreOrganizationMemberAction;

class OrganizationMemberService
{
    public function __construct(
        public ListOrganizationMemberRolesAction $listOrganizationMemberRolesAction,
        public ListOrganizationMembersAction $listOrganizationMembersAction,
        public ListOrganizationMembershipsAction $listOrganizationMembershipsAction,
        public StoreOrganizationMemberAction $storeOrganizationMemberAction,
    ) {}

    public function roles():array
    {
        return $this->listOrganizationMemberRolesAction->execute();
    }

    /**
     * Execute the organization members list action
     * @return array
     */
    public function members(): array
    {
        return $this->listOrganizationMembersAction->execute();
    }

    /**
     * Execute the organization memberships with list action.
     * @return array
     */
    public function memberships(): array
    {
        return $this->listOrganizationMembershipsAction->execute();
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
