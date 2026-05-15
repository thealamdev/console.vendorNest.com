<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Modules\AuthManagement\Models\User;
use Modules\AuthManagement\DTOs\Register\RegisterData;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Enums\UserType;

class UserResolverService
{
    public static function resolve(RegisterData | StoreOrganizationMemberData $data)
    {
        if (!empty($data->user_id)) {
            return User::findOrFail($data->user_id);
        }

        if (!empty($data->email)) {
            $user = User::where('email', $data->email)->first();

            if ($user) {
                return $user;
            }
        }

        $user = User::create([
            'name'      => $data->name,
            'email'     => $data->email,
            'type'      => UserType::VENDOR->value,
            'password'  => Hash::make($data->password)
        ]);

        $user->createToken('auth_token')->plainTextToken;
        return $user;
    }
}
