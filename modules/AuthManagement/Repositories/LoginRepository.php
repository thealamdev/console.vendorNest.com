<?php

namespace Modules\AuthManagement\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\AuthManagement\DTOs\Login\LoginData;
use Modules\AuthManagement\Models\User;

class LoginRepository
{
    /**
     * Handle the login logic.
     * @param LoginData $data
     * @return array{token: string, user: User}
     */
    public function login(LoginData $data): array
    {
        $user = User::query()
            ->where('email', $data->email)
            ->first();

        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
