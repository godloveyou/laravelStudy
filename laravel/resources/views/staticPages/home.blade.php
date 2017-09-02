@extends('layouts.default')
@section('title','首页')
@section('content')

  @if (Auth::check())
    <div class="row" style="margin-top: 30px">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._create_article_form')
        </section>

        <h3>微博列表</h3>
        @include('shared._feed')
      </div>

    </div>
  @else

  <div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
      你现在所看到的是 <a href="https://fsdhub.com/books/laravel-essential-training-5.1">Laravel 入门教程</a> 的示例项目主页。
    </p>
    <p>
      一切，将从这里开始。
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{route('signup')}}" role="button">现在注册</a>
    </p>
  </div>
  @endif
@stop
