<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MakechTec\ImageConverter\Converters\Webp;
use MakechTec\ImageConverter\ImgFile;
use SplFileInfo;
use SplFileObject;

class PruebaController extends Controller
{
    public function image( Webp $converter ){

        // $instance = new ImgFile( public_path('storage/light.jpg') );

        $instance = ImgFile::createInMemory( Storage::disk('public')->get('light.jpg') );
        $image = $instance->rawSize;

        // $instance = new SplFileObject('php://memory', 'w+');
        // $instance->fwrite('some text');
        // $image = $instance->();

        return var_dump($image);

        // return response( $image )->header('Content-Type', 'image/jpeg');
    }
}
