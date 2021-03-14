<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\Dashboard;
use Illuminate\Support\Facades\Route;

/* Backend Routes */

    Route::get('/admin/giris','\Back\AuthController@login')->name('admin.login')->middleware(isLogin::class);
    Route::post('/admin/giris','\Back\AuthController@loginPost')->name('admin.login.post')->middleware(isLogin::class);

    Route::get('/admin/panel','\Back\Dashboard@index')->name('admin.dashboard')->middleware(isAdmin::class); //aslında admin.dashboard
    Route::get('/admin/cikis', '\Back\AuthController@logout')->name('admin.logout')->middleware(isAdmin::class); 




/* Front Routes */

Route::get('/','\Front\Homepage@index')->name('homepage');
Route::get('/sayfa','\Front\Homepage@index');
Route::get('/iletisim','\Front\Homepage@contact')->name('contact'); // sabit urlleri başta tanımlamamız gerekiyor.
Route::post('/iletisim','\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}', '\Front\Homepage@category')->name('category'); // bu satırı bir alta alınca çalışmıyor sebebi is kategoriler tablosunda arıyıor bulamıyor hata veriyor
Route::get('/{category}/{slug}','\Front\Homepage@single')->name('single');
Route::get('/{sayfa}','\Front\Homepage@page')->name('page');