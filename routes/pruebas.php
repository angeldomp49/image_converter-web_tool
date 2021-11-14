<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('prueba')->name('prueba.')->group(function(){
    Route::get('ajax', function(){
        return response()->json([
            'some_data' => 'in ajax'
        ]);
    })->name('ajax');

    Route::get('waiting', function(){
        return view('waiting');
    });
});