<?php

namespace Modules\UserManagement\Http\Requests\OrganizationMember;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Models\OrganizationMember;

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
            'email'             => [
                'required_without:user_id',
                'unique:organizations,email',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->first();
                    if ($user) {
                        $exists = OrganizationMember::where('organization_id', activeOrganizationId())
                            ->where('user_id', $user->id)
                            ->exists();

                        if ($exists) {
                            $fail('This user is already a member of this organization.');
                        }
                    }
                }
            ],
            'phone'             => 'required_without:user_id|unique:organizations,phone',
            'password'          => 'required_without:user_id|string|min:8|confirmed',
            'role_id'           => 'required|exists:roles,id',
            'user_id'           => [
                'nullable',
                Rule::unique(OrganizationMember::class)->where('organization_id', activeOrganizationId())
            ],
        ];
    }
}
