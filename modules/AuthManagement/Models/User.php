<?php

namespace Modules\AuthManagement\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;

#[Fillable(['name', 'email', 'phone', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUlids, HasApiTokens;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function memberships()
    {
        return $this->hasMany(OrganizationMember::class, 'user_id');
    }

    public function hasRole(string $role, string $orgId)
    {
        return $this->memberships()
            ->where('organization_id', $orgId)
            ->whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            })
            ->exists();
    }

    public function hasPermission(string $permission, string $orgId): bool
    {
        return $this->memberships()
            ->where('organization_id', $orgId)
            ->whereHas('roles.permissions', function ($q) use ($permission) {
                $q->where('slug', $permission);
            })
            ->exists();
    }
}
