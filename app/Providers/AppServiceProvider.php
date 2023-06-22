<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings;
use Illuminate\Support\Facades\View;
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
        View::composer('partials.header', function ($view) {
            $show_activity_summary = Settings::where('show_activity_summary',1)->value('show_activity_summary');
             // Retrieve the data from the database
             $view->with('show_activity_summary', $show_activity_summary);
        });
    }
}
