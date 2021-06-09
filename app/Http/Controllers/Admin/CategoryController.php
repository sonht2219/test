<?php


namespace App\Http\Controllers\Admin;


use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param CategoryRequest $req
     * @return Category
     */
    public function create(CategoryRequest $req): Category {
        return $this->categoryService->create($req);
    }

    public function edit(int $id, CategoryRequest $req): Category {
        return $this->categoryService->edit($id, $req);
    }

    public function delete(int $id): Category {
        return $this->categoryService->delete($id);
    }

    public function single(int $id): Category {
        return $this->categoryService->single($id);
    }

    public function list(): Collection {
        return $this->categoryService->allParentCategory();
    }
}
