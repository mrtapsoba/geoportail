<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class ImageController extends Controller
{
    /*
    public function displayImage($filename)

    {



        $path = storage_public('images/' . $filename);



        if (!File::exists($path)) {

            abort(404);
        }



        $file = File::get($path);

        $type = File::mimeType($path);



        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);



        return $response;
    }*/
}
