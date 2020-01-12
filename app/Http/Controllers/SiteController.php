<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SiteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function welcome()
    {
        return View::make('welcome');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function backgroundImage(): BinaryFileResponse
    {
        $path = Storage::path('/public/default-image.png');

        return response()->file($path, [
            'Content-Length' => Storage::getSize('/public/default-image.png'),
            'Content-Type'   => Storage::mimeType('/public/default-image.png'),
            'Image-Src'      => $path,
        ]);
    }
}
