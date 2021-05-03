<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;


/* Backend Routes */
Route::prefix('admin')->name('admin.')->middleware(isLogin::class)->group(function(){
    Route::get('giris','App\Http\Controllers\Back\AuthController@login')->name('login');
    Route::post('giris','App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});
    

Route::prefix('admin')->name('admin.')->middleware(isAdmin::class)->group(function(){
    Route::get('panel','App\Http\Controllers\Back\Dashboard@index')->name('dashboard'); //aslında admin.dashboard
    Route::resource('makaleler', '\App\Http\Controllers\Back\ArticleController');
    Route::get('/switch/{id}','\App\Http\Controllers\Back\ArticleController')->name('switch');
    Route::get('cikis', 'App\Http\Controllers\Back\AuthController@logout')->name('logout'); 
});

/*
Route::resource('admin/makaleler', ArticleController::class)->except([
            'create', 'store', 'update', 'destroy'
        ]);
*/
    




/* Front Routes */

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/sayfa','App\Http\Controllers\Front\Homepage@index');
Route::get('/iletisim','App\Http\Controllers\Front\Homepage@contact')->name('contact'); // sabit urlleri başta tanımlamamız gerekiyor.
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category'); // bu satırı bir alta alınca çalışmıyor sebebi is kategoriler tablosunda arıyıor bulamıyor hata veriyor
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');