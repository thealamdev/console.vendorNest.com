<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasUlids;
    protected $table = 'role_permissions';
}
