<?php

namespace Modules\AuthManagement\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\AuthManagement\DTOs\Register\RegisterData;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Enums\UserType;

class RegisterRepository
{
    public function register(RegisterData $data): User
    {
        $user = User::create([
            'name'      => $data->name,
            'email'     => $data->email,
            'phone'     => $data->phone,
            'password'  => Hash::make($data->password),
            'type'      => UserType::VENDOR->value
        ]);

        $data = $user->load([
            'memberships:id,organization_id,user_id',
            'memberships.organization:id,owner_user_id,name,email',
        ]);
        
        return $data;
    }
}
