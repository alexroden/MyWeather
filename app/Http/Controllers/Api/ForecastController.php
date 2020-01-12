<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ForecastRequest;
use App\Services\Contracts\Forecast;
use Illuminate\Routing\Controller;

class ForecastController extends Controller
{
    /**
     * @param \App\Http\Requests\ForecastRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(ForecastRequest $request)
    {
        return response(
            app(Forecast::class)
                ->getWeeks(
                    $request->get('city')
                )
        );
    }
}
