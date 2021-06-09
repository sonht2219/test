<?php


namespace App\Services\Interfaces;


use App\Exceptions\RepositoryException;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface UserService
{
    /**
     * @param UserRequest $req
     * @return User
     */
    public function create(UserRequest $req);

    /**
     * @param $id
     * @param UserRequest $req
     * @return User
     * @throws RepositoryException
     */
    public function edit($id, UserRequest $req);

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function delete($id);

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function single($id);

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status);
}
