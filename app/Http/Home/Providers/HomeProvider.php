<?php

namespace App\Http\Home\Providers;

use Illuminate\Support\ServiceProvider;

/** REPOSITORIES*/
use App\Http\Home\Repositories\{TestimonyRepository, FaqRepository, HomeRepository};
use App\Http\Common\Repositories\CommonRepository;

/** MODELS */
use App\Http\Entities\{Testimony, Information, Faq};

class HomeProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Http\Home\Contracts\ITestimony', function () {
            return new TestimonyRepository(new Testimony);
        });

        $this->app->bind('App\Http\Home\Contracts\IHome', function () {
            return new HomeRepository(new Information());
        });

        $this->app->bind('App\Http\Home\Contracts\IFaq', function () {
            return new FaqRepository(new Faq);
        });

        $this->app->bind('App\Http\Common\Contracts\ICommonRepository', function () {
            return new TestimonyRepository(new Destination);
        });
    }
}
