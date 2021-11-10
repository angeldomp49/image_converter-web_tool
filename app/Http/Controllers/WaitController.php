<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversion;

class WaitController extends Controller
{
    public function statusScreen(){
        return view('status_screen');
    }

    public function statusDispatcher(Conversion $conversion){
        return response()->json([
            'percentage' => $conversion->percentage,
            'to_convert' => $conversion->to_convert,
            'success' => $conversion->success,
            'errors' => $conversion->errors
        ]);
    }
}
