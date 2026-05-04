<?php

namespace Modules\UserManagement\Http\Requests\RolePermission;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\UserManagement\Enums\OrganizationType;

class UpdateRolePermissionRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organization_type' => 'required|in:' . implode(',', OrganizationType::values()),
            'name' => [
                'required',
                'string',
                'max:30',
                Rule::unique('roles', 'name')
                    ->ignore($this->route('role'))
                    ->where(fn($query) => $query->where('organization_id', activeOrganizationId())),
            ],
            'description'       => 'nullable|string|max:255',
            'is_editable'       => 'nullable',
            'permissions'       => 'nullable|array'
        ];
    }
}
