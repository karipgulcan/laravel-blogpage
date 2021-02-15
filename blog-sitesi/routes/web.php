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
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
