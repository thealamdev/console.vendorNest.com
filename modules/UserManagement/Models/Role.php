<?php

namespace Modules\UserManagement\Models;

use App\Policies\RolePolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\AuthManagement\Models\User;

#[Fillable((['organization_id', 'organization_type', 'slug', 'name', 'description', 'is_editable', 'created_by']))]
#[UsePolicy(RolePolicy::class)]

class Role extends Model
{
    use HasUlids;
    protected $table = 'roles';

    /**
     * Make relation with organization
     * @return BelongsTo<Organization, Role>
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function member():HasOne
    {
        return $this->hasOne(MemberRole::class, 'role_id');
    }

    /**
     * Make relation with User
     * @return BelongsTo<User, Role>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
