<?php

use Illuminate\Support\Str;

if(!function_exists('vitadel')) 
{
    function vitadel($path) {
        $manifestPath = public_path('citadelkit/citadel/manifest.json');
        
        if (!file_exists($manifestPath)) {
            return asset("citadelkit/citadel/{$path}");
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        return asset("citadelkit/citadel/" . ($manifest[$path]['file'] ?? $path));
    }
}

if(!function_exists('strSnake')) 
{
    function strSnake(string $string) {
        try {
            return Str::snake($string);
        } catch (\Throwable $th) {
            dd(get_class_methods($string));
        }
    }
}