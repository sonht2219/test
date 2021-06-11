<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\Unit\UnitRequest;
use App\Models\Unit;
use App\Repositories\Interfaces\UnitRepository;
use App\Services\Interfaces\UnitService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UnitServiceImpl implements UnitService
{
    private UnitRepository $unit_repo;

    public function __construct(UnitRepository $unit_repo)
    {
        $this->unit_repo = $unit_repo;
    }

    /**
     * @param UnitRequest $req
     * @return Unit
     */
    public function create(UnitRequest $req): Unit
    {
        return $this->unit_repo->create($req->validated());
    }

    /**
     * @param int $id
     * @param UnitRequest $req
     * @return Unit
     * @throws RepositoryException
     */
    public function edit(int $id, UnitRequest $req): Unit
    {
        $unit = $this->single($id);

        return $this->unit_repo->update($unit, $req->validated());
    }

    /**
     * @param int $id
     * @return Unit
     * @throws RepositoryException
     */
    public function delete(int $id): Unit
    {
        $unit = $this->single($id);

        return $this->unit_repo->update($unit, ['status' => CommonStatus::INACTIVE]);
    }

    /**
     * @param int $id
     * @return Unit
     * @throws RepositoryException
     */
    public function single(int $id): Unit
    {
        return $this->unit_repo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator
    {
        $query = $this->unit_repo->buildQuery();

        if ($search)
            $query->where('title', 'like', "%$search%");

        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }
}
