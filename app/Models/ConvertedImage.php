<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class ConvertedImage extends Model
{
    use HasFactory;

    protected $table = "converted_images";

    public function image(){
        $this->belongsTo(Image::class);
    }
}
