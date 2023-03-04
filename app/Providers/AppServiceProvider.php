<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use LDAP\Result;
use League\CommonMark\Extension\CommonMark\Parser\Block\BlockQuoteStartParser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // JsonResource::withoutWrapping();
        //Solving Proplemes View
        Paginator::useBootstrapFive();
        Validator::extend('filter' , function($attribute ,$value , $words){
            return !in_array(strtolower($value),$words);
        } , 'This is Not Allowed using filter AppServiceProvider');
    }
}
