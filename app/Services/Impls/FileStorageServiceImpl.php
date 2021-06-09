<?php


namespace App\Services\Impls;


use App\Helper\Constant;
use App\Services\Interfaces\FileStorageService;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Exception;
use RuntimeException;

class FileStorageServiceImpl implements FileStorageService
{

    private $upload_path;
    private $acceptedMimes;
    private $dailyFolder;
    private array $compressibleExtension = ['jpg', 'jpeg', 'png'];

    public function __construct()
    {
        $this->upload_path = config('storage.path');
        $this->acceptedMimes = explode(',', config('storage.mimes'));
        $this->dailyFolder = explode(',', config('storage.daily_folder'));
    }

    /**
     * @param $file
     * @param string $folder
     * @param int $limit_width
     * @param float $resolution
     * @return mixed
     */
    public function storeFile($file, string $folder, $limit_width = 1000, $resolution = 0.8)
    {
        if (!$file)
            throw new BadRequestHttpException(__('messages.not_found_file'));
        try {
            $resource = ImageManagerStatic::make($file);
            $extension = str_replace('image/', '', $resource->mime());
            if (!Str::contains($extension, $this->acceptedMimes))
                throw new BadRequestHttpException(__('messages.invalid_file_type'));
            $folder = $this->resolveFolder($folder);
            $file_name = $this->generateName($extension);
            $path = $folder
                ? $folder . '/' . $file_name
                : $file_name;

            if (in_array($extension, $this->compressibleExtension)) {
                $this->compressResourceImage($resource, $path, $limit_width, $resolution);
            } else {
                $this->saveFile($resource, $path);
            }
            return $path;
        } catch (Exception $e) {
            if (!$file instanceof UploadedFile) {
                throw new RuntimeException('Not support save by string with non-image file.');
            }
            $extension = $file->extension();
            if (!Str::contains($extension, $this->acceptedMimes))
                throw new BadRequestHttpException(__('messages.invalid_file_type'));
            $file_name = $this->generateName($extension);
            $path = $folder
                ? $folder . '/' . $file_name
                : $file_name;
            $file->move(public_path($this->upload_path . $path));
            return $path;
        }
    }

    /**
     * @param $files
     * @param string $folder
     * @param int $limit_width
     * @param float $resolution
     * @return mixed
     */
    public function storeFiles($files, string $folder, $limit_width = 1000, $resolution = 0.8)
    {
        $result = [];
        foreach ($files as $file)
            $result[] = $this->storeFile($file, $folder, $limit_width, $resolution);

        return $result;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function removeFile(string $path)
    {
        $true_path = public_path($this->upload_path . $path);
        return File::delete($true_path);
    }

    /**
     * @param array $paths
     */
    public function removeFiles(array $paths)
    {
        foreach ($paths as $path)
            $this->removeFile($path);
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function uploadedUrl(string $path)
    {
        return url($this->upload_path . $path);
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function fullPath(string $path)
    {
        return '/' . $this->upload_path . $path;
    }

    /**
     * @param string $path
     * @param int $new_width
     * @return mixed
     */
    public function compressImageKeepRatio(string $path, $new_width = 400)
    {
        $new_path = $this->generatePathFromOldPath($path);
        $source_image = ImageManagerStatic::make(public_path($this->upload_path . $path));
        $this->compressResourceImage($source_image, $new_path, $new_width);
        return $new_path;
    }


    private function resolveFolder($folder = '') {
        if ($folder && in_array($folder, $this->dailyFolder))
            $folder .= '/' . Carbon::now()->format(Constant::FOLDER_LIKE_DATE_FORMAT);

        $folder = $folder ?? '';

        $folder_path = public_path($this->upload_path . $folder);
        if (!File::isDirectory($folder_path))
            File::makeDirectory($folder_path, 0755, true);

        return $folder;
    }

    private function compressResourceImage($source_image, $path, $limit_width = 400, $quality = .8) {
        $width = $source_image->width();
        $height = $source_image->height();
        if ($width > $limit_width) {
            $source_image = $source_image
                ->resize($limit_width, $limit_width * $height / $width)
                ->encode('jpg', $quality * 100);
        }
        $this->saveFile($source_image, $path);
    }

    /**
     * @param Image $source_image
     * @param string $path
     */
    private function saveFile($source_image, $path)
    {
        $source_image->save(public_path($this->upload_path . $path));
    }

    private function generateName($extension = 'jpg') {
        return Str::random(10) . '-' . round(microtime(true)) . '.' . $extension;
    }

    private function generatePathFromOldPath($old_path, $new_extension = 'jpg') {
        $path_extract = explode('/', $old_path);
        $path_extract[count($path_extract) - 1] = $this->generateName($new_extension);
        return implode('/', $path_extract);
    }
}
