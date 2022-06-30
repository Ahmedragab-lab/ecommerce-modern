<!DOCTYPE html>
<html>
  <head>
      @include('frontend.layout.head')
  </head>
  <body>
    <div class="page-holder">
      @include('frontend.layout.nav')
      @yield('content')
      @include('frontend.layout.footer')
      @include('frontend.layout.footerjs')
    </div>
  </body>
</html>
