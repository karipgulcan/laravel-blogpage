<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

use Validator;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;


class Homepage extends Controller
{
    public function __construct(){
        
        view()->share('pages',$data['pages']=Page::where('status',1)->orderBy('order','ASC')->get()); 
        view()->share('categories', $data['categories']=Category::where('status',1)->inRandomOrder()->get()); 
    }

    public function index(){
        $data['articles']=Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(6);
        //dd($data['articles']);
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
            'articles' => Article::where('category_id', $category->id)->where('status',1)
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
        
        Mail::raw('Mesajı Göderen:'.$request->name.'
                   Mesajı Gönderen Mail:'.$request->email. '
                   Mesaj Konusu: '.$request->topic. '
                   Mesaj : '.$request->message. '
                   Mesaj Gönderilme Tarihi: '.now(). '',function($message) use($request){

                    $message->from('blog@gulcankarip.com','Blog Sitesi');
                    $message->to('karipgulcan@gmail.com');
                    $message->subject($request->name. ' iletişimden mesaj gönderdi');
        });
        
        /*
        Mail::raw([],[], function($message) use($request){
            $message->from('blog@gulcankarip.com','Blog Sitesi');
            $message->to('karipgulcan@gmail.com');
            $message->setBody('Mesajı Göderen:'.$request->name.'
                Mesajı Gönderen Mail:'.$request->email. '<br/>
                Mesaj Konusu: '.$request->topic. '<br/>
                Mesaj : '.$request->message. '<br/><br/>
                Mesaj Gönderilme Tarihi: '.now(). '','text/html');
            $message->subject($request->name. ' iletişimden mesaj gönderdi');
            
        });
        */
        
        //die;

       // $contact = new Contact;
       // $contact->name=$request->name;
       // $contact->email=$request->email;
       // $contact->topic=$request->topic;
       // $contact->message=$request->message;
       // $contact->save();
        return redirect()->route('contactpost')->with('success','Mesajınız bize iletildi.'); //iletişim sayfasının url si
        //print_r($request->post());
    }
}
