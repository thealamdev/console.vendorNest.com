<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['organization_member_id', 'role_id', 'assigned_by'])]
class MemberRole extends Model
{
    use HasUlids;
    protected $table = 'member_roles';
}