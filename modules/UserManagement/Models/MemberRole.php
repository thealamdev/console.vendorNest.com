<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{
    use HasUlids;
    protected $table = 'member_roles';
}
