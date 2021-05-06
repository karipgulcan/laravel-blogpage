<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
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

 public function update(Request $request){
    //print_r($request->post());
    $isSlug=Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first(); //aynı şekilde name den de sorgulayabilirdik. Laravel bunuda destekliyor.
    $isName=Category::whereName($request->category)->whereNotIn('id',[$request->id])->first(); //aynı şekilde name den de sorgulayabilirdik. Laravel bunuda destekliyor.
    if($isName or $isSlug){
        toastr()->error($request->category.' adında bir kategori zaten mevcut!');
        return redirect()->back();
    }
    $category=Category::find($request->id);
    $category->name=$request->category;
    $category->slug=Str::slug($request->slug);
    $category->save();
    toastr()->success('Kategori başarıyla güncellendi');
    return redirect()->back();
}
public function delete(Request $request){
    $category=Category::findOrFail($request->id);
    if($category->id==1){
        toastr()->error('Bu kategori silinemez!');
        return redirect()->back();
    }
    $message=null;
    $count=$category->articleCount();
    if($count>0){
        Article::where('category_id',$category->id)->update(['category_id'=>1]);
        $defaulCategory=Category::find(1);
        $message='Bu kategoriye ait ' .$count.' makale '.$defaulCategory->name. ' kategorisine taşındı';
    }
    $category->delete();
    toastr()->success($message,' Kategori başarıyla silindi.');
    return redirect()->back();
}

 public function getData(Request $request){
    $category=Category::findOrFail($request->id);
    return response()->json($category);
}

 public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ; // if($request->statu =='1' ..... olayının kısaltılmış hali) string olduğu için
        $category->save();
}

}
