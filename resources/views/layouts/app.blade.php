<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><!--app()->getLocale()是获取app的locale值（zh_CH）-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>
     <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区')" />
  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

 @yield('styles')

</head>

<body>
  <div id="app" class="{{ route_class() }}-page">   <!--route_class()调用helpers的函数，该函数的目的是针对每个页面进行样式定制-->

    @include('layouts._header')

    <div class="container">

      @include('shared._messages')

      @yield('content')

    </div>

    @include('layouts._footer')
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
  
 @yield('scripts')
  
  
</body>

</html>