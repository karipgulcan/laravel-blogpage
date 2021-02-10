<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Article;

class Homepage extends Controller
{
    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->get();
        $data['categories']=Category::inRandomOrder()->get();
        return view('front.homepage',$data);
    }

    public function single($slug){

        $data['article']=Article::where('slug',$slug)->first() ?? abort(403,'Böyle bir yazı henüz yazılmadı.');
        //dd($article);

        $data['categories']=Category::inRandomOrder()->get();
        return view('front.single',$data);
    }
}
