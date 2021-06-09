<?php

namespace App\Http\Controllers;

use App\Exceptions\ExecuteException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Test;
use App\Models\User;
use App\Repositories\Eloquent\TestRepositoryEloquent;
use App\Services\Interfaces\AuthService;
use App\Traits\Transaction;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class AuthController extends Controller
{
    use Transaction;

    private TestRepositoryEloquent $testRepo;
    private AuthService $authService;
    public function __construct(
        TestRepositoryEloquent $testRepo,
        AuthService $authService
    )
    {
        $this->testRepo = $testRepo;
        $this->authService = $authService;
    }

    public function test() {
        $user = User::first();
        $test = Test::query()->create([
            'expired' => '2021-12-12',
            'user_id' => $user->id
        ]);

        return $test;
    }

    public function test2() {
        $result = User::query()->with(['tests', 'tests.test2s'])->paginate(1);
        return [
            'data' => $result->items(),
            'meta' => get_meta($result)
        ];
    }

    public function register(RegisterRequest $req): array {
        return $this->authService->register($req);
    }

    public function login(LoginRequest $req): array {
        return $this->authService->login($req);
    }

    public function userData() {
        return $this->authService->userData();
    }
}
