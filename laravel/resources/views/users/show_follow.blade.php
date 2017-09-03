@extends('layouts.default')
@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
@foreach ($users as $user)
<div class="panel panel-primary">
    <div class="panel-heading">{{$user->name}}</div>

    <div class="panel-body">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </div>

</div>
@endforeach

{!! $users->render() !!}

@stop
