<?php

namespace Modules\UserManagement\DTOs\Organization;

use Modules\UserManagement\Http\Requests\Organization\CheckOrgContextRequest;

readonly class CheckOrgContextData
{
    public function __construct(
        public string $organization_id = '',
    ) {}

    public static function make(CheckOrgContextRequest $request): self
    {
        return new self(
            organization_id: $request->input('organization_id')
        );
    }
}
