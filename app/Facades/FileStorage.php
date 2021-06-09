<?php


namespace App\Facades;


use App\Services\Interfaces\FileStorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * Class FileStorage
 * @package App\Facades
 *
 * @method static string uploadedUrl(string $path)
 * @method static string fullPath(string $path)
 * @method static string storeFile(string|UploadedFile $file, string $folder)
 * @method static string[]|array storeFiles(string[]|UploadedFile[] $file, string $folder)
 * @method static boolean removeFile(string $path)
 * @method static void removeFiles(string[]|array $paths)
 */
class FileStorage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FileStorageService::class;
    }
}
