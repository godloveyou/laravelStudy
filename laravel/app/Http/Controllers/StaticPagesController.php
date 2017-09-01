<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class StaticPagesController extends Controller
{
    //
    public function home($value = '')
    {

        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feeds()->paginate(5);
        }
        return view('staticPages.home', compact('feed_items'));
    }

    public function about($value = '')
    {
        # code...
        return view('staticPages.about');
    }

    public function help($value = '')
    {
        # code...
        return view('staticPages.help');
    }


}
