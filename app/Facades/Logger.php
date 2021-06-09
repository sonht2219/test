<?php


namespace App\Facades;


use App\Services\Interfaces\LoggerService;
use Illuminate\Support\Facades\Facade;

/**
 * Class Logger
 * @package App\Facades\Logger
 * @method static void exception(\Throwable $e)
 * @method static void error(string $message, array $context = [])
 * @method static void info(string $message, array $context = [])
 * @method static void debug(string $message, array $context = [])
 *
 * @see LoggerFactory
 */
class Logger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LoggerService::class;
    }
}
