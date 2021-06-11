<?php


namespace App\Services\Interfaces;


use App\Exceptions\RepositoryException;
use App\Http\Requests\Manufacturer\ManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ManufacturerService
{
    /**
     * @param ManufacturerRequest $req
     * @return Manufacturer
     */
    public function create(ManufacturerRequest $req): Manufacturer;

    /**
     * @param int $id
     * @param ManufacturerRequest $req
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturerRequest $req): Manufacturer;

    /**
     * @param int $id
     * @return Manufacturer
     * @throws RepositoryException
     */
    public function delete(int $id): Manufacturer;

    /**
     * @param int $id
     * @return Manufacturer
     */
    public function single(int $id): Manufacturer;

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator;
}
