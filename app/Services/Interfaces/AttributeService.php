<?php


namespace App\Services\Interfaces;


use App\Exceptions\RepositoryException;
use App\Http\Requests\Attribute\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AttributeService
{
    /**
     * @param AttributeRequest $req
     * @return Attribute
     */
    public function create(AttributeRequest $req): Attribute;

    /**
     * @param int $id
     * @param AttributeRequest $req
     * @return Attribute
     * @throws RepositoryException
     */
    public function edit(int $id, AttributeRequest $req): Attribute;

    /**
     * @param int $id
     * @return Attribute
     * @throws RepositoryException
     */
    public function delete(int $id): Attribute;

    /**
     * @param int $id
     * @return Attribute
     */
    public function single(int $id): Attribute;

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator;
}
