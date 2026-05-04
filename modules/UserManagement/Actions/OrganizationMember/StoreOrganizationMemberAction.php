<?php

namespace Modules\UserManagement\Actions\OrganizationMember;

use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\Repositories\OrganizationMemberRepository;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;

class StoreOrganizationMemberAction
{
    public function __construct(
        public OrganizationMemberRepository $organizationMemberRepository,
    ) {}

    /**
     * Store process through repo.
     * @param StoreOrganizationMemberData $data
     * @return OrganizationMember
     */
    public function execute(StoreOrganizationMemberData $data): OrganizationMember
    {
        return $this->organizationMemberRepository->store($data);
    }
}
