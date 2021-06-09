<?php


namespace App\Http\Controllers\Admin;

use App\Exceptions\RepositoryException;
use App\Helper\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UserRequest $req
     * @return User
     */
    public function create(UserRequest $req) {
        return $this->userService->create($req);
    }

    /**
     * @param $id
     * @param UserRequest $req
     * @return User
     * @throws RepositoryException
     */
    public function edit($id, UserRequest $req) {
        return $this->userService->edit($id, $req);
    }

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function delete($id) {
        return $this->userService->delete($id);
    }

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function single($id) {
        return $this->userService->single($id);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function list(Request $req) {
        $limit = $req->query('limit') ?? Constant::PAGE_LIMIT;
        $search = $req->query('search');
        $status = $req->query('status');
        $page_data = $this->userService->list($limit, $search, $status);
        return [
            'data' => $page_data->items(),
            'meta' => get_meta($page_data)
        ];
    }
}
