<?php


namespace App\Services\Interfaces;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface AuthService
{
    /**
     * @param RegisterRequest $req
     * @return mixed
     */
    public function register(RegisterRequest $req);

    /**
     * @param LoginRequest $req
     * @return mixed
     */
    public function login(LoginRequest $req);

    /**
     * @return mixed
     */
    public function userData();
}
