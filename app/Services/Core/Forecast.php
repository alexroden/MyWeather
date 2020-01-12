<?php

namespace App\Services\Core;

use App\Services\Contracts\DarkSky as DarkSkyContract;
use App\Services\Contracts\Forecast as ForecastContract;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Geocoder\Facades\Geocoder;

class Forecast implements ForecastContract
{
    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Forecast constructor.
     *
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $city
     *
     * @return array
     */
    public function getWeeks(string $city): array
    {
        return $this->cache->remember(Str::slug($city), 720, function () use ($city) {
            $geoInfo = Geocoder::getCoordinatesForAddress($city);

            $latitude = Arr::get($geoInfo, 'lat');
            $longitude = Arr::get($geoInfo, 'lng');

            /** @var \App\Services\Contracts\DarkSky $forecast */
            $forecast = app(DarkSkyContract::class)
                ->getForecast($latitude, $longitude);

            return [
                'breakdown' => $forecast->getDailyForecast(),
                'summary'   => $forecast->getWeekSummary(),
            ];
        });
    }
}
