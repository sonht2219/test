<?php


namespace App\Services\Interfaces;


use App\Exceptions\RepositoryException;
use App\Http\Requests\ManufacturingCountry\ManufacturingCountryRequest;
use App\Models\ManufacturingCountry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ManufacturingCountryService
{
    /**
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     */
    public function create(ManufacturingCountryRequest $req): ManufacturingCountry;

    /**
     * @param int $id
     * @param ManufacturingCountryRequest $req
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function edit(int $id, ManufacturingCountryRequest $req): ManufacturingCountry;

    /**
     * @param int $id
     * @return ManufacturingCountry
     * @throws RepositoryException
     */
    public function delete(int $id): ManufacturingCountry;

    /**
     * @param int $id
     * @return ManufacturingCountry
     */
    public function single(int $id): ManufacturingCountry;

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator;
}
