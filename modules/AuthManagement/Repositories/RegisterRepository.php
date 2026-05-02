<?php

namespace Modules\AuthManagement\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\AuthManagement\DTOs\Register\RegisterData;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Enums\UserType;

class RegisterRepository
{
    public function register(RegisterData $data)
    {
        return User::create([
            'name'      => $data->name,
            'email'     => $data->email,
            'phone'     => $data->phone,
            'password'  => Hash::make($data->password),
            'type'      => UserType::VENDOR->value
        ]);
    }
}
