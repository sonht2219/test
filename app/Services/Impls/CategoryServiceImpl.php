<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Interfaces\CategoryService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryServiceImpl implements CategoryService
{
    private CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * @param CategoryRequest $req
     * @return Category
     */
    public function create(CategoryRequest $req): Category
    {
        return $this->categoryRepo->create(array_merge($req->validated(), [
            'slug' => str_slug($req->title)
        ]));
    }

    /**
     * @param int $id
     * @param CategoryRequest $req
     * @return Category
     * @throws RepositoryException
     */
    public function edit(int $id, CategoryRequest $req): Category
    {
        $category = $this->single($id);
        return $this->categoryRepo->update($category, array_merge($req->validated(), [
            'slug' => str_slug($req->title)
        ]));
    }

    /**
     * @param int $id
     * @return Category
     * @throws RepositoryException
     */
    public function delete(int $id): Category
    {
        $category = $this->single($id);
        return $this->categoryRepo->update($category, [
            'status' => CommonStatus::INACTIVE
        ]);
    }

    /**
     * @param int $id
     * @return Category
     * @throws RepositoryException
     */
    public function single(int $id): Category
    {
        return $this->categoryRepo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string|null $search
     * @param int|null $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, ?string $search, ?int $status): LengthAwarePaginator
    {
        $query = $this->categoryRepo->buildQuery();

        if ($search) {
            $true_search = "%$search%";
            $query->where('title', 'like', $true_search);
        }

        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }

    public function allParentCategory(): Collection
    {
        return $this->categoryRepo->allParentCategory();
    }
}
