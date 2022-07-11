<!DOCTYPE html>
<html>
  <head>
    @include('layouts.head')
  </head>
  <body>
    <div class="page-holder">
        <!-- navbar-->
        @include('layouts.nav')
        <!-- HERO SECTION-->
        {{ $slot }}
        {{-- footer --}}
        @include('layouts.footer')
        <!-- JavaScript files-->
        @include('layouts.footerjs')
    </div>
  </body>
</html>
