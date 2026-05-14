<?php

namespace Modules\UserManagement\Models;

use App\Policies\OrganizationMemberPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Modules\AuthManagement\Models\User;

#[Fillable(['organization_id', 'user_id', 'invited_by', 'joined_at'])]
#[UsePolicy(OrganizationMemberPolicy::class)]

class OrganizationMember extends Model
{
    use HasUlids;
    protected $table = 'organization_members';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'member_roles');
    }
}
