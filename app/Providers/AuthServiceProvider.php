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
        // كل مودل شو يلي بقابله

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

        //لسوبر أدمن يكون فوق الكل
        //انو هاذا فوق كل الصلاحيات
        //بدال ما استخدمها في كل ملف Polici
        Gate::before(function ($user, $ability) {
            if ($user->super_admin) { //user Auth => is super admin
                return true; //has all abilities
            }
        });




        //The Way One
        /*
        Gate::define('categories.index', function ($user) {
            return true;
        });
        Gate::define('categories.store', function ($user) {
            return true;
        });*/

        // foreach($this->app->make('abilities') as  $code => $lable){
        //     Gate::define($code, function ($user) use ($code)  {
        //         return $user->hasAbility($code);
        //     });
        // }
    }
}
