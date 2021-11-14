<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('prueba')->name('prueba.')->group(function(){
    Route::get('ajax', function(){
        return response()->json([
            'percentage' => 35.3,
            'to_convert' => 5,
            'success' => 3,
            'errors' => 1
        ]);
    })->name('ajax');

    Route::get('waiting', function(){
        return view('waiting');
    });
});