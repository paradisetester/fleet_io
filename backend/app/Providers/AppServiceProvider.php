<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    
    
    
    /**
     * Register any application services.
     *
     * @return void
     */
    
    
    public function register()
    {

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        
        Passport::ignoreMigrations();
        
  
        #$config = config('database');
        #$default = $config['default'];
        #$oldDatabase = config('database.connections.'.$default.'.database');
        #$uniqueID = (Request()->input('uniqueID')?Request()->input('uniqueID'):$oldDatabase);
        #\Config::set('database.connections.'.$default.'.database', $uniqueID);
        Schema::defaultStringLength(191);
    }
}
