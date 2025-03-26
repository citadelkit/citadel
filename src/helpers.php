<?php

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