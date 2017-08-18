<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  //开启字段白名单 否则插入数据异常
  protected $fillable = ['name', 'email','password'];
  public function gravatar($size=100)
  {
    $hash = md5(strtolower(trim($this->attributes['email'])));
    return "http://www.gravatar.com/avatar/$hash?s=$size";
  }
}
