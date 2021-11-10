<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Submit;
use App\Models\OriginalImage;
use App\Models\ConvertedImage;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    public function converion(){
        $this->belongsTo(Conversion::class);
    }

    public function original(){
        $this->hasOne(OriginalImage::class);
    }

    public function converted(){
        $this->hasOne(ConvertedImage::class);
    }
}
