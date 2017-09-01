@extends('layouts.default')
@section('title',"个人信息")
@section('content')
<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      <div class="col-md-offset-2 col-md-8">
        <section class="user_info">
          @include('shared._userinfo', ['user' => $user])
        </section>
      </div>
    </div>
  </div>
</div>

  <div class="row">
    @foreach ($articles as $article)
      <div class="panel panel-primary">
        <div class="panel-heading">{{$user->name}}</div>

        <div class="panel-body">
          {{$article->content}}
        </div>
        <div class="panel-footer">  {{ $article->created_at->diffForHumans() }}</div>
      </div>
    @endforeach
  </div>
@stop
