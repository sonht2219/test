<?php


namespace App\Services\Interfaces;


use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoryService
{
    /**
     * @param CategoryRequest $req
     * @return Category
     */
    public function create(CategoryRequest $req): Category;

    /**
     * @param int $id
     * @param CategoryRequest $req
     * @return Category
     */
    public function edit(int $id, CategoryRequest $req): Category;

    /**
     * @param int $id
     * @return Category
     */
    public function delete(int $id): Category;

    /**
     * @param int $id
     * @return Category
     */
    public function single(int $id): Category;

    /**
     * @param int $limit
     * @param string|null $search
     * @param int|null $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, ?string $search, ?int $status): LengthAwarePaginator;

    public function allRootCategory(): Collection;
}
