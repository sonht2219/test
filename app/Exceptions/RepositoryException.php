<?php


namespace App\Exceptions;

use Exception;
use Throwable;

class RepositoryException extends Exception
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
