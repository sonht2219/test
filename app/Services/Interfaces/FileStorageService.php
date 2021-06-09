<?php


namespace App\Services\Interfaces;


interface FileStorageService
{
    /**
     * @param $file
     * @param string $folder
     * @param int $limit_width
     * @param float $resolution
     * @return mixed
     */
    public function storeFile($file, string $folder, $limit_width = 1000, $resolution = 0.8);

    /**
     * @param $files
     * @param string $folder
     * @param int $limit_width
     * @param float $resolution
     * @return mixed
     */
    public function storeFiles($files, string $folder, $limit_width = 1000, $resolution = 0.8);

    /**
     * @param string $path
     * @return mixed
     */
    public function removeFile(string $path);

    /**
     * @param array $paths
     * @return mixed
     */
    public function removeFiles(array $paths);

    /**
     * @param string $path
     * @return mixed
     */
    public function uploadedUrl(string $path);

    /**
     * @param string $path
     * @return mixed
     */
    public function fullPath(string $path);

    /**
     * @param string $path
     * @param int $new_width
     * @return mixed
     */
    public function compressImageKeepRatio(string $path, $new_width = 400);
}
