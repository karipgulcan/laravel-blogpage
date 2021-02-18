<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;


class Homepage extends Controller
{
    public function __construct(){
        view()->share('pages',$data['pages']=Page::orderBy('order','ASC')->get()); //bu data tüm viewlerde çalışıyor
        view()->share('categories',$data['categories']=Category::inRandomOrder()->get()); 
    }

    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('/sayfa'));
        return view('front.homepage',$data);
    }

    public function single($category,$slug){

        $category=Category::where('slug',$category)->first() ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        $article=Article::where('slug',$slug)->first() ?? abort(403,'Böyle bir yazı henüz yazılmadı.');
        $article->increment('hit');
        $data['article']=$article;
        return view('front.single',$data);
    }

    public function category($slug){

        $category=Category::where('slug',$slug)->first() ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        $data['category']=$category;
        $data['articles']=Article::where('category_id', $category->id)->orderBy('created_at','DESC')->paginate(2);
        return view('front.category',$data);
    }

    public function page($slug){

        $page=Page::where('slug',$slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı.');
        $data['page']=$page;
        return view('front.page',$data);
    }
}
