<?php

namespace App\Providers;

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
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('hasrole', function ($expression) {
            return "<?php if (auth()->check() && auth()->user()->hasRole($expression)) : ?>";
        });

        Blade::directive('endhasrole', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
