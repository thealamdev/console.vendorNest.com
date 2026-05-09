<?php

namespace Modules\UserManagement\Interfaces;

use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;

interface OrganizationRepositoryInterface
{
    public function get(): array|null;
    public function store(StoreOrganizationData $data): Organization;
}
