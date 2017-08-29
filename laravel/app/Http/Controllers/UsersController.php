<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UsersController extends Controller
{

    public function register()
    {
      return view('users.create');
    }


    public function show(User $user)
    {
      return view('users.show',compact('user'));
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:50',
        'email'=>'required|email|unique:users',
        'password'=>'confirmed'
      ]);

      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password)
      ]);

      //让用户注册成功后自动登录
      Auth::login($user);

      session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
      return redirect()->route('users.show',[$user]);
    }
}
