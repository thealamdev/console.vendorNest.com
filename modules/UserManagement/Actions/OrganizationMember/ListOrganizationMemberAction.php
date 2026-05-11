<?php

namespace Modules\UserManagement\Actions\OrganizationMember;

use Modules\UserManagement\Repositories\OrganizationMemberRepository;

class ListOrganizationMemberAction
{
    public function __construct(
        public OrganizationMemberRepository $repo
    ) {}

    public function execute(){
        return $this->repo->getAll();
    }
}
