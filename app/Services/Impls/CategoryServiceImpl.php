<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Interfaces\CategoryService;
use App\Traits\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryServiceImpl implements CategoryService
{
    use Transaction;

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
        $category = $this->categoryRepo->create(array_merge($req->validated(), [
            'slug' => str_slug($req->title)
        ]));

        $path = $category->id;

        if ($req->parent_id) {
            $parent = $this->categoryRepo->findBy('id', $req->parent_id);
            $path = $parent->path . '.' . $category->id;
        }

        return $this->categoryRepo->update($category, compact('path'));
    }

    /**
     * @param int $id
     * @param CategoryRequest $req
     * @return Category
     * @throws \Exception
     */
    public function edit(int $id, CategoryRequest $req): Category
    {
        return $this->useTransaction(function () use ($id, $req) {
            $category = $this->single($id);

            $prepare_data = [];

            if ($req->title != $category->title)
                $prepare_data['slug'] = str_slug($req->title);

            if ($req->parent_id != $category->parent_id) {
                $parent_new = $this->single($req->parent_id);
                $prepare_data['path'] = $parent_new->path . '.' . $category->id;
                $this->resolvePathAllChildren($category, $prepare_data['path']);
            }

            return $this->categoryRepo->update($category, array_merge($req->validated(), $prepare_data));
        });
    }

    /**
     * @param int $id
     * @return Category
     * @throws \Exception
     */
    public function delete(int $id): Category
    {
        return $this->useTransaction(function () use ($id) {
            $category = $this->single($id);

            $childrens = $this->categoryRepo->findAllChildrenOfCategory($category);

            foreach ($childrens as $children) {
                $this->categoryRepo->update($children, [
                    'status' => CommonStatus::INACTIVE
                ]);
            }

            return $this->categoryRepo->update($category, [
                'status' => CommonStatus::INACTIVE
            ]);
        });
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

    public function allRootCategory(): Collection
    {
        return $this->categoryRepo->findAllRootCategory();
    }

    private function resolvePathAllChildren(Category $category, string $new_path_prefix) {
        $childrens = $this->categoryRepo->findAllChildrenOfCategory($category);
        foreach ($childrens as $children) {
            /** @var Category $children */
            $children->path = Str::replaceFirst($category->path, $new_path_prefix, $children->path);
            $children->save();
        }
    }
}
