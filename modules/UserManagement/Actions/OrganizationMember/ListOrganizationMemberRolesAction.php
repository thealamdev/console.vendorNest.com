<?php

namespace Modules\UserManagement\Actions\OrganizationMember;

use Modules\UserManagement\Repositories\OrganizationMemberRepository;

class ListOrganizationMemberRolesAction
{
    public function __construct(
        public OrganizationMemberRepository $repo
    ) {}

    public function execute(){
        return $this->repo->roles();
    }
}
