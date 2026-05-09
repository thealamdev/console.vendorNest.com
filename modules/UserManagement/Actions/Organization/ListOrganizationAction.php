<?php

namespace Modules\UserManagement\Actions\Organization;

use Modules\UserManagement\Repositories\OrganizationRepository;

class ListOrganizationAction
{
    public function __construct(
        public OrganizationRepository $repo
    ) {}

    /**
     * Execute get organizer repo
     * @return array|null
     */
    public function execute(): array|null
    {
        return $this->repo->get();
    }
}
