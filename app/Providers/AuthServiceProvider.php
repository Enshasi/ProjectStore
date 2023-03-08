<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(){
        $this->app->singleton('abilities', function ($app) {
            return include base_path('data/abilities.php');
        });
    }
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //The Way One
        /*
        Gate::define('categories.index', function ($user) {
            return true;
        });
        Gate::define('categories.store', function ($user) {
            return true;
        });*/

        foreach($this->app->make('abilities') as  $code => $lable){
            Gate::define($code, function ($user) use ($code)  {
                return $user->hasAbility($code);
            });
        }
    }
}
