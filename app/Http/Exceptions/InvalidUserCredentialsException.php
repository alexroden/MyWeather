<?php

namespace App\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InvalidUserCredentialsException extends NotFoundHttpException implements HttpExceptionInterface
{
    public function __construct()
    {
        parent::__construct('User not found.');
    }
}
