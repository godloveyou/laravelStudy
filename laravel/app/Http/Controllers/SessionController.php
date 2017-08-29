<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{

  public function destory()
  {
    Auth::logout();
    session()->flash('success', '您已经退出登录');
    return redirect('login');
  }

    //
    public function toLogin()
    {
      return view('session.login');
    }

    public function login(Request $request)
    {
      $this->validate($request,[
        'email'=>'required|email|max:255',
        'password'=>'required'
      ]);

      $usercred = [
        'email'=>$request['email'],
        'password'=>$request['password']
      ];

      if(Auth::attempt($usercred,$request->has('remember'))){
        session()->flash('success',"登录成功");
        return redirect()->route('users.show',[Auth::user()]);

      }else{
        session()->flash('danger',"登录失败[用户名密码错]");
        return redirect()->back();
      }

    }



}
