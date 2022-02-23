<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Contracts\HashProviderContract;
use Src\UsersManagement\Auth\Domain\Contracts\SocialAuthProviderContract;
use Src\UsersManagement\Auth\Infrastruture\Services\GoogleAuthProvider;
use Src\UsersManagement\Auth\Infrastruture\Services\LaravelAuthProvider;
use Src\UsersManagement\Auth\Infrastruture\Services\LaravelHashProvider;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Infrastructure\Repositories\EloquentUserRepository;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Definimos las implementaciones que Laravel inyectará a cada contrato de dominio

        /* Repositorios */
        $this->app->bind(UserRepositoryContract::class, EloquentUserRepository::class);

        /* Proveedores de servicios */
        $this->app->bind(AuthProviderContract::class, LaravelAuthProvider::class);
        $this->app->bind(SocialAuthProviderContract::class, GoogleAuthProvider::class);
        $this->app->bind(HashProviderContract::class, LaravelHashProvider::class);
    }
}
