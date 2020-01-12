<?php

namespace App\Services\Contracts;

interface Forecast
{
    /**
     * @param string $city
     *
     * @return array
     */
    public function getWeeks(string $city): array;
}
