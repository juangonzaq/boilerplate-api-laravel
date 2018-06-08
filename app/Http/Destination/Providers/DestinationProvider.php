<?php

namespace App\Http\Destination\Providers;

use Illuminate\Support\ServiceProvider;

/** REPOSITORIES*/
use App\Http\Destination\Repositories\{DestinationRepository, ServiceRepository, HotelRepository};
use App\Http\Common\Repositories\CommonRepository;

/** MODELS */
use App\Http\Entities\{Destination, Service, Hotel};

class DestinationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Http\Destination\Contracts\IDestination', function () {
            return new DestinationRepository(new Destination);
        });

        $this->app->bind('App\Http\Destination\Contracts\IService', function () {
            return new ServiceRepository(new Service);
        });

        $this->app->bind('App\Http\Destination\Contracts\IHotel', function () {
            return new HotelRepository(new Hotel);
        });

        $this->app->bind('App\Http\Common\Contracts\ICommonRepository', function () {
            return new DestinationRepository(new Destination);
        });
    }
}
