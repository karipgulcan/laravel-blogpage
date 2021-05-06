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
    //MAKALE ROUTE'S
    Route::get('makaleler/silinenler','\App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler', '\App\Http\Controllers\Back\ArticleController');
    Route::get('/switch','\App\Http\Controllers\Back\ArticleController@switch')->name('switch');
    Route::get('/deletearticle/{id}','\App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle/{id}','\App\Http\Controllers\Back\ArticleController@harddelete')->name('hard.delete.article');
    Route::get('/recoverarticle/{id}','\App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');
    //CATEGORY ROUTE'S
    Route::get('/kategoriler','\App\Http\Controllers\Back\CategoryController@index')->name('category.index');
    Route::get('/kategoriler/create','\App\Http\Controllers\Back\CategoryController@create')->name('category.create');
    Route::get('/kategoriler/update','\App\Http\Controllers\Back\CategoryController@update')->name('category.update');
    Route::get('/kategoriler/delete','\App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');
    Route::get('/kategori/status','\App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
    Route::get('/kategori/getData','\App\Http\Controllers\Back\CategoryController@getData')->name('category.getdata');
    //PAGES ROUTE'S
    Route::get('/sayfalar','\App\Http\Controllers\Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/olustur','\App\Http\Controllers\Back\PageController@create')->name('page.create');
    Route::get('/sayfalar/guncelle/{id}','\App\Http\Controllers\Back\PageController@update')->name('page.edit');
    Route::post('/sayfalar/guncelle/{id}','\App\Http\Controllers\Back\PageController@updatePost')->name('page.edit.post');
    Route::post('/sayfalar/olustur','\App\Http\Controllers\Back\PageController@post')->name('page.create.post');
    Route::get('/sayfa/switch','\App\Http\Controllers\Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/sil/{id}','\App\Http\Controllers\Back\PageController@delete')->name('page.delete');
    //AUTH ROUTE
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