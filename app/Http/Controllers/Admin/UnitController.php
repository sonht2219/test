<?php


namespace App\Http\Controllers\Admin;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\UnitRequest;
use App\Models\Unit;
use App\Services\Interfaces\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private UnitService $unit_service;

    public function __construct(UnitService $unit_service)
    {
        $this->unit_service = $unit_service;
    }

    /**
     * @param UnitRequest $req
     * @return Unit
     */
    public function create(UnitRequest $req): Unit {
        return $this->unit_service->create($req);
    }

    /**
     * @param int $id
     * @param UnitRequest $req
     * @return Unit
     * @throws RepositoryException
     */
    public function edit(int $id, UnitRequest $req): Unit {
        return $this->unit_service->edit($id, $req);
    }

    /**
     * @param int $id
     * @return Unit
     * @throws RepositoryException
     */
    public function delete(int $id): Unit {
        return $this->unit_service->delete($id);
    }

    /**
     * @param int $id
     * @return Unit
     */
    public function single(int $id): Unit {
        return $this->unit_service->single($id);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function list(Request $req): array {
        $limit = $req->query('limit') ?: Constant::PAGE_LIMIT;
        $search = $req->query('search');
        $status = $req->query('status') ?: CommonStatus::ACTIVE;

        $page_data = $this->unit_service->list($limit, $search, $status);

        return [
            'data' => $page_data->items(),
            'meta' => get_meta($page_data)
        ];
    }
}
