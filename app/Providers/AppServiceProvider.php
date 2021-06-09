<?php

namespace App\Providers;

use App\Services\Impls\AuthServiceImpl;
use App\Services\Impls\CategoryServiceImpl;
use App\Services\Impls\FileStorageServiceImpl;
use App\Services\Impls\LoggerServiceImpl;
use App\Services\Impls\UserServiceImpl;
use App\Services\Interfaces\AuthService;
use App\Services\Interfaces\CategoryService;
use App\Services\Interfaces\FileStorageService;
use App\Services\Interfaces\LoggerService;
use App\Services\Interfaces\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        FileStorageService::class => FileStorageServiceImpl::class,
        LoggerService::class => LoggerServiceImpl::class,
        AuthService::class => AuthServiceImpl::class,
        UserService::class => UserServiceImpl::class,
        CategoryService::class => CategoryServiceImpl::class
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.debug')) {
            DB::listen(function($query) {
                Log::info(
                    $query->sql,
                    [
                        'bindings' => implode(',', $query->bindings),
                        'times' => $query->time
                    ]
                );
            });
        }
    }
}
