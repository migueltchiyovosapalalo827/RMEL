<?php

namespace App\Providers;

use App\Models\User;
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

        //
        Gate::define('admin',function(User $user){
            return $user->tipo=='Chefe da repartição';
        });

        Gate::define('rh',function(User $user){
            return $user->tipo=='Chefe do Recursos Humanos';
        });

        Gate::define('SPE',function(User $user){
            return $user->tipo=='Chefe da Secção da Educação e Ensino';
        });

        Gate::define('secretario',function(User $user){
            return $user->tipo=='secretario(a)';
        });

    }
}
