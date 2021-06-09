<?php


namespace App\Services\Interfaces;

use Throwable;

interface LoggerService
{
    /**
     * @param Throwable $e
     */
    public function exception(Throwable $e);

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []);

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []);

    /**
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = []);
}
