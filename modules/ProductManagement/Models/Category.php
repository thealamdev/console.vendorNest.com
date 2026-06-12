<?php

namespace Modules\ProductManagement\Models;

use App\Policies\CategoryPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['parent_id', 'name', 'slug', 'status'])]
#[ObservedBy(CategoryPolicy::class)]


class Category extends Model
{
    use HasUlids;
    protected $table = 'categories';
}
