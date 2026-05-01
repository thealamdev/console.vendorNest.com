<?php

namespace Modules\UserManagement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable((['organization_id', 'organization_type', 'slug', 'name', 'description', 'is_editable', 'created_by']))]

class Role extends Model
{
    use HasUlids;
    protected $table = 'roles';
}
