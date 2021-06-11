<?php


namespace App\Http\Controllers\Admin;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManufacturingCountry\ManufacturingCountryRequest;
use App\Models\ManufacturingCountry;
use App\Services\Interfaces\ManufacturingCountryService;
use Illuminate\Http\Request;

class ManufacturingCountryController extends Controller
{
    private ManufacturingCountryService $manufacturing_country_service;

    public function __construct(ManufacturingCountryService $manufacturing_country_service)
    {
        $this->manufacturing_country_service = $manufacturing_country_service;
    }

    /**
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     */
    public function create(ManufacturingCountryRequest $req): ManufacturingCountry {
        return $this->manufacturing_country_service->create($req);
    }

    /**
     * @param int $id
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturingCountryRequest $req): ManufacturingCountry {
        return $this->manufacturing_country_service->edit($id, $req);
    }

    /**
     * @param int $id
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function delete(int $id): ManufacturingCountry {
        return $this->manufacturing_country_service->delete($id);
    }

    /**
     * @param int $id
     * @return ManufacturingCountry
     */
    public function single(int $id): ManufacturingCountry {
        return $this->manufacturing_country_service->single($id);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function list(Request $req): array {
        $limit = $req->query('limit') ?: Constant::PAGE_LIMIT;
        $search = $req->query('search');
        $status = $req->query('status') ?: CommonStatus::ACTIVE;

        $page_data = $this->manufacturing_country_service->list($limit, $search, $status);

        return [
            'data' => $page_data->items(),
            'meta' => get_meta($page_data)
        ];
    }
}
