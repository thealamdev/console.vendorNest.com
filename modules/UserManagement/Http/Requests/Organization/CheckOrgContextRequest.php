<?php

namespace Modules\UserManagement\Http\Requests\Organization;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\UserManagement\Models\OrganizationMember;

class CheckOrgContextRequest extends BaseFormRequest
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
            'organization_id'   => [
                'required',
                Rule::exists(OrganizationMember::class, 'organization_id')->where('user_id', Auth::id()),
            ],
        ];
    }
}
