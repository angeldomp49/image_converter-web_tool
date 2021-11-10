<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\OriginalImage;
use App\Models\Conversion;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;

class UploadController extends Controller
{
    public function form(){
        $submit = Conversion::create();
        return view('upload_form', compact('submit'));
    }

    public function uploadImage(Request $request){
        $image = Image::create([
            'submit_id' => $request->submit_id,
            'name' => $this->generateName($request->image->extension()),
            'raw' => $this->base64Content( $request->image )
        ]);

        $encrypted_id = Crypt::encryptString($image->id);

        $image->encrypted_id = $encrypted_id;
        $image->route = $this->genRoute( $encrypted_id );
        $image->save();

        OriginalImage::create([
            'image_id' => $image->id
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'success'
        ]);
    }

    public function endUploads(){
        //start the conversion in a new thread
        //add code here
        return redirect()->route('wait');
    }

    public function generateName( $extension ){
        return 'image_' . (new DateTime())->getTimestamp() . '.' . $extension;
    }

    public function base64Content( UploadedFile $file){
        return base64_encode( $file->getContent() );
    }

    public function genRoute( $encrypted_id ){
        return route('image.download', [ 'encrypted_id' => $encrypted_id ]);
    }
}
