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
@stop
