@extends('layouts.default')
@section('title',"用户列表")
@section('content')
<div class="row" style="margin-top:100px">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      <table class="table table-striped">
          <caption>列表</caption>
          <thead>
          <tr>
            <th>Logo</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
          </tr>
          </thead>

          <tbody>
          @foreach($users as $user)
          <tr>
                <td> <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/></td>
                <td><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>
                    @can('destroy', $user)
                     <form action="{{ route('users.destroy', $user->id) }}" method="post">
                       {{ csrf_field() }}
                       {{ method_field('DELETE') }}
                       <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
                     </form>
                   @endcan
               </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      {!! $users->render() !!}

    </div>
  </div>
</div>
@stop
