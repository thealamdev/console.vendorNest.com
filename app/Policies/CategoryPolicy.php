<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use Modules\AuthManagement\Models\User;
use Modules\ProductManagement\Models\Category;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::CATEGORY_VIEW->value, activeOrganizationId());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $user->hasPermission(PermissionEnum::CATEGORY_VIEW->value, activeOrganizationId());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::CATEGORY_CREATE->value, activeOrganizationId());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasPermission(PermissionEnum::CATEGORY_UPDATE->value, activeOrganizationId());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermission(PermissionEnum::CATEGORY_DELETE->value, activeOrganizationId());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return false;
    }
}
