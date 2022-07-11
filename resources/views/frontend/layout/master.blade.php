<!DOCTYPE html>
<html>
  <head>
      @include('frontend.layout.head')
      @livewireStyles
      @yield('styles')
  </head>
  <body>
    <div class="page-holder">
      @include('frontend.layout.nav')
      {{-- @yield('content') --}}
      {{ $slot }}
      @include('frontend.layout.footer')
      @include('frontend.layout.footerjs')
      @livewireScripts
      @yield('scripts')
    </div>
  </body>
</html>
