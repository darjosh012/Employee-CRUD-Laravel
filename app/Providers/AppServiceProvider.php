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
       Validator::extend('oldPasswordCheck', function ($attribute, $value, $parameters, $validator) {
           $hashedPass = current($parameters);
          if (Hash::check($value, str_replace(' ', '', $hashedPass)))
            return true;
          else {
            return false;
          }
}, 'Wrong current password!');
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
