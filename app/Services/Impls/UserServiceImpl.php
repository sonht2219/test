<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    private UserRepository $userRepo;

    /**
     * UserServiceImpl constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param UserRequest $req
     * @return User
     */
    public function create(UserRequest $req): User
    {
        $data = array_merge($req->validated(), [
            'password' => Hash::make($req->password)
        ]);
        return $this->userRepo->create($data);
    }

    /**
     * @param $id
     * @param UserRequest $req
     * @return User
     * @throws RepositoryException
     */
    public function edit($id, UserRequest $req)
    {
        $user = $this->single($id);
        return $this->userRepo->update($user, $req->validated());
    }

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function delete($id)
    {
        $user = $this->single($id);
        return $this->userRepo->update($user, ['status' => CommonStatus::INACTIVE]);
    }

    /**
     * @param $id
     * @return User
     * @throws RepositoryException
     */
    public function single($id)
    {
        return $this->userRepo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status)
    {
        $query = User::query();
        if ($search) {
            $true_search = "%${search}%";
            $query->where(fn(Builder $q) => $q->where('email', 'like', $true_search)
                ->orWhere('name', 'like', $true_search)
                ->orWhere('phone_number' , 'like', $true_search)
            );
        }
        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }
}
