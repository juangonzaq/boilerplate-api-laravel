<?php

namespace App\Http\Events\Providers;

use Illuminate\Support\ServiceProvider;

/** REPOSITORIES*/
use App\Http\Destination\Repositories\DestinationRepository;

/** MODELS */
use App\Http\Entities\Destination;

class DestinationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Http\Destination\Contracts\IDestination', function () {
            return new DestinationRepository(new Destination);
        });
    }
}
