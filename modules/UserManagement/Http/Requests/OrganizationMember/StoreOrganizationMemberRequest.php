<?php

namespace Modules\UserManagement\Http\Requests\OrganizationMember;

use App\Http\Requests\BaseFormRequest;

class StoreOrganizationMemberRequest extends BaseFormRequest
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
            'name'              => 'required_without:user_id|string|max:30',
            'email'             => 'required_without:user_id|unique:organizations,email',
            'phone'             => 'required_without:user_id|unique:organizations,phone',
            'user_id'           => 'nullable'
        ];
    }
}
