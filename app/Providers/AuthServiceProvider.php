<?php

namespace App\Providers;

use App\Policies\KeyPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Key::class => KeyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Passport::withoutCookieSerialization();

        Passport::enableImplicitGrant();

        Passport::tokensCan([
            'keys' => 'Add, Edit and Remove SSH keys on your account (!!)'
        ]);
    }
}
