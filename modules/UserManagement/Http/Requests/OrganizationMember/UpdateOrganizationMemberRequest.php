<?php

namespace Modules\UserManagement\Http\Requests\OrganizationMember;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\UserManagement\Models\OrganizationMember;

class UpdateOrganizationMemberRequest extends BaseFormRequest
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
            'role_ids'          => 'required|array',
            'role_ids.*'        => [
                'required',
                Rule::exists('roles', 'id')->where('organization_id', activeOrganizationId()),
            ],
            'user_id'           => [
                'nullable',
                Rule::unique(OrganizationMember::class)->where('organization_id', activeOrganizationId())
            ],
        ];
    }
}
