<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('admin/panel','App\Http\Controllers\Back\Dashboard@index')->name('admin.dashboard');
Route::get('admin/giris','App\Http\Controllers\Back\Auth@login')->name('admin.login');



/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
|
|    Nomalde bu şekilde kullanılıyor. Ama Controllerdan çalıştırmak istiyorsak yani dinamik bir şeyler yapıyorsak aşağıdaki şekilde kullanıyoruz.
|    Route::get('/', function () {
|       return view('front.homepage');
|    });
|
*/

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/sayfa','App\Http\Controllers\Front\Homepage@index');
Route::get('/iletisim','App\Http\Controllers\Front\Homepage@contact')->name('contact'); // sabit urlleri başta tanımlamamız gerekiyor.
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category'); // bu satırı bir alta alınca çalışmıyor sebebi is kategoriler tablosunda arıyıor bulamıyor hata veriyor
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');


