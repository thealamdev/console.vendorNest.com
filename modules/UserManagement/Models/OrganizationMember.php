<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasUlids;
    protected $table = 'organization_members';
}
