<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{

  //只让未登录用户可以去执行登录操作
  public function __construct()
  {
      $this->middleware('guest', [
          'only' => ['login']
      ]);
  }

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
        //return redirect()->route('users.show',[Auth::user()]);

        //redirect() 实例提供了一个 intended 方法，该方法可将页面重定向到上一次请求尝试访问的页面上，
        //并接收一个默认跳转地址参数，当上一次请求记录为空时，跳转到默认地址上
        return redirect()->intended(route('users.show', [Auth::user()]));

      }else{
        session()->flash('danger',"登录失败[用户名密码错]");
        return redirect()->back();
      }

    }



}
