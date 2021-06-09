<?php

use App\Enums\StorageFolder;

return [
    'mimes' => env('STORAGE_MIMES', 'png,jpg,jpeg,gif'),
    'path' => env('STORAGE_PATH', 'upload/images/'),
    'daily_folder' => env('STORAGE_DAILY_FOLDER', StorageFolder::PRODUCTS),
    'folder_enum' => env('STORAGE_FOLDER_ENUM')
];
