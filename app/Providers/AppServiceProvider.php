<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Slider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view
                ->with('headers', Slider::where('type', 1)->get())
                ->with('category', Category::all())
                ->with('option_nav', Option::first());
        });
        Paginator::useBootstrapFive();
    }
}
