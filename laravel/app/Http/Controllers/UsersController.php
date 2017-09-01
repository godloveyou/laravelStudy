<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'store', 'create', 'index', 'destroy', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['register']
        ]);
    }



    //用户列表
    public function index()
    {
        //$users = User::all();
        $users = User::paginate(2);
        return view('users.index', compact('users'));
    }

    //删除
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    //更新用户
    public function update(User $user, Request $request)
    {
        //授权检查  在 Laravel 中可以使用 授权策略 (Policy) 来对用户的操作权限进行验证，在用户未经授权进行操作时将返回 403 禁止访问的异常。
        //https://fsdhub.com/books/laravel-essential-training-5.5/599/permissions-system
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '更新成功');
        return redirect()->route('users.show', $user->id);

    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function show(User $user)
    {
        //return view('users.show', compact('user'));
        $articles = $user->articles()
            ->orderBy('created_at','desc')
            ->paginate(30);
        return view('users.show',compact('user','articles'));
    }

    //发送激活邮件
    public function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'aufree@yousails.com';
        $name = 'Aufree';
        $to = $user->email;
        $subject = "感谢注册应用!请确认你的邮箱";
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    //注册
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //让用户注册成功后自动登录
        //Auth::login($user);
        //return redirect()->route('users.show',[$user]);

        //发送激活邮件
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '激活邮件已经发送到您的邮箱，点击链接激活账户');
        return redirect("/");
    }


    //激活操作
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }


}
