<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;


class Homepage extends Controller
{
    public function __construct(){
        
        view()->share('pages',$data['pages']=Page::orderBy('order','ASC')->get()); 
        view()->share('categories', $data['categories']=Category::inRandomOrder()->get()); 
    }

    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('/sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category,$slug){

        $category=Category::where('slug',$category)->first() ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        $article=Article::where('slug',$slug)->first() ?? abort(403,'Böyle bir yazı henüz yazılmadı.');
        $article->increment('hit'); 
        return view('front.single', [
            'article' => $article
        ]); 
    }

    public function category($slug){

        $category = Category::where('slug',$slug)->first() 
                    ?? abort(403,'Böyle bir kategori henüz eklenmedi.');
        return view('front.category', [
            'category' => $category,
            'articles' => Article::where('category_id', $category->id)
                            ->orderBy('created_at','DESC')
                            ->paginate(2)
        ]);
    }

    public function page($slug){

        $page=Page::where('slug',$slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı.');
        $data['page']=$page;
        return view('front.page', $data);
    }

    public function contact(){
        return view('front.contact');
    }

    public function contactpost(Request $request){

        $rules =[
            'name'=>'required|min:2',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:7'
        ];


        $validate=Validator::make($request->post(),$rules);

        if($validate->fails()){

            return redirect()->route('contactpost')->withErrors($validate)->withInput();
            //print_r($validate->errors()->first('message'));

        }
        //die;

        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route('contactpost')->with('success','Mesajınız bize iletildi.'); //iletişim sayfasının url si
        //print_r($request->post());
    }
}
