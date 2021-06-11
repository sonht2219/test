<?php


namespace App\Http\Requests\Category;


use App\Http\Requests\Base\BaseRequest;
use App\Rules\CategoryHierarchy;

/**
 * Class CategoryRequest
 * @package App\Http\Requests\Category
 *
 * @property-read string $title
 * @property-read string $parent_id
 */
class CategoryRequest extends BaseRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id', new CategoryHierarchy]
        ];
    }
}
