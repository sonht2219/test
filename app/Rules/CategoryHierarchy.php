<?php

namespace App\Rules;

use App\Helper\Constant;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Contracts\Validation\Rule;

class CategoryHierarchy implements Rule
{
    public CategoryRepository $categoryRepo;

    public function __construct()
    {
        $this->categoryRepo = app(CategoryRepository::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var Category $category */
        $category = $this->categoryRepo->findBy('id', $value);
        return $category->level() <= Constant::MAX_CATEGORY_HIERARCHY - 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.category_hierarchy', ['category_hierarchy' => Constant::MAX_CATEGORY_HIERARCHY]);
    }
}
