<?php

namespace App\Providers;

use App\Http\Facade\InvoiceHelper;
use App\Http\Facade\UploadHelper;
use Illuminate\Support\ServiceProvider;

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
        //
        $this->app->singleton('invoice', function(){
            return new InvoiceHelper();
        });
        $this->app->bind('upload',function(){
            return new UploadHelper();
        });
    }
}
