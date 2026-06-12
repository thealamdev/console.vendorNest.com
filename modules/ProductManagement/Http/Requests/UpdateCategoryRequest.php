<?php

namespace Modules\ProductManagement\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Modules\ProductManagement\Models\Category;

class UpdateCategoryRequest extends BaseFormRequest
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
        $category = $this->route('category');
        $categoryId = is_string($category) ? $category : $category?->id;

        return [
            'parent_id' => [
                'nullable',
                Rule::exists(Category::class, 'id'),
                function (string $attribute, mixed $value, \Closure $fail) use ($categoryId) {
                    if ($categoryId && $value === $categoryId) {
                        $fail('The parent category must be different from the category.');
                    }
                },
            ],
            'name'   => [
                'required',
                'string',
                'max:100',
                Rule::unique(Category::class, 'name')->ignore($categoryId),
            ],
            'status' => ['required', 'boolean'],
        ];
    }
}
