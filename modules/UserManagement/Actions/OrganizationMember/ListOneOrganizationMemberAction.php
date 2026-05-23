<?php

namespace Modules\UserManagement\Actions\OrganizationMember;

use Modules\UserManagement\Repositories\OrganizationMemberRepository;

readonly class ListOneOrganizationMemberAction
{
    public function __construct(
        public OrganizationMemberRepository $repo
    ) {}

    public function execute(string $id): array
    {
        return $this->repo->show($id);
    }
}
