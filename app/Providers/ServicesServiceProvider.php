<?php

namespace App\Providers;

use App\Services\Contracts\DarkSky as DarkSkyContract;
use App\Services\Contracts\Forecast as ForecastContract;
use App\Services\Contracts\Ipify as IpifyContract;
use App\Services\Core\DarkSky;
use App\Services\Core\Forecast;
use App\Services\Core\Ipify;
use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDarkSky();
        $this->registerForecast();
        $this->registerIpify();
    }

    protected function registerDarkSky()
    {
        $this->app->singleton(DarkSkyContract::class, function (Container $app) {
            $client = new Client();

            return new DarkSky($client, Config::get('darksky.token'));
        });
    }

    protected function registerForecast()
    {
        $this->app->singleton(ForecastContract::class, function (Container $app) {
            $cache = $app->make(Repository::class);

            return new Forecast($cache);
        });
    }

    protected function registerIpify()
    {
        $this->app->singleton(IpifyContract::class, function (Container $app) {
            $client = new Client();

            return new Ipify($client);
        });
    }
}
