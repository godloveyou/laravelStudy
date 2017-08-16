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
       @yield('content')

     </div>
     @include('layouts._footer')
   </body>
</html>
