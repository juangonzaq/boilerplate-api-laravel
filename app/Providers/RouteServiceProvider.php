<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')->namespace($this->namespace)->group(base_path('routes/api.php'));

        //Destination
        Route::prefix('api')->middleware('auth:api')->namespace('App\Http\Destination\Controllers')->group(base_path('app/Http/Destination/Routes/api.php'));

        //Home
        Route::prefix('api')->middleware('auth:api')->namespace('App\Http\Home\Controllers')->group(base_path('app/Http/Home/Routes/api.php'));
    }
}
