<?php

namespace Modules\UserManagement\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\UserManagement\Enums\OrganizationType;
use Modules\UserManagement\Models\User;

class StoreOrganizerRequest extends FormRequest
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
            'owner_user_id'     => ['required', Rule::exists(User::class)],
            'type'              => 'required|in:' . implode(',', OrganizationType::values()),
            'name'              => 'required|string|max:30',
            'slug'              => 'required|string|max:30',
            'email'             => 'required|unique:organizations,email',
            'phone'             => 'required|unique:organizations,phone',
            'address'           => 'nullable|string|max:50',
            'city'              => 'nullable|string|max:30',
            'country'           => 'nullable"string|max:20',
        ];
    }
}
