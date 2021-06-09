<?php


namespace App\Services\Impls;


use App\Exceptions\ExecuteException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\AuthService;
use Illuminate\Support\Facades\Hash;

class AuthServiceImpl implements AuthService
{
    /**
     * @var UserRepository
     */
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param RegisterRequest $req
     * @return mixed
     */
    public function register(RegisterRequest $req)
    {
        $user = $this->userRepo->create(array_merge($req->validated(), [
            'password' => Hash::make($req->password),
        ]));

        return [
            'user' => $user,
            'access_token' => $user->createToken('access_token')->plainTextToken
        ];
    }

    /**
     * @param LoginRequest $req
     * @return mixed
     * @throws ExecuteException
     */
    public function login(LoginRequest $req)
    {
        $user = $this->userRepo->findBy('email', $req->email);

        if (!$user || !Hash::check($req->password, $user->password))
            throw new ExecuteException(__('messages.exception_attempt_login'));

        return [
            'user' => $user,
            'access_token' => $user->createToken('access_token')->plainTextToken
        ];
    }

    /**
     * @return mixed|void
     */
    public function userData()
    {
        return auth()->user();
    }
}
