<?php


namespace App\Repositories\Eloquent;


use App\Models\Category;
use App\Repositories\Base\RepositoryEloquent;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepositoryEloquent extends RepositoryEloquent implements CategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * @return Collection
     */
    public function allParentCategory(): Collection
    {
        return $this->model
            ->whereNull('parent_id')
            ->with('children.children')
            ->get();
    }
}
