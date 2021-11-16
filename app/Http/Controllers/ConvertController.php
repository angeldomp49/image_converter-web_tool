<?php

namespace App\Http\Controllers;

use App\MakechTec\Converters\Webp;
use App\MakechTec\ImgFile;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConvertController extends Controller{

    public $webpConverter;

    public function __construct(Webp $webpConverter){
        $this->webpConverter = $webpConverter;
    }

    public function __invoke(Request $request, Image $model){
        $originalFile = $this->readImage( $model);
        $convertedFile = $this->convert( $originalFile );

        $newModel = Image::create([
            'conversion_id' => $model->conversion_id,
            'name' => $convertedFile->getBasename(),
        ]);

        $this->writeInModel( $convertedFile,  );
    }

    private function readImage( Image $image ) : ImgFile{
        $tempImgFile = ImgFile::createInMemory();
        $tempImgFile->fwrite($image->raw);
        return $tempImgFile;
    }

    private function convert( ImgFile $originalFile ) : ImgFile{
        Storage::disk('local')->makeDirectory('image_converter');

        $relativeTempFileLocation = '/image_converter' . '/' . $this->webpConverter->changeNameExtension($originalFile);
        $temporaryFileLocation = storage_path( $relativeTempFileLocation );

        $this->webpConverter->convert( $originalFile, $temporaryFileLocation );
        $convertedFile = new ImgFile( $temporaryFileLocation );

        Storage::disk('local')->delete( $relativeTempFileLocation );

        return $convertedFile;
    }

    private function writeInModel( ImgFile $convertedFile, Image $model = null) : Image {
        if(empty($model)){
            $model = new Image();
        }

        $model->raw = $convertedFile->fread($convertedFile->getSize());

        return $model;
    }
}
