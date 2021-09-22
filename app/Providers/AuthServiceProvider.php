<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        # authorized 
        Gate::define('authorized', function ($user) {
            if($user->role == 'authorized') {
                return true;
            }
            $admins = explode(',', trim(config('listas.admins')));
            return ( in_array($user->codpes, $admins) and $user->codpes );
        });
    }
}
