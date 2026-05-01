<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Organization\StoreOrganizationAction;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;

class OrganizationService
{
    public function __construct(
        public StoreOrganizationAction $storeOrganizationAction
    ) {}

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
