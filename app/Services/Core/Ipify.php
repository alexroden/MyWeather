<?php

namespace App\Services\Core;

use App\Services\Contracts\Ipify as IpifyContract;
use GuzzleHttp\Client;

class Ipify implements IpifyContract
{
    /**
     * @var string
     */
    const URL = 'https://api.ipify.org/?format=json';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getIP()
    {
        return json_decode(
            $this->client
                ->get(self::URL)
                ->getBody(),
            true
        )['ip'];
    }
}
