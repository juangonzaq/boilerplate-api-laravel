<?php
namespace App\Http\Transaction\Providers;

use Illuminate\Support\ServiceProvider;

/** REPOSITORIES*/
use App\Http\Transaction\Repositories\{TransactionRepository};

/** MODELS */
use App\Http\Entities\{Transaction};

class TransactionProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Http\Transaction\Contracts\ITransaction', function () {
            return new TransactionRepository(new Transaction);
        });
    }
}
