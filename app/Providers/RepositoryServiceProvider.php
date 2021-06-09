<?php

namespace App\Providers;

use App\Repositories\Eloquent\CategoryRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserRepository::class => UserRepositoryEloquent::class,
        CategoryRepository::class => CategoryRepositoryEloquent::class
    ];
}
