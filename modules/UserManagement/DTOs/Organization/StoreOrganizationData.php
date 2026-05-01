<?php

namespace Modules\UserManagement\DTOs\Organization;

use Modules\UserManagement\Http\Requests\Organizer\StoreOrganizerRequest;

class StoreOrganizationData
{
    public function __construct(
        public string $owner_user_id = '',
        public string $type = '',
        public string $name = '',
        public string $email = '',
        public ?string $phone = null,
    ) {}

    public static function make(StoreOrganizerRequest $request): self
    {
        return new self(
            owner_user_id: $request->input('owner_user_id'),
            type: $request->input('type'),
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone')
        );
    }
}
