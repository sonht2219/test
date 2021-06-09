<?php


namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Base\RepositoryEloquent;
use App\Repositories\Interfaces\UserRepository;

class UserRepositoryEloquent extends RepositoryEloquent implements UserRepository
{
    public function model()
    {
        return User::class;
    }
}
