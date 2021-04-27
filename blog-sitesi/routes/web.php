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
    Route::get('giris','\Back\AuthController@login')->name('login');
    Route::post('giris','\Back\AuthController@loginPost')->name('login.post');
});
    

Route::prefix('admin')->name('admin.')->middleware(isAdmin::class)->group(function(){
    Route::get('panel','\Back\Dashboard@index')->name('dashboard'); //aslında admin.dashboard
    Route::resource('makaleler', 'Back\ArticleController');
    
    Route::get('cikis', '\Back\AuthController@logout')->name('logout'); 
});

Route::resource('admin/makaleler', ArticleController::class)->except([
            'create', 'store', 'update', 'destroy'
        ]);

    




/* Front Routes */

Route::get('/','\Front\Homepage@index')->name('homepage');
Route::get('/sayfa','\Front\Homepage@index');
Route::get('/iletisim','\Front\Homepage@contact')->name('contact'); // sabit urlleri başta tanımlamamız gerekiyor.
Route::post('/iletisim','\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}', '\Front\Homepage@category')->name('category'); // bu satırı bir alta alınca çalışmıyor sebebi is kategoriler tablosunda arıyıor bulamıyor hata veriyor
Route::get('/{category}/{slug}','\Front\Homepage@single')->name('single');
Route::get('/{sayfa}','\Front\Homepage@page')->name('page');