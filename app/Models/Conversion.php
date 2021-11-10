<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class Conversion extends Model
{
    use HasFactory;

    protected $table = "conversions";

    public function images(){
        return $this->hasMany(Image::class);
    }
}
