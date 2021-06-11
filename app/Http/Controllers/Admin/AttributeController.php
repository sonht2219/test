<?php


namespace App\Http\Controllers\Admin;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\AttributeRequest;
use App\Models\Attribute;
use App\Services\Interfaces\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    private AttributeService $attribute_service;

    public function __construct(AttributeService $attribute_service)
    {
        $this->attribute_service = $attribute_service;
    }

    /**
     * @param AttributeRequest $req
     * @return Attribute
     */
    public function create(AttributeRequest $req): Attribute {
        return $this->attribute_service->create($req);
    }

    /**
     * @param int $id
     * @param AttributeRequest $req
     * @return Attribute
     * @throws RepositoryException
     */
    public function edit(int $id, AttributeRequest $req): Attribute {
        return $this->attribute_service->edit($id, $req);
    }

    /**
     * @param int $id
     * @return Attribute
     * @throws RepositoryException
     */
    public function delete(int $id): Attribute {
        return $this->attribute_service->delete($id);
    }

    /**
     * @param int $id
     * @return Attribute
     */
    public function single(int $id): Attribute {
        return $this->attribute_service->single($id);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function list(Request $req): array {
        $limit = $req->query('limit') ?: Constant::PAGE_LIMIT;
        $search = $req->query('search');
        $status = $req->query('status') ?: CommonStatus::ACTIVE;

        $page_data = $this->attribute_service->list($limit, $search, $status);

        return [
            'data' => $page_data->items(),
            'meta' => get_meta($page_data)
        ];
    }
}
