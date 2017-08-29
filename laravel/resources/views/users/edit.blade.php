@extends('layouts.default')
@section('title', '编辑个人资料')

@section('content')
<div class="col-md-offset-2 col-md-8" style="margin-top:100px">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>编辑个人资料</h5>
    </div>
    <div class="panel-body">
      @include('shared._error')
      <form method="post" action="{{ route('users.update',$user->id) }}">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
          </div>

          <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="form-control" value="{{$user->email }}" disabled>
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{old('password')}}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </div>
  </div>
</div>
@stop
