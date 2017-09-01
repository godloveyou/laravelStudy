<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Auth;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:500'
        ]);


        Auth::user()->articles()->create([
            'content'=> $request->content
        ]);

        session()->flash('success','发布成功');
        return redirect()->back();
    }

    public function destroy(Article $article)
    {
        $this->authorize('destroy',$article);
        $article->delete();
        session()->flash('success',"微博删除成功");
        return redirect()->back();
    }



}
