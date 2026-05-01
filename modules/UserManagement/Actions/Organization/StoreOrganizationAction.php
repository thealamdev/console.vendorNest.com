<?php

namespace Modules\UserManagement\Actions\Organization;

use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Repositories\OrganizationRepository;

class StoreOrganizationAction
{
    public function __construct(
        public OrganizationRepository $repo
    ) {}

    /**
     * Store process through repo.
     * @param StoreOrganizationData $data
     * @return Organization
     */
    public function execute(StoreOrganizationData $data): Organization
    {
        return $this->repo->store($data);
    }
}
