<?php

namespace App\Providers;

use App\Repositories\Eloquent\AttributeRepositoryEloquent;
use App\Repositories\Eloquent\CategoryRepositoryEloquent;
use App\Repositories\Eloquent\ManufacturerRepositoryEloquent;
use App\Repositories\Eloquent\ManufacturingCountryRepositoryEloquent;
use App\Repositories\Eloquent\UnitRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Interfaces\AttributeRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ManufacturerRepository;
use App\Repositories\Interfaces\ManufacturingCountryRepository;
use App\Repositories\Interfaces\UnitRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserRepository::class => UserRepositoryEloquent::class,
        CategoryRepository::class => CategoryRepositoryEloquent::class,
        ManufacturerRepository::class => ManufacturerRepositoryEloquent::class,
        ManufacturingCountryRepository::class => ManufacturingCountryRepositoryEloquent::class,
        UnitRepository::class => UnitRepositoryEloquent::class,
        AttributeRepository::class => AttributeRepositoryEloquent::class
    ];
}
