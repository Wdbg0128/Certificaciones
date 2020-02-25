<?php

namespace App\Providers;
use Illuminate\Support\Facades\view;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
        // Carbon::setUtf8(true);
        // Carbon::setLocale('es');
        // setlocale(LC_TIME, 'es_ES');
        Schema::defaultStringLength(191);
        view:: share('theme', 'lte');
    }
}
