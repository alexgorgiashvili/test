<?php

namespace App\Providers;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\SampleChart::class
        ]);

        Blade::if('admin', function (){
            return auth()->check() && auth()->user()->isAdmin();
        });
        Schema::defaultStringLength(191);
        Carbon::setLocale('ka');
        
    }
}
