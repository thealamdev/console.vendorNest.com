<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['owner_user_id', 'type', 'name', 'slug', 'email', 'phone', 'address', 'city', 'country', 'verification_status', 'status'])]
class Organization extends Model
{
    use HasUlids;
    protected $table = 'organizations';
}
