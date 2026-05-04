<?php

namespace Modules\UserManagement\Actions\Organization;

use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Repositories\OrganizationRepository;

class ListOrganizationAction
{
    public function __construct(
        public OrganizationRepository $repo
    ) {}

    /**
     * Execute get organizer repo
     * @return Organization|\stdClass|null
     */
    public function execute(): Organization|\stdClass|null
    {
        return $this->repo->get();
    }
}
