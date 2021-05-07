<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index(){
        $pages=Page::all();
        return view('back.pages.index',compact('pages'));
    }

    public function orders(Request $request){
        //print_r($request->get('orders'));
        //dd($request->get('page'));
        foreach($request->get('page') as $key=>$order){
            Page::where('id',$order)->Update(['order'=>$key]);
        }
    }

    public function create(){
        return view('back.pages.create');
    } 
    public function update($id){
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function updatePost(Request $request, $id)
    {
        //return "geldi";
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:1500'
        ]);
        //dd($request->post());
        $page=Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=Str::slug($request->title);//url yi uyumlu hale getirip kaydedecek

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='http://localhost:8000/uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Başarılı', 'Sayfa başarı ile güncellendi');
        return redirect()->route('admin.page.index');
    }

    public function post(Request $request){
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:1500'
        ]);

        $last=Page::orderBy('order','desc')->first();

        //dd($request->post());
        $page= new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order+1;
        $page->slug=Str::slug($request->title);//url yi uyumlu hale getirip kaydedecek

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='http://localhost:8000/uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Sayfa başarı ile oluşturuldu');
        return redirect()->route('admin.page.index');
    }

    public function delete($id){
        $page=Page::find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->delete(); 
        toastr()->success('Sayfa başarıyla silindi');
        return redirect()->route('admin.page.index');
    }

    public function switch(Request $request){
        //return $request->id;
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0 ;
        $page->save();
    }
}
