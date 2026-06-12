<?php

namespace Modules\ProductManagement\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\ProductManagement\Models\Category;

class StoreCategoryRequest extends BaseFormRequest
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
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')],
            'name'      => ['required', 'string', 'max:100', Rule::unique(Category::class, 'name')],
            'status'    => ['required', 'boolean'],
        ];
    }
}