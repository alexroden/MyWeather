<?php

namespace App\Services\Contracts;

interface Ipify
{
    /**
     * @return mixed
     */
    public function getIP();
}
