<?php

namespace App\Providers;

use Blade;
use DB;
use Illuminate\Support\ServiceProvider;

use App\Models\Categorie;
use App\Models\SousCategorie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
            $categories = Categorie::all();
            view()->share('categories', $categories);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Gestion\MediaGestionInterface',
            'App\Gestion\MediaGestion'
            );
    }
}
