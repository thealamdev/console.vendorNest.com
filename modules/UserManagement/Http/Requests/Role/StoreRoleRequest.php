<?php

namespace Modules\UserManagement\Http\Requests\Role;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\UserManagement\Enums\OrganizationType;

class StoreRoleRequest extends BaseFormRequest
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
            'organization_id'   => 'required|exists:organizations,id',
            'organization_type' => 'required|in:' . implode(',', OrganizationType::values()),
            'name' => [
                'required',
                'string',
                'max:30',
                Rule::unique('roles', 'name')->where(fn($query) => $query->where('organization_id', $this->organization_id)),
            ],
            'description'       => 'nullable|string|max:255',
            'is_editable'       => 'nullable',
            'created_by'        => 'required|exists:users,id',
        ];
    }
}
