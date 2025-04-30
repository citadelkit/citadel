<?php

namespace Citadel;

use Citadel\Components\Page;
use Citadel\Providers\AuthProvider;
use Citadel\Providers\CitadelServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\DirectoryAttributes;
use League\Flysystem\FileAttributes;
use League\Flysystem\StorageAttributes;
use RuntimeException;

class Citadel extends Facade
{
    static protected $index = 0;
    static protected $start_time = 0;

    public function page($name)
    {
        return Page::make($name);
    }

    public function menu() {}

    public function SidebarMenuRender() {}

    public static function response($data, $status_code = 200)
    {
        // if($data instanceof InteractiveComponent) {
        //     $data = $data->compile(false);
        // }
        return response()->json([
                'status_code' => $status_code,
                'citadel' => $data
            ], $status_code);
    }


    /**
     * Handle Fileupload based on Filepond
     *
     * @param string $directory_name unique folder id from filepond upload file
     * @return array
     */
    public static function moveFileUpload(string $directory_name, string $directory_target)
    {
        return collect(Storage::files("tmp/$directory_name"))
            ->map(function ($path) use ($directory_target) {
                $new_path = $directory_target . "/" . basename($path);
                Storage::move($path, "public/" . $new_path);
                return $new_path;
            });
    }

    public static function getIndex()
    {
        return static::$index++;
    }

    public static function startTimer()
    {
        static::$start_time = microtime(true);
    }

    public static function endTimer()
    {
        $end_time = microtime(true);
        return $end_time - static::$start_time . "s";
    }

    public static function authRoutes($options = [])
    {
        if (! static::$app->providerIsLoaded(CitadelServiceProvider::class)) {
            throw new RuntimeException('In order to use the Citadel::routes() method, please install the laravel/ui package first.');
        }
        
        static::$app->make('router')->auth($options);
    }
}
