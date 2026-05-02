<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['organization_id', 'user_id', 'invited_by', 'joined_at'])]
class OrganizationMember extends Model
{
    use HasUlids;
    protected $table = 'organization_members';
}