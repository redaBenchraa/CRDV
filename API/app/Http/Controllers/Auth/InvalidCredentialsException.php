<?php

namespace App\Http\Controllers\Auth;


use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class InvalidCredentialsException extends UnauthorizedHttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct('', $message, $previous, $code);
    }
}