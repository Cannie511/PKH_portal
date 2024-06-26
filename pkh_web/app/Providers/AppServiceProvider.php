<?php

namespace App\Providers;

use Blade;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set for Blade
        Blade::setRawTags("[[", "]]");
        Blade::setContentTags('<%', '%>');
        Blade::setEscapedContentTags('<%%', '%%>');

        // Set custom validator
        Validator::extend('maxLen', function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {

            if (!isset($value) || null == $value) {
                return true;
            }

            return strlen($value) < $parameters[0];
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = [
            //'Illuminate\Contracts\Auth\Registrar' => 'App\Services\Registrar'
            // 'App\Services\ProductService'        => 'App\Services\ProductServiceImpl',
            // 'App\Services\StoreService'    => 'App\Services\StoreServiceImpl',
            // 'App\Services\OrderService'    => 'App\Services\OrderServiceImpl',
            // 'App\Services\FuncConfService' => 'App\Services\FuncConfServiceImpl',
        ];

        // foreach ($bindings as $key => $value) {
        //     $this->app->bind($key, $value);
        // }

    }

}
