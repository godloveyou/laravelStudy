<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title','index')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basic.css') }}" rel="stylesheet">
  </head>
  <body>
     @include('layouts._header')
     <div class="container">
       <div class="col-md-offset-1 col-md-10">
        @include('shared._message')
        @yield('content')
        @include('layouts._footer')
      </div>
     </div>

   </body>
</html>
