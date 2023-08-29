<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
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
        // Partagez la variable $categories avec toutes les vues
        $categories = Category::with('subcategories')
            ->orderBy('view', 'desc')
            ->limit(5)
            ->get();

        View::share('menuCategories', $categories);
    }
}
