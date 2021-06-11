<?php


namespace App\Services\Interfaces;


use App\Exceptions\RepositoryException;
use App\Http\Requests\Unit\UnitRequest;
use App\Models\Unit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UnitService
{
    /**
     * @param UnitRequest $req
     * @return Unit
     */
    public function create(UnitRequest $req): Unit;

    /**
     * @param int $id
     * @param UnitRequest $req
     * @return Unit
     * @throws RepositoryException
     */
    public function edit(int $id, UnitRequest $req): Unit;

    /**
     * @param int $id
     * @return Unit
     * @throws RepositoryException
     */
    public function delete(int $id): Unit;

    /**
     * @param int $id
     * @return Unit
     */
    public function single(int $id): Unit;

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator;
}
