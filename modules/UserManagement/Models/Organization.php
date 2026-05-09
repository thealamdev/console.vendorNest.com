<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Observers\OrganizationObserver;

#[Fillable(['owner_user_id', 'type', 'name', 'slug', 'email', 'phone', 'address', 'city', 'country', 'verification_status', 'status'])]
#[ObservedBy(OrganizationObserver::class)]

class Organization extends Model
{
    use HasUlids;
    protected $table = 'organizations';

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}
