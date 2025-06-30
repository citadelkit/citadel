<?php

namespace Citadel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;


class FilepondController extends BaseController {


    /**
     * Processing Filepond file upload expect unique location id
     *
     * File uploaded saved in temporary file.
     *
     * @param Illuminate\Support\Facades\Request $request,
     *
     */
    public function process(Request $request) {
        $location_id = substr(sha1(microtime()), 0, 20);
        $file = $request->file('file');
        $data = $file->storeAs("tmp/$location_id/".$file->getClientOriginalName());
        // return $location_id;
        return response()->json(['location_id' => $location_id]);

    }


    public function revert(Request $request) {

    }

    public function load(Request $request) {
            return redirect($request->filepath);
        // $filepath  = $request->filepath;
        // return response()->file(Storage::path($filepath));
        
    }

    public function restore($filepath) {
        return response()->file(Storage::path('tmp'.DIRECTORY_SEPARATOR.$filepath));
    }

    public function fetch(Request $request) {

    }

    public function patch(Request $request) {

    }
}
