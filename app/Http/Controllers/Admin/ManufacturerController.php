<?php


namespace App\Http\Controllers\Admin;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacturer\ManufacturerRequest;
use App\Models\Manufacturer;
use App\Services\Interfaces\ManufacturerService;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    private ManufacturerService $manufacturer_service;

    public function __construct(ManufacturerService $manufacturer_service)
    {
        $this->manufacturer_service = $manufacturer_service;
    }

    /**
     * @param ManufacturerRequest $req
     * @return Manufacturer
     */
    public function create(ManufacturerRequest $req): Manufacturer {
        return $this->manufacturer_service->create($req);
    }

    /**
     * @param int $id
     * @param ManufacturerRequest $req
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturerRequest $req): Manufacturer {
        return $this->manufacturer_service->edit($id, $req);
    }

    /**
     * @param int $id
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function delete(int $id): Manufacturer {
        return $this->manufacturer_service->delete($id);
    }

    /**
     * @param int $id
     * @return Manufacturer
     */
    public function single(int $id): Manufacturer {
        return $this->manufacturer_service->single($id);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function list(Request $req): array {
        $limit = $req->query('limit') ?: Constant::PAGE_LIMIT;
        $search = $req->query('search');
        $status = $req->query('status') ?: CommonStatus::ACTIVE;

        $page_data = $this->manufacturer_service->list($limit, $search, $status);

        return [
            'data' => $page_data->items(),
            'meta' => get_meta($page_data)
        ];
    }
}
