<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        
        if($this->app->environment() === 'production'){ $this->app['request']->server->set('HTTPS', true); }
        
        if (env('FORCE_HTTPS')) {
            URL::forceScheme('https');
        }
        //
    }

}
