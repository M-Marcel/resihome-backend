<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('edit-settings', function ($user) {
            return $user->isAdmin;
        });


        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });

        // Passport::tokensExpireIn(now()->addDays(15));

        // Passport::refreshTokensExpireIn(now()->addDays(30));

        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::personalAccessClientSecret(config('X69mFyApSkIKQ9WETDv20JGvgAzW4Vckv6vXJ2KW'));

        Passport::personalAccessClientId(config('9123fc6c-88cf-4915-8cd2-33f2785f4283'));



    }
}
