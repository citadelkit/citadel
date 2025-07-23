<?php

namespace Citadel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


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

    public function load(Request $request)
    {
        $fileUrl = $request->filepath;
        $appUrl = url('');

        $fileHost = parse_url($fileUrl, PHP_URL_HOST);
        $appHost = parse_url($appUrl, PHP_URL_HOST);

        if ($fileHost === $appHost) {
            return redirect($fileUrl);
        }
        // handle if doc from another website
        try {
            $response = Http::get($fileUrl);
            // Get the actual content type from the response headers
            $contentType = $response->header('Content-Type') ?? 'application/octet-stream';

            return Response::make($response->body(), 200, [
                'Content-Type' => $contentType,
                'Access-Control-Allow-Origin' => '*',
            ]);
        } catch (\Exception $e) {
            return response('File could not be loaded.', 404);
        }
    }

    public function restore($filepath) {
        return response()->file(Storage::path('tmp'.DIRECTORY_SEPARATOR.$filepath));
    }

    public function fetch(Request $request) {

    }

    public function patch(Request $request) {

    }
}
