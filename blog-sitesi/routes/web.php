<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Nomalde bu şekilde kullanılıyor. Ama Controllerdan çalıştırmak istiyorsak yani dinamik bir şeyler yapıyorsak aşağıdaki şekilde kullanıyoruz.
Route::get('/', function () {
    return view('front.homepage');
});

*/

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/sayfa','App\Http\Controllers\Front\Homepage@index');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category'); // bu satırı bir alta alınca çalışmıyor sebebi is kategoriler tablosunda arıyıor bulamıyor hata veriyor
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');