<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\UserManagement\DTOs\Register\RegisterData;
use Modules\UserManagement\Models\User;

class RegisterRepository
{
    public function register(RegisterData $data)
    {
        return User::create([
            'name'  => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'password' => Hash::make($data->password)
        ]);
    }
}
