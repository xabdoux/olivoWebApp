<?php

namespace App\Providers;

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

         Gate::define('isInjecteur', function ($user) {
        return $user->role == "injecteur";
    });
         Gate::define('isCaissiere', function ($user) {
        return $user->role == "caissiere";
    });

         Gate::define('isDonneur', function ($user) {
        return $user->role == "donneur";
    });

          Gate::define('isAdmin', function ($user) {
        return $user->role == "admin";
    });
        //
    }
}
