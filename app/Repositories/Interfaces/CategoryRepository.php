<?php


namespace App\Repositories\Interfaces;


use App\Models\Category;
use App\Repositories\Base\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllRootCategory(): Collection;

    /**
     * @param Category $category
     * @return Collection
     */
    public function findAllChildrenOfCategory(Category $category): Collection;
}
