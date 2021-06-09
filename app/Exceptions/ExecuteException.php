<?php


namespace App\Exceptions;

use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExecuteException extends HttpException
{
    public function __construct(?string $message = '', Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct(404, $message, $previous, $headers, $code);
    }
}
