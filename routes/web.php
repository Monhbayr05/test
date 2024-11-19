<?php

use App\Http\Controllers\PageContoller;
use Illuminate\Support\Facades\Route;

Route::controller(PageContoller::class)->group(function () {
    Route::get('/product', 'index')->name("index");
    Route::get('/product/create', 'create')->name("create");
    Route::post('/product/create', 'store')->name("store");
    Route::delete('/product/delete/{id}', 'destroy')->name('destroy');
    Route::get('/product/edit/{id}', 'edit')->name("edit");
    Route::put('/product/edit/{id}', 'update')->name("update");


    Route::get('product/image/{id}', 'image')->name("image");
    Route::post('product/image/{id}', 'imageStore')->name("imageStore");
    Route::delete('product/image/{id}', 'imageDestroy')->name("imageDestroy");
});

Route::get('/', function (){
   return view('pixel');
});



