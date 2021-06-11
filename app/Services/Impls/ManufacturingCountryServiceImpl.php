<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\ManufacturingCountry\ManufacturingCountryRequest;
use App\Models\ManufacturingCountry;
use App\Repositories\Interfaces\ManufacturingCountryRepository;
use App\Services\Interfaces\ManufacturingCountryService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManufacturingCountryServiceImpl implements ManufacturingCountryService
{
    private ManufacturingCountryRepository $manufacturingCountry_repo;

    public function __construct(ManufacturingCountryRepository $manufacturingCountry_repo)
    {
        $this->manufacturingCountry_repo = $manufacturingCountry_repo;
    }

    /**
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     */
    public function create(ManufacturingCountryRequest $req): ManufacturingCountry
    {
        return $this->manufacturingCountry_repo->create($req->validated());
    }

    /**
     * @param int $id
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturingCountryRequest $req): ManufacturingCountry
    {
        $manufacturing_country = $this->single($id);

        return $this->manufacturingCountry_repo->update($manufacturing_country, $req->validated());
    }

    /**
     * @param int $id
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function delete(int $id): ManufacturingCountry
    {
        $manufacturing_country = $this->single($id);

        return $this->manufacturingCountry_repo->update($manufacturing_country, ['status' => CommonStatus::INACTIVE]);
    }

    /**
     * @param int $id
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function single(int $id): ManufacturingCountry
    {
        return $this->manufacturingCountry_repo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator
    {
        $query = $this->manufacturingCountry_repo->buildQuery();

        if ($search)
            $query->where('name', 'like', "%$search%");

        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }
}
