<?php

namespace Modules\AuthManagement\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
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
            'name'      => ['string', 'required', 'min:3', 'max:30'],
            'email'     => ['email', 'required', 'unique:users,email'],
            'phone'     => ['string', 'nullable', 'unique:users,phone'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
