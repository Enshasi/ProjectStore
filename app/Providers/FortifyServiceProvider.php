<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();

        if($request->is('/admin/*')){
            Config::set('fortify.guard' , 'admin');
            Config::set('fortify.prefix' , 'admin');
            Config::set('fortify.passwords' , 'admins');
           Config::set('fortify.home' , '/admin/dashboard'); //redirect to admin
        }
        //Or redirect to admin another way
        // بحكيله سجلي في اللوجن تبع التجسيل لما يكون الأوث أدمن بعد ما يسجل وديه على الراوت يلي طلبه
       /*
    //    LoginResponse::class Or RegisterResponse::class
        $this->app->instance(LoginResponse::class , new class implements LoginResponse{
            public function toResponse($request)
            {
                if($request->user('admin')){
                    return redirect()->intended('admin/dashboard');

                }
                return redirect()->intended('/');
            }
        });*/
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        // Fortify::authenticateUsing(function($request))

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());//5 requests in 1 minutes
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        // Fortify::loginView('auth.login');
        // Fortify::registerView('auth.register');
        // Fortify::forgetPasswordView('auth.login');
        // Fortify::registerView(function(){
        //     return view('auth.register');
        // });
        //Or
        if(Config::get('fortify.guard') === 'admin'){

            Fortify::viewPrefix('auth.'); //default name Folder

            //login using phone , email , username
            Fortify::authenticateUsing([new AuthenticateUser ,'Authenticate']);

        }
        else{
            Fortify::viewPrefix('front.auth.');
        }
    }
}
