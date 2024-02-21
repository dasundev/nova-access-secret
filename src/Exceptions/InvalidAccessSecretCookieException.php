<?php

namespace Dasundev\NovaAccessSecret\Exceptions;

use Exception;

class InvalidAccessSecretCookieException extends Exception
{
    protected $message = 'The provided access secret cookie is invalid.';
}