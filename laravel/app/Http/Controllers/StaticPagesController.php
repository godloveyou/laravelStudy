<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //
    public function home($value='')
    {
      # code...
      return view('staticPages.home');
    }

    public function about($value='')
    {
      # code...
      return view('staticPages.about');
    }

    public function help($value='')
    {
      # code...
      return view('staticPages.help');
    }


}
