<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use Validator;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
           Log::emergency($value .'  '. current($parameters));
            return Hash::check($value, current($parameters));

});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
