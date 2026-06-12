<?php

namespace Modules\UserManagement\DTOs\Organization;

use Modules\UserManagement\Http\Requests\Organization\StoreOrganizationRequest;

readonly class StoreOrganizationData
{
    public function __construct(
        public string $type = '',
        public string $name = '',
        public string $email = '',
        public ?string $phone = null,
        public ?string $addrss = null,
        public ?string $country = null,
        public ?string $city = null,
    ) {}

    public static function make(StoreOrganizationRequest $request): self
    {
        return new self(
            type: $request->input('type'),
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            addrss: $request->input('address'),
            country: $request->input('country'),
            city: $request->input('city'),
        );
    }
}
