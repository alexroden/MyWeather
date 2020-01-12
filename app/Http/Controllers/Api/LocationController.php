<?php

namespace App\Http\Controllers\Api;

use App\Services\Contracts\Ipify;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke()
    {
        $geoInfo = geoip(app(Ipify::class)->getIP());

        return response()
            ->json([
                'city' => $geoInfo->getAttribute('city'),
            ]);
    }
}
