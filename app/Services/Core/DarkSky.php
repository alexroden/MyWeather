<?php

namespace App\Services\Core;

use App\Services\Contracts\DarkSky as DarkSkyContract;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class DarkSky implements DarkSkyContract
{
    /**
     * @var int
     */
    const TODAY = 0;

    /**
     * @var int
     */
    const TOMORROW = 1;

    /**
     * @var string
     */
    const URL = 'https://api.darksky.net/forecast/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @var array
     */
    protected $weekSummary = [];

    /**
     * @var string
     */
    protected $token;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $token
     */
    public function __construct(Client $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function getDailyForecast(): array
    {
        $dailyForecasts = [];
        if (!empty($this->response)) {
            $daily = $this->response['daily'];

            $dailyForecasts = Arr::pull($daily, 'data');
            $this->weekSummary = $daily;
        }

        return $dailyForecasts;
    }

    /**
     * @param string $latitude
     * @param string $longitude
     *
     * @return \App\Services\Core\DarkSky
     */
    public function getForecast(string $latitude, string $longitude)
    {
        $this->response = json_decode(
            $this->client
                ->get(self::URL."{$this->token}/{$latitude},{$longitude}")
                ->getBody(),
            true
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getWeekSummary(): array
    {
        return $this->weekSummary;
    }

    /**
     * @return array
     */
    public function response(): array
    {
        return $this->response;
    }
}
