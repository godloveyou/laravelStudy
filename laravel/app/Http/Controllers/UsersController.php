<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UsersController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth',[
        'except'=>['show','store','create','index','destroy']
      ]);

      $this->middleware('guest', [
           'only' => ['register']
       ]);
    }

    public function index()
    {
      //$users = User::all();
      $users = User::paginate(2);
      return view('users.index',compact('users'));
    }

    public function destroy(User $user)
    {
       $this->authorize('destroy', $user);
       $user->delete();
       session()->flash('success', '成功删除用户！');
       return back();
    }

    public function update(User $user,Request $request)
    {
      //授权检查  在 Laravel 中可以使用 授权策略 (Policy) 来对用户的操作权限进行验证，在用户未经授权进行操作时将返回 403 禁止访问的异常。
      //https://fsdhub.com/books/laravel-essential-training-5.5/599/permissions-system
      $this->authorize('update', $user);

      $this->validate($request,[
        'name'=>'required|max:50',
        'password'=>'nullable|confirmed|min:6'
      ]);
      $data = [];
      $data['name'] = $request->name;
      if($request->password){
        $data['password'] = bcrypt($request->password);
      }
      $user->update($data);
      session()->flash('success','更新成功');
      return redirect()->route('users.show',$user->id);

    }

    public function edit(User $user)
    {
      return view('users.edit',compact('user'));
    }

    public function create()
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
