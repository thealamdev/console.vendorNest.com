<?php

namespace Modules\UserManagement\Http\Requests\Organizer;

use App\Http\Requests\BaseFormRequest;
use Modules\UserManagement\Enums\OrganizationType;

class StoreOrganizerRequest extends BaseFormRequest
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
            'owner_user_id'     => 'required|exists:users,id',
            'type'              => 'required|in:' . implode(',', OrganizationType::values()),
            'name'              => 'required|string|max:30',
            'email'             => 'required|unique:organizations,email',
            'phone'             => 'required|unique:organizations,phone',
            'address'           => 'nullable|string|max:50',
            'city'              => 'nullable|string|max:30',
            'country'           => 'nullable"string|max:20',
        ];
    }
}
