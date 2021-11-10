<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class OriginalImage extends Model
{
    use HasFactory;

    protected $table = "original_images";

    public function image(){
        $this->belongsTo(Image::class);
    }
}
