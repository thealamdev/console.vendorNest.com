<?php

namespace Modules\UserManagement\Actions\Organization;

use Modules\UserManagement\DTOs\Organization\CheckOrgContextData;
use Modules\UserManagement\Repositories\OrganizationRepository;

class CheckOrgContextAction
{
    public function __construct(
        public OrganizationRepository $repo
    ) {}

    /**
     * Store process through repo.
     * @param CheckOrgContextData $data
     * @return bool
     */
    public function execute(CheckOrgContextData $data): bool
    {
        return $this->repo->checkOrgContext($data);
    }
}
