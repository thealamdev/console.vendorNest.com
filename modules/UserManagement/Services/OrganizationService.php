<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Organization\CheckOrgContextAction;
use Modules\UserManagement\Actions\Organization\ListOrganizationAction;
use Modules\UserManagement\Actions\Organization\StoreOrganizationAction;
use Modules\UserManagement\DTOs\Organization\CheckOrgContextData;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;

class OrganizationService
{
    public function __construct(
        public ListOrganizationAction $listOrganizationAction,
        public CheckOrgContextAction $checkOrgContextAction,
        public StoreOrganizationAction $storeOrganizationAction

    ) {}

    public function get()
    {
        return $this->listOrganizationAction->execute();
    }

    public function checkOrgContext(CheckOrgContextData $data): bool
    {
        return $this->checkOrgContextAction->execute($data);
    }

    /**
     * Execute the organization store action.
     * @param StoreOrganizationData $data
     * @return Organization
     */
    public function store(StoreOrganizationData $data): Organization
    {
        return $this->storeOrganizationAction->execute($data);
    }
}
