<?php 
namespace MakechTec\ImageConverter\Converters;

class Webp extends Converter {
    public function transform() : Converter {
        $imageToTrueColor = $this->imgFile->getGDImage();
        $this->tempFilename = $this->imgFile->uniqueName( '', '.' . $this->finalExtension());

        imagepalettetotruecolor($imageToTrueColor);
        imagewebp( $imageToTrueColor, $this->tempFilename );
        
        return $this;
    }

    public function supportedExtension(): array {
        return [
            'jpeg',
            'jpg',
            'png',
            'JPEG',
            'JPG',
            'PNG'
        ];
    }

    public function finalExtension(): string {
        return 'webp';
    }
}