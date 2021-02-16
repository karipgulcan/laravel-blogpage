<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Article;
use App\Models\Category;

class Homepage extends Controller
{
    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->get();
        $data['categories']=Category::inRandomOrder()->get();
        return view('front.homepage',$data);
    }

    public function single($category,$slug){

        $category=Category::where('slug',$category)->first() ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        $article=Article::where('slug',$slug)->first() ?? abort(403,'Böyle bir yazı henüz yazılmadı.');
        //dd($article);
        $article->increment('hit');
        $data['article']=$article;
        $data['categories']=Category::inRandomOrder()->get();
        return view('front.single',$data);
    }

    public function category($slug){
        $category=Category::where('slug',$slug)->first() ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        $data['category']=$category;
        $data['articles']=Article::where('category_id', $category->id)->orderBy('created_at','DESC')->get();
        $data['categories']=Category::inRandomOrder()->get();
        return view('front.category',$data);
    }
}
