<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\Manufacturer\ManufacturerRequest;
use App\Models\Manufacturer;
use App\Repositories\Interfaces\ManufacturerRepository;
use App\Services\Interfaces\ManufacturerService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManufacturerServiceImpl implements ManufacturerService
{
    private ManufacturerRepository $manufacturer_repo;

    public function __construct(ManufacturerRepository $manufacturer_repo)
    {
        $this->manufacturer_repo = $manufacturer_repo;
    }

    /**
     * @param ManufacturerRequest $req
     * @return Manufacturer
     */
    public function create(ManufacturerRequest $req): Manufacturer
    {
        return $this->manufacturer_repo->create($req->validated());
    }

    /**
     * @param int $id
     * @param ManufacturerRequest $req
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturerRequest $req): Manufacturer
    {
        $manufacturer = $this->single($id);

        return $this->manufacturer_repo->update($manufacturer, $req->validated());
    }

    /**
     * @param int $id
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function delete(int $id): Manufacturer
    {
        $manufacturer = $this->single($id);

        return $this->manufacturer_repo->update($manufacturer, ['status' => CommonStatus::INACTIVE]);
    }

    /**
     * @param int $id
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function single(int $id): Manufacturer
    {
        return $this->manufacturer_repo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator
    {
        $query = $this->manufacturer_repo->buildQuery();

        if ($search)
            $query->where('name', 'like', "%$search%");

        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }
}
