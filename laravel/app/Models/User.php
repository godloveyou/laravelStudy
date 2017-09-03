<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Auth;
class User extends Authenticatable
{
    //开启字段白名单 否则插入数据异常
    protected $fillable = ['name', 'email', 'password'];

    //关注方法
    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    //取消关注
    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }


    //获取用户所有粉丝
    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'followers', 'user_id', 'follower_id');
    }

    //获取用户关注的人
    public function followings()
    {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'user_id');
    }

    //判断登录用户是否关注了用户b
    public function isFollow($user_id)
    {
        return $this->followings->contains($user_id);
    }

    //通过该方法构建用户与微博1对多的关系
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    //用户头像
    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //boot 方法会在用户模型类完成初始化之后进行加载，因此我们对事件的监听需要放在该方法中
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    //查询关注者的微博动态
    public function feeds()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        //将登录者的id也加入进来，否则就只显示关注者的微博，而没有自己的
        array_push($user_ids, Auth::user()->id);
        return Article::whereIn('user_id',$user_ids)
                ->with('user')
                ->orderBy('created_at','desc');
    }
}
