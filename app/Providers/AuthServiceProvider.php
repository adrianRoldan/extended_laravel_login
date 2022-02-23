<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Registramos proveedor de autenticacion que extiende al de usuario
        //y ofrece soporte al inicio de sesión con múltiples emails
        Auth::provider('user_email_aliases', function ($app, array $config) {
            return new EloquentUserEmailAliasProvider($app['hash'], $config['model']);
        });
    }
}
