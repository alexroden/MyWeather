<?php

namespace App\Services\Contracts;

interface DarkSky
{
    /**
     * @return array
     */
    public function getDailyForecast(): array;

    /**
     * @param string $latitude
     * @param string $longitude
     *
     * @return \App\Services\Core\DarkSky
     */
    public function getForecast(string $latitude, string $longitude);

    /**
     * @return array
     */
    public function getWeekSummary(): array;

    /**
     * @return array
     */
    public function response(): array;
}
