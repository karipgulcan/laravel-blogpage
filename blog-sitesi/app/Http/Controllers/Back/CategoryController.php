<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
 public function index(){
     $categories=Category::all();
     return view('back.categories.index',compact('categories'));
 }
 public function create(Request $request){
     //print_r($request->post());
     $isExist=Category::whereSlug(Str::slug($request->category))->first(); //aynı şekilde name den de sorgulayabilirdik. Laravel bunuda destekliyor.
     if($isExist){
         toastr()->error($request->category.' adında bir kategori zaten mevcut!');
         return redirect()->back();
     }
     $category=new Category;
     $category->name=$request->category;
     $category->slug=Str::slug($request->category);
     $category->save();
     toastr()->success('Kategori başarıyla oluşturuldu');
     return redirect()->back();
 }
 public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ; // if($request->statu =='1' ..... olayının kısaltılmış hali) string olduğu için
        $category->save();
}
}
