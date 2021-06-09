<?php


namespace App\Services\Impls;


use App\Services\Interfaces\LoggerService;
use Illuminate\Support\Facades\Log;
use Throwable;

class LoggerServiceImpl implements LoggerService
{

    /**
     * @param Throwable $e
     */
    public function exception(Throwable $e)
    {
        Log::error('MESSAGE: ' . $e->getMessage() . ' - FILE: ' . $e->getFile() . ' - LINE: ' . $e->getLine(), ['exception' => $e]);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = [])
    {
        Log::error($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = [])
    {
        Log::info($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = [])
    {
        Log::debug($message, $context);
    }
}
