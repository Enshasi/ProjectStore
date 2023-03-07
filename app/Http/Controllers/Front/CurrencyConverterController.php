<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'currency_code' =>'required|string|size:3'
        ]);
        $currencyCode = $request->input('currency_code');
        $cache_key = 'currency_rate_'.$currencyCode ;
        $baseCurrencyCode = config('app.currency');
        // $rates = Cache::get('currency_rates' , []);
        $rate = Cache::get($cache_key, [] , 0);
        if(!$rate){
            $converter = new CurrencyConverter(config('services.currency.api_key'));
            $rate = $converter->convert($baseCurrencyCode , $currencyCode);
            // storage in Array
            Cache::put($cache_key,$rate , now()->addMinutes(60));
        }
        Session::put('currency_code', $currencyCode);
        //Storage in side Chach
        // Session::put('currency_rate', $rate);
        return redirect()->back();
    }
}
