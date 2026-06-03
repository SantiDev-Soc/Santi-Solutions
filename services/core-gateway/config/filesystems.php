<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        // El disco local lo dejamos para cosas internas de Laravel
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        // ESTE ES TU DISCO COMPARTIDO
        'shared_media' => [
            'driver' => 'local',
            // base_path() apunta a /app, así que esto apunta a /app/shared/storage
            'root' => base_path('shared/storage'),
            // La URL que usará el navegador para ver la foto
            'url' => env('APP_URL') . '/shared_media',
            'visibility' => 'public',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        // ...
    ],

    /*
|--------------------------------------------------------------------------
| Symbolic Links
|--------------------------------------------------------------------------
*/
    'links' => [
        // Esto creará un acceso directo de public/shared_media -> shared/storage
        public_path('shared_media') => base_path('shared/storage'),
        public_path('storage') => storage_path('app/public'),
    ],

];
