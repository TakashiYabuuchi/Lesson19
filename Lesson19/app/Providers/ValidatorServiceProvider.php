<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //新規ルール
        \Validator::extend(
            'nospace',
            function ($attribute, $value, $parameters, $validator) {
                if( mb_ereg_match("^(\s|　)+$", $value) ){
                return false;
            }else{
                return true;
            }
            }
        );


    }
}
